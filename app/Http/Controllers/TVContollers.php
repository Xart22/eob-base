<?php

namespace App\Http\Controllers;

use App\Models\TV;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TVContollers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $PATH_FILE_DB_TV_IMG = "public/tv/banner/";
    private $PATH_FILE_DB_TV_VIDEO = "public/tv/video/";
    public function index()
    {
        try {
            return view('admin.tv.index', ['data' => TV::all()]);
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
                'ch_name' => 'required',
                'ch_banner' => 'required|mimes:jpg,bmp,png',
                'ch_file' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'code' => 400,
                    'status' => 'failed',
                    'message' => $validator->getMessageBag()->getMessages(),
                ], 200);
            }
            $banner = $req->file('ch_banner');
            $file_tv = $req->file('ch_file');
            $name_file_banner = time() . '_banner_' . preg_replace("/[^a-zA-Z0-9]+/", "", $req->ch_name)  . '.' . $banner->getClientOriginalExtension();
            $name_file_tv = time() . '_file_' . preg_replace("/[^a-zA-Z0-9]+/", "", $req->ch_name) . '.' . $file_tv->getClientOriginalExtension();
            TV::create([
                'ch_name' => $req->ch_name,
                'path_file' => $name_file_tv,
                'path_banner' => $name_file_banner
            ]);

            Storage::putFileAs($this->PATH_FILE_DB_TV_IMG, $banner, $name_file_banner);
            Storage::putFileAs($this->PATH_FILE_DB_TV_VIDEO, $file_tv, $name_file_tv);
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Successfully uploaded.',
                'url' => route('flashMsg', 'tv-success')
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
            $detil_data = Tv::where('uuid', $id)->first();
            return view('admin.tv.edit', ['detil_data' => $detil_data, 'data' => Tv::all()]);
        } catch (\Throwable $err) {
            return redirect()->route('tv.index')->with('error', $err->getMessage());
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
            $tv = Tv::where('uuid', $id)->first();
            if (!empty($req->file('ch_banner'))) {
                $banner = $req->file('ch_banner');
                $name_file_banner = time() . '_banner_' . preg_replace("/[^a-zA-Z0-9]+/", "", $req->ch_name) . '.' . $banner->getClientOriginalExtension();
                Tv::where('uuid', $id)->update([
                    'path_banner' =>  $name_file_banner
                ]);
                Storage::putFileAs($this->PATH_FILE_DB_TV_IMG, $banner, $name_file_banner);
                Storage::delete($this->PATH_FILE_DB_TV_IMG . $tv->path_banner);
            }
            if (!empty($req->file('ch_file'))) {
                $file_tv = $req->file('ch_file');
                $name_file_tv = time() . '_file_' . preg_replace("/[^a-zA-Z0-9]+/", "", $req->ch_name) . '.' . $file_tv->getClientOriginalExtension();
                Tv::where('uuid', $id)->update([
                    'path_file' =>  $name_file_tv,
                ]);
                Storage::putFileAs($this->PATH_FILE_DB_TV_IMG, $file_tv, $name_file_tv);
                Storage::delete($this->PATH_FILE_DB_TV_IMG . $tv->path_file);
            }
            Tv::where('uuid', $id)->update([
                'ch_name' => $req->ch_name
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
            $tv = TV::where('uuid', $id)->first();
            Storage::delete($this->PATH_FILE_DB_TV_IMG . $tv->path_banner);
            Storage::delete($this->PATH_FILE_DB_TV_VIDEO . $tv->path_file);
            TV::where('uuid', $id)->delete();

            return redirect()->route('tv.index')->with('status', 'CH Tv Deleted!');
        } catch (\Throwable $err) {
            return redirect()->route('tv.index')->with('error', $err->getMessage());
        }
    }
}
