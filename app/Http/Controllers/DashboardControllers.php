<?php

namespace App\Http\Controllers;

use App\Models\Info;
use App\Models\Movie;
use App\Models\Route;
use App\Models\Setting;
use Illuminate\Http\Request;

class DashboardControllers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::first();
        $info = Info::find(1);
        if ($setting) {
            $data = Route::with('routeList', 'routeList.getLocation')->find($setting->route_id);
            $route_name = $data->route_name;
            $location_name = [];
            foreach ($data->routeList as $key => $location) {
                array_push($location_name, $location->getLocation->location_name);
            }

            return view('admin.dashboard', ['route' => $location_name, 'data' => $setting, 'route_name' => $route_name, 'info' => (!empty($info)) ? $info->message : null]);
        }

        return view('admin.dashboard', ['info' => (!empty($info)) ? $info->message : null, 'data' => $setting]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        } catch (\Throwable $th) {
            //throw $th;
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
        //
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
        //
    }
}
