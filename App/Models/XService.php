<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class XService extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'x_service';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
