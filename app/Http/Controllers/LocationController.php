<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return view('admin.location.index', ['data' => Location::all()]);
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
                'location_name' => 'required',
                'lat' => 'required',
                'long' => 'required',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            Location::create([
                'location_name' => $req->location_name,
                'lat' => $req->lat,
                'long' => $req->long
            ]);
            return redirect()->route('location.index')->with('');
        } catch (\Throwable $err) {
            return back()->withErrors($err)->withInput();
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
            $detil_data = Location::where('uuid', $id)->first();
            return view('admin.location.edit', ['detil_data' => $detil_data, 'data' => Location::all()]);
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
            $validator = Validator::make($req->all(), [
                'location_name' => 'required',
                'lat' => 'required',
                'long' => 'required',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            Location::where('uuid', $id)->update([
                'location_name' => $req->location_name,
                'lat' => $req->lat,
                'long' => $req->long
            ]);
            return redirect()->route('location.index')->with('');
        } catch (\Throwable $err) {
            return back()->withErrors($err)->withInput();
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
            Location::where('uuid', $id)->delete();
            return redirect()->route('location.index')->with('');
        } catch (\Throwable $err) {
            return back()->withErrors($err)->withInput();
        }
    }
}
