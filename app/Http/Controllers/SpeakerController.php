<?php

namespace App\Http\Controllers;

use App\Models\Speaker;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SpeakerController extends Controller
{
    public function index()
    {
        $speakers = Speaker::all();

        if( $speakers->isEmpty() )
        {
            return response()->json(null, 404);
        }

        return response()->json($speakers, 200);
    }

    public function show($id, Request $request)
    {
        $rules = [
            'id' => 'required|integer|min:1|max:2147483647',
        ];

        try {

            $request->merge(['id' => $id]);
            $this->validate($request, $rules);

        } catch (ValidationException $e) {

            return response()->json([
                'error' => $e->getResponse()->original
            ], 422);
        }

        /**
         * Manipulate data
         */
        $speaker = Speaker::find($id);
        if(!$speaker)
        {
            return response()->json(null, 404);
        }

        return response()->json($speaker);

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
