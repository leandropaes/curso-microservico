<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use SoftDeletes, Uuid;

    const RATING_LIST = [
        'L',
        '10',
        '12',
        '14',
        '16',
        '18'
    ];

    protected $fillable = [
        'id',
        'title',
        'description',
        'year_launched',
        'opened',
        'rating',
        'duration',
    ];

    protected $dates = ['deleted_at'];

    public $incrementing = false;

    protected $casts = [
        'id' => 'string',
        'year_launched' => 'integer',
        'opened' => 'boolean',
        'duration' => 'integer',
    ];
}
