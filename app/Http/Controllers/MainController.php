<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Distance;
use App\Models\Driver;
use App\Models\Bus;

class MainController extends Controller
{
    /**
     * Присваивает каждому водителю поле 'travel_time' и сортирует по возрастанию этого поля, также присваивает поле 'age'
     *
     * @param  string $p1
     * @param  string $p2
     *
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
     * Присваивает водителю поле 'travel_time' и поле 'age'
     *
     * @param  integer $id
     * @param  string $p1
     * @param  string $p2
     *
     */
    public function getTravelTimeForOne($id, $p1, $p2)
    {
        $distance =  (new Distance)->callApi($p1, $p2);

        $driver = Driver::find($id);

        $driver->age = $driver->getAge();

        $driver->travel_time = $driver->getTravelTime($distance);

        return response()->json($driver);
    }

    public function restoreDriver($id){

        $driver = Driver::onlyTrashed()->find($id);
        $driver->restore();

        return $driver;
    }

    public function restoreBus($id){

        $bus = Bus::onlyTrashed()->find($id);
        $bus->restore();

        return $bus;
    }
}
