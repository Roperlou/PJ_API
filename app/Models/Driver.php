<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * @SWG\Definition(
 *  definition="Driver",
 *  @SWG\Property(
 *      property="id",
 *      type="integer"
 *  ),
 *  @SWG\Property(
 *      property="full_name",
 *      type="string"
 *  ),
 *  @SWG\Property(
 *      property="birth_date",
 *      type="date"
 *  )
 * )
 */
class Driver extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $hidden = [
        'updated_at',
        'created_at',
        'deleted_at',
        'buses',

    ];

    protected $fillable = [
        'full_name',
        'birth_date',
    ];

    /**
     * Связь между водителем и автобусами
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

            return $this->age = substr( $diff, 0, -4 );

    }

    /**
     * Выполняет расчет времени путешествия для водителя в днях
     *
     * @param  integer $distance
     * @return void
     */
    public function getTravelTime($distance)
    {
        if ($this->buses->isEmpty())
        {
            return '404';

        } else {

        $travelTime = ceil($distance / $this->buses()->max('bus_average_speed') / 8);

        return intval($travelTime);
        }
    }
}
