<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class RestcountriesController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://restcountries.com/v2/',
        ]);
    }

    public function index()
    {
        // Obtener todos los países utilizando la API de Restcountries
        $response = $this->client->get('all');
        $countries = json_decode($response->getBody(), true);

        return response()->json($countries);
    }

    public function show($countryCode)
    {
        // Obtener un país específico utilizando el API de Restcountries y el código de país proporcionado
        $response = $this->client->get("alpha/{$countryCode}");
        $country = json_decode($response->getBody(), true);

        return response()->json($country);
    }

    public function update(Request $request, $countryCode)
    {
        // Actualizar un país específico utilizando el API de Restcountries y el código de país proporcionado
        $response = $this->client->put("alpha/{$countryCode}", [
            'json' => $request->all(),
        ]);

        return response()->json(['message' => 'Country updated successfully']);
    }

    public function store(Request $request)
    {
        // Crear un nuevo país utilizando el API de Restcountries
        $response = $this->client->post('country', [
            'json' => $request->all(),
        ]);

        return response()->json(['message' => 'Country created successfully'], 201);
    }
}
