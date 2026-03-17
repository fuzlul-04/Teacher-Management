<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function create(ClassModel $class)
    {
        $class->load(['teacher', 'subject']);
        return view('ratings.create', compact('class'));
    }

    public function store(Request $request, ClassModel $class)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'feedback' => 'nullable|string|max:1000',
        ]);

        $existingRating = Rating::where('class_id', $class->id)
            ->where('teacher_id', $class->teacher_id)
            ->first();

        if ($existingRating) {
            $existingRating->update([
                'rating' => $validated['rating'],
                'feedback' => $validated['feedback'] ?? null,
            ]);
            $message = 'Rating updated successfully.';
        } else {
            Rating::create([
                'teacher_id' => $class->teacher_id,
                'class_id' => $class->id,
                'rating' => $validated['rating'],
                'feedback' => $validated['feedback'] ?? null,
            ]);
            $message = 'Rating submitted successfully.';
        }

        return redirect()->route('dashboard')->with('success', $message);
    }
}
