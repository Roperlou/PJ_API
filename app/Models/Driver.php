<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $hidden = [
        'updated_at',
        'created_at',
        'buses',
    ];

    /**
     *      * Связь между водителем и автобусами
     *
     *
     */
    public function buses()
    {
        return $this->belongsToMany(Bus::class);
    }

    /**
     * Выполняет расчет возроста водителя относитель текущей даты
     *
     * @return string
     */
    public function getAge()
    {
            $diff = date( 'Ymd' ) - date( 'Ymd', strtotime($this->birth_date) );

            return substr( $diff, 0, -4 );
    }

    /**
     * Выполняет расчет времени путешествия для водителя в днях
     *
     * @param  integer $distance
     * @return void
     */
    public function getTravelTime($distance)
    {
        $travelTime = ceil($distance / $this->buses->max('bus_average_speed') / 8);

        return intval($travelTime);
    }
}
