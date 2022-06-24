<?php

namespace App\Http\Controllers;

use App\Models\Info;
use App\Models\Location;
use App\Models\Route;
use App\Models\RouteLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use stdClass;

use function convertDMSToDecimal;

class NvrGPSControllers extends Controller
{
    public function getLocation(Request $request)
    {
        try {
            $setting = DB::table('setting')->first();
            $route = Route::where('id',$setting->route_id)->with('routeList', 'routeList.getLocation')->first();
            $textinfo = Info::find(1);
            $locations = Location::all();
            $position_lat = $request['lat'];
            $position_long = $request['lng'];
            $speed = floatval($request['speed']);
            $arr_location = [];
            $arr_distance = [];
            $arr_eta = [];
            $position_name = 'Unknown';


            //GET POSITON
            foreach ($locations as $location) {
                $position = $this->haversineGreatCircleDistance($position_lat, $position_long, $location->lat, $location->long);
               if ($position < 1) {
                   $position_name = $location->location_name;
               }
            }


            foreach ($route->routeList as $location_nm) {
                array_push($arr_location, $location_nm->getLocation->location_name);
            }

            // GET DISTANCE
            foreach ($route->routeList as $key => $location) {
                if ($location->pass == null) {
                    $distance = $this->haversineGreatCircleDistance($position_lat, $position_long, $location->getLocation->lat, $location->getLocation->long);
                    if ($distance <= 0.020) {
                        RouteLocation::where('location_id', $location->location_id)->update([
                            'pass' => 1
                        ]);
                        array_push($arr_distance, 0);
                    } else {
                        array_push($arr_distance, round($distance));
                    }
                } else {
                    array_push($arr_distance, 0);
                }
            }
            // GET ETA
            foreach ($arr_distance as $distance) {
                $speed = ($speed <= 20.00) ? 20.00 : $speed;
                $eta = $distance / $speed;
                $mnt = $eta * 60;
                array_push($arr_eta, $mnt);
            }


            return response()->json([
                'speed' => ($speed <= 20.00) ? 0 : $speed,
                'position' => $position_name,
                'location_name' => $arr_location,
                'distance_route' => $arr_distance,
                'eta' => $arr_eta,
                'text_info' => ($textinfo) ? $textinfo->message : ''
            ]);
        } catch (\Throwable $err) {
            return response()->json([
                "error" => $err->getMessage()
            ], 500);
        }
    }

    public function calculateDistance()
    {
    }



    function haversineGreatCircleDistance(
        $latitudeFrom,
        $longitudeFrom,
        $latitudeTo,
        $longitudeTo,
        $earthRadius = 6371000
    ) {
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
            cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        $distance =   ($angle * $earthRadius) / 1000;
        return round($distance, 3);
    }
}
