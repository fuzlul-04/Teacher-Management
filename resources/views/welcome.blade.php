<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EduAdmin') }} - Teacher Management System</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #0f172a 100%) !important;
            min-height: 100vh;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #0f172a 100%);
        }
        .gradient-text {
            background: linear-gradient(135deg, #a855f7 0%, #3b82f6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .gradient-button {
            background: linear-gradient(135deg, #7c3aed 0%, #3b82f6 100%);
        }
        .gradient-button:hover {
            background: linear-gradient(135deg, #6d28d9 0%, #2563eb 100%);
        }
        .glow-purple {
            box-shadow: 0 0 60px -15px rgba(124, 58, 237, 0.5);
        }
        .glow-blue {
            box-shadow: 0 0 60px -15px rgba(59, 130, 246, 0.5);
        }
    </style>
</head>
<body class="font-sans antialiased" style="background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #0f172a 100%); min-height: 100vh; color: #cbd5e1;">
    <!-- Navigation -->
    <nav class="fixed w-full z-50 bg-slate-900/80 backdrop-blur-md border-b border-slate-700/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl gradient-button flex items-center justify-center glow-purple">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-white">EduAdmin</span>
                </div>
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-slate-300 hover:text-white transition-colors">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-slate-300 hover:text-white transition-colors font-medium">Log in</a>
                        @if(Route::has('register'))
                            <a href="{{ route('register') }}" class="gradient-button text-white px-5 py-2 rounded-lg font-medium hover:shadow-lg transition-all duration-300 glow-blue">
                                Get Started
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 overflow-hidden">
        <!-- Background Effects -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-40 -right-40 w-80 h-80 rounded-full bg-purple-500/20 blur-3xl"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 rounded-full bg-blue-500/20 blur-3xl"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] rounded-full bg-gradient-to-r from-purple-500/5 to-blue-500/5 blur-3xl"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-4xl mx-auto">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-slate-800/50 border border-slate-700/50 text-sm text-slate-300 mb-8">
                    <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                    Modern Teacher Management
                </div>

                <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold text-white mb-6 leading-tight">
                    Manage Your
                    <span class="gradient-text">Teachers</span>
                    <br />With Ease
                </h1>

                <p class="text-xl text-slate-400 mb-10 max-w-2xl mx-auto leading-relaxed">
                    A powerful, modern dashboard to manage teachers, subjects, and their assignments. Built with Laravel, Tailwind CSS, and designed for the future.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="gradient-button text-white px-8 py-4 rounded-xl font-semibold text-lg hover:shadow-xl hover:scale-105 transition-all duration-300 glow-blue">
                            Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="gradient-button text-white px-8 py-4 rounded-xl font-semibold text-lg hover:shadow-xl hover:scale-105 transition-all duration-300 glow-blue">
                            Get Started Free
                        </a>
                        <a href="{{ route('login') }}" class="px-8 py-4 rounded-xl font-semibold text-lg border border-slate-600 text-white hover:bg-slate-800 transition-all duration-300">
                            Sign In
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Dashboard Preview -->
            <div class="mt-20 relative">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-transparent to-transparent z-10"></div>
                <div class="rounded-2xl border border-slate-700/50 bg-slate-800/50 backdrop-blur-xl p-2 glow-purple">
                    <div class="rounded-xl bg-slate-800 overflow-hidden">
                        <div class="flex border-b border-slate-700/50">
                            <div class="w-64 border-r border-slate-700/50 p-4">
                                <div class="flex items-center gap-3 mb-6">
                                    <div class="w-8 h-8 rounded-lg gradient-button flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    </div>
                                    <span class="font-semibold text-white">EduAdmin</span>
                                </div>
                                <div class="space-y-2">
                                    <div class="h-8 rounded-lg bg-slate-700/50 w-full"></div>
                                    <div class="h-8 rounded-lg bg-purple-500/20 w-3/4"></div>
                                    <div class="h-8 rounded-lg bg-slate-700/50 w-full"></div>
                                </div>
                            </div>
                            <div class="flex-1 p-6">
                                <div class="grid grid-cols-3 gap-4 mb-6">
                                    <div class="h-20 rounded-xl bg-slate-700/30"></div>
                                    <div class="h-20 rounded-xl bg-slate-700/30"></div>
                                    <div class="h-20 rounded-xl bg-slate-700/30"></div>
                                </div>
                                <div class="h-40 rounded-xl bg-slate-700/30"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-slate-800/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">
                    Everything You Need
                </h2>
                <p class="text-lg text-slate-400 max-w-2xl mx-auto">
                    Powerful features to manage your educational institution efficiently
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="p-6 rounded-2xl bg-slate-800/50 border border-slate-700/50 hover:border-purple-500/30 transition-colors">
                    <div class="w-12 h-12 rounded-xl gradient-button flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">Teacher Management</h3>
                    <p class="text-slate-400">Easily add, edit, and manage teacher profiles with all their details in one place.</p>
                </div>

                <!-- Feature 2 -->
                <div class="p-6 rounded-2xl bg-slate-800/50 border border-slate-700/50 hover:border-blue-500/30 transition-colors">
                    <div class="w-12 h-12 rounded-xl gradient-button flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">Subject Organization</h3>
                    <p class="text-slate-400">Organize subjects with codes and assign teachers to multiple subjects seamlessly.</p>
                </div>

                <!-- Feature 3 -->
                <div class="p-6 rounded-2xl bg-slate-800/50 border border-slate-700/50 hover:border-purple-500/30 transition-colors">
                    <div class="w-12 h-12 rounded-xl gradient-button flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">Dashboard Analytics</h3>
                    <p class="text-slate-400">Get insights with overview stats and manage everything from a central dashboard.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-8 border-t border-slate-700/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg gradient-button flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <span class="text-white font-medium">EduAdmin</span>
                </div>
                <p class="text-sm text-slate-400">
                    &copy; {{ date('Y') }} EduAdmin. Built with Laravel & Tailwind CSS.
                </p>
            </div>
        </div>
    </footer>
</body>
</html>
