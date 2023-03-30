<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        $files = glob(public_path('pdf/*.*'));
        $file = explode('\\', $files[0]);
        $fileName = end($file);
        return view('welcome', ['pdf'=>$fileName]);
    }
}
