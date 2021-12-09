<?php

namespace Models;

use Models\Relations\CompanyRelations;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use CompanyRelations;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'companies';

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
