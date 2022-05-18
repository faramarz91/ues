<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;

/**
 * @property mixed $id
 * @property mixed $title
 * @property mixed $questions
 * @property mixed $q_count
 * @property int|mixed $q_score
 */
class Exam extends Model
{
    use HasFactory;

    protected $casts = [
        'questions' => 'json'
    ];

    protected $guarded = [];

//    the exam result of a user who take in quiz
    public function candidate(): HasOne
    {
        return $this->hasOne(UserExam::class, 'exam_id')
            ->ofMany([],function($query){
                $query->where('student_id', Auth::user()->id);
            });
    }

    public function candidates(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_exams', 'exam_id', 'student_id')
            ->withTimestamps()
            ->withPivot('result', 'total_correct', 'total_false', 'score');
    }
}
