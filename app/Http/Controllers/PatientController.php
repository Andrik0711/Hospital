<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalInfo;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function index()
    {
        return view('patient.index');
    }

    public function medicalInfos()
    {
        $medicalInfos = MedicalInfo::where('patient_id', Auth::id())->get();
        return view('patient.medical_infos', compact('medicalInfos'));
    }
}
