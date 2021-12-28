<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImageManagementController extends Controller
{
    //
    public function Index()
    {
        $files = Storage::allFiles('/public/image');

        return view('dashboard.imagemanagement', [
            'files' => $files
        ]);
    }

    public function Delete(Request $request)
    {
        if (Auth::user()->admin) {
            $validate = $request->validate([
                'uri' => 'required|string'
            ]);

            if (Storage::delete($validate)) {
                session()->flash('success', 'Image successfully deleted!');
                return redirect()->back();
            }
            session()->flash('fail', 'Image failed to delete');
            return redirect()->back();
        } else {
            session()->flash('fail', 'Invalid Pervilege');
            return redirect()->back();
        }
    }

    public function View()
    {
        if (Auth::user()->admin) {
            return view('dashboard.imageupload');
        }
    }

    public function Create(Request $request)
    {
        if (Auth::user()->admin) {
            $validate = $request->validate([
                'path' => 'required|string',
                'image' => 'required|image'
            ]);
            $directory = "public/image/" . $validate['path'];
            if ($request->file('image')->store($directory)) {
                session()->flash('success', 'Image successfully uploaded');
                return redirect()->back();
            }
            session()->flash('fail', 'Image failed to upload');
            return redirect()->back();
        } else {
            session()->flash('fail', 'Invalid Pervilege');
            return redirect()->back();
        }
    }
}
