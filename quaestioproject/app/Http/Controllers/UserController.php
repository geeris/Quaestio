<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestRegister;
use App\Models\Question;
use App\Models\Role;
use App\Models\StarterQuestion;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserController extends MainController
{
    private $model;
    private $message;
    public function __construct()
    {
        parent::__construct();
        $this->model = new User();
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $this->data['users'] = $this->model->getAllUsers();
        return view('pages.admin.users', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $this->data['genderList'] = $this->model->genderList();
        return view('pages.register', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(RequestRegister $request)
    {
        $result = $this->model->makeNewUser($request);

        if($result)
        {
            $this->message = 'Your account has been made successfully!';

            $model = new StarterQuestion();
            $starterQuestions = $model->getAllStarterQuestions();

            $lastInsertedUser = $this->model->getLastInsertedUser();

            $this->model->sendStarterQuestionsToUser($starterQuestions, $lastInsertedUser);
        }
        else{
            $this->message = 'Username or password may be incorrect.';
        }
        session()->put('message', $this->message);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     */
    public function show($id)
    {
        $this->data['profile'] = $this->model->getOneUser($id);

        $modelQ = new Question();
        $resultWithoutUserFrom = $modelQ->getAnsweredQuestionsForLoggedUser($id);

        $this->data['answeredQuestionsOfUser'] = $modelQ->getAnsweredQuestionsForLoggedUser($id);
        $this->data['userFrom'] = $modelQ->makeUserFromArray($resultWithoutUserFrom);

        return view('pages.user.profile', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit($id)
    {
        $result = $this->model->getOneUser($id);
        $this->data['profile'] = $result;
        $this->data['genderList'] = $this->model->genderList();
        return view('pages.user.profileEdit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, $id)
    {
        try{
            $result=true;

            if($request->file('image')) {
                $image = $request->file('image');

                $uniqueImageName = uniqid() . time() . '.' . $image->extension();

                $image->storeAs('public/products', $uniqueImageName);

                $result = $this->model->updateUser($request, $id, $uniqueImageName);
            }
            else{
                $result = $this->model->updateUser($request, $id, null);
            }

            if($result)
            {
                $this->message = 'Profile changes have been saved.';
            }
            else{
                $this->message = 'Something has gone wrong with saving data.';
            }
            session()->put('message', $this->message);

            return redirect()->back();
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy($id)
    {
        $this->model->deleteUser($id);
        return redirect()->back();
    }
}
