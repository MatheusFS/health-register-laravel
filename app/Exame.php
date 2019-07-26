<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exame extends Model {
    
    protected $primaryKey = 'name';
    public $incrementing = false;
    protected $keyType = 'string';
}
