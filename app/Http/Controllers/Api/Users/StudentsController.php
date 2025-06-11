<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Models\Api\Users\Student;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $students = Student::with(['key.user', 'group.section.year.department', 'baladiya.wilaya'])
            ->when($request->has('username'), function ($query) use ($request) {
                $query->where('username', 'like', '%' . $request->username . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        return response()->json($students);
    }

    public function timeTable(Student $student)
    {
        return true;
    }


    public function store(Request $request)
    {
        // Log::info($request->all());
        $validated = $request->validate([
            'name' => 'required|string',
            'last' => 'required|string',
            'date_of_birth' => 'required|date',
            'inscreption_number' => 'required|string',
            'group_id' => 'required|exists:groups,id',
        ]);


        $student = Student::create([
            'username' => $validated['name'] . '_' . $validated['last'] . '_' . str()->random(6),
            'name' => $validated['name'],
            'last' => $validated['last'],
            'date_of_birth' => $validated['date_of_birth'],
            'inscreption_number' => $validated['inscreption_number'],
            'group_id' => $validated['group_id'],
            'baladiyas_id' => 1,
        ]);

        return response()->json([
            'message' => 'Student created successfully',
            'student' => $student->load('key.user')
        ], 201);
    }

    public function createKey(Student $student)
    {
        $student->key()->create([
            'value' => str()->random(10),
        ]);

        return response()->json([
            'message' => 'Key created successfully',
            'key' => $student->key->value,
        ], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return response()->json([
            'message' => 'Student fetched successfully',
            'student' => $student->load('key.user' , 'group.section.year.department', 'baladiya.wilaya')
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'last' => 'required|string',
            'date_of_birth' => 'required|date',
            'inscreption_number' => 'required|string',
            'group_id' => 'required|exists:groups,id',
        ]);
        $validated['username'] = $validated['name'] . '_' . $validated['last'] . '_' . str()->random(6);
        $student->update(
            [
                'name' => $validated['name'],
                'last' => $validated['last'],
                'date_of_birth' => $validated['date_of_birth'],
                'inscreption_number' => $validated['inscreption_number'],
                'baladiyas_id' => 1,
                'group_id' => $validated['group_id'],
                'username' => $validated['username'],
            ]
        );
        return response()->json([
            'message' => 'Student updated successfully',
            'student' => $student->load('key.user')
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->key()->delete();
        $student->delete();
        return response()->json([
            'message' => 'Student deleted successfully'
        ], 200);
    }
}
