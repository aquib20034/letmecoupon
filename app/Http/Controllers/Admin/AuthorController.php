<?php

namespace App\Http\Controllers\Admin;

use App\Author;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAuthorRequest;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Site;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('author_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $status = (isset(request()->test_id) ? !request()->test_id > 0 : !getSiteID() > 0);
        if($status) return redirect('/admin');

        $authors = Author::get();

        if(isset(request()->bid)) {
            $authors = $authors->where('id', request()->bid);
        }

        return view('admin.authors.index', compact('authors'));
    }

    public function create()
    {
        abort_if(Gate::denies('author_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $status = (isset(request()->test_id) ? !request()->test_id > 0 : !getSiteID() > 0);
        if($status) return redirect('/admin');

        //$sites = Site::all()->pluck('name', 'id');

        return view('admin.authors.create');
    }

    public function store(StoreAuthorRequest $request)
    {
        // $author = Author::create($request->all());
        $author = Author::create(array_merge($request->all(), ['created_by' => auth()->id(), 'updated_by' => auth()->id()]));
        $last_id    = $author->id;

        if (\App::environment('production')) {
            if ($request->input('image', false)) {
                $author->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->addCustomHeaders([
                    'ACL' => 'public-read'
                ])->toMediaCollection('image','s3');
            }
        } else {
            if ($request->input('image', false)) {
                $author->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
            }
        }
        
        $authorUpdate = Author::select('id','first_name','image')->where('id',$last_id)->first();
        $img = $authorUpdate['image'] ? $authorUpdate['image']['url'] : '';
//        $imagePath = str_replace('https://va8ive-cms.s3.amazonaws.com/', $website->cdn_path ?? '', $img);
        $path['image'] = $img;
        Author::where('id', $last_id)->update($path);

        if(isset($request->test_id)) {
            $url = route('admin.authors.index') . $request->test_id;
        } else {
            $url = route('admin.authors.index');
        }

        return redirect($url);
    }

    public function edit(Author $author)
    {
        abort_if(Gate::denies('author_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $status = (isset(request()->test_id) ? !request()->test_id > 0 : !getSiteID() > 0);
        if($status) return redirect('/admin');

        return view('admin.authors.edit', compact('author'));
    }

    public function update(UpdateAuthorRequest $request, Author $author)
    {   
        // $author->update($request->all());
        $author->update(array_merge($request->all(), ['updated_by' => auth()->id()]));
        $last_id    = $author->id;

        if (\App::environment('production')) {
            if ($request->input('image', false)) {
                if (!$author->image || $request->input('image') !== $author->image->file_name) {
                    $author->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->addCustomHeaders([
                        'ACL' => 'public-read'
                    ])->toMediaCollection('image','s3');
                }
            } elseif ($author->image) {
                $author->image->delete();
            }
        } else {
            if ($request->input('image', false)) {
                if (!$author->image || $request->input('image') !== $author->image->file_name) {
                    $author->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
                }
            } elseif ($author->image) {
                $author->image->delete();
            }
        }

        $authorUpdate = Author::select('id','first_name','image')->where('id',$last_id)->first();
        $img = $authorUpdate['image'] ? $authorUpdate['image']['url'] : '';
        //$imagePath = str_replace('https://va8ive-cms.s3.amazonaws.com/', $website->cdn_path ?? '', $img);
        $path['image'] = $img;
        Author::where('id', $last_id)->update($path);

        if(isset($request->test_id)) {
            $url = route('admin.authors.index') . $request->test_id;
        } else {
            $url = route('admin.authors.index');
        }

        return redirect($url);
    }

    public function show(Author $author)
    {
        abort_if(Gate::denies('author_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $status = (isset(request()->test_id) ? !request()->test_id > 0 : !getSiteID() > 0);
        if($status) return redirect('/admin');

        return view('admin.authors.show', compact('author'));
    }

    public function destroy(Author $author)
    {
        abort_if(Gate::denies('author_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $status = (isset(request()->test_id) ? !request()->test_id > 0 : !getSiteID() > 0);
        if($status) return redirect('/admin');

        $author->delete();

        return back();
    }

    public function massDestroy(MassDestroyAuthorRequest $request)
    {
        Author::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
