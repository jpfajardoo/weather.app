<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserLocationResource;
use App\Models\UserLocation;
use Illuminate\Support\Facades\Auth;

class UserLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $location = UserLocation::where('user_id',Auth::user()->id)->orderBy('updated_at','desc')->first();
        return new UserLocationResource($location);
    }
}
