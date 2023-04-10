<?php

namespace App\Http\Controllers\Admin;

use App\Review;
use App\Category;
use App\Slug;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyReviewRequest;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Site;
use App\Store;
use App\Tag;
use App\User;
use App\Author;
use Gate;
use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ReviewController extends Controller
{
    public function __construct() {
        $this->slug = new Slug;
    }

    protected $table   = 'reviews';
    protected $primaryKey   = 'id';
    protected $slug_prefix  = 'review/';
    protected $page_type    = 'categories';

    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('review_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $status = (isset(request()->test_id) ? !request()->test_id > 0 : !getSiteID() > 0);
        if($status) return redirect('/admin');

        if ($request->ajax()) {
            $query = Review::with(['sites'])->select(sprintf('%s.*', (new Review)->table));

            if(isset($request->bid)) {
                $query = $query->where('id', $request->bid);
            }

            $query = $query->whereHas('sites', function($q) use($request) {
                if($request->siteId != 'all') {
                    if(!empty($request->siteId)) {
                        $q->where('site_id', $request->siteId);
                    } elseif (isset(request()->test_id)) {
                        $q->where('site_id', request()->test_id);
                    } else {
                        $q->where('site_id', getSiteID());
                    }
                }
            });
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'review_show';
                $editGate      = 'review_edit';
                $deleteGate    = 'review_delete';
                $crudRoutePart = 'reviews';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('site', function ($row) {
                $labels = [];

                foreach ($row->sites as $site) {
                    $labels[] = sprintf('<span class="badge badge-info">%s</span>', $site->country_name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('title', function ($row) {
                return $row->title;
            });
            $table->editColumn('sort', function ($row) {
                return $row->sort ? $row->sort : "";
            });

            $table->editColumn('publish', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->publish ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'site', 'title', 'publish']);

            return $table->make(true);
        }

        return view('admin.reviews.index');
    }

    public function create()
    {
        abort_if(Gate::denies('review_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $status = (isset(request()->test_id) ? !request()->test_id > 0 : !getSiteID() > 0);
        if($status) return redirect('/admin');

        $sites = Site::all()->pluck('name', 'id');

        $categories = Category::all()->pluck('title', 'id');

        $users = User::all()->pluck('name', 'id');

        $tags = Tag::all()->pluck('title', 'id');

        $authors = Author::all()->pluck('full_name', 'id');
        
        $stores = Store::with('sites')->whereHas('sites', function($q) {
            $q->where('site_id', isset(request()->test_id) ? request()->test_id : getSiteID());
        })->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.reviews.create', compact('sites', 'categories', 'tags', 'users', 'stores', 'authors'));
    }

    public function store(StoreReviewRequest $request)
    {
        $review = Review::create($request->all());
        $review->sites()->sync($request->input('sites', []));
        $review->categories()->sync($request->input('categories', []));
        $review->store_details()->sync($request->input('stores', []));
        $review->tags()->sync($request->input('tags', []));

        $last_id    = $review->id;
        $slug       = $review->slug;

        $return = $this->slug->insertSlug($last_id, $this->slug_prefix . $slug, $this->table, $request->input('sites', []));
        if (isset($return['status']) && $return['status'] === false) {
            return $return;
        }

        if (\App::environment('production')) {
            if ($request->input('image', false)) {
                $review->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->addCustomHeaders([
                    'ACL' => 'public-read'
                ])->toMediaCollection('image','s3');
            }
        } else {
            if ($request->input('image', false)) {
                $review->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
            }
        }

        $reviewUpdate = Review::select('id','title','review_image')->where('id',$last_id)->first();
        $img = $reviewUpdate['image'] ? $reviewUpdate['image']['url'] : '';
        if ($request->input('image', false)) {
            $path['review_image'] = $img;
            Review::where('id', $last_id)->update($path);
        }

        if(isset($request->test_id)) {
            $url = route('admin.reviews.index') . $request->test_id;
        } else {
            $url = route('admin.reviews.index');
        }

        return redirect($url);
    }

    public function edit(Review $review)
    {
        abort_if(Gate::denies('review_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $status = (isset(request()->test_id) ? !request()->test_id > 0 : !getSiteID() > 0);
        if($status) return redirect('/admin');

        $sites = Site::all()->pluck('name', 'id');

        $categories = Category::all()->pluck('title', 'id');

        $users = User::all()->pluck('name', 'id');

        $tags = Tag::all()->pluck('title', 'id');

        $authors = Author::all()->pluck('full_name', 'id');
        
        $stores = Store::with('sites')->whereHas('sites', function($q) use($review) {
            if($review->sites()->pluck('site_id')->count() > 0) {
                $q->whereIn('site_id', $review->sites()->pluck('site_id'));
            } else {
                $q->where('site_id', isset(request()->test_id) ? request()->test_id : getSiteID());
            }
        })->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $review->load('sites', 'categories', 'tags','user');

        return view('admin.reviews.edit', compact('sites', 'categories', 'tags', 'review', 'users', 'stores', 'authors'));
    }

    public function update(UpdateReviewRequest $request, Review $review)
    {
        $review->update($request->all());
        $review->sites()->sync($request->input('sites', []));
        $review->categories()->sync($request->input('categories', []));
        $review->store_details()->sync($request->input('stores', []));
        $review->tags()->sync($request->input('tags', []));

        $last_id    = $review->id;
        $slug       = $review->slug;

        $return = $this->slug->updateSlug($last_id, $this->slug_prefix . $slug, $this->table, $request->input('sites', []));

        if (isset($return['status']) && $return['status'] === false) {
            return $return;
        }


        if (\App::environment('production')) {
            if ($request->input('image', false)) {
                if (!$review->image || $request->input('image') !== $review->image->file_name) {
                    $review->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->addCustomHeaders([
                        'ACL' => 'public-read'
                    ])->toMediaCollection('image','s3');
                }
            } elseif ($review->image) {
                $review->image->delete();
            }
        } else {
            if ($request->input('image', false)) {
                if (!$review->image || $request->input('image') !== $review->image->file_name) {
                    $review->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
                }
            } elseif ($review->image) {
                $review->image->delete();
            }
        }

        $reviewUpdate = Review::select('id','title','review_image')->where('id',$last_id)->first();
        $img = $reviewUpdate['image'] ? $reviewUpdate['image']['url'] : '';
        if ($request->input('image', false)) {
            $path['review_image'] = $img;
            Review::where('id', $last_id)->update($path);
        }

        if(isset($request->test_id)) {
            $url = route('admin.reviews.index') . $request->test_id;
        } else {
            $url = route('admin.reviews.index');
        }

        return redirect($url);

    }

    public function show(Review $review)
    {
        abort_if(Gate::denies('review_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $status = (isset(request()->test_id) ? !request()->test_id > 0 : !getSiteID() > 0);
        if($status) return redirect('/admin');

        $review->load('sites', 'categories', 'tags');

        return view('admin.reviews.show', compact('review'));
    }

    public function destroy(Review $review)
    {
        abort_if(Gate::denies('review_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $status = (isset(request()->test_id) ? !request()->test_id > 0 : !getSiteID() > 0);
        if($status) return redirect('/admin');

        $review->delete();
        $this->slug->deleteSlug($review->id, $this->table);
        return back();
    }

    public function massDestroy(MassDestroyReviewRequest $request)
    {
        Review::whereIn('id', request('ids'))->delete();
        $this->slug->massdeleteSlug(request('ids'), $this->table);
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
