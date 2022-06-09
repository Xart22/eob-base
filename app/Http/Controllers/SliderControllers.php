<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SliderControllers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $PATH_FILE_DB_NEWS_IMG = "public/slider/img/";
    public function index()
    {
        return view('admin.slider.index', ['data' => Slider::all()]);
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
                'slider_headline' => 'required',
                'slider_img' => 'required',
                'slider_content' => 'required',
            ]);
            if ($validator->fails()) {
                return back()->withInput()->with('error', $validator->getMessageBag());
            }
            $img = $req->file('slider_img');
            $name_file_img = time() . '_img_' . preg_replace("/[^a-zA-Z0-9]+/", "", $req->slider_headline)  . '.' . $img->getClientOriginalExtension();
            Storage::putFileAs($this->PATH_FILE_DB_NEWS_IMG, $img, $name_file_img);
            Slider::create([
                'title' => $req->slider_headline,
                'content' => $req->slider_content,
                'img' => $name_file_img
            ]);

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Successfully uploaded.',
                'url' => route('flashMsg', 'slider-success')
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
            return view('admin.slider.edit', ['detil_data' => Slider::find($id), 'data' => Slider::all()]);
        } catch (\Throwable $err) {
            return redirect()->route('slider.index')->with('error', $err->getMessage());
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
            $data = Slider::find($id);
            if ($req->file('slider_img')) {
                $img = $req->file('slider_img');
                $name_file_img = time() . '_img_' . preg_replace("/[^a-zA-Z0-9]+/", "", $req->slider_headline)  . '.' . $img->getClientOriginalExtension();
                Storage::putFileAs($this->PATH_FILE_DB_NEWS_IMG, $img, $name_file_img);
                Slider::find($id)->update([
                    'img' => $name_file_img
                ]);
                Storage::delete($this->PATH_FILE_DB_NEWS_IMG . $data->img);
            }
            Slider::find($id)->update([
                'title' => $req->slider_headline,
                'content' => $req->slider_content,
            ]);
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Successfully uploaded.',
                'url' => route('flashMsg', 'slider-success')
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
            $data = Slider::find($id)->first();
            Storage::delete($this->PATH_FILE_DB_NEWS_IMG . $data->img);
            Slider::find($id)->delete();
            return redirect()->route('slider.index')->with('status', 'Slider Deleted!');
        } catch (\Throwable $err) {
            return redirect()->route('slider.index')->with('error', $err->getMessage());
        }
    }
}
