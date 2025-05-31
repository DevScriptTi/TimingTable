<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Models\Api\Main\TimeTable;
use App\Models\Api\Users\Teacher;
use Illuminate\Http\Request;

class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $teachers = Teacher::with(['key.user' , 'baladiya.wilaya'])
            ->when($request->has('username'), function ($query) use ($request) {
                $query->where('username', 'like', '%' . $request->username . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        return response()->json($teachers);
    }

    public function timeTable(Teacher $teacher)
    {
        $timeTable = TimeTable::with(['days' => [
            'lessens' => function($query) use ($teacher) {
                $query->where('teacher_id', $teacher->id)
                      ->orderBy('start_time')
                      ->with(['classRome', 'module']);
            }
        ]])->get();
        return response()->json($timeTable);
    }

    public function store(Request $request)
    {
        // Log::info($request->all());
        $validated = $request->validate([
            'name' => 'required|string',
            'last' => 'required|string',
            'date_of_birth' => 'required|date',
            'baladiyas_id' => 'required|exists:baladiyas,id',
        ]);


        $teacher = Teacher::create([
            'username' => $validated['name'] . '_' . $validated['last'] . '_' . str()->random(6),
            'name' => $validated['name'],
            'last' => $validated['last'],
        ]);

        return response()->json([
            'message' => 'Teacher created successfully',
            'teacher' => $teacher->load('key.user')
        ], 201);
    }

    public function createKey(Teacher $teacher)
    {
        $teacher->key()->create([
            'value' => str()->random(10),
        ]);

        return response()->json([
            'message' => 'Key created successfully',
            'key' => $teacher->key->value,
        ], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        return response()->json([
            'message' => 'Teacher fetched successfully',
            'teacher' => $teacher->load('key.user')
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'last' => 'required|string',
            'date_of_birth' => 'required|date',
            'baladiyas_id' => 'required|exists:baladiyas,id',
        ]);
        $validated['username'] = $validated['name'] . '_' . $validated['last'] . '_' . str()->random(6);
        $teacher->update($validated);
        return response()->json([
            'message' => 'Teacher updated successfully',
            'teacher' => $teacher->load('key.user')
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->key()->delete();
        $teacher->delete();
        return response()->json([
            'message' => 'Teacher deleted successfully'
        ], 200);
    }
}
