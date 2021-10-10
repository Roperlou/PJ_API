<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use App\Http\Requests\DriverRequest;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drivers = Driver::orderBy('full_name')->get();

        foreach ($drivers as $driver)
        {
            $driver->age = $driver->getAge();
        }

        return $drivers;
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
    public function store(DriverRequest $request)
    {
        $driver = Driver::create($request->only('full_name', 'birth_date'));
        foreach ($request->only('bus_models') as $model){
            $driver->buses()->attach($model);
        }
        return $driver;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function show(Driver $driver)
    {
        $driver = Driver::find($driver)->first();
        $driver->age = $driver->getAge();
        return $driver;
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Driver $driver)
    {
        $driver = Driver::findOrFail($driver->id);

        $driver->fill($request->only('full_name', 'birth_date'));

        $models = $request->only('bus_models')['bus_models'];

        foreach ($models as $model)
        {
            if (!$driver->buses->find($model))
            {
               $driver->buses()->attach($model);
            }
    }
        $driver->save();

        return $driver;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy(Driver $driver)
    {
        $driver = Driver::findOrFail($driver->id);

        $driver->buses()->detach();

        $driver->delete($driver->id);

        return $driver;
    }
}
