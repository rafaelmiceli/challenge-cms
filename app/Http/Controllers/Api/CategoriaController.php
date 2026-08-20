<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use App\Http\Resources\CategoriaResource;
use App\Services\CategoriaService;
use Illuminate\Http\JsonResponse;

class CategoriaController extends Controller
{
    public function __construct(
        protected CategoriaService $service
    ) {
    }

    public function index()
    {
        $articulos = $this->service->paginate();

        return CategoriaResource::collection($articulos);
    }

    public function store(StoreCategoriaRequest $request)
    {
        $articulo = $this->service->create(
            $request->validated()
        );

        return (new CategoriaResource($articulo))
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

        return new CategoriaResource($articulo);
    }

    public function update(
        UpdateCategoriaRequest $request,
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

        return new CategoriaResource($articulo);
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