<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;

class UserShowController extends Controller
{

    public function __invoke(User $user)
    {

        // dd($user->toArray());

        $user->load(['posts.user']);

        return inertia()->render('Users/Show', [
            'user' => UserResource::make($user),
            // 'posts' => PostResource::collection($user->posts)
            // 'posts' => PostResource::collection(
            //     Post::with('user')->whereBelongsTo($user)->get(),
            // todo: Lazy data
            'posts' => Inertia::lazy(function () use ($user) {
                return PostResource::collection($user->posts);
            })
        ]);
    }
}