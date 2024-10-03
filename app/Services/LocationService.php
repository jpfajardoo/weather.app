<?php

namespace App\Services;

use App\Models\UserLocation;
use Illuminate\Support\Facades\Auth;

class LocationService
{
    public function storeLocation($locationData)
    {
        UserLocation::updateOrCreate([
            'user_id' => Auth::user()->id,
            'latitude' => $locationData['lat'],
            'longitude' => $locationData['lon']
        ],[
            'address' => $locationData['address'],
        ]);
    }
}
