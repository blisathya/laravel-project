<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->get('q');
        $students = Student::when($q, function ($query, $q) {
            $query->where('nama', 'like', "%{$q}%")
                ->orWhere('nim', 'like', "%{$q}%")
                ->orWhere('jurusan', 'like', "%{$q}%");
        })
            ->orderBy('nim')
            ->paginate(5)
            ->withQueryString();

        return view('students.index', compact('students', 'q'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nim' => 'required|unique:students,nim',
            'nama' => 'required|string',
            'email' => 'required|email|unique:students,email',
            'jurusan' => 'required|string',
            'tahun_masuk' => 'required|digits:4|integer',
        ]);
        Student::create($data);
        return redirect()->route('students.index')->with('success', 'Data mahasiswa berhasil ditambah.');
    }

    public function show(Student $student)
    {
        $attendances = $student->attendances()->orderByDesc('tanggal')->paginate(8);
        return view('students.show', compact('student', 'attendances'));
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'nim' => "required|unique:students,nim,{$student->id}",
            'nama' => 'required|string',
            'email' => "required|email|unique:students,email,{$student->id}",
            'jurusan' => 'required|string',
            'tahun_masuk' => 'required|digits:4|integer',
        ]);
        $student->update($data);
        return redirect()->route('students.index')->with('success', 'Data mahasiswa berhasil diupdate.');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}