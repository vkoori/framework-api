<?php

namespace Models;

use Models\Relations\LackOfBackgroundRelations;
use Illuminate\Database\Eloquent\Model;

class LackOfBackground extends Model
{
    use LackOfBackgroundRelations;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lack_of_backgrounds';

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
