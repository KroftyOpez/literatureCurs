<?php

namespace App\Http\Controllers;

use App\Http\Requests\HistoryUpdateRequest;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    // все истории
    public function index()
    {
        $histories = History::all();
        return response()->json($histories);
    }
    // одна история
    public function show($id)
    {
        $histories = History::find($id);

        if (!$histories) {
            return response()->json(['message' => 'История не найдена'], 404);
        }

        return response()->json($histories);
    }

    /*

    public function create(Request $request)
    {
        $user = Auth::user();

        // Базовые данные истории
        $historyData = $request->all();

        if ($user->role->code === 'admin') {
            // Устанавливаем confirmation = 0 для администратора
            $historyData['confirmation'] = 0;
        } elseif ($user->role->code === 'user') {
            // Устанавливаем confirmation = 1 и user_id для обычного пользователя
            $historyData['confirmation'] = 1;
            $historyData['user_id'] = $user->id;
        } else {
            // Если роль не admin или user
            return response()->json(['message' => 'Доступ запрещен'], 403);
        }

        // Создаём запись
        $history = History::create($historyData);

        return response()->json($history, 201);
    }

     */
}

