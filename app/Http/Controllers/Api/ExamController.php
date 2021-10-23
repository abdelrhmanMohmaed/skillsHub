<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExamResource;
use App\Models\Exam;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExamController extends Controller
{
    public function show($id)
    {
        $exam = Exam::FindOrFail($id);
        return new ExamResource($exam);
    }
    public function showQuestions($id)
    {
        $exam = Exam::with('questions')->findOrFail($id);
        return new ExamResource($exam);
    }
    public function start($examId, Request $request)
    {
        $request->user()->exams()->attach($examId);
        return response()->json([
            'message' => 'you started exam',
        ]);
    }

    public function submit($examId, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'answers' => 'required|array',
            'answers.*' => 'required|in:1,2,3,4',
        ]);
        if ($validator->fails()) {
            return  response()->json($validator->errors());
        }

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

        $score = ($points / $totalQuseNum)  * 100;

        return  response()->json($score);
        //Calc time 
        $user = $request->user();
        $pivotRow = $user->exams()->where('exam_id', $examId)->first();
        $startTime = $pivotRow->pivot->created_at;
        $submitTime = Carbon::now();

        $timeMins = $submitTime->diffInMinutes($startTime);

        //chack in the time exam 
        // if ($timeMins > $pivotRow->duration_mins) {
        //     $score = 0;
        // };


        // update the Pivot
        $user->exams()->updateExistingPivot($examId, [
            'score' => $score,
            'time_mins' => $timeMins,
        ]);

        return response()->json([
            'message' => "your submitted exam successfully with score : $score%"
        ]);
    }
}
