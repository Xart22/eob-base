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

    public function runningText()
    {
        $setting = Setting::first();
        if ($setting->nomor_ka != '' && $setting->nomor_ka != '') {
            $text = $setting->nomor_ka . ' | ' . $setting->nama_ka . " | " . $setting->relasi_ka . " | " . $setting->nama_csot . " | " . $setting->nipp . " | " . $setting->no_hp;
            return view('stream.running-text', ['running_text' => $text]);
        } else {
            return view('stream.running-text');
        }
    }

    public function template2()
    {
        $setting = Setting::first();
        return view('stream.template-2', ['setting' => $setting]);
    }
}
