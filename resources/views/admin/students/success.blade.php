@extends('layouts.sidebar')

@section('header', 'Registration Successful')

@section('content')
<div class="max-w-lg mx-auto">
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-8 text-center">
        <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-green-100 flex items-center justify-center">
            <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
        </div>

        <h2 class="text-2xl font-bold text-gray-800 mb-2">Registration Successful!</h2>
        <p class="text-gray-500 mb-6">Your registration has been completed successfully.</p>

        <div class="bg-gray-50 rounded-lg p-6 mb-6">
            <p class="text-sm text-gray-500 mb-1">Your Registration Number</p>
            <p class="text-3xl font-bold text-blue-600">{{ $registrationNumber }}</p>
        </div>

        <div class="text-sm text-gray-500 mb-6">
            <p>Your login credentials have been sent to your phone.</p>
            <p class="mt-1">Please check your SMS for registration number and password.</p>
        </div>

        <div class="flex gap-4">
            <a href="{{ route('students.register') }}" class="flex-1 px-6 py-3 rounded-lg border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition-colors">
                Register Another
            </a>
            <a href="{{ route('dashboard') }}" class="flex-1 px-6 py-3 rounded-lg bg-blue-600 text-white font-medium hover:bg-blue-700 transition-colors shadow-sm">
                Go to Dashboard
            </a>
        </div>
    </div>
</div>
@endsection
