<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index(Request $request)
    {
        $query = ClassModel::with(['teacher', 'subject', 'ratings']);

        if ($request->has('teacher_id') && $request->teacher_id) {
            $query->where('teacher_id', $request->teacher_id);
        }

        if ($request->has('subject_id') && $request->subject_id) {
            $query->where('subject_id', $request->subject_id);
        }

        if ($request->has('month') && $request->month) {
            $query->whereMonth('class_date', date('m', strtotime($request->month)))
                  ->whereYear('class_date', date('Y', strtotime($request->month)));
        }

        $classes = $query->orderBy('class_date', 'desc')->paginate(10);
        $teachers = Teacher::all();
        $subjects = Subject::all();

        return view('admin.classes.index', compact('classes', 'teachers', 'subjects'));
    }

    public function create()
    {
        $teachers = Teacher::all();
        $subjects = Subject::all();
        return view('admin.classes.create', compact('teachers', 'subjects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'subject_id' => 'required|exists:subjects,id',
            'class_date' => 'required|date',
            'duration_hours' => 'nullable|integer|min:0',
            'duration_minutes' => 'nullable|integer|min:0|max:59',
            'payment' => 'nullable|numeric|min:0',
        ]);

        $hours = $validated['duration_hours'] ?? 0;
        $minutes = $validated['duration_minutes'] ?? 0;
        $validated['duration'] = ($hours * 60) + $minutes;
        
        unset($validated['duration_hours'], $validated['duration_minutes']);

        ClassModel::create($validated);

        return redirect()->route('admin.classes.index')
            ->with('success', 'Class created successfully.');
    }

    public function edit(ClassModel $class)
    {
        $teachers = Teacher::all();
        $subjects = Subject::all();
        return view('admin.classes.edit', compact('class', 'teachers', 'subjects'));
    }

    public function update(Request $request, ClassModel $class)
    {
        $validated = $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'subject_id' => 'required|exists:subjects,id',
            'class_date' => 'required|date',
            'duration_hours' => 'nullable|integer|min:0',
            'duration_minutes' => 'nullable|integer|min:0|max:59',
            'payment' => 'nullable|numeric|min:0',
        ]);

        $hours = $validated['duration_hours'] ?? 0;
        $minutes = $validated['duration_minutes'] ?? 0;
        $validated['duration'] = ($hours * 60) + $minutes;
        
        unset($validated['duration_hours'], $validated['duration_minutes']);

        $class->update($validated);

        return redirect()->route('admin.classes.index')
            ->with('success', 'Class updated successfully.');
    }

    public function destroy(ClassModel $class)
    {
        $class->delete();

        return redirect()->route('admin.classes.index')
            ->with('success', 'Class deleted successfully.');
    }
}

