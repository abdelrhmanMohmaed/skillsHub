<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function show($id)
    {
        $data['exam'] = Exam::findOrFail($id);

        $data['canViewStartBtn'] = true;
        $user =  Auth::user();
        //chack the user auth or no
        if ($user !== null) {
            $pivotRow = $user->exams()->where('exam_id', $id)->active()->first();
            //chack the status exam isnt closed
            if ($pivotRow !== null and $pivotRow->pivot->status == 'closed') {
                $data['canViewStartBtn'] = false;
            };
        };

        return view('web.exams.show')->with($data);
    }


    public function start($examId, Request $request)
    {
        $user = Auth::user();
        if (!$user->exams->contains($examId)) {
            $user->exams()->attach($examId);
        } else {
            $user->exams()->updateExistingPivot($examId, [
                'status' => 'closed',
            ]);
        }
        $request->session()->flash('prev', "start/$examId");
        return redirect(url("/exam/questions/$examId"));
    }


    public function questions($examId, Request $request)
    {
        if (session('prev') !== "start/$examId") {
            return redirect("exam/show/$examId");
        }
        $request->session()->flash('prev', "questions/$examId");

        $data['exam'] = Exam::findOrFail($examId);
        return view('web.exams.questions')->with($data);
    }


    public function submit($examId, Request $request)
    {
        if (session('prev') !== "questions/$examId") {
            return redirect("exam/show/$examId");
        }

        $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|in:1,2,3,4',
        ]);

        //calcScore
        $exam = Exam::findOrFail($examId);

        $points = 0;
        $totalQuseNum = $exam->questions->count();

        foreach ($exam->questions as $question) {
            if (isset($request->answers[$question->id])) {
                $userAus =  $request->answers[$question->id];
                $rightAns = $question->right_ans;

                if ($userAus == $rightAns) {
                    $points += 1;
                }
            }
        }

        $score = ($points / $totalQuseNum  * 100);
      //  return dd($score);
        //Calc time 
        $user = Auth::user();
        $pivotRow = $user->exams()->where('exam_id', $examId)->first();
        $startTime = $pivotRow->pivot->created_at;
        $submitTime = Carbon::now();

        $timeMins = $submitTime->diffInMinutes($startTime);

        //chack in the time exam 

        if ($timeMins > $pivotRow->duration_mins) {
            $score = 0;
        };


        // update the Pivot
        $user->exams()->updateExistingPivot($examId, [
            'score' => $score,
            'time_mins' => $timeMins,
        ]);

        $request->session()->flash("success", "You fininsed exam successfully with score : $score %");

        return redirect(url("exam/show/$examId"));
    }
}
