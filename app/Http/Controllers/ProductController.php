<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductsRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Repositories\ProductsRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(readonly ProductsRepository $model)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->model->index(
            $request->has('isPaginate') ? true : false,
            $request->has('onlyActive') ? true : false,
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProductsRequest $request)
    {
        return $this->model->store($request, [
            'oneToMany' => [
                [
                    'relationName' => 'productPrices',
                    'foreignKey' => 'product_id',
                    'model' => \App\Models\ProductPrice::class,
                    'uploads' => [],
                ]
            ]
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->model->show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        return $this->model->update($id, $request, [
            'oneToMany' => [
                [
                    'relationName' => 'productPrices',
                    'foreignKey' => 'product_id',
                    'model' => \App\Models\ProductPrice::class,
                    'uploads' => [],
                ]
            ]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->model->destroy($id);
    }
}
