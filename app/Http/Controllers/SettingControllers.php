<?php

namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\DocBlock\Tags\See;

class SettingControllers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = Setting::first();
            if ($data) {
                $route = Route::find($data->route_id);

                return view('admin.setting.index', [
                    'data' => $data,
                    'routes' => Route::all(),
                    'route_name' => $route->route_name
                ]);
            }
            return view('admin.setting.index', ['data' => null, 'routes' => Route::all()]);
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
            $data = $req->all();
            Setting::create($data);
            return redirect()->route('setting.index')->with('succes', 'Setting Applied');
        } catch (\Throwable $err) {
            return back()->withErrors($err->getMessage())->withInput();
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
    public function update(Request $req, $id)
    {
        try {
            $validator = Validator::make($req->all(), [
                'ip_nvr' => 'required',
                'route_id' => 'required',
                'interval_update_location' => 'required',
                'radius_location' => 'required',

            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            $data = $req->except(['_method', '_token']);
            $data['id'] = $id;
            Setting::where('id', $id)->update($data);


            return redirect()->route('setting.index')->with('succes', 'Setting Applied');;
        } catch (\Throwable $err) {
            return back()->withErrors($err->getMessage())->withInput();
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
        //
    }
}
