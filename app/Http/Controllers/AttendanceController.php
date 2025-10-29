<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->get('q');
        $student_id = $request->get('student_id');

        $attendances = Attendance::with('student')
            ->when($student_id, fn($q, $id) => $q->where('student_id', $id))
            ->when($request->get('q'), function ($query, $q) {
                $query->whereHas('student', function ($q2) use ($q) {
                    $q2->where('nama', 'like', "%{$q}%")
                        ->orWhere('nim', 'like', "%{$q}%");
                });
            })
            ->orderByDesc('nama')
            ->paginate(5)
            ->withQueryString();

        $students = Student::orderBy('nama')->get();

        return view('attendances.index', compact('attendances', 'students', 'q', 'student_id'));
    }

    public function create(Request $request)
    {
        $students = Student::orderBy('nama')->get();
        $student_id = $request->get('student_id');
        return view('attendances.create', compact('students', 'student_id'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'student_id' => 'required|exists:students,id',
            'tanggal' => 'required|date',
            'status' => 'required|in:Hadir,Izin,Sakit,Alpha',
            'keterangan' => 'nullable|string',
        ]);
        Attendance::create($data);
        return redirect()->route('attendances.index')->with('success', 'Data absensi berhasil ditambah.');
    }

    public function edit(Attendance $attendance)
    {
        $students = Student::orderBy('nama')->get();
        return view('attendances.edit', compact('attendance', 'students'));
    }

    public function update(Request $request, Attendance $attendance)
    {
        $data = $request->validate([
            'student_id' => 'required|exists:students,id',
            'tanggal' => 'required|date',
            'status' => 'required|in:Hadir,Izin,Sakit,Alpha',
            'keterangan' => 'nullable|string',
        ]);
        $attendance->update($data);
        return redirect()->route('attendances.index')->with('success', 'Data absensi berhasil diupdate.');
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return redirect()->route('attendances.index')->with('success', 'Data absensi berhasil dihapus.');
    }
}
