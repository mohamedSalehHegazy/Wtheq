<?php

namespace App\Repositories;

use App\Http\Resources\UsersListResource;
use App\Http\Resources\UsersSingleResource;
use App\Models\User;

class UsersRepository extends BaseRepository
{
    protected $model;
    protected $uploads;
    protected $listResource;
    protected $singleResource;

    public function __construct(User $model)
    {
        $this->model = $model;
        $this->uploads = ['avatar'];
        $this->listResource = UsersListResource::class;
        $this->singleResource = UsersSingleResource::class;
    }
}
