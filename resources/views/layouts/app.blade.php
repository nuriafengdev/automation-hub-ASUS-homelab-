<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Automation Hub</title>
</head>
<body class="flex min-h-screen w-full">
    <aside class="w-64 bg-[#0f172a] p-4 text-white flex flex-col justify-between">
        <div class="flex flex-col justify-center gap-2">
            <h2 class="text-lg font-bold py-3">Automation Hub</h2>
            <a href="{{ route('dashboard') }}" class="hover:bg-[#2563EB] hover:text-white p-2 rounded-lg">Dashboard</a>
            <a href="{{ route('tasks') }}" class="hover:bg-[#2563EB] hover:text-white p-2 rounded-lg">Tasks</a>
        </div>
        <div class="flex flex-col justify-end">
            <hr class="my-2 border-gray-600">
            <a href="" class="hover:bg-[#2563EB] hover:text-white p-2 rounded-lg">System</a>
            <a href="" class="hover:bg-[#2563EB] hover:text-white p-2 rounded-lg">Settings</a>
        </div>
    </aside>
    <main class="flex-1 p-4 overflow-y-auto bg-[#F8FAFC]">
        @yield('content')
    </main>
</body>
</html>