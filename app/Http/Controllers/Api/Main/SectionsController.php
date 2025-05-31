<?php

namespace App\Http\Controllers\Api\Main;

use App\Http\Controllers\Controller;
use App\Models\Api\Core\ClassRome;
use App\Models\Api\Core\Module;
use App\Models\Api\Main\Day;
use App\Models\Api\Main\Lessen;
use App\Models\Api\Main\Section;
use App\Models\Api\Users\Teacher;
use Illuminate\Http\Request;

class SectionsController extends Controller
{
    public function index()
    {
        $sections = Section::with(['year.department', 'timeTable.days.lessens.classRome'])
            ->withCount('groups')
            ->paginate(6);
        return response()->json($sections);
    }

    public function timeTable(Section $section)
    {
        $timeTable = $section->timeTable;
        return response()->json([
            'timeTable' => $timeTable->load(['days' => [
                'lessens' => function($query) {
                    $query->orderBy('start_time')
                          ->with(['classRome', 'module', 'teacher']);
                }
            ]]),
        ]);
    }

    public function validClasses(Request $request, Section $section)
    {
        $department = $section->year->department;
        $classRomes = $department->classRomes->load('lessens.day');

        $validClasses = [];
        foreach ($classRomes as $classRome) {

            if (!$classRome->isBusy($request->start_time, $request->end_time, $request->day)) {
                $validClasses[] = $classRome;
            }
        }
        return response()->json($validClasses);
    }

    public function reserveClassRome(Request $request, Section $section)
    {
        // return response()->json($request->all());
        $request->validate([
            'class_rome_id' => 'required|exists:class_romes,id',
            'day_id' => 'required|exists:days,id',
            'module_id' => 'required|exists:modules,id',
            'teacher_id' => 'required|exists:teachers,id',
            'start_time' => 'required|date_format:H:i:s',
            'end_time' => 'required|date_format:H:i:s',
            'type' => 'required|in:td,tp,course',
        ]);


        // $timeTable = $section->timeTable;
        $day = Day::where('id', $request->day_id)->first();
        // return response()->json($day);
        $lessen = $day->lessens()->create([
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'type' => $request->type,
            'day_id' => $request->day_id,
            'module_id' => $request->module_id,
            'teacher_id' => $request->teacher_id,
            'class_rome_id' => $request->class_rome_id,
        ]);
        $lessen->classRome()->associate($request->class_rome_id);
        $lessen->module()->associate($request->module_id);
        $lessen->teacher()->associate($request->teacher_id);
        $lessen->save();

        return response()->json($lessen->load('classRome', 'module', 'teacher', 'day'));
    }

    public function deleteLessen(Lessen $lessen)
    {
        $lessen->delete();
        return response()->json(['message' => 'Lessen deleted successfully']);
    }

    public function days(Section $section)
    {
        $days = $section->timeTable->days;
        return response()->json($days);
    }

    public function teachers()
    {
        $teachers = Teacher::all();
        return response()->json($teachers);
    }

    public function modules()
    {
        $modules = Module::all();
        return response()->json($modules);
    }
}
