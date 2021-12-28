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
    private static function AdminOnly()
    {
        if (!Auth::user()->admin) {
            session()->flash('fail', 'Invalid Pervilege');
            return redirect()->back();
        }
    }

    public function Form(Request $request)
    {
        BlogController::AdminOnly();

        if ($request->id) {
            $key = "blog-" . strval($request->id);

            $blog = Cache::remember($key, 180, function () use ($request) {
                return Blog::find($request->id);
            });

            if ($blog->user->id == Auth::user()->id) {
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
    public function Create(Request $request)
    {
        BlogController::AdminOnly();

        $validate = $request->validate([
            'title' => 'required|string|unique:blog,title',
            'content' => 'required|string',
            'photo' => 'required|image'
        ]);

        $blog = new Blog();
        $blog->users_id = Auth::user()->id;
        $blog->title = $validate['title'];
        $blog->content = $validate['content'];

        if ($blog->save()) {

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

    public function Update(Request $request)
    {
        BlogController::AdminOnly();

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

    public function Delete(Request $request)
    {
        BlogController::AdminOnly();

        $blog = Blog::find($request->id);
        if ($blog == null) {
            session()->flash('fail', 'Blog not found!');
            return redirect()->back();
        }

        if (Auth::user()->id == $blog->users_id || Auth::user()->admin) {
            if (!Storage::delete('public/image/blog/' . $blog->title . '.png')) {
                session()->flash('fail', 'Image failed to delete!');
                return redirect()->back();
            }

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

    public function AllBlogList()
    {
        BlogController::AdminOnly();

        $blog = Cache::remember('owned-blog-list', 2, function () {
            return Blog::paginate(4);
        });

        return view('dashboard.bloglist', [
            'blog' => $blog
        ]);
    }

    public function ListOwnedBlog()
    {
        BlogController::AdminOnly();

        $blog = Cache::remember('owned-blog-list', 2, function () {
            return Blog::where('users_id', Auth::user()->id)->paginate(4);
        });

        return view('dashboard.bloglist', [
            'blog' => $blog
        ]);
    }

    public function BlogList()
    {
        $blog = Cache::remember('blog-list', 2, function () {
            return Blog::paginate(2);
        });

        return view('bloglist', [
            'blog' => $blog
        ]);
    }

    public function Blog($id)
    {
        $key = "blog-" . strval($id);

        $Blog = Cache::remember($key, 180, function () use ($id) {
            return Blog::find($id);
        });

        return view('blog', [
            'Blog' => $Blog
        ]);
    }

    private static function UploadPhoto($photo, $title, $oldphoto)
    {
        $directory = "public/image/blog";

        if (!$oldphoto || $oldphoto == "") {
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
