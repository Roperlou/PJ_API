<?php

namespace App;

use Illuminate\Support\Facades\Http;

class Distance
{

    /**
     * Обращается в стороннему сервису для получения расстояния между городами
     *
     * @param  mixed $point_1
     * @param  mixed $point_2
     *
     */

    public function callApi($point_1, $point_2){

        $response = Http::get(config('services.distance.url'), [

            'stops'=> $point_1 . '|' . $point_2
        ]);

        return $response->json()['distance'] ? $response->json()['distance'] : null;
    }



}
