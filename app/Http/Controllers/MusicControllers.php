<?php

namespace App\Http\Controllers;

use App\Models\Music;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MusicControllers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $PATH_FILE_DB_BANNER = "public/banner-music/";
    private $PATH_FILE_DB_MUSIC = "public/music/";
    public function index()
    {
        try {
            return view('admin.music.index', ['data' => Music::all()]);
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
                'music_name' => 'required',
                'music_tag' => 'required',
                'music_duration' => 'required',
                'music_file' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'code' => 400,
                    'status' => 'failed',
                    'message' => $validator->getMessageBag()->getMessages(),
                ], 200);
            }
            $name_file_banner = '';
            if (!empty($req->file('music_banner'))) {
                $banner = $req->file('music_banner');
                $name_file_banner = time() . '_banner_' . preg_replace("/[^a-zA-Z0-9]+/", "", $req->music_name)  . '.' . $banner->getClientOriginalExtension();
                Storage::putFileAs($this->PATH_FILE_DB_BANNER, $banner, $name_file_banner);
            }
            $file_music = $req->file('music_file');
            $name_file_music = time() . '_file_' . $req->music_name . '.' . $file_music->getClientOriginalExtension();
            Music::create([
                'music_name' => $req->music_name,
                'music_tag' => $req->music_tag,
                'duration' => $req->music_duration,
                'path_file' =>  $name_file_music,
                'path_banner' =>  $name_file_banner == '' ? null : $name_file_banner
            ]);


            Storage::putFileAs($this->PATH_FILE_DB_MUSIC, $file_music, $name_file_music);
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Successfully uploaded.',
                'url' => route('flashMsg', 'music-success')
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
        //
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
            $detil_data = Music::where('uuid', $id)->first();
            return view('admin.music.edit', ['detil_data' => $detil_data, 'data' => Music::all()]);
        } catch (\Throwable $err) {
            return redirect()->route('music.index')->with('error', $err->getMessage());
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
                'music_name' => 'required',
                'music_tag' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'code' => 400,
                    'status' => 'failed',
                    'message' => $validator->getMessageBag()->getMessages(),
                ], 200);
            }
            $music = Music::where('uuid', $id)->first();
            if (!empty($req->file('music_banner'))) {
                $banner = $req->file('music_banner');
                $name_file_banner = time() . '_banner_' . preg_replace("/[^a-zA-Z0-9]+/", "", $req->music_name) . '.' . $banner->getClientOriginalExtension();

                Music::where('uuid', $id)->update([
                    'path_banner' =>  $name_file_banner
                ]);
                Storage::putFileAs($this->PATH_FILE_DB_BANNER, $banner, $name_file_banner);
                Storage::delete($this->PATH_FILE_DB_BANNER . $music->path_banner);
            }
            if (!empty($req->file('music_file'))) {
                $file_music = $req->file('music_file');
                $name_file_music = time() . '_file_' . preg_replace("/[^a-zA-Z0-9]+/", "", $req->music_name) . '.' . $file_music->getClientOriginalExtension();
                Music::where('uuid', $id)->update([
                    'path_file' =>  $name_file_music,
                    'duration' => $req->music_duration,
                ]);
                Storage::putFileAs($this->PATH_FILE_DB_MUSIC, $file_music, $name_file_music);
                Storage::delete($this->PATH_FILE_DB_MUSIC . $music->path_file);
            }
            Music::where('uuid', $id)->update([
                'music_name' => $req->music_name,
                'music_tag' => $req->music_tag,

            ]);
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Successfully uploaded.',
                'url' => route('flashMsg', 'music-success')
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
            $music = Music::where('uuid', $id)->first();
            if ($music->path_banner) {
                Storage::delete($this->PATH_FILE_DB_BANNER . $music->path_banner);
            }
            Music::where('uuid', $id)->delete();

            return redirect()->route('music.index')->with('status', 'Music Deleted!');
        } catch (\Throwable $err) {
            return redirect()->route('music.index')->with('error', $err->getMessage());
        }
    }
}
