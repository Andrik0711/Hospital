<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <!-- Barra de Navegación -->
    <nav class="bg-green-600 p-4 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <a href="#" class="text-white text-lg font-semibold">Hospital Management</a>
            <div>
                <a href="{{ route('patient.dashboard') }}" class="text-white mr-4 hover:underline">Dashboard</a>
                <a href="{{ route('patient.medical_infos') }}" class="text-white mr-4 hover:underline">Citas</a>
                <a href="{{ route('profile.edit') }}" class="text-white hover:underline">Profile</a>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="inline-block">
                @csrf
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Logout</button>
            </form>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <div class="container mx-auto mt-10">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold mb-4">Bienvenido, Paciente</h1>
            <p class="mb-4">This is your dashboard where you can view your appointments, medical records, and more.</p>
            <!-- Aquí puedes agregar más contenido específico para el paciente -->
        </div>
    </div>

</body>
</html>
