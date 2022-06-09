<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Route;
use App\Models\RouteLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RouteControllers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return view('admin.route.index', ['data_location' => Location::all(), 'data_route' => Route::with('routeList', 'routeList.getLocation')->get()]);
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
                'route_name' => 'required',
                'from' => 'required',
                'to' => 'required',
                'translit' => 'required',

            ]);

            if ($validator->fails()) {

                return back()->withErrors($validator->getMessageBag())->withInput();
            }
            $route = Route::create([
                'route_name' => $req->route_name,
                'from' => $req->from,
                'to' => $req->to
            ]);
            foreach ($req->translit as $location) {
                RouteLocation::create([
                    'route_id' => $route->id,
                    'location_id' => $location
                ]);
            }
            return redirect()->route('route.index')->with('');
        } catch (\Throwable $err) {
            return redirect()->route('route.index')->with('error', $err->getMessage());
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
            Route::find($id)->delete();
            RouteLocation::where('route_id', $id)->delete();
            return redirect()->route('route.index')->with('');
        } catch (\Throwable $err) {
            return redirect()->route('route.index')->with('error', $err->getMessage());
        }
    }
}
