<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Client\ClientRequest;
use App\Models\Client;
use Illuminate\Http\JsonResponse;

class ClientsController extends Controller
{
    public function index()
    {
        return Client::active()->paginate(10);
    }

    public function store(ClientRequest $request)
    {

    }

    public function update(ClientRequest $request, Client $client)
    {

    }

    public function destroy(Client $client): JsonResponse
    {
        $client->delete();
        return response()->json([
            'message' => 'Recurso removido'
        ]);
    }

}
