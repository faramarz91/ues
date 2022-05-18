<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\Exam;
use App\Models\User;
use App\Models\UserExam;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AnalyzeController extends Controller
{
    public function __invoke()
    {
        $students = User::role(UserRole::Student->value);
        $userExams = UserExam::whereIn('student_id', $students->get('id')->toArray());
        $total_score = $userExams->sum('score');
        $total_correct = $userExams->sum('total_correct');
        $total_false = $userExams->sum('total_false');
        $total_questions = $total_correct+$total_false;
        $of_score = $userExams->count()*100;
        $candidate_users = User::whereIn('id', $userExams->get('student_id')->toArray());
        return view('admin.analyzer')->with(
            compact('students',
                'userExams',
                'total_score',
                'of_score',
                'total_correct',
                'total_false',
                'total_questions',
                'candidate_users'
            )
        );
    }
}
