<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FlashMsgControllers extends Controller
{
    public function index($params)
    {
        if ($params == 'movie-success') {
            return redirect()->route('movie.index')->with('status', 'Movie Saved!');
        }
        if ($params == 'ebook-success') {
            return redirect()->route('ebook.index')->with('status', 'Ebook Saved!');
        }

        if ($params == 'music-success') {
            return redirect()->route('music.index')->with('status', 'Music Saved!');
        }
        if ($params == 'game-success') {
            return redirect()->route('game.index')->with('status', 'Game Saved!');
        }
        if ($params == 'news-success') {
            return redirect()->route('news.index')->with('status', 'News Saved!');
        }
        if ($params == 'tv-success') {
            return redirect()->route('tv.index')->with('status', 'Chanel Saved!');
        }
        if ($params == 'company-success') {
            return redirect()->route('company.index')->with('status', 'News Saved!');
        }
        if ($params == 'slider-success') {
            return redirect()->route('slider.index')->with('status', 'Slider Saved!');
        }
    }
}
