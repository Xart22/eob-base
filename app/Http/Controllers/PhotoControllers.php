<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PhotoControllers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $PATH_FILE_DB_PHOTO = "public/photo/";
    public function index()
    {
        try {
            return view('admin.photo.index', ['data' => Photo::all()]);
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
                'photo_name' => 'required',
                'photo_file' => 'required',

            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            $file_banner = $req->file('photo_file');
            $name_file_banner = time() . '_file_' . preg_replace("/[^a-zA-Z0-9]+/", "", $req->photo_name)  . '.' . $file_banner->getClientOriginalExtension();
            Photo::create([
                'photo_name' => $req->photo_name,
                'path_file' => $name_file_banner,
            ]);
            Storage::putFileAs($this->PATH_FILE_DB_PHOTO, $file_banner, $name_file_banner);
            return redirect()->route('photo.index')->with('');
        } catch (\Throwable $err) {
            return back()->withInput()->with('error', $err);
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
            return view('admin.photo.edit', ['data' => Photo::all(), 'detil_data' => Photo::where('uuid', $id)->first()]);
        } catch (\Throwable $err) {
            return redirect()->route('dashboard')->with('error', $err->getMessage());
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
                'photo_name' => 'required',
                'photo_file' => 'required',

            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            if (!empty($req->file('photo_file'))) {
                $photo = Photo::where('uuid', $id)->first();
                $file_banner = $req->file('photo_file');
                $name_file_banner = time() . '_file_' . preg_replace("/[^a-zA-Z0-9]+/", "", $req->photo_name) . '.' . $file_banner->getClientOriginalExtension();
                Photo::where('uuid', $id)->update([
                    'photo_name' => $req->photo_name,
                    'path_file' => $name_file_banner,
                ]);
                Storage::putFileAs($this->PATH_FILE_DB_PHOTO, $file_banner, $name_file_banner);
                Storage::delete($this->PATH_FILE_DB_PHOTO . $photo->path_file);
            }

            Photo::where('uuid', $id)->update([
                'photo_name' => $req->photo_name,

            ]);

            return redirect()->route('photo.index')->with('');
        } catch (\Throwable $err) {
            return back()->withInput()->with('error', $err);
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
            $photo = Photo::where('uuid', $id)->first();

            Storage::delete($this->PATH_FILE_DB_PHOTO . $photo->path_file);

            Photo::where('uuid', $id)->delete();
            return redirect()->route('photo.index')->with('status', 'Photo Deleted!');
        } catch (\Throwable $err) {
            return redirect()->route('photo.index')->with('error', $err->getMessage());
        }
    }
}
