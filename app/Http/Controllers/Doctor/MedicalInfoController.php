<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\MedicalInfo;
use App\Models\User;
use Illuminate\Http\Request;

class MedicalInfoController extends Controller
{
    public function create()
    {
        $patients = User::where('role', 'patient')->get();
        return view('doctor.create_medical_info', compact('patients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:users,id',
            'temperature' => 'required|numeric',
            'heart_rate' => 'required|numeric',
            'blood_pressure' => 'required|string',
            'reason' => 'required|string',
            'medications' => 'required|string',
            'consultation_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        MedicalInfo::create([
            'patient_id' => $request->patient_id,
            'vital_signs' => json_encode([
                'temperature' => $request->temperature,
                'heart_rate' => $request->heart_rate,
                'blood_pressure' => $request->blood_pressure,
            ]),
            'reason' => $request->reason,
            'medications' => $request->medications,
            'consultation_date' => $request->consultation_date,
            'notes' => $request->notes,
        ]);

        return redirect()->route('doctor.dashboard')->with('success', 'Medical information added successfully.');
    }

    public function index()
    {
        $patients = User::where('role', 'patient')->with('medicalInfos')->get();
        return view('doctor.patients', compact('patients'));
    }
}
