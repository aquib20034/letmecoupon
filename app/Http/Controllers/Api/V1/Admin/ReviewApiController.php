<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Review;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Http\Resources\Admin\ReviewResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReviewApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('review_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ReviewResource(Review::with(['sites', 'categories', 'tags'])->get());
    }

    public function store(StoreReviewRequest $request)
    {
        $review = Review::create($request->all());
        $review->sites()->sync($request->input('sites', []));
        $review->categories()->sync($request->input('categories', []));
        $review->tags()->sync($request->input('tags', []));

        if ($request->input('image', false)) {
            $review->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
        }

        if ($request->input('banner_image', false)) {
            $review->addMedia(storage_path('tmp/uploads/' . $request->input('banner_image')))->toMediaCollection('banner_image');
        }

        return (new ReviewResource($review))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Review $review)
    {
        abort_if(Gate::denies('review_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ReviewResource($review->load(['sites', 'categories', 'tags']));
    }

    public function update(UpdateReviewRequest $request, Review $review)
    {
        $review->update($request->all());
        $review->sites()->sync($request->input('sites', []));
        $review->categories()->sync($request->input('categories', []));
        $review->tags()->sync($request->input('tags', []));

        if ($request->input('image', false)) {
            if (!$review->image || $request->input('image') !== $review->image->file_name) {
                $review->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
            }
        } elseif ($review->image) {
            $review->image->delete();
        }

        if ($request->input('banner_image', false)) {
            if (!$review->banner_image || $request->input('banner_image') !== $review->banner_image->file_name) {
                $review->addMedia(storage_path('tmp/uploads/' . $request->input('banner_image')))->toMediaCollection('banner_image');
            }
        } elseif ($review->banner_image) {
            $review->banner_image->delete();
        }

        return (new ReviewResource($review))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Review $review)
    {
        abort_if(Gate::denies('review_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $review->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
