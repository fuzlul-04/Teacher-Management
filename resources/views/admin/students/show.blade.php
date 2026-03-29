@extends('layouts.sidebar')

@section('header', 'Student Details')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">Student Information</h2>
            <a href="{{ route('students.index') }}" class="text-gray-500 hover:text-gray-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Registration Number -->
                <div class="bg-blue-50 rounded-lg p-4">
                    <p class="text-sm text-blue-600 font-medium">Registration Number</p>
                    <p class="text-2xl font-bold text-blue-700">{{ $student->registration_number }}</p>
                </div>

                <!-- Personal Info Section -->
                <div class="md:col-span-2">
                    <h3 class="text-lg font-medium text-gray-800 mb-4">Personal Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Full Name</p>
                            <p class="text-gray-800 font-medium">{{ $student->full_name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Nick Name</p>
                            <p class="text-gray-800 font-medium">{{ $student->nick_name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Gender</p>
                            <p class="text-gray-800 capitalize">{{ $student->gender ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Date of Birth</p>
                            <p class="text-gray-800">{{ $student->date_of_birth ? $student->date_of_birth->format('d M, Y') : '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Religion</p>
                            <p class="text-gray-800">{{ $student->religion ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Blood Group</p>
                            <p class="text-gray-800">{{ $student->blood_group ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Contact Info Section -->
                <div class="md:col-span-2 mt-4">
                    <h3 class="text-lg font-medium text-gray-800 mb-4">Contact Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Phone Number</p>
                            <p class="text-gray-800 font-medium">{{ $student->phone }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Father's Name</p>
                            <p class="text-gray-800">{{ $student->father_name ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Mother's Name</p>
                            <p class="text-gray-800">{{ $student->mother_name ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Father's Mobile</p>
                            <p class="text-gray-800">{{ $student->father_mobile ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Mother's Mobile</p>
                            <p class="text-gray-800">{{ $student->mother_mobile ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="px-6 py-4 border-t border-gray-100 flex justify-end gap-4">
            <a href="{{ route('students.edit', $student->id) }}" class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition-colors">
                Edit Student
            </a>
            <form action="{{ route('students.destroy', $student->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 rounded-lg border border-red-300 text-red-600 font-medium hover:bg-red-50 transition-colors" onclick="return confirm('Are you sure you want to delete this student?')">
                    Delete Student
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
