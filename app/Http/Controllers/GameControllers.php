<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class GameControllers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $PATH_FILE_DB_GAME_COVER = "public/game/cover/";
    public function index()
    {
        try {
            return view('admin.game.index', ['data' => Game::all()]);
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
                'game_name' => 'required',
                'game_category' => 'required',
                'game_url' => 'required',
                'game_banner' => 'required',
            ]);
            if ($validator->fails()) {
                return back()->withInput()->with('error', $validator->getMessageBag());
            }
            $file_banner = $req->file('game_banner');
            $name_file_banner = time() . '_file_' . preg_replace("/[^a-zA-Z0-9]+/", "", $req->game_name) . '.' . $file_banner->getClientOriginalExtension();
            Game::create([
                'game_name' => $req->game_name,
                'game_category' => $req->game_category,
                'game_url' => $req->game_url,
                'path_banner' => $name_file_banner
            ]);
            Storage::putFileAs($this->PATH_FILE_DB_GAME_COVER, $file_banner, $name_file_banner);


            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Successfully uploaded.',
                'url' => route('flashMsg', 'game-success')
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
            $detil_data = Game::where('uuid', $id)->first();
            return view('admin.game.edit', ['detil_data' => $detil_data, 'data' => Game::all()]);
        } catch (\Throwable $err) {
            return redirect()->route('game.index')->with('error', $err->getMessage());
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
                'game_name' => 'required',
                'game_category' => 'required',
                'game_url' => 'required',
            ]);
            if ($validator->fails()) {
                return back()->withInput()->with('error', $validator->getMessageBag());
            }
            $game = Game::where('uuid', $id)->first();
            if (!empty($req->file('game_banner'))) {
                $file_banner = $req->file('game_banner');
                $name_file_banner = time() . '_file_' . preg_replace("/[^a-zA-Z0-9]+/", "", $req->game_name) . '.' . $file_banner->getClientOriginalExtension();
                Game::where('uuid', $id)->update([
                    'path_banner' => $name_file_banner
                ]);
                Storage::delete($this->PATH_FILE_DB_GAME_COVER . $game->path_banner);
                Storage::putFileAs($this->PATH_FILE_DB_GAME_COVER, $file_banner, $name_file_banner);
            }

            Game::where('uuid', $id)->update([
                'game_name' => $req->game_name,
                'game_category' => $req->game_category,
                'game_url' => $req->game_url,
            ]);


            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Successfully uploaded.',
                'url' => route('flashMsg', 'game-success')
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
            $game = Game::where('uuid', $id)->first();
            Storage::delete($this->PATH_FILE_DB_GAME_COVER . $game->path_banner);
            Game::where('uuid', $id)->delete();

            return redirect()->route('game.index')->with('status', 'Game Deleted!');
        } catch (\Throwable $err) {
            return redirect()->route('game.index')->with('error', $err->getMessage());
        }
    }
}
