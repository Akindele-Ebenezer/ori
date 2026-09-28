<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeriodicCheck extends Model
{
    protected $fillable = ['Type', 'Equipment', 'Location', 'Date', 'Time', 'DoneBy', 'Remarks'];
}