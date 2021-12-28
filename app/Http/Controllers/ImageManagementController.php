<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $validate = $request->validate([
            'uri' => 'required|string'
        ]);

        if (Storage::delete($validate)) {
            session()->flash('success', 'Image successfully deleted!');
            return redirect()->back();
        }
        session()->flash('fail', 'Image failed to delete');
        return redirect()->back();
    }
}
