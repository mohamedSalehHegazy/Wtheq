<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UsersRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(readonly UsersRepository $model)
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
    public function store(CreateUserRequest $request)
    {
        if($request->has('password')){
            $request['password'] = bcrypt($request->password);
        }

        return $this->model->store($request);
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
    public function update(UpdateUserRequest $request, string $id)
    {
        if($request->has('password')){
            $request['password'] = bcrypt($request->password);
        }
        
        return $this->model->update($id, $request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->model->destroy($id);
    }
}
