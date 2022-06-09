<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Ebook;
use App\Models\Game;
use App\Models\Movie;
use App\Models\Music;
use App\Models\News;
use App\Models\Photo;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\TV;
use Illuminate\Http\Request;

class AppControllers extends Controller
{
    public function index()
    {
        return view('app.index.index', ['data_news' => News::all(), 'data_company' => Company::all(), 'sliders' => Slider::all()]);
    }
    public function infoLoading()
    {
        return view('app.index.info', ['data_news' => News::all(), 'data_company' => Company::all()]);
    }

    public function carouselLoading()
    {
        return view('app.index.carousel', ['sliders' => Slider::all()]);
    }

    public function movie()
    {

        return view('app.movies.index', ['data' => Movie::all(), 'tv' => TV::all()]);
    }
    public function movie_loading()
    {

        return view('app.movies.loading', ['data' => Movie::all(), 'tv' => TV::all()]);
    }

    public function playMovie($id)
    {

        return view('app.movies.play', ['movie' => Movie::where('uuid', $id)->first(), 'data' => Movie::all()]);
    }

    public function playTv($id)
    {

        return view('app.movies.play_tv', ['tv' => TV::where('uuid', $id)->first(), 'data' => TV::all()]);
    }

    public function music()
    {

        return view('app.music.index', ['data' => Music::all()]);
    }
    public function company($id)
    {
        return view('app.seputar_kai.index', ['data' => Company::where('uuid', $id)->first()]);
    }
    public function cctv()
    {
        $setting = Setting::first();


        return view('app.cctv.index', ['cctv_url' => ($setting->cctv) ? $setting->cctv : null]);
    }
    public function game()
    {
        return view('app.game.index', ['data' => Game::all()]);
    }
    public function game_loading()
    {
        return view('app.game.loading', ['data' => Game::all()]);
    }

    public function news($id)
    {
        return view('app.news.index', ['data' => News::where('uuid', $id)->first()]);
    }

    public function ebook()
    {
        return view('app.ebooks.index', ['data' => Ebook::all()]);
    }
    public function ebook_loading()
    {
        return view('app.ebooks.loading', ['data' => Ebook::all()]);
    }
    public function readEbook($id)
    {
        return view('admin.ebook.detail', ['detil_data' => Ebook::where('uuid', $id)->first()]);
    }

    public function galeri()
    {
        return view('app.galeri.index', ['data' => Photo::all()]);
    }
    public function galeri_loading()
    {
        return view('app.galeri.loading', ['data' => Photo::all()]);
    }
}
