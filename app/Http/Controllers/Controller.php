<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

abstract class Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories)->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create(CategoryCreateRequest $request)
    {
        $user = Auth::getUser();
        return $user;
        /*
        if($user->role->code === 'admin' || $user->role->code === 'manager'){
            $category = Category::create($request->validated());
            return response()->json($category)->setStatusCode(201);

        }
*/
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        if (empty($category->id)) {
            throw new ApiException('Not Found ', 404);
        }

        return response()->json($category)->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        if (empty($category->id)) {
            throw new ApiException('Not Found ', 404);
        }
        $category->update($request->validated());
        return response()->json($category)->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if (empty($category->id)) {
            throw new ApiException('Not Found ', 404);
        }
        $category->delete();
        return response()->json(null)->setStatusCode(204);
    }
}
