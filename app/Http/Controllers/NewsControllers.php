<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class NewsControllers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $PATH_FILE_DB_NEWS_IMG = "public/news/img/";
    private $PATH_FILE_DB_NEWS_VIDEO = "public/news/video/";
    public function index()
    {
        try {
            return view('admin.news.index', ['data' => News::all()]);
        } catch (\Throwable $err) {
            return redirect()->route('dashboard')->with('error', $err->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        try {
            $validator = Validator::make($req->all(), [
                'news_headline' => 'required',
                'news_source' => 'required',
                'news_content' => 'required',
            ]);
            if ($validator->fails()) {
                return back()->withInput()->with('error', $validator->getMessageBag());
            }
            $news = News::create([
                'news_headline' => $req->news_headline,
                'news_content' => $req->news_content,
                'news_source' => $req->news_source,
            ]);

            if (!empty($req->file('news_video'))) {
                $video = $req->file('news_video');
                $name_file_video = time() . '_video_' . preg_replace("/[^a-zA-Z0-9]+/", "", $req->news_headline)  . '.' . $video->getClientOriginalExtension();
                Storage::putFileAs($this->PATH_FILE_DB_NEWS_VIDEO, $video, $name_file_video);
                News::where('id', $news->id)->update([
                    'news_video' => $name_file_video
                ]);
            }
            if (!empty($req->file('news_img'))) {
                $img = $req->file('news_img');
                $name_file_img = time() . '_img_' . preg_replace("/[^a-zA-Z0-9]+/", "", $req->news_headline)  . '.' . $img->getClientOriginalExtension();
                Storage::putFileAs($this->PATH_FILE_DB_NEWS_IMG, $img, $name_file_img);
                News::where('id', $news->id)->update([
                    'news_img' => $name_file_img
                ]);
            }
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Successfully uploaded.',
                'url' => route('flashMsg', 'news-success')
            ]);
        } catch (\Throwable $err) {
            return response()->json([
                'code' => 400,
                'status' => 'failed',
                'message' => $err->getMessage(),
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            return view('admin.news.detail', ['data' => News::where('uuid', $id)->first()]);
        } catch (\Throwable $err) {
            return redirect()->route('admin.news.index')->with('error', $err->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            return view('admin.news.edit', ['detil_data' => News::where('uuid', $id)->first(), 'data' => News::all()]);
        } catch (\Throwable $err) {
            return redirect()->route('admin.news.index')->with('error', $err->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        try {
            $validator = Validator::make($req->all(), [
                'news_headline' => 'required',
                'news_source' => 'required',
                'news_content' => 'required',
            ]);
            if ($validator->fails()) {
                return back()->withInput()->with('error', $validator->getMessageBag());
            }
            $news = News::where('uuid', $id)->first();

            if (!empty($req->file('news_video'))) {
                $video = $req->file('news_video');
                $name_file_video = time() . '_video_' . preg_replace("/[^a-zA-Z0-9]+/", "", $req->news_headline)  . '.' . $video->getClientOriginalExtension();
                Storage::putFileAs($this->PATH_FILE_DB_NEWS_VIDEO, $video, $name_file_video);
                News::where('id', $news->id)->update([
                    'news_video' => $name_file_video
                ]);
            }
            if (!empty($req->file('news_img'))) {
                $img = $req->file('news_img');
                $name_file_img = time() . '_img_' . preg_replace("/[^a-zA-Z0-9]+/", "", $req->news_headline)  . '.' . $img->getClientOriginalExtension();
                Storage::putFileAs($this->PATH_FILE_DB_NEWS_IMG, $img, $name_file_img);
                News::where('id', $news->id)->update([
                    'news_img' => $name_file_img
                ]);
            }
            News::where('id', $news->id)->update([
                'news_headline' => $req->news_headline,
                'news_content' => $req->news_content,
                'news_source' => $req->news_source,
            ]);
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Successfully uploaded.',
                'url' => route('flashMsg', 'news-success')
            ]);
        } catch (\Throwable $err) {
            return response()->json([
                'code' => 400,
                'status' => 'failed',
                'message' => $err->getMessage(),
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $news = News::where('uuid', $id)->first();
            if ($news->news_img) {
                Storage::delete($this->PATH_FILE_DB_NEWS_IMG . $news->news_img);
            }
            if ($news->news_video) {
                Storage::delete($this->PATH_FILE_DB_NEWS_VIDEO . $news->news_video);
            }
            News::where('uuid', $id)->delete();

            return redirect()->route('news.index')->with('status', 'News Deleted!');
        } catch (\Throwable $err) {
            return redirect()->route('news.index')->with('error', $err->getMessage());
        }
    }
}
