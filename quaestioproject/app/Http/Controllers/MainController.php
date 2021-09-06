<?php

namespace App\Http\Controllers;

use App\Models\Navigation;
use App\Models\Notifications;
use App\Models\Question;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;
use Illuminate\Contracts\Foundation\Application;


class MainController extends Controller
{
    protected $data = [];

    public function __construct()
    {
        $model = new Navigation();
        $this->data['footerLinks'] = $model->getLinks('socialNavigation');
        $this->data['additionalLinks'] = $model->getLinks('additionalLinks');
        $this->data['userMenu'] = $model->getLinks('userNavigation');



        $this->data['adminMenu'] = $model->getLinks('adminNavigation');

        $this->middleware(function ($request, $next){
            if(session()->has('user'))
            {
                if(session()->get('user')->role_id == 1) {
                    $id = session()->get('user')->id;

                    $modelN = new Notifications();
                    $notifications = $modelN->getNotificationsForLoggedUser($id);

                    $notificationNumber = count($notifications);

                    $modelQ = new Question();
                    $questions = $modelQ->getAskedQuestionsForLoggedUser($id);

                    $questionNumber = count($questions);

                    session()->put('notificationNumber', $notificationNumber);
                    session()->put('questionNumber', $questionNumber);
                }
        }

            return $next($request);

        });
    }
}
