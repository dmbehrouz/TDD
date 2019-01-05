<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class AccessorController extends Controller
{
    public function index(Request $request)
    {
        $post_id = $request->get("id", 0);
        $post = Post::find($post_id);

        return $post->name;
    }
}
