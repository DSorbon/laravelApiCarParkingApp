<?php

namespace App\Models;

use App\Traits\UserRecord;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Vehicle extends Model
{
    use HasFactory, UserRecord;

    protected $fillable = [
        'user_id',
        'plate_number'
    ];
}
