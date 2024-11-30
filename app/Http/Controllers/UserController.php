<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function update(UserUpdateRequest $request, $id)
    {
        $userAuth = Auth::user();
        // проверка юзера, какой авторизирован по ID
        if ($userAuth->id !== (int) $id) {
            return response()->json(['message' => 'Доступ запрещен'], 403);
        }
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Пользователь не найден'], 404);
        }

        $updateData = $request->only(['email', 'nickname', 'avatar', 'api_token', 'role_id']);
        if ($request->has('password')) {
            $updateData['password'] = bcrypt($request->password); // хэш
        }
        $user->update($updateData);

        return response()->json([
            'message' => 'Данные были успешно обновлены',
            'user' => $user,
        ]);
    }

    /**
     */
    public function show(Request $request, $id)
    {

        $corUser = Auth::user();
        if($corUser){
            $user = User::find($id);
            if (!$user) {
                return response()->json(['message' => 'Пользователь не найден'], 404);
            }
            if($corUser->role->code === 'admin'){
                return response()->json($user);
            }
            return response()->json([
                'nickname' => $user->nickname,
                'avatar' => $user->avatar,
                'lol'=> 1
            ]);
        }
        $user = User::find($id);
        return response()->json([
            'nickname' => $user->nickname,
            'avatar' => $user->avatar,
            'lol'=> 'гость'
            ]);
    }
}
