<?php

namespace App\Http\Controllers;

use App\Circle;
use App\Http\Resources\CirclesResource;
use Illuminate\Http\Request;

class CirclesController extends Controller
{
    public function show(Circle $circle)
    {
        // return view('circles.show', compact('circle'));
        return response()->json([
            'title'  => $circle->title,
            'members' => $circle->members,
            'member_ids' => $circle->members->pluck('id')
        ], 200);
    }

    public function store(Request $request)
    {
        $circle = Circle::create([
            'title' => $request->title,
            'user_id' => $request->user()->id
        ]);

        $circle->members()->syncWithoutDetaching($request->user()->id);

        return response()->json([
            'circle' => new CirclesResource($circle)
        ], 201);
    }

    public function join(Circle $circle)
    {
        dd("Requesting to join circle");
    }
}
