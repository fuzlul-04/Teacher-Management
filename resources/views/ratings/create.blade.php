<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EduAdmin') }} - Rate Class</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Figtree', sans-serif;
        }
    </style>
</head>
<body class="font-sans antialiased" style="background-color: #f3f4f6;">
    <div class="min-h-screen flex items-center justify-center py-12 px-4">
        <div class="max-w-md w-full">
            <!-- Logo -->
            <div class="text-center mb-8">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3">
                    <div class="w-12 h-12 rounded-xl bg-blue-600 flex items-center justify-center">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <span class="text-2xl font-bold text-gray-800">EduAdmin</span>
                </a>
            </div>

            <!-- Class Info -->
            <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Class Details</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Teacher:</span>
                        <span class="text-gray-800 font-medium">{{ $class->teacher->name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Subject:</span>
                        <span class="text-gray-800 font-medium">{{ $class->subject->name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Date:</span>
                        <span class="text-gray-800 font-medium">{{ $class->class_date->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Rating Form -->
            <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800 mb-6">Rate Your Experience</h3>
                
                @auth
                    <form method="POST" action="{{ route('ratings.store', $class->id) }}" class="space-y-6">
                        @csrf

                        <!-- Star Rating -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">Rating</label>
                            <div class="flex items-center gap-2" id="star-rating">
                                @for($i = 1; $i <= 5; $i++)
                                    <button type="button" 
                                        class="star-btn w-12 h-12 rounded-lg border-2 border-gray-200 flex items-center justify-center text-2xl transition-all hover:border-yellow-400 hover:text-yellow-400"
                                        data-rating="{{ $i }}">
                                        <span class="text-gray-300">&#9733;</span>
                                    </button>
                                @endfor
                            </div>
                            <input type="hidden" name="rating" id="rating-value" value="{{ old('rating') }}">
                            @error('rating')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Feedback -->
                        <div>
                            <label for="feedback" class="block text-sm font-medium text-gray-700 mb-2">Feedback (Optional)</label>
                            <textarea id="feedback" name="feedback" rows="4" 
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                placeholder="Share your experience...">{{ old('feedback') }}</textarea>
                            @error('feedback')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="w-full px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                            Submit Rating
                        </button>
                    </form>
                @else
                    <div class="text-center">
                        <p class="text-gray-600 mb-4">Please login to rate this class</p>
                        <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                            Login to Rate
                        </a>
                    </div>
                @endauth
            </div>

            <!-- Back to Home -->
            <div class="text-center mt-6">
                <a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-gray-700">
                    Back to Home
                </a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('.star-btn');
            const ratingInput = document.getElementById('rating-value');
            const selectedRating = ratingInput.value;

            // Set initial rating if exists
            if (selectedRating) {
                updateStars(selectedRating);
            }

            stars.forEach(star => {
                star.addEventListener('click', function() {
                    const rating = this.dataset.rating;
                    ratingInput.value = rating;
                    updateStars(rating);
                });

                star.addEventListener('mouseenter', function() {
                    const rating = this.dataset.rating;
                    updateStars(rating);
                });
            });

            document.getElementById('star-rating').addEventListener('mouseleave', function() {
                if (ratingInput.value) {
                    updateStars(ratingInput.value);
                } else {
                    stars.forEach(s => {
                        s.querySelector('span').innerHTML = '&#9733;';
                        s.classList.remove('text-yellow-400', 'border-yellow-400');
                        s.querySelector('span').classList.add('text-gray-300');
                    });
                }
            });

            function updateStars(rating) {
                stars.forEach((star, index) => {
                    if (index < rating) {
                        star.querySelector('span').innerHTML = '&#9733;';
                        star.classList.add('text-yellow-400', 'border-yellow-400');
                        star.classList.remove('text-gray-300', 'border-gray-200');
                        star.querySelector('span').classList.remove('text-gray-300');
                    } else {
                        star.querySelector('span').innerHTML = '&#9734;';
                        star.classList.remove('text-yellow-400', 'border-yellow-400');
                        star.classList.add('text-gray-300', 'border-gray-200');
                    }
                });
            }
        });
    </script>
</body>
</html>
