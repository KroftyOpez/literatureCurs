<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\RoleCreateRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function index()
    {
        $user = Auth::User();
        if($user->role->code === 'admin'){
            $roles = Role::all();
            return response()->json($roles)->setStatusCode(200);
        }
        throw new ApiException('У вас нет прав для этого действия :(', 403 );
    }


    public function create(RoleCreateRequest $request)
    {
        $user = Auth::User();
        if($user->role->code === 'admin'){
            $role = Role::create($request->validated());
            return response()->json($role)->setStatusCode(201);
        }
        throw new ApiException('У вас нет прав для этого действия :(', 403 );

    }


    public function show(Role $role)
    {
        if (empty($role->id)) {
            throw new ApiException('Увы, не найдено', 404);
        }

        return response()->json($role)->setStatusCode(200);
    }


    public function update(RoleUpdateRequest $request, Role $category)
    {
        $user = Auth::getUser();
        if($user->role->code === 'admin'){
            if (empty($category->id)) {
                throw new ApiException('Увы, не найдено', 404);
            }
            $category->update($request->validated());
            return response()->json($category)->setStatusCode(200);
        }
        throw new ApiException('У вас нет прав для этого действия :(', 403 );


    }


    public function destroy(Category $category)
    {
        $user = Auth::getUser();
        if($user->role->code === 'admin'){
            if (empty($category->id)) {
                throw new ApiException('Not Found ', 404);
            }
            $category->delete();
            return response()->json(null)->setStatusCode(204);
        }
        throw new ApiException('У вас нет прав для этого действия :(', 403 );

    }
}
