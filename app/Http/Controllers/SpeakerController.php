<?php

namespace App\Http\Controllers;

use App\Models\Speaker;
use Illuminate\Http\Request;

class SpeakerController extends Controller
{
    public function index()
    {
        $speakers = Speaker::all();

        return response()->json($speakers);
    }

    public function show($id)
    {
        $Speaker = Speaker::find($id);

        return response()->json($Speaker);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name'   => 'required',
            'resume' => 'required',
            'github' => 'required|unique:Speakers',
        ]);

        $Speaker = Speaker::create($request->all());

        return response()->json($Speaker, 201);
    }

    public function update(Request $request, $id)
    {
        $Speaker = Speaker::findOrFail($id);
        $Speaker->update($request->all());

        return response()->json($Speaker, 200);
    }

    public function destroy($id)
    {
        $Speaker = Speaker::findOrFail($id);
        $Speaker->delete();

         return response()->json('Speaker removed successfully', 200);
    }
}
