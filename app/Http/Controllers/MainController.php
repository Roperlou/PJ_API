<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Distance;
use App\Models\Driver;
use App\Models\Bus;

class MainController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/drivers/getTravelTime/{point_1}|{point_2}",
     *     summary="Get travel time between two points for all drivers",
     *     tags={"Travel time"},
     *     description="Get trevel time to all drivers",
     *     @OA\Parameter(
     *         name="point_1",
     *         in="path",
     *         description="Point 1",
     *         required=true,
     *     ),
     *
     *     @OA\Parameter(
     *         name="point_2",
     *         in="path",
     *         description="Point 2",
     *         required=true,
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\Schema(ref="#/definitions/Driver"),
     *
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Driver is not found",
     *     )
     * )
     */
    public function getTravelTimeForAll($p1, $p2)
    {
        $distance =  (new Distance)->callApi($p1, $p2);

        $drivers = Driver::get();

        foreach ($drivers as $driver)
        {
            $driver->age = $driver->getAge();

            $driver->travel_time = $driver->getTravelTime($distance);
        }

        return response()->json($drivers->sortBy('travel_time'));
    }

    /**
     * @OA\Get(
     *     path="/api/drivers/{driver_id}/getTravelTime/{point_1}|{point_2}",
     *     summary="Get travel time between two points for 1 driver",
     *     tags={"Travel time"},
     *     description="Get trevel time driver",
     *
     *     @OA\Parameter(
     *         name="driver_id",
     *         in="path",
     *         description="Driver id",
     *         required=true,
     *     ),
     *
     *     @OA\Parameter(
     *         name="point_1",
     *         in="path",
     *         description="Point 1",
     *         required=true,
     *     ),
     *
     *     @OA\Parameter(
     *         name="point_2",
     *         in="path",
     *         description="Point 2",
     *         required=true,
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\Schema(ref="#/definitions/Driver"),
     *
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Driver is not found",
     *     )
     * )
     */
    public function getTravelTimeForOne($id, $p1, $p2)
    {
        $distance =  (new Distance)->callApi($p1, $p2);

        $driver = Driver::find($id);

        $driver->age = $driver->getAge();

        $driver->travel_time = $driver->getTravelTime($distance);

        return response()->json($driver);
    }

    /**
     * @OA\Get(
     *     path="/api/drivers/restore/{driver_id}",
     *     summary="Get driver by id",
     *     tags={"Drivers"},
     *     description="Get driver by id",
     *     @OA\Parameter(
     *         name="driver_id",
     *         in="path",
     *         description="Driver id",
     *         required=true,
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\Schema(ref="#/definitions/Driver"),
     *
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Driver is not found",
     *     )
     * )
     */

    public function restoreDriver($id){

        $driver = Driver::onlyTrashed()->find($id);
        $driver->restore();

        return $driver;
    }

    /**
     * @OA\Get(
     *     path="/api/buses/restore/{bus_id}",
     *     summary="Restore bus by id",
     *     tags={"Buses"},
     *     description="Restore bus by id",
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
     *         description="Driver is not found",
     *     )
     * )
     */

    public function restoreBus($id){

        $bus = Bus::onlyTrashed()->find($id);
        $bus->restore();

        return $bus;
    }


    /**
     * @OA\Get(
     *     path="/api/drivers/{driver_id}/deleteRelations",
     *     summary="Delete driver's available buses",
     *     tags={"Drivers"},
     *     description="UDelete driver's available buses",
     *
     *     @OA\Parameter(
     *         name="driver_id",
     *         in="path",
     *         description="Driver id",
     *         required=true,
     *     ),
     *
     *     @OA\Parameter(
     *         name="bus_models[]",
     *         in="query",
     *         description="Driver available bus models",
     *         required=true,
     *         @OA\Schema(
     *             type="array", @OA\Items(type="integer")),
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\Schema(ref="#/definitions/Driver"),
     *
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Driver is not found",
     *     )
     * )
     */
    public function deleteRelations(Request $request, $id)
    {
        $driver = Driver::findOrFail($id);

        foreach ($request->only('bus_model') as $model){
            $driver->buses()->detach($model);
        }

        return $driver;
    }
}
