<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class BlogController extends Controller
{
    public function Form(Request $request) {
        if ($request->id) {
            $key = "blog-" . strval($request->id);

            $blog = Cache::remember($key, 180, function () use ($request) {
                return Blog::find($request->id);
            });

            if($blog->user->id == Auth::user()->id) {
                return view('dashboard.blogform', [
                    'blog' => $blog
                ]);
            } else {
                session()->flash('fail', 'Invalid Pervilege');
                return redirect()->back();
            }


        }

        return view('dashboard.blogform');
    }
    public function Create (Request $request) {
        dd($request);
    }

    public function Update (Request $request) {
        dd($request);
    }

    public function Delete (Request $request) {
        dd($request);
    }

    public function AllBlogList () {
        $blog = Cache::remember('owned-blog-list', 2, function () {
            return Blog::paginate(4);
        });

        return view('dashboard.bloglist', [
            'blog' => $blog
        ]);
    }

    public function ListOwnedBlog () {
        $blog = Cache::remember('owned-blog-list', 2, function () {
            return Blog::where('users_id', Auth::user()->id)->paginate(4);
        });

        return view('dashboard.bloglist', [
            'blog' => $blog
        ]);
    }

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
