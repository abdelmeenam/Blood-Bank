<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function getAllPosts(Request $request)
    {
        $posts = Post::with('category')
            ->latest()
            ->paginate(10);

        /*
        $likedPostIds = $request->user()->posts()->exists() ? $request->user()->posts()->pluck('post_id')->toArray() : [];
        $posts->each(function ($post) use ($likedPostIds) {
            $post->liked = in_array($post->id, $likedPostIds);
        });
        */
        return apiResponse(200, 'success', PostResource::collection($posts));
    }

    public function showPost(Request $request)
    {
        // get the id from the url and find the post.
        $rules = [
            'post_id' => 'required|exists:posts,id'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return apiResponse(422, $validator->errors());
        }

        $postId = request()->post_id;
        $post = Post::find($postId)->with('category')->first();
        return apiResponse(200, 'success', $post);
    }

    public function search(Request $request)
    {
        $rules = [
            'search' => 'required|string|min:3'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return apiResponse(422, $validator->errors());
        }

        $searchTerm = $request->input('search');
        $posts = Post::where('title', 'like', '%' . $searchTerm . '%')->paginate(10);
        $posts = $posts->isEmpty() ? apiResponse(404, 'No posts found with this term.') : apiResponse(200, 'success', $posts);
        return $posts;
    }

    public function filterByCategory(Request $request)
    {
        $rules = [
            'category_id' => 'required|exists:categories,id'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return apiResponse(422, $validator->errors());
        }

        $posts = Post::where('category_id', $request->category_id)->with('category')->paginate(10);
        $posts = $posts->isEmpty() ? apiResponse(404, 'No posts found with this category.') : apiResponse(200, 'success', $posts);
        return $posts;
    }

    public function postToggleFavourite(Request $request)
    {
        $rules = [
            'post_id' => 'required|exists:posts,id'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return apiResponse(422, $validator->errors());
        }

        $post = $request->user()->posts()->toggle($request->post_id);
        return apiResponse(200, 'Success', $post);
    }

    public function getAllFavourites(Request $request)
    {
        $favourites = $request->user()->posts()->latest();
        $favourites = $favourites->isEmpty() ? apiResponse(404, 'No favourites found.') : apiResponse(200, 'success', $favourites);
        return $favourites;
    }
}
