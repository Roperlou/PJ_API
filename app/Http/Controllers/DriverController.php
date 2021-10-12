<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use App\Http\Requests\DriverRequest;

class DriverController extends Controller
{


    /**
     * @OA\Get(
     *     path="/api/drivers",
     *     summary="Get list of drivers",
     *     tags={"Drivers"},
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/definitions/Driver")
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
        $drivers = Driver::orderBy('full_name')->get();

        foreach ($drivers as $driver)
        {
            $driver->age = $driver->getAge();
        }

        return response()->json($drivers);
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
     *     path="/api/drivers",
     *     summary="Store driver",
     *     tags={"Drivers"},
     *     description="Store driver",
     *
     *     @OA\Parameter(
     *         name="full_name",
     *         in="query",
     *         description="Driver name",
     *         required=true,
     *         @OA\Schema(
     *             type="string"),
     *     ),
     *
     *     @OA\Parameter(
     *         name="birth_date",
     *         in="query",
     *         description="Driver birth_date",
     *         required=true,
     *     ),
     *
     *     @OA\Parameter(
     *         name="bus_models[]",
     *         in="query",
     *         description="Driver available bus models",
     *         required=false,
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
    public function store(DriverRequest $request)
    {
         $driver = Driver::create($request->only('full_name', 'birth_date'));
         foreach ($request->only('bus_models')['bus_models'] as $model){
             $driver->buses()->attach($model);
         }
        return response()->json($driver);
    }

    /**
     * @OA\Get(
     *     path="/api/drivers/{driver_id}",
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
    public function show(Driver $driver)
    {
        $driver = Driver::findOrFail($driver->id);
        $driver->age = $driver->getAge();
        return response()->json($driver);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function edit(Driver $driver)
    {
        //
    }

    /**
     * @OA\Put(
     *     path="/api/drivers/{driver_id}",
     *     summary="Update driver",
     *     tags={"Drivers"},
     *     description="Update driver",
     *
     *     @OA\Parameter(
     *         name="driver_id",
     *         in="path",
     *         description="Driver id",
     *         required=true,
     *     ),
     *
     *     @OA\Parameter(
     *         name="full_name",
     *         in="query",
     *         description="Driver name",
     *         required=true,
     *         @OA\Schema(
     *             type="string"),
     *     ),
     *
     *     @OA\Parameter(
     *         name="birth_date",
     *         in="query",
     *         description="Driver birth_date",
     *         required=true,
     *     ),
     *
     *     @OA\Parameter(
     *         name="bus_models[]",
     *         in="query",
     *         description="Driver available bus models",
     *         required=false,
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
    public function update(Request $request, Driver $driver)
    {
        $driver = Driver::findOrFail($driver->id);

        $driver->fill($request->only('full_name', 'birth_date'));

        $models = $request->only('bus_models');

        foreach ($models as $model)
        {
            if (!$driver->buses->find($model))
            {
               $driver->buses()->attach($model);
            }
    }
        $driver->save();

        return response()->json($driver);
    }

    /**
     * @OA\Delete(
     *     path="/api/drivers/{driver_id}",
     *     summary="Delete driver by id",
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
    public function destroy(Driver $driver)
    {
        $driver = Driver::findOrFail($driver->id);

        $driver->delete();

        return response()->json($driver);
    }
}
