<?php

namespace App\Http\Controllers;

use App\Models\Info;
use Illuminate\Http\Request;

class InfoControllers extends Controller
{
    public function createInfo(Request $req)
    {
        try {
            $check = Info::find(1);
            if ($check == null) {
                Info::create([
                    'id' => 1,
                    'message' => $req->message
                ]);
            } else {
                Info::find(1)->update([
                    'message' => $req->message
                ]);
            }
            return redirect()->route('dashboard')->with('success', 'Message Send');
        } catch (\Throwable $err) {
            return redirect()->route('dashboard')->with('error', $err->getMessage());
        }
    }


    public function getInfo()
    {
        $data = Info::find(1);
        return response()->json([
            'code' => 200,
            'message' => $data->message
        ]);
    }

    public function delete_info()
    {
        Info::find(1)->delete();
        return response()->json([
            'code' => 200,
            'message' => 'success'
        ]);
    }
}
