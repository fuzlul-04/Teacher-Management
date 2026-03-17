<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Rating;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Teachers per Subject (for Pie Chart)
        $subjects = Subject::withCount('teachers')->get();
        $subjectLabels = $subjects->pluck('name')->toArray();
        $subjectTeacherCounts = $subjects->pluck('teachers_count')->toArray();

        // Monthly Classes - Last 6 Months (for Line Chart)
        $monthlyData = [];
        $monthLabels = [];
        
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthLabels[] = $date->format('M Y');
            $monthlyData[] = ClassModel::whereMonth('class_date', $date->month)
                ->whereYear('class_date', $date->year)
                ->count();
        }
        $monthlyClassCounts = $monthlyData;

        // Teacher Earnings (for Bar Chart)
        $teachers = Teacher::with('classes')->get();
        $teacherLabels = $teachers->pluck('name')->toArray();
        $teacherEarnings = $teachers->map(function ($teacher) {
            return $teacher->classes->sum('payment') ?? 0;
        })->toArray();

        return view('dashboard', compact(
            'subjectLabels',
            'subjectTeacherCounts',
            'monthLabels',
            'monthlyClassCounts',
            'teacherLabels',
            'teacherEarnings'
        ));
    }
}
