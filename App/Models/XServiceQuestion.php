<?php

namespace App\Models;

use App\Models\GeneratedRelations\XServiceQuestionRelations;
use Illuminate\Database\Eloquent\Model;

class XServiceQuestion extends Model
{
    use XServiceQuestionRelations;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'x_service_question';

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
