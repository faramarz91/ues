<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\UserExam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TakeTestController extends Controller
{

    public function index()
    {
        $exams = Exam::whereNotNull('approved')->latest()->get();
        return view('exams.index')->with(compact('exams'));
    }

    public function result(Request $request, UserExam $exam)
    {
        $takenExam = Auth::user()->exams();
        return view('exams.result')->with(['takenExam' => $takenExam, 'userExam' => $exam]);
    }

    public function doExam( Exam $exam)
    {
        if ($exam->candidate()->exists()){
            return redirect()->action([self::class, 'result'], ['exam' => $exam->candidate]);
        } else {
            return view('exams.quiz')->with(compact('exam'));
        }
    }

    public function storeExam(Request $request, Exam $exam)
    {
        if (!Auth::user()->hasRole('admin')) {
            abort(403);
        }
        $request->validate([
            'answers' => ['array', 'required', 'size:'.$exam->q_count],
            'answers.*' => ['string', 'required'],
        ]);

        $corrects = 0;
        $false = 0;
        foreach ($request->answers as $index => $answer){
            $exam->questions[$index]['correct'] == $answer ? $corrects++ : $false++;
        }

        $exam->candidate()->create([
            'student_id' => Auth::user()->id,
            'result' => $request->input('answers'),
            'total_correct' => $corrects,
            'total_false' => $false,
            'score' => ($exam->q_score)*$corrects
        ]);

        return redirect()->route('take-test.result', ['exam' => $exam->id]);
    }
}
