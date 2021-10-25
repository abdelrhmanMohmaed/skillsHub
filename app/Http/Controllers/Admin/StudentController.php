<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function index()
    {
        $studentRole = Role::where('name', 'student')->first();
        $data['students'] = User::where('role_id', $studentRole->id)
            ->orderBy('id', 'DESC')
            ->paginate(10);

        return view('admin.students.index')->with($data);
    }
    public function showScores($id)
    {
        $student = User::findOrFail($id);

        if ($student->role->name !== 'student') {
            return back();
        }

        $data['student'] = $student;
        $data['exams'] = $student->exams;

        return view('admin.students.show-scores')->with($data);
    }
    public function delete($id, Request $request)
    {

        $user = User::findOrFail($id);
        try {
            $user->delete();
            Storage::delete($user);
            $msg = 'row deleted successfully';
        } catch (Exception $e) {
            $msg = "can't delete this row";
        }

        $request->session()->flash('msg', $msg);
        return back();
    }

    public function openExam($studentId, $examId)
    {
        $student = User::findOrFail($studentId);
        $student->exams()->updateExistingPivot($examId, [
            'status' => 'opened',
        ]);
        return back();
    }
    public function closedExam($studentId, $examId)
    {
        $student = User::findOrFail($studentId);
        $student->exams()->updateExistingPivot($examId, [
            'status' => 'closed',
        ]);
        return back();
    }
}
