<?php

namespace App\Models;

use App\Models\GeneratedRelations\XServiceOptionRelations;
use Illuminate\Database\Eloquent\Model;

class XServiceOption extends Model
{
    use XServiceOptionRelations;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'x_service_option';

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
