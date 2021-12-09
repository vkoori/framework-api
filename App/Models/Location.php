<?php

namespace Models;

use Models\Relations\LocationRelations;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use LocationRelations;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'locations';

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
    public $timestamps = true;
}
