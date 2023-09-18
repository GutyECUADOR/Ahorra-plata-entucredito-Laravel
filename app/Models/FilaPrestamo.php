<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilaPrestamo extends Model
{
    use HasFactory;

    protected $fillable = [
        'credito_id',
        'cuota',
        'aextracapital'
    ];
}
