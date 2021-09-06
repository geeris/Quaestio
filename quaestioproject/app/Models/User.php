<?php

namespace App\Models;

use App\Http\Requests\RequestRegister;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAllUsers(){
        try {
            return DB::table('user')
                ->select('user.*','gender.id as name', 'gender.name as gender', 'role.name as role')
                ->join('gender', 'user.gender_id', '=', 'gender.id')
                ->join('role', 'user.role_id', '=', 'role.id')
                ->get();
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
        }
    }

    public function getUserToLogin(Request $request)
    {
        try {
            return DB::table('user')
            ->select('user.*', 'gender_id as name', 'gender.icon as icon', 'gender.colour as colour')
            ->join('gender', 'gender_id', '=', 'gender.id')
            ->where('username', '=', $request->input('username'))
            ->where('password', '=', md5($request->input('password')))
            ->first();
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
        }
    }

    public function genderList(){
        try {
            return DB::table('gender')
                ->get();
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
        }
    }

    public function getGenderName($id)
    {
        try {
            return DB::table('gender')
                ->select('gender.name as genderName')
                ->where('id', '=', $id)
                ->first();
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
        }
    }

    public function makeNewUser(RequestRegister $request){
        try {

            $result = $this->getGenderName($request->input('gender'));
            $gender = mb_strtolower($result->genderName);

            return DB::table('user')->insert([
                'username' => $request->input('username'),
                'password' => md5($request->input('password')),
                'email' => $request->input('email'),
                'image' => $gender.'.png',
                'gender_id' => $request->input('gender'),
                'createdAt' => time(),
                'role_id' => 1
            ]);


        }
        catch(\Exception $e){
            Log::info($e->getMessage());
        }
    }

    public function getOneUser($id){
        try {
            return DB::table('user')
                ->select('user.*', 'gender_id as name', 'gender.icon as icon', 'gender.colour as colour')
                ->join('gender', 'gender_id', '=', 'gender.id')
                ->where('user.id', '=', $id)
                ->first();
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
        }
    }

    public function getSearchedUsers($key){
        try {
            return DB::table('user')
                ->where('username', 'like', $key.'%')
                ->limit(7)
                ->get();
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
        }
    }

    public function updateUser(Request $request, $id, $image){
        try{
            $forUpdate = $request->all();
            unset($forUpdate['_method']);
            unset($forUpdate['_token']);

            if($image != null)
            {
                $forUpdate['image'] = $image;
            }
            else{
                unset($forUpdate['image']);
            }

            $forUpdate['updatedAt'] = time();

            return DB::table('user')
                ->where('id', $id)
                ->update($forUpdate);

        }
        catch(\Exception $e){
            Log::info($e->getMessage());
        }
    }

    public function deleteUser($id){
        try{
            return DB::table('user')
                ->where('id','=', $id)
                ->update(['isDeleted' => 1]);
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
        }
    }

    public function reportUser($id){
        try{
            return DB::table('user')
                ->where('id','=', $id)
                ->update(['isReported' => 1]);
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
        }
    }

    public function getLastInsertedUser(){
        try {
            return DB::table('user')
                ->orderBy('id', 'DESC')
                ->first();
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
        }
    }

    public function sendStarterQuestionsToUser($starterQuestions, $lastInsertedUser){
        try{
            foreach($starterQuestions as $one) {
                DB::table('question_user')->insert([
                    'question_id' => $one->id,
                    'userTo_id' => $lastInsertedUser->id,
                    'dateSent' => time(),
                ]);
            }
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
        }
    }


}
