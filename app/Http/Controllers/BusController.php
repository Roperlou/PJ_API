<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bus;

class BusController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/buses",
     *     summary="Get list of buses",
     *     tags={"Buses"},
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/definitions/Bus")
     *         ),
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Ooops, something wrong",
     *     )
     * )
     */
    public function index()
    {
        $buses = Bus::orderBy('bus_average_speed')->get();

        return response()->json($buses);
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
     * @OA\Post(
     *     path="/api/buses",
     *     summary="Store bus",
     *     tags={"Buses"},
     *     description="Store driver",
     *
     *     @OA\Parameter(
     *         name="bus_name",
     *         in="query",
     *         description="Bus name",
     *         required=true,
     *         @OA\Schema(
     *             type="string"),
     *     ),
     *
     *     @OA\Parameter(
     *         name="bus_average_speed",
     *         in="query",
     *         description="Average speed",
     *         required=true,
     *     ),
     *
     *     @OA\Parameter(
     *         name="drivers[]",
     *         in="query",
     *         description="Drivers for this model",
     *         required=false,
     *         @OA\Schema(
     *             type="array", @OA\Items(type="integer")),
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\Schema(ref="#/definitions/Bus"),
     *
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Bus is not found",
     *     )
     * )
     */
    public function store(Request $request)
    {

        $bus = Bus::create($request->only('bus_name', 'bus_average_speed'));
        foreach ($request->only('drivers')['drivers'] as $driver){
            $bus->drivers()->attach($driver);
        }
        return response()->json($bus);
    }

    /**
     * @OA\Get(
     *     path="/api/buses/{bus_id}",
     *     summary="Get bus by id",
     *     tags={"Buses"},
     *     description="Get bus by id",
     *     @OA\Parameter(
     *         name="bus_id",
     *         in="path",
     *         description="Bus id",
     *         required=true,
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\Schema(ref="#/definitions/Bus"),
     *
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Bus is not found",
     *     )
     * )
     */
    public function show(Bus $bus)
    {
        $bus =Bus::findOrFail($bus->id);
        return response()->json($bus);

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
     * @OA\Put(
     *     path="/api/buses/{bus_id}",
     *     summary="Update bus",
     *     tags={"Buses"},
     *     description="Update bus",
     *
     *     @OA\Parameter(
     *         name="bus_id",
     *         in="path",
     *         description="Bus id",
     *         required=true,
     *     ),
     *
     *     @OA\Parameter(
     *         name="bus_name",
     *         in="query",
     *         description="Bus name",
     *         required=true,
     *         @OA\Schema(
     *             type="string"),
     *     ),
     *
     *     @OA\Parameter(
     *         name="bus_average_speed",
     *         in="query",
     *         description="Average speed",
     *         required=true,
     *     ),
     *
     *
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\Schema(ref="#/definitions/Bus"),
     *
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Bus is not found",
     *     )
     * )
     */
    public function update(Request $request, Bus $bus)
    {
        $bus = Bus::findOrFail($bus->id);

        $bus ->fill($request->only('bus_name', 'bus_average_speed'));

        $bus->save();

        return response()->json($bus);
    }

    /**
     * @OA\Delete(
     *     path="/api/buses/{bus_id}",
     *     summary="Get bus by id",
     *     tags={"Buses"},
     *     description="Get bus by id",
     *     @OA\Parameter(
     *         name="bus_id",
     *         in="path",
     *         description="Bus id",
     *         required=true,
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\Schema(ref="#/definitions/Bus"),
     *
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Bus is not found",
     *     )
     * )
     */
    public function destroy(Bus $bus)
    {
        $bus = Bus::findOrFail($bus->id);

        $bus->drivers()->detach();

        $bus->delete();

        return response()->json($bus);
    }
}
