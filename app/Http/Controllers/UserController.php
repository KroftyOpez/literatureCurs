<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // ready
    public function update(UserUpdateRequest $request, $id)
    {
        $userAuth = Auth::user();

        if ($userAuth->id !== (int) $id) {
            return response()->json(['message' => 'Доступ запрещен'], 403);
        }

        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Пользователь не найден'], 404);
        }

        $updateData = $request->only(['nickname']);

        if ($request->has('password')) {
            $updateData['password'] = bcrypt($request->password);
        }

        if ($request->hasFile('avatar')) {
            // Удаление старого аватара
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Сохранение нового аватара
            $updateData['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $user->update($updateData);

        return response()->json([
            'message' => 'Данные были успешно обновлены',
            'user' => $user,
        ]);
    }

    /**
     */
    public function showforguest(Request $request, $id)
    {
        $user = User::find($id);
        return response()->json([
            'nickname' => $user->nickname,
            'avatar' => $user->avatar,
            ]);
    }
    public function showforuser(Request $request, $id)
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
            ]);
        }
    }
    public function showforadmin(Request $request, $id)
    {
        // Получаем текущего авторизованного пользователя
        $corUser = Auth::user();
        // Проверяем, авторизован ли пользователь
        if ($corUser) {
            // Находим пользователя по ID
            $user = User::find($id);
            // Если пользователь с указанным ID не найден, возвращаем ошибку 404
            if (!$user) {
                return response()->json(['message' => 'Пользователь не найден'], 404);
            }
            // Если роль текущего пользователя — администратор (role_id = 1), возвращаем все данные пользователя
            if ($corUser->role_id === 1) {
                $user->makeHidden('api_token');
                return response()->json($user);
            } else {
                return response()->json(['message' => 'Доступ запрещен'], 403);
            }
        }
    }
    public function indexusers()
    {
        // Получаем текущего авторизованного пользователя
        $corUser = Auth::user();
        // Проверяем, авторизован ли пользователь и его роль
        if ($corUser && $corUser->role_id === 1) {
            $users = User::select('id', 'nickname')->get();
            return response()->json([
                'users' => $users,
            ]);
        }
        // Если пользователь не авторизован или его роль не 1
        return response()->json([
            'message' => 'Доступ запрещен',
        ], 403);
    }
    public function indexadmins()
    {
        // Получаем текущего авторизованного пользователя
        $corUser = Auth::user();
        // Проверяем, авторизован ли пользователь и его роль
        if ($corUser && $corUser->role_id === 1) {
            // Получаем пользователей с role_id = 1
            $users = User::where('role_id', 1)->select('id', 'nickname')->get();
            return response()->json([
                'users' => $users,
            ]);
        }
        // Если пользователь не авторизован или его роль не 1
        return response()->json([
            'message' => 'Доступ запрещен',
        ], 403);
    }
    //nedodelano
    public function destroy($id)
    {
        // Получаем текущего авторизованного пользователя
        $corUser = Auth::user();

        // Проверяем, авторизован ли пользователь
        if (!$corUser) {
            return response()->json(['message' => 'Вы не авторизованы'], 401);
        }

        // Проверяем, является ли пользователь администратором
        if ($corUser->role->code !== 'admin') {
            return response()->json(['message' => 'Доступ запрещен'], 403);
        }

        // Находим пользователя по ID
        $user = User::find($id);

        // Проверяем, существует ли пользователь
        if (!$user) {
            return response()->json(['message' => 'Пользователь не найден'], 404);
        }

        // Удаляем пользователя
        $user->delete();

        // Возвращаем успешный ответ с сообщением
        return response()->json(['message' => 'Пользователь был удален'], 204);
    }
}
