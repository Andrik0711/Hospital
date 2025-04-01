@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10 p-4 sm:p-6 lg:p-8">
    <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-6">Patients List</h2>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white dark:bg-gray-800 shadow-md rounded-lg">
            <thead>
                <tr>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Consultation Date</th>
                    <th class="px-4 py-2">Reason</th>
                    <th class="px-4 py-2">Medications</th>
                    <th class="px-4 py-2">Vital Signs</th>
                    <th class="px-4 py-2">Notes</th>
                </tr>
            </thead>
            <tbody>
                @foreach($patients as $patient)
                    @foreach($patient->medicalInfos as $info)
                        <tr>
                            <td class="border px-4 py-2">{{ $patient->name }}</td>
                            <td class="border px-4 py-2">{{ $patient->email }}</td>
                            <td class="border px-4 py-2">{{ $info->consultation_date }}</td>
                            <td class="border px-4 py-2">{{ $info->reason }}</td>
                            <td class="border px-4 py-2">{{ $info->medications }}</td>
                            <td class="border px-4 py-2">
                                @php
                                    $vitalSigns = json_decode($info->vital_signs, true);
                                @endphp
                                <ul>
                                    <li>Temperature: {{ $vitalSigns['temperature'] ?? 'N/A' }} °C</li>
                                    <li>Heart Rate: {{ $vitalSigns['heart_rate'] ?? 'N/A' }} bpm</li>
                                    <li>Blood Pressure: {{ $vitalSigns['blood_pressure'] ?? 'N/A' }}</li>
                                </ul>
                            </td>
                            <td class="border px-4 py-2">{{ $info->notes }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
