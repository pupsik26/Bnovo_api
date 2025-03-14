<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guests extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'phone',
        'email',
        'country',
    ];
}
