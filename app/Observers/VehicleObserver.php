<?php

namespace App\Observers;

use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;

class VehicleObserver
{
    public function creating(Vehicle $vehicle): void
    {
        if (Auth::check()) {
            $vehicle->user_id = Auth::id();
        }
    }
}
