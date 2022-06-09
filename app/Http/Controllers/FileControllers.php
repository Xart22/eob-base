<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FileControllers extends Controller
{

    public function fileMovie($nm_file)
    {
        $path = storage_path("app/public/banner-movie/" . $nm_file);
        if (!File::exists($path)) {
            $path = storage_path('app/public/movie/' . $nm_file);
            if (!file_exists($path)) {
                abort(404);
            }
        }

        return response()->file($path);
    }

    public function fileMusic($nm_file)
    {
        $path = storage_path("app/public/banner-music/" . $nm_file);
        if (!File::exists($path)) {
            $path = storage_path('app/public/music/' . $nm_file);
            if (!file_exists($path)) {
                abort(404);
            }
        }

        return response()->file($path);
    }
    public function fileGame($nm_file)
    {
        $path = storage_path("app/public/game/cover/" . $nm_file);
        if (!File::exists($path)) {
            abort(404);
        }

        return response()->file($path);
    }
    public function fileEbook($nm_file)
    {
        $path = storage_path("app/public/ebook/" . $nm_file);
        if (!File::exists($path)) {
            $path = storage_path('app/public/ebook/cover/' . $nm_file);
            if (!file_exists($path)) {
                abort(404);
            }
        }

        return response()->file($path);
    }
    public function fileNews($nm_file)
    {
        $path = storage_path("app/public/news/" . $nm_file);
        if (!File::exists($path)) {
            $path = storage_path('app/public/news/img/' . $nm_file);
            if (!file_exists($path)) {
                abort(404);
            }
        }

        return response()->file($path);
    }
    public function filePhoto($nm_file)
    {
        $path = storage_path("app/public/photo/" . $nm_file);
        if (!File::exists($path)) {
            abort(404);
        }

        return response()->file($path);
    }
    public function fileChTv($nm_file)
    {
        $path = storage_path("app/public/tv/banner/" . $nm_file);
        if (!File::exists($path)) {
            $path = storage_path('app/public/tv/video/' . $nm_file);
            if (!file_exists($path)) {
                abort(404);
            }
        }
        return response()->file($path);
    }
    public function fileCompany($nm_file)
    {
        $path = storage_path("app/public/company/video/" . $nm_file);
        if (!File::exists($path)) {
            $path = storage_path('app/public/company/img/' . $nm_file);
            if (!file_exists($path)) {
                abort(404);
            }
        }

        return response()->file($path);
    }

    public function fileSlider($nm_file)
    {
        $path = storage_path("app/public/slider/img/" . $nm_file);

        if (!file_exists($path)) {
            abort(404);
        }


        return response()->file($path);
    }
}
