<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * @SWG\Definition(
 *  definition="Bus",
 *  @SWG\Property(
 *      property="id",
 *      type="integer"
 *  ),
 *  @SWG\Property(
 *      property="bus_name",
 *      type="string"
 *  ),
 *  @SWG\Property(
 *      property="bus_average_speed",
 *      type="integer"
 *  )
 * )
 */
class Bus extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'bus_name',
        'bus_average_speed',
    ];

    public function drivers()
    {
        return $this->belongsToMany(Driver::class);
    }

}
