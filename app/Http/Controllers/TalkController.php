<?php

namespace App\Http\Controllers;

use App\Models\Talk;
use Illuminate\Http\Request;

class TalkController extends Controller
{
    public function index()
    {
        $talks = Talk::all();

        return response()->json($talks);
    }

    public function show($id)
    {
        $talk = Talk::find($id);

        return response()->json($talk);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'title'       => 'required|unique:talks',
            'description' => 'required'
        ]);

        $talk = Talk::create($request->all());

        return response()->json($talk, 201);
    }

    public function update(Request $request, $id)
    {
        $talk = Talk::findOrFail($id);
        $talk->update($request->all());

        return response()->json($talk, 200);
    }

    public function destroy($id)
    {
        $talk = Talk::findOrFail($id);
        $talk->delete();

         return response()->json('Talk removed successfully', 200);
    }
}
