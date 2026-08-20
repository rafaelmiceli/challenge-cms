<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticuloRequest;
use App\Http\Requests\UpdateArticuloRequest;
use App\Http\Resources\ArticuloResource;
use App\Services\ArticuloService;
use Illuminate\Http\JsonResponse;

class ArticuloController extends Controller
{
    public function __construct(
        protected ArticuloService $service
    ) {
    }

    public function index()
    {
        $articulos = $this->service->paginate();

        return ArticuloResource::collection($articulos);
    }

    public function store(StoreArticuloRequest $request)
    {
        $articulo = $this->service->create(
            $request->validated()
        );

        return (new ArticuloResource($articulo))
            ->response()
            ->setStatusCode(201);
    }

    public function show(int $id)
    {
        $articulo = $this->service->findById($id);

        if (!$articulo) {
            return response()->json([
                'message' => 'Artículo no encontrado',
            ], 404);
        }

        return new ArticuloResource($articulo);
    }

    public function update(
        UpdateArticuloRequest $request,
        int $id
    ) {
        $articulo = $this->service->findById($id);

        if (!$articulo) {
            return response()->json([
                'message' => 'Artículo no encontrado',
            ], 404);
        }

        $articulo = $this->service->update(
            $id,
            $request->validated()
        );

        return new ArticuloResource($articulo);
    }

    public function destroy(int $id): JsonResponse
    {
        $articulo = $this->service->findById($id);

        if (!$articulo) {
            return response()->json([
                'message' => 'Artículo no encontrado',
            ], 404);
        }

        $this->service->delete($id);

        return response()->json([
            'message' => 'Artículo eliminado correctamente',
        ]);
    }
}