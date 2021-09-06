<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Notifications extends Model
{
    use HasFactory;

    public function getNotificationsForLoggedUser($id){
        try {
            return DB::table('question_user')
                ->select('answer.dateAnswered as dateAnswered', 'question.text as question', 'question_user.*', 'u1.username as userTo')
                ->join('question', 'question_id', '=', 'question.id')
                ->join('answer', 'answer_id', '=', 'answer.id')
                ->join('user as u1', 'userTo_id', '=', 'u1.id')
                ->join('user as u2', 'userFrom_id', '=', 'u2.id')
                ->where('question.isDeleted', '=', '0')
                ->where('userFrom_id', '=', $id)
                ->orderBy('dateAnswered', 'DESC')
                ->limit(50)
                ->get();
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
        }
    }

    public function oneNotification($id){
        try {
            return DB::table('question_user')
                ->select('answer.dateAnswered as dateAnswered', 'answer.text as answer', 'question.text as question', 'question_user.*', 'u1.username as userTo', 'u1.image as image')
                ->join('question', 'question_id', '=', 'question.id')
                ->join('answer', 'answer_id', '=', 'answer.id')
                ->join('user as u1', 'userTo_id', '=', 'u1.id')
                ->join('user as u2', 'userFrom_id', '=', 'u2.id')
                ->where('question.isDeleted', '=', '0')
                ->where('answer_id', '=', $id)
                ->orderBy('dateAnswered', 'DESC')
                ->first();
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
        }
    }
}
