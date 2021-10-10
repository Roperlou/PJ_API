<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bus;

class BusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buses = Bus::orderBy('bus_average_speed')->get();

        return $buses;
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
    public function store(Request $request)
    {

        $bus = Bus::create($request->only('bus_name', 'bus_average_speed'));
        return $bus;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Bus $bus)
    {
        $bus = Bus::findOrFail($bus->id);
        return $bus;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bus $bus
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  i\App\Models\Bus $bus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bus $bus)
    {
        $bus = Bus::indOrFail($bus->id);

        $bus ->fill($request->only('bus_name', 'bus_average_speed'));

        $bus->save();

        return response()->json($bus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bus $bus)
    {
        $bus = Bus::findOrFail($bus->id);

        $bus->drivers()->detach();

        $bus->delete();

        return response()->json($bus);
    }
}
