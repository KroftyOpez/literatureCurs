<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return response()->json($categories)->setStatusCode(200);
    }


    public function create(CategoryCreateRequest $request)
    {
        $user = Auth::User();
        if($user->role->code === 'admin'){
            $category = Category::create($request->validated());
            return response()->json($category)->setStatusCode(201);
        }
        throw new ApiException('У вас нет прав для этого действия :(', 403 );

    }


    public function show(Category $category)
    {
        if (empty($category->id)) {
            throw new ApiException('Увы, не найдено', 404);
        }

        return response()->json($category)->setStatusCode(200);
    }


    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $user = Auth::getUser();
        if($user->role->code === 'admin'){
            if (empty($category->id)) {
                throw new ApiException('Not Found ', 404);
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
