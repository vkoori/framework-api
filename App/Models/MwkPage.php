<?php

namespace App\Models;

use App\Models\GeneratedRelations\MwkPageRelations;
use Illuminate\Database\Eloquent\Model;

class MwkPage extends Model
{
    use MwkPageRelations;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mwk_pages';

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
