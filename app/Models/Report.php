<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'report_link', 'start_date', 'end_date'
    ];

    protected $casts = [
        'created_at'  => 'date:d/m/Y'
    ];
}
