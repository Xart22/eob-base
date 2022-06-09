<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class StreamScreenControllers extends Controller
{
    public function cctv()
    {
        $setting = Setting::first();

        if ($setting) {
            return view('stream.cctv', ['cctv_url' => $setting->cctv]);
        } else {
            return view('stream.cctv');
        }
    }
    public function location()
    {
        return view('stream.location');
    }
    public function info()
    {
        return view('stream.info');
    }
}
