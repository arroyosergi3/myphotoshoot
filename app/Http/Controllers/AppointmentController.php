<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Pack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::where('photographer_id', Auth::guard('photographer')->user()->id );

        return response()->json($appointments->map(function ($appointment) {
            return [
                'id' => $appointment->id,
                'title' => $appointment->notes ?? 'Cita con fotógrafo',
                'start' => $appointment->appointment_date,
                'allDay' => false,
            ];
        }));
    }

      public function create(Pack $pack)
    {
        /** @disregard */
        return view('appointments.create', compact('pack'));
    }

     public function store(Request $request)
    {
        $data = $request->validate([
            'appointment_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

         $exists = Appointment::where('photographer_id', $request->photographer_id)
        ->whereDate('date', $request->date)
        ->exists();

    if ($exists) {
        return redirect()->back()->withInput()->with('error', 'El fotógrafo ya tiene una cita ese día a esa hora.');
    }

        $appointment = Appointment::create([
            'user_id' => Auth::user()->id,
            'photographer_id' => session('photographer'), 
            'duration' => session('duration'), 
            'appointment_date' => $data['appointment_date'],
            'notes' => $data['notes'] ?? null,
        ]);

        return response()->json([
            'id' => $appointment->id,
            'title' => $appointment->notes ?? 'Cita con fotógrafo',
            'start' => $appointment->appointment_date,
            'allDay' => false,
        ], 201);
    }

    public function availableHours(Request $request)
{
    
    $request->validate([
        'date' => 'required|date',
        'photographer_id' => 'required|integer',
    ]);

    $occupiedTimes = Appointment::where('photographer_id', $request->photographer_id)
        ->whereDate('date', $request->date)
        ->pluck('time')
        ->map(fn($t) => \Carbon\Carbon::parse($t)->format('H:i'))
        ->toArray();


    $allTimes = [];
    for ($h = 10; $h <= 17; $h++) {
        $allTimes[] = sprintf('%02d:00', $h);
    }

    $available = array_values(array_diff($allTimes, $occupiedTimes));

    return response()->json($available);
}


    
}
