<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;

class UserShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(User $user)
    {

        // dd($user->toArray());

        $user->load(['posts.user']);

        return inertia()->render('Users/Show', [
            'user' => UserResource::make($user),
            // 'posts' => PostResource::collection($user->posts)
            'posts' => PostResource::collection(
                Post::with('user')->whereBelongsTo($user)->get()
            )
        ]);
    }
}
