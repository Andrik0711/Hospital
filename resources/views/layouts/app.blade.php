<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Hospital Management')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <!-- Barra de Navegación -->
    <nav class="bg-blue-600 p-4 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <a href="#" class="text-white text-lg font-semibold">Hospital Management</a>
            <div>
                <a href="#" class="text-white mr-4 hover:underline">Dashboard</a>
                <a href="#" class="text-white mr-4 hover:underline">Pacientes</a>
                <a href="{{ route('doctor.medical_infos.create') }}" class="text-white mr-4 hover:underline">Añadir Información Médica</a>
                <a href="#" class="text-white hover:underline">Perfil</a>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="inline-block">
                @csrf
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Logout</button>
            </form>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <div class="container mx-auto mt-10">
        @yield('content')
    </div>

</body>
</html>
