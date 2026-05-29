<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class GeneratorAvailability extends Model
{
    protected $table = 'generator_availability';
    protected $fillable = [
        'GeneratorId',
        'EngineMake',
        'Status',
        'DoneBy',
        'Remarks',
        'StartTime',
        'EndTime',
        'StartDate',
        'EndDate',
        'TillNow',
        'DateIn',
        'TimeIn',
    ];
}