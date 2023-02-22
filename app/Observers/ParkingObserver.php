<?php

namespace App\Observers;

use App\Models\Parking;
use Illuminate\Support\Facades\Auth;

class ParkingObserver
{
    public function creating(Parking $parking)
    {
        if (Auth::check()) {
            $parking->user_id = Auth::id();
        }

        $parking->start_time = now();
    }
}
