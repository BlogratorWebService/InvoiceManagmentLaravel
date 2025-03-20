<!-- filepath: /C:/Users/sudip/OneDrive/Documents/LaravelNew/invoiceManagement/resources/views/user/auth/register.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GKTAX Register</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-2xl font-bold mb-6 text-center">Register</h2>
            
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Whoops!</strong>
                    <span class="block sm:inline"> {{ $errors->first() }}</span>
                    
                </div>
            @endif
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline"> {{ session('success') }}</span>
                    
                </div>
           
        @endif

            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="firstName" class="block text-gray-700">First Name</label>
                    <input type="text" id="firstName" value="{{ old('firstName') }}" style="text-transform: uppercase;" name="firstName" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="mb-4">
                    <label for="lastName" class="block text-gray-700">Last Name</label>
                    <input type="text" id="lastName" name="lastName" style="text-transform: uppercase;" value="{{ old('lastName') }}" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="mb-4">
                    <label for="phoneNumber" class="block text-gray-700">Phone Number</label>
                    <div class="flex">
                        <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">+91</span>
                        <input type="text" id="phoneNumber" name="phoneNumber" value="{{ old('phoneNumber') }}" class="w-full px-3 py-2 border rounded-r-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="text" id="email" name="email" value="{{ old('email') }}" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="mb-4">
                    <label for="panNumber" class="block text-gray-700">PAN Number</label>
                    <input type="text" max="10" id="panNumber" name="panNumber" style="text-transform: uppercase;" value="{{ old('panNumber') }}" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700">Password</label>
                    <input type="password" id="password" name="password" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-gray-700">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Register</button>
                </div>
            </form>
            <div class="mt-4 text-center">
                <a href="{{ route('loginPage') }}" class="text-blue-500 hover:underline">Already have an account? Login</a>
            </div>
        </div>
    </div>
</body>
</html>