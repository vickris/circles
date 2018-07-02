<?php

namespace App\Http\Controllers;

use App\Circle;
use Illuminate\Http\Request;

class CirclesController extends Controller
{
    public function show(Circle $circle)
    {
        return view('circles.show', compact('circle'));
        // return response()->json([
        //     'data' => [
        //         'circle'  => $circle->title,
        //         'members' => $circle->members,
        //         'movies'  => $circle->movies,
        //     ]
        // ], 200);
    }

    public function store(Request $request)
    {
        $circle = Circle::create([
            'title' => $request->title,
            'user_id' => $request->user_id
        ]);
    }

    public function join(Circle $circle)
    {
        dd("Requesting to join circle");
    }
}
