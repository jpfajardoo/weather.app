<?php

namespace App\Http\Controllers;

use App\Http\Requests\FetchWeatherRequest as RequestsFetchWeatherRequest;
use App\Services\LocationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    private $apiKey;

    public function __construct(private LocationService $locationService)
	{
        $this->apiKey = config('services.openweathermap.key');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(RequestsFetchWeatherRequest $request)
    {
        if(Auth::check()){
            $this->locationService->storeLocation($request->validated());
        }

        $apiKey = $this->apiKey;
        $lat = request('lat');
        $lon = request('lon');
        $time = request('time');
        
        $response = Http::get("https://api.openweathermap.org/data/2.5/$time?lat=$lat&lon=$lon&appid=$apiKey&units=metric");

        return $response->json();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
