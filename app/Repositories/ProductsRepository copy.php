<?php

namespace App\Repositories;

use App\Http\Resources\ProductsListResource;
use App\Http\Resources\ProductsSingleResource;
use App\Models\Product;

class ProductsRepository extends BaseRepository
{
    protected $model;
    protected $uploads;
    protected $listResource;
    protected $singleResource;

    public function __construct(Product $model)
    {
        $this->model = $model;
        $this->uploads = ['image'];
        $this->listResource = ProductsListResource::class;
        $this->singleResource = ProductsSingleResource::class;
    }
}
