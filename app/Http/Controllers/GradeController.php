<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\GradeCreateRequest;
use App\Http\Requests\GradeUpdateRequest;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GradeController extends Controller
{
    /**
     */
    public function create(GradeCreateRequest $request, $history_id)
    {
        $user_id = Auth::user()->id;

        $grade = Grade::create([
            'comment' => $request->comment,
            'grade' => $request->grade,
            'user_id' => $user_id,
            'history_id' => $history_id,
        ]);

        $grade->save();
        return response()->json(['message' => 'Оценка успешно создана', 'grade' => $grade], 201);
    }

    /**
     */
    public function show($id)
    {
        $grade = Grade::find($id);

        if (!$grade) {
            return response()->json(['message' => 'Оценка не найдена'], 404);
        }

        return response()->json($grade);
    }

    /**
     */

    public function update(GradeUpdateRequest $request, $id)
    {
        $grade = Grade::find($id);

        if (!$grade) {
            return response()->json(['message' => 'Оценка не найдена'], 404);
        }

        $grade->update($request->only(['comment', 'grade', 'user_id', 'history_id']));

        return response()->json([
            'message' => 'Оценка успешно обновлена',
            'grade' => $grade,
        ]);
    }

    /**
     */
    public function destroy($id)
    {
        $grade = Grade::find($id);

        if (!$grade) {
            return response()->json(['message' => 'Оценка не найдена'], 404);
        }

        $grade->delete();

        return response()->json(['message' => 'Оценка удалена']);
    }
}

