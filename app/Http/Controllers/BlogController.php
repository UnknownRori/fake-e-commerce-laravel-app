<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BlogController extends Controller
{
    public function BlogList () {
        $blog = Cache::remember('blog-list', 2, function () {
            return Blog::paginate(2);
        });

        return view('bloglist', [
            'blog' => $blog
        ]);
    }

    public function Blog ($id) {
        $key = "blog-" . strval($id);

        $Blog = Cache::remember($key, 180, function () use ($id) {
            return Blog::find($id);
        });

        return view('blog', [
            'Blog' => $Blog
        ]);
    }
}
