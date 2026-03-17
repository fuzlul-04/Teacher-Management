<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::with('subjects')->paginate(10);
        return view('admin.teachers.index', compact('teachers'));
    }

    public function create()
    {
        $subjects = Subject::all();
        return view('admin.teachers.create', compact('subjects'));
    }

    public function store(StoreTeacherRequest $request)
    {
        $teacher = Teacher::create($request->validated());
        $teacher->subjects()->attach($request->input('subjects'));

        return redirect()->route('admin.teachers.index')
            ->with('success', 'Teacher created successfully.');
    }

    public function edit(Teacher $teacher)
    {
        $teacher = Teacher::with('subjects')->findOrFail($teacher->id);
        $subjects = Subject::all();
        return view('admin.teachers.edit', compact('teacher', 'subjects'));
    }

    public function update(UpdateTeacherRequest $request, Teacher $teacher)
    {
        $teacher->update($request->validated());
        $teacher->subjects()->sync($request->input('subjects'));

        return redirect()->route('admin.teachers.index')
            ->with('success', 'Teacher updated successfully.');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->subjects()->detach();
        $teacher->delete();

        return redirect()->route('admin.teachers.index')
            ->with('success', 'Teacher deleted successfully.');
    }

    public function monthlyReport(Request $request)
    {
        $month = $request->input('month', now()->format('Y-m'));
        
        $teachers = Teacher::with(['classes' => function ($query) use ($month) {
            $query->whereMonth('class_date', date('m', strtotime($month)))
                  ->whereYear('class_date', date('Y', strtotime($month)));
        }])->get();

        $reportData = $teachers->map(function ($teacher) {
            $totalClasses = $teacher->classes->count();
            $totalEarnings = $teacher->classes->sum('payment') ?? 0;
            
            return [
                'teacher' => $teacher,
                'total_classes' => $totalClasses,
                'total_earnings' => $totalEarnings,
            ];
        });

        $grandTotalClasses = $reportData->sum('total_classes');
        $grandTotalEarnings = $reportData->sum('total_earnings');

        return view('admin.reports.monthly', compact('reportData', 'month', 'grandTotalClasses', 'grandTotalEarnings'));
    }
}
