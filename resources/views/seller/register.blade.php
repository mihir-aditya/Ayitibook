<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Seller Registration</title>
    <link rel="stylesheet" href="{{ mix('resources/css/app.css') }}" />
</head>
<body class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4">
    <div class="max-w-3xl w-full bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="md:flex">
            <div class="md:w-1/2 p-8 bg-gradient-to-br from-indigo-600 to-indigo-400 text-white">
                <h2 class="text-2xl font-semibold">Create your Seller Account</h2>
                <p class="mt-4 text-sm opacity-90">Start selling your products on our marketplace. Fill in your details to get started.</p>
                <ul class="mt-6 text-sm space-y-2">
                    <li class="flex items-start"><span class="mr-2">✅</span> Quick setup</li>
                    <li class="flex items-start"><span class="mr-2">✅</span> Secure payments</li>
                    <li class="flex items-start"><span class="mr-2">✅</span> Seller dashboard</li>
                </ul>
            </div>

            <div class="md:w-1/2 p-8">
                @if(session('status'))
                    <div class="mb-4 px-4 py-3 rounded bg-green-100 text-green-800">{{ session('status') }}</div>
                @endif

                @if($errors->any())
                    <div class="mb-4 px-4 py-3 rounded bg-red-50 border border-red-200 text-red-700">
                        <ul class="list-disc pl-5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('seller.register.submit') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Full name</label>
                        <input name="name" value="{{ old('name') }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="John Doe">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email address</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="you@example.com">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Password</label>
                            <input type="password" name="password" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="••••••••">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Confirm Password</label>
                            <input type="password" name="password_confirmation" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="••••••••">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Shop name</label>
                        <input name="shop_name" value="{{ old('shop_name') }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="My Awesome Shop">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Phone</label>
                            <input name="phone" value="{{ old('phone') }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="+1 555 555 5555">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">City / State</label>
                            <input name="city" value="{{ old('city') }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Lagos, NG">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Shop address</label>
                        <textarea name="shop_address" rows="3" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="123 Market Street">{{ old('shop_address') }}</textarea>
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-md shadow-sm">Register as Seller</button>
                        <a href="" class="text-sm text-indigo-600 hover:underline">Already have an account?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>