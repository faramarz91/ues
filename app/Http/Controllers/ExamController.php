<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\Exam;
use App\Models\UserExam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ExamController extends Controller
{
    public function __construct()
    {
//        determine only admin and teacher
        $this->middleware(['auth', 'role:admin|teacher']);
    }

    public function index()
    {
        $exams = Exam::latest()->get();
        return view('admin.exams.index')->with(compact('exams'));
    }

    public function show(Exam $exam)
    {
        return view('admin.exams.single')->with(compact('exam'));
    }

    public function create(Request $request)
    {
        if (!Auth::user()->hasRole('admin')) {
            abort(403);
        }
        return view('admin.exams.create');
    }

    public function store(Request $request)
    {
        if (!Auth::user()->hasRole('admin')) {
            abort(403);
        }
        $request->validate([
            'title' => ['string', 'required'],
            'questions' => ['array', 'required' /*, 'min:5'*/],
            'questions.*.question' => ['string', 'required'],
            'questions.*.A' => ['string', 'required'],
            'questions.*.B' => ['string', 'required'],
            'questions.*.C' => ['string', 'required'],
            'questions.*.D' => ['string', 'required'],
            'questions.*.correct' => ['string', 'max:1', 'required'],
        ]);
        $count = count($request->input('questions'));
//        throw a validation exception with min 5 questions
//        this also could be defined in validation roles with min:5
//        if ($count < 5){
//            throw ValidationException::withMessages((array)'at least you should have 5 questions to able add exam list');
//        }

        $exam = new Exam();
        $exam->title = $request->input('title', null);
        $exam->questions = $request->input('questions');
        $exam->q_count = (int) $count; //number of questions
        $exam->q_score = 100/$count; //each question scour
        $exam->save();
        $questions = [];
        foreach ($exam->questions as $index => $question){
            $questions['e'.$exam->id.'q'.$index+1] = $question;
        }
        $exam->update(['questions' => $questions]);

        $request->session()->flash('message.success', 'Task was successful!');
        return redirect()->action([self::class, 'index']);
    }

    public function edit(Exam $exam)
    {
        if (!Auth::user()->hasRole(UserRole::Admin->value)){
            abort(403);
        }
        return view('admin.exams.update')->with(compact('exam'));
    }

    public function update(Request $request, Exam $exam)
    {
        if (!Auth::user()->hasRole(UserRole::Admin->value)){
            abort(403);
        }
        $request->validate([
            'title' => ['string', 'required'],
            'questions' => ['array', 'required' /*, 'min:5'*/],
            'questions.*.question' => ['string', 'required'],
            'questions.*.A' => ['string', 'required'],
            'questions.*.B' => ['string', 'required'],
            'questions.*.C' => ['string', 'required'],
            'questions.*.D' => ['string', 'required'],
            'questions.*.correct' => ['string', 'max:1', 'required'],
        ]);
        $count = count($request->input('questions'));
//        throw a validation exception with min 5 questions
//        this also could be defined in validation roles with min:5
//        if ($count < 5){
//            throw ValidationException::withMessages((array)'at least you should have 5 questions to able add exam list');
//        }

//        update all taken exams witch doesn't completed, change the status to finished, because user should not take broken exam.
//        broken exam is updated exam question or changed order of question.
//        a person who on the test should not be affected the result.
//        UserExam::where('exam_id', $exam->id)->where('finished', null)->where('last_question', '!=', null)->update(['finished' => now()]);
        $exam->title = $request->input('title', null);
        $exam->questions = $request->input('questions');
        $exam->q_count = (int) $count; //number of questions
        $exam->q_score = 100/$count; //each question scour
        $exam->save();
        $questions = [];
        foreach ($exam->questions as $index => $question){
            $questions['e'.$exam->id.'q'.$index+1] = $question;
        }
        $exam->update(['questions' => $questions]);

        $request->session()->flash('message.success', 'Task was successfully Updated!');
        return redirect()->action([self::class, 'index']);
    }

    public function submit(Request $request, Exam $exam)
    {
        $exam->update(['approved' => now()]);

        return redirect()->action([self::class, 'index']);
    }

    public function destroy(Exam $exam)
    {
        $exam->delete();
        return redirect()->action([self::class, 'index']);
    }
}
