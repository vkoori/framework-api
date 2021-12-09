<?php

namespace Models;

use Models\Relations\CacheVerificationRelations;
use Illuminate\Database\Eloquent\Model;

class CacheVerification extends Model
{
    use CacheVerificationRelations;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cache_verifications';

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
