<?php

namespace App\Http\Controllers\Api\Main;

use App\Http\Controllers\Controller;
use App\Models\Api\Main\Day;
use App\Models\Api\Main\Group;
use App\Models\Api\Main\Lessen;
use App\Models\Api\Users\Student;
use App\Models\Api\Users\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupsController extends Controller
{
    public function index()
    {
        $groups = Group::with(['section.year.department'])
            ->withCount('students')
            ->paginate(6);

        return response()->json($groups);
    }

    public function students()
    {
        $student = Student::find(Auth::user()->key->keyable_id);
        $group = $student->group;
        $section = $group->section;
        $timeTableGroup = $group->timeTable;
        $timeTableSection = $section->timeTable;
        return response()->json(
            [
                'timeTableGroup' => $timeTableGroup->load(
                    [
                        'days' => [
                            'lessens' => function ($query) {
                                $query->orderBy('start_time')
                                    ->with(['classRome', 'module', 'teacher']);
                            }
                        ]
                    ]
                ),
                'timeTableSection' => $timeTableSection->load(
                    [
                        'days' => [
                            'lessens' => function ($query) {
                                $query->orderBy('start_time')
                                    ->with(['classRome', 'module', 'teacher']);
                            }
                        ]
                    ]
                ),
            ]
        );
    }

    public function teacher()
    {
        $teacher = Teacher::find(Auth::user()->key->keyable_id);
        $mon = Day::where('name', 'mon')->with(['lessens' => function ($query) use ($teacher) {
            $query->where('teacher_id', $teacher->id)
                ->orderBy('start_time')
                ->with(['classRome', 'module', 'teacher']);
        }])->first();
        $tues = Day::where('name', 'tues')->with(['lessens' => function ($query) use ($teacher) {
            $query->where('teacher_id', $teacher->id)
                ->orderBy('start_time')
                ->with(['classRome', 'module', 'teacher']);
        }])->first();
        $wed = Day::where('name', 'wed')->with(['lessens' => function ($query) use ($teacher) {
            $query->where('teacher_id', $teacher->id)
                ->orderBy('start_time')
                ->with(['classRome', 'module', 'teacher']);
        }])->first();
        $thu = Day::where('name', 'thu')->with(['lessens' => function ($query) use ($teacher) {
            $query->where('teacher_id', $teacher->id)
                ->orderBy('start_time')
                ->with(['classRome', 'module', 'teacher']);
        }])->first();
        $fri = Day::where('name', 'fri')->with(['lessens' => function ($query) use ($teacher) {
            $query->where('teacher_id', $teacher->id)
                ->orderBy('start_time')
                ->with(['classRome', 'module', 'teacher']);
        }])->first();
        $sat = Day::where('name', 'sat')->with(['lessens' => function ($query) use ($teacher) {
            $query->where('teacher_id', $teacher->id)
                ->orderBy('start_time')
                ->with(['classRome', 'module', 'teacher']);
        }])->first();
        $sun = Day::where('name', 'sun')->with(['lessens' => function ($query) use ($teacher) {
            $query->where('teacher_id', $teacher->id)
                ->orderBy('start_time')
                ->with(['classRome', 'module', 'teacher']);
        }])->first();
        return response()->json([
            'lessons' => [
                'mon' => $mon,
                'tues' => $tues,
                'wed' => $wed,
                'thu' => $thu,
                'fri' => $fri,
                'sat' => $sat,
                'sun' => $sun,
            ]
        ]);
    }

    public function timeTable(Group $group)
    {
        $timeTable = $group->timeTable;
        return response()->json([
            'timeTable' => $timeTable->load(['days' => [
                'lessens' => function ($query) {
                    $query->orderBy('start_time')
                        ->with(['classRome', 'module', 'teacher']);
                }
            ]]),
        ]);
    }

    public function validClasses(Request $request, Group $group)
    {


        $department = $group->section->year->department;
        $classRomes = $department->classRomes->load('lessens.day');

        $validClasses = [];
        foreach ($classRomes as $classRome) {

            if (!$classRome->isBusy($request->start_time, $request->end_time, $request->day)) {
                $validClasses[] = $classRome;
            }
        }
        return response()->json($validClasses);
    }

    public function reserveClassRome(Request $request, Group $group)
    {
        $request->validate([
            'class_rome_id' => 'required|exists:class_romes,id',
            'day_id' => 'required|exists:days,id',
            'module_id' => 'required|exists:modules,id',
            'teacher_id' => 'required|exists:teachers,id',
            'start_time' => 'required|date_format:H:i:s',
            'end_time' => 'required|date_format:H:i:s',
            'type' => 'required|in:td,tp,course',
        ]);


        $timeTable = $group->timeTable;
        $day = $timeTable->days->where('id', $request->day_id)->first();
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

    public function days(Group $group)
    {
        $days = $group->timeTable->days;
        return response()->json($days);
    }
}
