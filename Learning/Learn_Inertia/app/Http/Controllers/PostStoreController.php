<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PostStoreController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // Validation

        $request->validate([
            'title' => 'required|string|min:3|max:10',
            'body' => 'required|string|min:5|max:20',
        ]);

        $request->user()->posts()->create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
        ]);
        // todo: auth()->user() or $request->user()

        return back();

    }
}
