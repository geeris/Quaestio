<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestLogin;
use App\Models\Answer;
use App\Models\Question;
use http\QueryString;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Navigation;
use PhpParser\Node\Expr\Array_;
use Psy\Util\Json;
use function PHPUnit\Framework\isEmpty;

class HomeController extends MainController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if(session()->has('user'))
        {
            if(session()->get('user')->role_id==1)
            {
                $model = new Question();
                $resultWithoutUserFrom = $model->getAnsweredQuestionsForAllUsers();

                $this->data['answeredQuestionsOfAllUsers'] = $model->getAnsweredQuestionsForAllUsers();
                $this->data['userFrom'] = $model->makeUserFromArray($resultWithoutUserFrom);

                return view('pages.user.homeUser', $this->data);
            }
            else if(session()->get('user')->role_id==2)
            {
                $model = new User();
                $this->data['users'] = $model->getAllUsers();
                return view('pages.admin.users', $this->data);
            }
        }
        else{
            return view('pages.homeDefault', $this->data);
        }
    }

    public function logUser(RequestLogin $request){
        $model = new User();
        $result = $model->getUserToLogin($request);

        if($result == null)
        {
            session()->put('message', 'An error has occured, try again later.');
            return redirect()->route('home');
        }
        else{
            $request->session()->put('user', $result);
            return redirect()->route('home');
        }
    }

    public function logout(Request $request){
        $request->session()->invalidate();
        return redirect()->route('home');
    }

    public function reportUser(Request $request, $id)
    {
        $model = new User();
        $model->reportUser($id);
        return redirect()->back();
    }

    public function userQuestions()
    {
        $loggedUser = session()->get('user')->id;
//        dd($loggedUser);
        $model = new Question();
        $result = $model->getAskedQuestionsForLoggedUser($loggedUser);
        $this->data['askedQuestions'] = $result;

        $this->data['userFrom'] = $model->makeUserFromArray($result);

        return view('pages.user.userQuestions', $this->data);
    }

    public function answerOnQuestion($question_id, $userTo_id, $userFrom = null){
        $model = new Question();
        $result = $model->getOneQuestion($question_id, $userTo_id);
        $this->data['oneQuestion'] = $result;
        $this->data['userFrom'] = $userFrom;
        return view('pages.user.answerOnQuestion', $this->data);
    }

    public function answerOnQuestionInsert(Request $request, $question_id, $userTo_id)
    {
        $modelQ = new Question();
        $modelA = new Answer();

        $result = $modelA->makeAnAnswer($request->input('answer'));

        if($result)
        $answer = $modelA->getLastInsertedAnswer();

        $result1 = $modelQ->answerOnQuestion($question_id, $userTo_id, $answer);

        if($result1)
            return redirect()->route('userQuestions');
    }

    public function deleteAnswer($id){
        $model = new Answer();
        $result = $model->deleteAnswerInstance($id);

        if($result)
        {
            $result1 = $model->deleteAnswer($id);
        }

        if($result1)
            return Json::encode(['result' => $result1]);
    }

    public function author(){
        return view('pages.author', $this->data);
    }

    public function goBack(){
        return redirect()->route('home');
    }

    public function sendQuestion(Request $request, $userFrom_id, $userTo_id){
        $modelQ = new Question();
        $result = $modelQ->makeNewQuestion($request->input('question'));

        if($result)
            $question = $modelQ->getLastInsertedQuestion();

        $result1 = $modelQ->sendQuestionToUser($question, $userFrom_id, $userTo_id);

        return redirect()->back();
    }

    public function getUsers($key){
        if(null)
            return [1,2,3];
        $model = new User();
        $result = $model->getSearchedUsers($key);
        return Json::encode($result);
//        response()->json($result);
    }

//    public function changeRoles($role_id, $user_id){
//        return [$role_id, $user_id];
//    }
}
