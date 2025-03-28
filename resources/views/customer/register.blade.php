<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Registration</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center text-gray-700">Register as Customer</h2>
        <form method="POST" action="{{route('customer.register')}}" class="mt-4">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-600">First Name</label>
                <input type="text" name="first_name" placeholder="First Name" value="{{old('first_name','')}}" required
                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
                @error('first_name')
                    <div class="alert alert-danger text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-600">Last Name</label>
                <input type="text" name="last_name" placeholder="Last Name" value="{{old('last_name','')}}" required
                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
                 @error('last_name')
                    <div class="alert alert-danger text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-600">Email</label>
                <input type="email" name="email" placeholder="Email" value="{{old('email','')}}" required
                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
                 @error('email')
                    <div class="alert alert-danger text-red-600">{{ $message }}</div>
                @enderror

            </div>
            <div class="mb-4">
                <label class="block text-gray-600">Password</label>
                <input type="password" name="password" placeholder="Password" value="{{old('password','')}}" required
                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
                 @error('password')
                    <div class="alert alert-danger text-red-600">{{ $message }}</div>
                @enderror

            </div>
            <div class="mb-4">
                <label class="block text-gray-600">Confirm Password</label>
                <input type="password" name="password_confirmation" placeholder="Confirm Password" value="{{old('password_confirmation','')}}" required
                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
                 @error('password_confirmation')
                    <div class="alert alert-danger text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="w-full px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">
                Register as Admin
            </button>
        </form>
    </div>
</body>
</html>
