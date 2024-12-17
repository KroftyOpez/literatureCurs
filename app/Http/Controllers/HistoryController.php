<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\HistoryCreateRequest;
use App\Http\Requests\HistoryUpdateRequest;
use App\Http\Resources\HistoryResource;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    // все истории
    public function indexAdmin(Request $request)
    {
        $user = Auth::User();
        if($user->role->code === 'admin'){
            $histories = History::where('confirmation', '=', '0' )->get();
            return response()->json($histories);
        }
        throw new ApiException('У вас нет прав для этого действия :(', 403 );

    }
    public function indexUser(Request $request)
    {
            $histories = History::where('confirmation', '=', '1' )->get();
            return response()->json(HistoryResource::collection($histories));
    }
    // одна история
    public function show($id)
    {
        $histories = History::find($id);
        if (!$histories) {
            return response()->json(['message' => 'История не найдена'], 404);
        }
        return response()->json(HistoryResource::make($histories));
    }


    public function createAdmin(HistoryCreateRequest $request){
        $user = Auth::user();

        if ($user->role->code === 'admin') {
            $path = null;

            //Сохранение аватара пользователя
            if ($request->hasFile('photo')) {
                $path = $request->file('photo')->store('photos', 'public');
            }
            // Создаём историю
            $history = History::create([
                'name' => $request->name,
                'description' => $request->description,
                'content' => $request->content,
                'read_time' => $request->read_time,
                'photo' => $path,
                'user_id' => $user->id,
                'confirmation' => 1,

            ]);
            $history->save();

            // Привязываем категории
            if ($request->has('category_ids')) {
                $categoryIds = $request->input('category_ids'); // массив ID категорий
                $history->categories()->sync($categoryIds);
            }
            // Возвращаем историю с привязанными категориями
            return new HistoryResource($history->load('categories'));
        }
        throw new ApiException('У вас нет прав для этого действия :(', 403 );

    }
    public function createUser(HistoryCreateRequest $request){

        $user = Auth::user();

        if ($user->role->code === 'admin') {
            $path = null;

            //Сохранение аватара пользователя
            if ($request->hasFile('photo')) {
                $path = $request->file('photo')->store('photos', 'public');
            }
            // Создаём историю
            $history = History::create([
                'name' => $request->name,
                'description' => $request->description,
                'content' => $request->content,
                'read_time' => $request->read_time,
                'photo' => $path,
                'user_id' => $user->id,
                'confirmation' => 0,

            ]);
            $history->save();

            // Привязываем категории
            if ($request->has('category_ids')) {
                $categoryIds = $request->input('category_ids'); // массив ID категорий
                $history->categories()->sync($categoryIds);
            }
            // Возвращаем историю с привязанными категориями
            return new HistoryResource($history->load('categories'));
        }
        throw new ApiException('У вас нет прав для этого действия :(', 403 );

    }
}

