<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-md text-center">
        @if(isset($success))
        <div class="alert alert-danger text-green-800">{{ $success }}</div>

        <div class="mt-6">
            <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Back to Login</a>
        </div>
        @else
        <h2 class="text-2xl font-bold text-gray-800">Verify Your Email</h2>
        <p class="mt-4 text-gray-600">We have sent a verification email to your registered email address. Please check your inbox and verify your email before logging in.</p>

        @isset($email)
            <form method="POST" action="{{ route('resend_email') }}" class="mt-6">
                @csrf
                <input type="hidden" name="email" value="{{ $email }}">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Resend Verification Email</button>
            </form>
        @endisset
        <p class="mt-4 text-sm text-gray-500">Didn’t receive the email? Check your spam folder or click the button above to resend.</p>
        @endif
    </div>
</body>
</html>
