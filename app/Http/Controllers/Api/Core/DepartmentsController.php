<?php

namespace App\Http\Controllers\Api\Core;

use App\Http\Controllers\Controller;
use App\Models\Api\Core\Department;
use Illuminate\Http\Request;

class DepartmentsController extends Controller
{
    public function allDepartments()
    {
        $departments = Department::with([
            'years.sections.groups',
        ])->get();
        return response()->json([
            'departments' => $departments
        ], 200);
    }
}
