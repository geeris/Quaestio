<?php

namespace App\Http\Controllers;

use App\Http\Requests\StarterQuestionRequest;
use App\Models\StarterQuestion;
use Illuminate\Http\Request;

class StarterQuestionController extends MainController
{
    private $model;
    private $message;

    public function __construct()
    {
        parent::__construct();
        $this->model = new StarterQuestion();
    }

    public function index()
    {
        $this->data['starterQuestions'] = $this->model->getAllStarterQuestions();
        return view('pages.admin.starterQuestions', $this->data);
    }

    public function create()
    {
        //
    }

    public function store(StarterQuestionRequest $request)
    {
        $this->model->addStarterQuestion($request);
        return redirect()->back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $question = $this->model->getOneQuestion($id);
        $this->data['question'] = $question;
        return view('pages.admin.editStarterQuestion', $this->data);
    }

    public function update(StarterQuestionRequest $request, $id)
    {
        $result = $this->model->updateStarterQuestion($request, $id);

        if($result)
        {
            $this->message = 'Question is saved.';
        }
        else{
            $this->message = 'Something has gone wrong with saving data.';
        }
        session()->put('message', $this->message);

        return redirect()->back();
    }

    public function destroy($id)
    {
        $this->model->deleteStarterQuestion($id);
        return redirect()->back();
    }
}
