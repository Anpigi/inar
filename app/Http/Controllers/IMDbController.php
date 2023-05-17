<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class IMDbController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.imdb.com/',
        ]);
    }

    public function index()
    {
        // Obtener todas las películas utilizando la API de IMDb
        $response = $this->client->get('movies');
        $movies = json_decode($response->getBody(), true);

        return response()->json($movies);
    }

    public function show($movieId)
    {
        // Obtener una película específica utilizando el API de IMDb y el ID de película proporcionado
        $response = $this->client->get("movies/{$movieId}");
        $movie = json_decode($response->getBody(), true);

        return response()->json($movie);
    }

    public function update(Request $request, $movieId)
    {
        // Actualizar una película específica utilizando el API de IMDb y el ID de película proporcionado
        $response = $this->client->put("movies/{$movieId}", [
            'json' => $request->all(),
        ]);

        return response()->json(['message' => 'Movie updated successfully']);
    }

    public function store(Request $request)
    {
        // Crear una nueva película utilizando el API de IMDb
        $response = $this->client->post('movies', [
            'json' => $request->all(),
        ]);

        return response()->json(['message' => 'Movie created successfully'], 201);
    }
}
