<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageManagementController extends Controller
{
    public function Index()
    {
        $files = Storage::allFiles('/public/image');

        return view('dashboard.imagemanagement', [
            'files' => $files
        ]);
    }

    public function Delete(Request $request)
    {
            $validate = $request->validate([
                'uri' => 'required|string'
            ]);

            if (Storage::delete($validate))
                return redirect()->back()->with('success', 'Image successfully deleted!');

            return redirect()->back()->with('fail', 'Image failed to delete');
    }

    public function View()
    {
        return view('dashboard.imageupload');
    }

    public function Create(Request $request)
    {
        $validate = $request->validate([
            'path' => 'required|string',
            'image' => 'required|image'
        ]);

        $directory = "public/image/" . $validate['path'];

        if ($request->file('image')->store($directory))
            return redirect()->back()->with('success', 'Image successfully uploaded');

        return redirect()->back()->with('fail', 'Image failed to upload');
    }
}
