<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Medical Information</title>
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
            <h1 class="text-2xl font-bold mb-4">Tus Citas y Signos Vitales</h1>
            <p class="mb-4">Aquí puedes ver tus citas y los signos vitales que han sido registrados por tu doctor.</p>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b">Fecha de Consulta</th>
                            <th class="py-2 px-4 border-b">Signos Vitales</th>
                            <th class="py-2 px-4 border-b">Motivo</th>
                            <th class="py-2 px-4 border-b">Medicamentos</th>
                            <th class="py-2 px-4 border-b">Notas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($medicalInfos as $info)
                            @php
                                $vitalSigns = json_decode($info->vital_signs, true);
                            @endphp
                            <tr>
                                <td class="border px-4 py-2">{{ $info->consultation_date }}</td>
                                <td class="border px-4 py-2">
                                    <ul>
                                        <li>Temperatura: {{ $vitalSigns['temperature'] ?? 'N/A' }} °C</li>
                                        <li>Frecuencia Cardíaca: {{ $vitalSigns['heart_rate'] ?? 'N/A' }} bpm</li>
                                        <li>Presión Arterial: {{ $vitalSigns['blood_pressure'] ?? 'N/A' }}</li>
                                    </ul>
                                </td>
                                <td class="border px-4 py-2">{{ $info->reason }}</td>
                                <td class="border px-4 py-2">{{ $info->medications }}</td>
                                <td class="border px-4 py-2">{{ $info->notes }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>
