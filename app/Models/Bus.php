<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bus extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function drivers()
    {
        return $this->belongsToMany(Driver::class);
    }

}
