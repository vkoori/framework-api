<?php

namespace Models;

use Models\Relations\AdminLogRelations;
use Illuminate\Database\Eloquent\Model;

class AdminLog extends Model
{
    use AdminLogRelations;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admin_logs';

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
