<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Audit extends Model
{

    protected $connection = 'mongodb';

    protected $table = 'logs';

    protected $guarded = [];

}
