<?php

namespace Models;

use Models\Relations\IdentityRelations;
use Illuminate\Database\Eloquent\Model;

class Identitie extends Model
{
    use IdentityRelations;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'identities';

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
