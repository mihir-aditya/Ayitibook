<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Seller Login</title>
    <link rel="stylesheet" href="{{ mix('resources/css/app.css') }}" />
</head>
<body class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4">

<div class="w-full max-w-md bg-white rounded-lg shadow-md p-6">
    <h1 class="text-2xl font-semibold text-gray-800 text-center">Seller Sign In</h1>

    @if($errors->any())
        <div class="mt-4 p-3 bg-red-50 border border-red-200 text-red-700 rounded">
            <ul class="list-disc pl-5 text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('status'))
        <div class="mt-4 p-3 bg-green-50 border border-green-200 text-green-700 rounded">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('seller.login.submit') }}" class="mt-6 space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                   placeholder="seller@example.com">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                   placeholder="••••••••">
        </div>

        <div class="flex items-center justify-between">
            <label class="flex items-center text-sm">
                <input type="checkbox" name="remember"
                       class="h-4 w-4 text-indigo-600 border-gray-300 rounded">
                <span class="ml-2 text-gray-600">Remember me</span>
            </label>

            <span class="text-sm text-gray-400">Password reset coming soon</span>
        </div>

        <button type="submit"
                class="w-full py-2 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-md">
            Sign in
        </button>
    </form>

    <p class="mt-4 text-center text-sm text-gray-600">
        Don't have an account?
        <a href="{{ route('seller.register') }}" class="text-indigo-600 hover:underline">
            Create one
        </a>
    </p>
</div>

</body>
</html>
