<?php

namespace App\Http\Controllers;

use App\Models\Ebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EbookControllers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $PATH_FILE_DB_EBOOK = "public/ebook/";
    private $PATH_FILE_DB_EBOOK_COVER = "public/ebook/cover/";
    public function index()
    {
        try {
            return view('admin.ebook.index', ['data' => Ebook::all()]);
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
                'ebook_name' => 'required',
                'ebook_tag' => 'required',
                'ebook_cover' => 'required',
                'ebook_file' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'code' => 400,
                    'status' => 'failed',
                    'message' => $validator->getMessageBag()->getMessages(),
                ], 200);
            }
            $file_cover = $req->file('ebook_cover');
            $name_file_cover = time() . '_file_' . preg_replace("/[^a-zA-Z0-9]+/", "", $req->ebook_name)  . '.' . $file_cover->getClientOriginalExtension();
            $file_ebook = $req->file('ebook_file');
            $name_file_ebook = time() . '_file_' . $req->ebook_name . '.' . $file_ebook->getClientOriginalExtension();
            Ebook::create([
                'ebook_name' => $req->ebook_name,
                'tag' => $req->ebook_tag,
                'path_cover' => $name_file_cover,
                'path_file' =>  $name_file_ebook,
            ]);

            Storage::putFileAs($this->PATH_FILE_DB_EBOOK_COVER, $file_cover, $name_file_cover);
            Storage::putFileAs($this->PATH_FILE_DB_EBOOK, $file_ebook, $name_file_ebook);
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Successfully uploaded.',
                'url' => route('flashMsg', 'ebook-success')
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
        return view('admin.ebook.detail', ['detil_data' => Ebook::where('uuid', $id)->first()]);
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
            $detil_data = Ebook::where('uuid', $id)->first();
            return view('admin.ebook.edit', ['detil_data' => $detil_data, 'data' => Ebook::all()]);
        } catch (\Throwable $err) {
            return redirect()->route('admin.ebook.index')->with('error', $err->getMessage());
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
            $ebook = Ebook::where('uuid', $id)->first();
            if (!empty($req->file('ebook_cover'))) {
                Storage::delete($this->PATH_FILE_DB_EBOOK_COVER . $ebook->path_cover);
                $cover = $req->file('ebook_cover');
                $name_file_cover = time() . '_cover_' . preg_replace("/[^a-zA-Z0-9]+/", "", $req->ebook_name)  . '.' . $cover->getClientOriginalExtension();
                Ebook::where('uuid', $id)->update([
                    'path_cover' =>  $name_file_cover
                ]);
                Storage::putFileAs($this->PATH_FILE_DB_EBOOK_COVER, $cover, $name_file_cover);
            }
            if (!empty($req->file('ebook_file'))) {
                Storage::delete($this->PATH_FILE_DB_EBOOK . $ebook->path_file);
                $file_ebook = $req->file('ebook_file');
                $name_file_ebook = time() . '_file_' . preg_replace("/[^a-zA-Z0-9]+/", "", $req->ebook_name)  . '.' . $file_ebook->getClientOriginalExtension();
                Ebook::where('uuid', $id)->update([
                    'path_file' =>  $name_file_ebook,
                ]);
                Storage::putFileAs($this->PATH_FILE_DB_EBOOK, $file_ebook, $name_file_ebook);
            }

            Ebook::where('uuid', $id)->update([
                'ebook_name' => $req->ebook_name,
                'tag' => $req->ebook_tag,
            ]);
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Successfully uploaded.',
                'url' => route('flashMsg', 'ebook-success')
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
            $ebook = Ebook::where('uuid', $id)->first();
            Storage::delete($this->PATH_FILE_DB_EBOOK_COVER . $ebook->path_cover);

            Storage::delete($this->PATH_FILE_DB_EBOOK . $ebook->path_file);
            Ebook::where('uuid', $id)->delete();

            return redirect()->route('ebook.index')->with('status', 'Ebook Deleted!');
        } catch (\Throwable $err) {
            return redirect()->route('ebook.index')->with('error', $err->getMessage());
        }
    }

    public function flashMsg()
    {
        return redirect()->route('ebook.index')->with('status', 'Ebook Saved!');
    }
}
