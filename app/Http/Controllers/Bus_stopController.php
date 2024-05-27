<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bus_stop;


class Bus_stopController extends Controller
{
    public function index()
    {
        $busStops = Bus_Stop::all();
        return view('bus_stops', compact('busStops'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'direction' => 'nullable|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);
        //dd($request);
        Bus_Stop::create($request->all());

        return redirect()->back();
    }
}
