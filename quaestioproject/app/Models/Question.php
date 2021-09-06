<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Question extends Model
{
    use HasFactory;

    public function getAllQuestions(){
        try {
            return DB::table('question')
                ->join('question_user', 'question.id', '=', 'question_user.question_id')
                ->join('user', 'question_user.userFrom_id', '=', 'user.id')
                ->select('question.text, question', 'question_user.userFrom_id, userFrom_ID')
                ->where('isDeleted', '=', '0')
                ->where('answer_id', '!=', null)
                ->get();
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
        }
    }

    public function getAskedQuestionsForLoggedUser($id){

        try {
            return DB::table('question_user')
                ->join('question', 'question_user.question_id', '=', 'question.id')
                ->join('user', 'userTo_id', '=', 'user.id')
                ->where('question.isDeleted', '=', 0)
                ->where('userTo_id', '=', $id)
                ->where('answer_id', '=', null)
                ->orderBy('dateSent', 'DESC')
                ->get();
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
        }
    }

    public function getAnsweredQuestionsForLoggedUser($id)
    {
        try {
            return DB::table('question_user')
                ->select('answer.text as answer', 'answer.dateAnswered as dateAnswered', 'question.text as question', 'question_user.*')
                ->join('question', 'question_id', '=', 'question.id')
                ->join('answer', 'answer_id', '=', 'answer.id')
//                ->join('user', 'userTo_id', '=', 'user.id')
                ->where('isDeleted', '=', '0')
                ->where('userTo_id', '=', $id)
                ->orderBy('dateSent', 'DESC')
                ->get();
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
        }
    }
    public function getAnsweredQuestionsForAllUsers()
    {
        try {
            return DB::table('question_user')
                ->select('answer.text as answer', 'answer.dateAnswered as dateAnswered', 'question.text as question', 'question_user.*', 'user.username as userTo', 'user.image as image')
                ->join('user', 'userTo_id', '=', 'user.id')
//                ->select('answer.text as answer', 'answer.dateAnswered as dateAnswered', 'question.text as question', 'question_user.*', 'u1.username as userTo', 'u2.username as userFrom')
//                ->join('user as u1', 'userTo_id', '=', 'u1.id')
//                ->join('user as u2', 'userFrom_id', '=', 'u2.id')
                ->join('question', 'question_id', '=', 'question.id')
                ->join('answer', 'answer_id', '=', 'answer.id')
                ->where('question.isDeleted', '=', '0')
                ->orderBy('dateSent', 'DESC')
                ->get();
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
        }
    }

    public function getUserFrom($id)
    {
        try {
            return DB::table('question_user')
                ->select('user.username as userFrom')
                ->join('user', 'userFrom_id', '=', 'user.id')
                ->where('userFrom_id', '=', $id)
                ->first();
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
        }
    }

    public function makeUserFromArray($objectArray){
        $userFromArray = new \stdClass();
        $userFromArray->userFrom = [];
        foreach($objectArray as $index => $one)
        {
            if($one->userFrom_id != null) {
                $result = $this->getUserFrom($one->userFrom_id)->userFrom;
                array_push($userFromArray->userFrom, [$index => $result]);
            }
            else {
                array_push($userFromArray->userFrom, [$index => null]);
            }
        }

        return $userFromArray;
    }

    public function getOneQuestion($question_id, $userTo_id){

        try {
            return DB::table('question')
                ->join('question_user', 'question.id', '=', 'question_id')
                ->where('question.id', '=', $question_id)
                ->where('userTo_id', '=', $userTo_id)
                ->first();
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
        }
    }

    public function answerOnQuestion($question_id, $userTo_id, $answer)
    {
        try {
            return DB::table('question_user')
                ->where('question_id', '=', $question_id)
                ->where('userTo_id', '=', $userTo_id)
                ->update([
                    'answer_id' => $answer->id
                ]);
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
        }
    }

    public function makeNewQuestion($question){
        try {
            return DB::table('question')->insert([
                'text' => $question
            ]);
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
        }
    }

    public function getLastInsertedQuestion(){
        try {
            return DB::table('question')
                ->orderBy('id', 'DESC')
                ->first();
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
        }
    }

    public function sendQuestionToUser($question, $userFrom_id, $userTo_id){
        try {
            return DB::table('question_user')->insert([
                'question_id' => $question->id,
                'userTo_id' => $userTo_id,
                'userFrom_id' => $userFrom_id,
                'dateSent' => time()
            ]);
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
        }
    }

    public function deleteQuestion($id){
        try {
            return DB::table('question')
                ->where('id', '=', $id)
                ->update(['isDeleted' => 1]);
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
        }
    }
}
