<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GKTAX Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

</head>

<body>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <strong class="font-bold">Whoops!</strong>
                    <span class="block sm:inline"> {{ $errors->first() }}</span>

                </div>
            @endif
            <form method="POST" action="{{ route('loginSubmit') }}">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="email" id="email" name="email" autocomplete="off"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-gray-700">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required autocomplete="off">
                        <button type="button" onclick="togglePassword()"
                            class="absolute inset-y-0 right-0 px-3 py-2 text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-.274.823-.676 1.597-1.186 2.285M15 12a3 3 0 01-6 0m6 0a3 3 0 01-6 0m6 0c0 1.657-1.343 3-3 3s-3-1.343-3-3" />
                            </svg>
                        </button>
                    </div>


                </div>
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <input type="checkbox" id="remember" name="remember" class="mr-2">
                        <label for="remember" class="text-gray-700">Remember Me</label>
                    </div>
                    <a href="#" class="text-blue-500 hover:underline">Forgot Password?</a>
                </div>
                <button type="submit"
                    class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Login</button>
            </form>
            <div class="mt-4 text-center">
                <span class="text-gray-600">Don't have an account?</span>
                <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Register</a>
            </div>
        </div>
    </div>
    <script>
        function togglePassword() {
            var passwordField = document.getElementById("password");
            var passwordFieldType = passwordField.getAttribute("type");
            if (passwordFieldType === "password") {
                passwordField.setAttribute("type", "text");
            } else {
                passwordField.setAttribute("type", "password");
            }
        }
    </script>
</body>

</html>
