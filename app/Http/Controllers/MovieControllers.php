<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MovieControllers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $PATH_FILE_DB_BANNER = "public/banner-movie/";
    private $PATH_FILE_DB_MOVIE = "public/movie/";
    public function index()
    {
        try {
            return view('admin.movie.index', ['data' => Movie::all()]);
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
                'movie_name' => 'required',
                'movie_rating' => 'required',
                'movie_duration' => 'required',
                'movie_file' => 'required',
                'movie_banner' => 'required|mimes:jpg,bmp,png',
                'movie_category' => 'required',
                'movie_desc' => 'required',
                'movie_actors' => 'required',
                'movie_director' => 'required'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'code' => 400,
                    'status' => 'failed',
                    'message' => $validator->getMessageBag()->getMessages(),
                ], 200);
            }
            $banner = $req->file('movie_banner');
            $file_movie = $req->file('movie_file');
            $name_file_banner = time() . '_banner_' . preg_replace("/[^a-zA-Z0-9]+/", "", $req->movie_name) . '.' . $banner->getClientOriginalExtension();
            $name_file_movie = time() . '_file_' . preg_replace("/[^a-zA-Z0-9]+/", "", $req->movie_name)  . '.' . $file_movie->getClientOriginalExtension();
            Movie::create([
                'movie_name' => $req->movie_name,
                'movie_rating' => $req->movie_rating,
                'category' => $req->movie_category,
                'duration' => $req->movie_duration,
                'movie_desc' => $req->movie_desc,
                'path_file' =>  $name_file_movie,
                'path_banner' =>  $name_file_banner,
                'movie_actors' => $req->movie_actors,
                'movie_director' => $req->movie_director,
            ]);

            Storage::putFileAs($this->PATH_FILE_DB_BANNER, $banner, $name_file_banner);
            Storage::putFileAs($this->PATH_FILE_DB_MOVIE, $file_movie, $name_file_movie);
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Successfully uploaded.',
                'url' => route('flashMsg', 'movie-success')
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
            $data = Movie::where('uuid', $id);
            return view('admin.movie.edit')->with('data', $data);
        } catch (\Throwable $err) {
            return back()->withErrors($err);
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
            $detil_data = Movie::where('uuid', $id)->first();
            return view('admin.movie.edit', ['detil_data' => $detil_data, 'data' => Movie::all()]);
        } catch (\Throwable $err) {
            return redirect()->route('movie.index')->with('error', $err->getMessage());
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
            $movie = Movie::where('uuid', $id)->first();
            if (!empty($req->file('movie_banner'))) {
                $banner = $req->file('movie_banner');
                $name_file_banner = time() . '_banner_' . preg_replace("/[^a-zA-Z0-9]+/", "", $req->movie_name) . '.' . $banner->getClientOriginalExtension();
                Movie::where('uuid', $id)->update([
                    'path_banner' =>  $name_file_banner
                ]);
                Storage::putFileAs($this->PATH_FILE_DB_BANNER, $banner, $name_file_banner);
                Storage::delete($this->PATH_FILE_DB_BANNER . $movie->path_banner);
            }
            if (!empty($req->file('movie_file'))) {
                $file_movie = $req->file('movie_file');
                $name_file_movie = time() . '_file_' . preg_replace("/[^a-zA-Z0-9]+/", "", $req->movie_name) . '.' . $file_movie->getClientOriginalExtension();
                Movie::where('uuid', $id)->update([
                    'duration' => $req->movie_duration,
                    'path_file' =>  $name_file_movie,
                ]);
                Storage::putFileAs($this->PATH_FILE_DB_MOVIE, $file_movie, $name_file_movie);
                Storage::delete($this->PATH_FILE_DB_MOVIE . $movie->path_file);
            }
            Movie::where('uuid', $id)->update([
                'movie_name' => $req->movie_name,
                'movie_rating' => $req->movie_rating,
                'category' => $req->movie_category,
                'movie_desc' => $req->movie_desc,
                'movie_actors' => $req->movie_actors,
                'movie_director' => $req->movie_director,
            ]);
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Successfully uploaded.',
                'url' => route('flashMsg', 'movie-success')
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
            $movie = Movie::where('uuid', $id)->first();
            Storage::delete($this->PATH_FILE_DB_BANNER . $movie->path_banner);
            Storage::delete($this->PATH_FILE_DB_MOVIE . $movie->path_file);
            Movie::where('uuid', $id)->delete();

            return redirect()->route('movie.index')->with('status', 'Movie Deleted!');
        } catch (\Throwable $err) {
            return redirect()->route('movie.index')->with('error', $err->getMessage());
        }
    }
}
