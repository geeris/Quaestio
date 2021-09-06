<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StarterQuestion extends Model
{
    use HasFactory;

    public function getAllStarterQuestions(){
        try{
            return DB::table('question')
                ->where('isStarterPack', '=', 1)
                ->where('isDeleted', '=', 0)
                ->get();
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
        }
    }

    public function getOneQuestion($id){
        try{
            return DB::table('question')
                ->where('id', '=', $id)
                ->first();
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
        }
    }

    public function addStarterQuestion(Request $request){
        try {
            return DB::table('question')->insert([
                'text' => $request->input('starterQuestion'),
                'isStarterPack' => 1
            ]);
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
        }
    }

    public function deleteStarterQuestion($id){
        try{
            return DB::table('question')
                ->where('id', '=', $id)
                ->update(['isDeleted' => 1]);
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
        }
    }

    public function updateStarterQuestion(Request $request, $id){
        try{
            return DB::table('question')
                ->where('id', '=', $id)
                ->update(['text' => $request->input('question')]);
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
        }
    }
}
