<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        $validate = $request->validate([
            'title' => 'required|string|unique:blog,title',
            'content' => 'required|string',
            'photo' => 'required|image'
        ]);

        $blog = new Blog();
        $blog->users_id = Auth::user()->id;
        $blog->title = $validate['title'];
        $blog->content = $validate['content'];

        if($blog->save()) {

            if (BlogController::UploadPhoto($validate['photo'], $validate['title'], null)) {
                session()->flash('success', 'Blog successfully posted!');
                return redirect()->back();
            }
            session()->flash('fail', 'Image cannot be saved! but Blog has been posted!');
            return redirect()->back();
        }

        session()->flash('fail', 'Internal Server Error!');
        return redirect()->back();

    }

    public function Update (Request $request) {
        $validate = $request->validate([
            'title' => 'required|string|unique:blog,title',
            'content' => 'required|string',
            'photo' => 'required|image'
        ]);

        $blog = Blog::find($request->id);
        $oldphoto = $blog->title;
        $blog->title = $validate['title'];
        $blog->content = $validate['content'];

        if ($blog->save()) {

            if (BlogController::UploadPhoto($validate['photo'], $validate['title'], $oldphoto)) {
                session()->flash('success', 'Blog successfully edited!');
                return redirect()->back();
            }
            session()->flash('fail', 'Image cannot be saved! but Blog has been edited!');
            return redirect()->back();
        }

        session()->flash('fail', 'Internal Server Error!');
        return redirect()->back();
    }

    public function Delete (Request $request) {
        $blog = Blog::find($request->id);
        if($blog == null) {
            session()->flash('fail', 'Failed to delete blog!');
            return redirect()->back();
        }

        if (Auth::user()->id == $blog->users_id || Auth::user()->admin) {

            if (DB::table('blog')->where('id', $blog->id)->delete()) {
                session()->flash('success', 'Blog successfully deleted!');
                return redirect()->back();
            }

            session()->flash('fail', 'Failed to delete blog!');
            return redirect()->back();
        } else {
            session()->flash('fail', 'Invalid Pervilege!');
            return redirect()->route('Home');
        }

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

    protected static function UploadPhoto($photo, $title, $oldphoto) {
        $directory = "public/image/blog";

        if (!$oldphoto || $oldphoto == "") {
            dd("acat");
            $path = Storage::putFileAs(
                $directory,
                $photo,
                $title . '.png'
            );
            return $path;
        } else {
            if (!Storage::delete($directory . '/' . $oldphoto . '.png')) {
                session()->flash('fail', 'Old image failed to deleted!');
            }

            $path = Storage::putFileAs(
                $directory,
                $photo,
                $title . '.png'
            );

            return $path;
        }
    }
}
