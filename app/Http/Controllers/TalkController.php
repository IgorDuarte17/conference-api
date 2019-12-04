<?php

namespace App\Http\Controllers;

use App\Models\Talk;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TalkController extends Controller
{
    public function index()
    {
        $talks = Talk::all();

        if( $talks->isEmpty() )
        {
            return response()->json(null, 404);
        }

        return response()->json($talks, 200);
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
        $talk = Talk::find($id);
        if(!$talk)
        {
            return response()->json(null, 404);
        }

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
