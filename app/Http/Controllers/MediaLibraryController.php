<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MediaLibraryController extends Controller
{
    public function index(Request $request)
    {
        return view('media-library', ['data' => [
            'html' => ''//$html,
        ]]);
    }
}
