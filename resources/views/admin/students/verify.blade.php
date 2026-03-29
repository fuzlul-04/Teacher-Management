@extends('layouts.sidebar')

@section('header', 'Verify OTP')

@section('content')
<div class="max-w-md mx-auto">
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-8">
        <div class="text-center mb-8">
            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-blue-100 flex items-center justify-center">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Verify Your Phone</h2>
            <p class="text-gray-500 mt-2">We've sent a 4-digit OTP to your phone</p>
            <p class="text-blue-600 font-medium mt-1">{{ Session::get('otp_phone') }}</p>
        </div>

        @if(session('error'))
            <div class="mb-6 px-4 py-3 rounded-lg bg-red-100 border border-red-200 text-red-700 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="mb-6 px-4 py-3 rounded-lg bg-green-100 border border-green-200 text-green-700 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('students.verify.submit') }}" method="POST" class="space-y-6">
            @csrf
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Enter OTP</label>
                <input type="text" name="otp" id="otp" required maxlength="4" pattern="\d{4}"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-center text-2xl tracking-widest font-mono"
                    placeholder="0000">
                @error('otp')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full px-6 py-3 rounded-lg bg-blue-600 text-white font-medium hover:bg-blue-700 transition-colors shadow-sm">
                Verify OTP
            </button>
        </form>

        <div class="mt-6 text-center">
            <p class="text-gray-500 text-sm">Didn't receive the OTP?</p>
            <form action="{{ route('students.resend-otp') }}" method="POST" class="mt-3">
                @csrf
                <button type="submit" id="resendBtn" class="text-blue-600 font-medium hover:text-blue-700 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                    Resend OTP
                </button>
            </form>
            <p class="text-gray-400 text-xs mt-2">OTP expires in 5 minutes</p>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('otp').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    const resendBtn = document.getElementById('resendBtn');
    let countdown = 60;
    
    resendBtn.addEventListener('click', function() {
        this.disabled = true;
        this.textContent = 'Resend in ' + countdown + 's';
        
        const timer = setInterval(() => {
            countdown--;
            if (countdown <= 0) {
                clearInterval(timer);
                resendBtn.disabled = false;
                resendBtn.textContent = 'Resend OTP';
                countdown = 60;
            } else {
                resendBtn.textContent = 'Resend in ' + countdown + 's';
            }
        }, 1000);
    });
</script>
@endpush
@endsection
