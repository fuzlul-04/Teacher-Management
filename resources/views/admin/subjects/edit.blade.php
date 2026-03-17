@extends('layouts.sidebar')

@section('header', 'Edit Subject')

@section('content')
<div class="max-w-2xl">
    <!-- Header -->
    <div class="mb-6">
        <a href="{{ route('admin.subjects.index') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-gray-700 transition-colors mb-4">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Back to Subjects
        </a>
        <h2 class="text-2xl font-bold text-gray-800">Edit Subject</h2>
        <p class="text-gray-500 mt-1">Update subject information</p>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
        <form action="{{ route('admin.subjects.update', $subject->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <!-- Name & Code Row -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Subject Name *</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $subject->name) }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent @error('name') border-red-500 @enderror"
                            placeholder="e.g., Mathematics">
                        @error('name')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="code" class="block text-sm font-medium text-gray-700 mb-2">Subject Code *</label>
                        <input type="text" name="code" id="code" value="{{ old('code', $subject->code) }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent @error('code') border-red-500 @enderror"
                            placeholder="e.g., MATH-101">
                        @error('code')
                            <p class="mt-2 text-sm text-red-500">{{ $message->first('code') }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center gap-4 pt-4">
                    <button type="submit" class="px-6 py-3 rounded-xl bg-green-600 text-white font-medium hover:bg-green-700 transition-colors shadow-sm">
                        Update Subject
                    </button>
                    <a href="{{ route('admin.subjects.index') }}" class="px-6 py-3 rounded-xl border border-gray-300 text-gray-600 hover:bg-gray-50 transition-colors">
                        Cancel
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
