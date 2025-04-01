@extends('layouts.app')

@section('content')

<div class="container mx-auto mt-10 p-4 sm:p-6 lg:p-8">
    <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-6">Add Medical Information</h2>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
            <strong class="font-bold">Whoops!</strong>
            <span class="block sm:inline"> There were some problems with your input.</span>
            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('doctor.medical_infos.store') }}" method="POST" class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 space-y-6">
        @csrf

        <div class="form-group">
            <label for="patient_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Patient</label>
            <select class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="patient_id" name="patient_id" required>
                <option value="">Select Patient</option>
                @foreach($patients as $patient)
                    <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="temperature" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Temperature (°C)</label>
            <input type="number" step="0.1" class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="temperature" name="temperature" required>
        </div>

        <div class="form-group">
            <label for="heart_rate" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Heart Rate (bpm)</label>
            <input type="number" class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="heart_rate" name="heart_rate" required>
        </div>

        <div class="form-group">
            <label for="blood_pressure" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Blood Pressure (mmHg)</label>
            <input type="text" class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="blood_pressure" name="blood_pressure" required>
        </div>

        <div class="form-group">
            <label for="reason" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Reason for Consultation</label>
            <textarea class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="reason" name="reason"></textarea>
        </div>

        <div class="form-group">
            <label for="medications" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Medications</label>
            <textarea class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="medications" name="medications"></textarea>
        </div>

        <div class="form-group">
            <label for="consultation_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Consultation Date</label>
            <input type="date" class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="consultation_date" name="consultation_date" required>
        </div>

        <div class="form-group">
            <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Notes</label>
            <textarea class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="notes" name="notes"></textarea>
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Add Medical Information</button>
    </form>
</div>
@endsection
