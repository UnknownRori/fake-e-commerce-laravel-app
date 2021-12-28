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
}
