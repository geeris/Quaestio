<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Answer extends Model
{
    use HasFactory;

    public function makeAnAnswer($answer){
        try{
            return DB::table('answer')->insert([
            'text' => $answer,
            'dateAnswered' => time()
        ]);
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
        }
    }

    public function getLastInsertedAnswer(){
        try {
            return DB::table('answer')
                ->orderBy('id', 'DESC')
                ->first();
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
        }
    }

    public function deleteAnswerInstance($id){
        try{
            return DB::table('question_user')
            ->where('answer_id', $id)
            ->update(['answer_id' => null]);
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
        }
    }

    public function deleteAnswer($id){
        try{
            return DB::table('answer')
            ->where('id', '=', $id)
            ->delete();
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
        }
    }
}
