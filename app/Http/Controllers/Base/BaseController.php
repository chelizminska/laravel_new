<?php
namespace App\Http\Controllers\Base;

use App\Fish;
use App\ForumPageMessage;
use App\Page;
use App\PersonalMessage;
use App\Topic;
use App\User;
use App\News;
use Validator;
use Faker\Provider\DateTime;
use Hamcrest\Type\IsInteger;
use Illuminate\Support\Facades\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class BaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function indexAction()
    {
        //$page = Page::where('title', '=', 'Главная')->get();
        $news = News::latest('created_at')->take(5)->get();
        return view('base.home', ['news' => $news]);
    }

    public function showNewsAction()
    {
        if (! Request::has('page_number')){
            $page_number = 1;
        }
        else{
            $page_number = Request::input('page_number');
        }
        $news = News::latest('created_at')->skip(($page_number - 1) * 5)->take(5)->get();
        $news_amount = count(News::all());
        return view('base.news', ['news' => $news, 'page_number' => $page_number, 'news_amount' => $news_amount]);
    }

    public function viewNewsAction()
    {
        if (Request::has('id')){
            $news = News::where('id', '=', Request::input('id'))->first();
            return view('base.view_news', ['news' => $news]);
        }
    }

    public function showFishesAction()
    {
        $fishes = Fish::orderBy('title')->get();
        return view('base.fishes', ['fishes' => $fishes]);
    }

    public function showFishInfoAction($id)
    {
        $fish = Fish::where('id', '=', $id)->first();
        return view('base.fish_info', ['fish' => $fish]);
    }

    public function showAboutAction()
    {
        $page = Page::where('title', '=', 'О клубе')->get();
        return view('base.about', ['page' => $page[0]]);
    }

    public function showContactsAction()
    {
        $page = Page::where('title', '=', 'Контакты')->get();
        return view('base.contacts', ['page' => $page[0]]);
    }

    public function showForumAction()
    {
        if (Request::has('id')) {
            if (!Request::has('page_number')) {
                $page_number = 1;
            }
            else {
                $page_number = Request::get('page_number');
            }
            $parent = Page::where('id', '=', Request::input('id'))->first();
            if ($parent->is_sheet){
                $messages = ForumPageMessage::where('page_id', '=', $parent->id)
                    ->take(3)->skip(($page_number - 1) * 3)->get();
                $users = User::all();
                $page_title = $parent->title;
                $messages_count = ForumPageMessage::where('page_id', '=', $parent->id)->count();
                return view('base.forum_page', ['messages' => $messages,
                    'page_id' => Request::input('id'),
                    'users' => $users,
                    'page_title' => $page_title,
                    'page_number' => $page_number,
                    'messages_count' => $messages_count,
                ]);
            }
            $childs = Page::where('parent_id', '=', $parent->id)->get();
        }
        else{
            $parent = Page::where('title', '=', 'Форум')->first();
            $childs = Page::where('parent_id', '=', $parent->id)->get();
        }
        $child_messages = null;
        foreach($childs as $child){
            if ($child->is_sheet)
                $child_messages[] = ForumPageMessage::where('page_id', '=', $child->id)->get();
        }
        return view('base.forum', ['topics' => $childs, 'parent_page' => $parent, 'page_messages' => $child_messages]);
    }

    public function addForumMessageAction()
    {
        ForumPageMessage::create(array(
            'page_title' => Input::get('title'),
            'content' => Input::get('message_content'),
            'page_id' => Input::get('page_id'),
            'user' => Input::get('user'),
        ));
        $user = User::where('user_name', '=', Input::get('user'))->first();
        $user->messages_amount++;
        $user->save();
        return redirect('/forum?id='.Input::get('page_id').'&page_number='.Input::get('page_number'));
    }

    public function getAddForumTopicAction()
    {
        $parentPage = Page::where('id', '=', Request::input('id'))->first();
        return view('base.add_forum_topic', ['parent_page' => $parentPage]);
    }

    public function postAddForumTopicAction()
    {
        $user = Auth::user();
        Page::create(array(
            'title' => Input::get('title'),
            'parent_id' => Input::get('parent_page_id'),
        ));
        $page_id = Page::max('id');
        ForumPageMessage::create(array(
            'page_title' => Input::get('title'),
            'content' => Input::get('content'),
            'page_id' => $page_id,
            'user' => $user->user_name,
        ));
        $parent_page = Page::where('id', '=', Input::get('parent_page_id'))->first();
        $parent_page->child_amount++;
        $parent_page->save();
        return redirect('/forum?id='.$page_id.'&page_number=1');
    }

    public function showPersonalInfoAction()
    {
        $user = Auth::user();
        if($_GET['user_id'] == Auth::user()->id){
            return view('base.personal_info', ['user' => $user]);
        }
        else{
            abort(404);
        }
    }

    public function getChangePersonalInfoAction()
    {
        $user = Auth::user();
        if($_GET['user_id'] == Auth::user()->id){
            return view('base.personal_info_change', ['user' => $user]);
        }
        else{
            abort(404);
        }
    }

    public function postChangePersonalInfoUsernameAction()
    {
        $user = Auth::user();
        if($_GET['user_id'] == Auth::user()->id){
            $rules = array(
                'user_name' => 'required',
            );
            $validator = Validator::make(Input::all(), $rules);
            if($validator->fails()){
                return redirect()->back()->withErrors(array("Введите новое имя пользователя!"));
            }
            $user->user_name = Input::get('user_name');
            $user->save();
            return redirect('/personal_info?user_id='.$user->id);
        }
        else{
            abort(404);
        }
    }

    public function postChangePersonalInfoPasswordAction()
    {
        $user = Auth::user();
        if($_GET['user_id'] == Auth::user()->id){
            $new_password = Input::get('new_password');
            $new_password_confirmation = Input::get('new_password_confirmation');
            $rules = array(
                'pre_password' => 'required',
                'new_password' => 'required',
                'new_password_confirmation' => 'required',
            );
            $validator = Validator::make(Input::all(), $rules);
            if($validator->fails()){
                return redirect()->back()->withErrors(array("Не все поля были заполнены."));
            }
            if (password_hash(Input::get('pre_password'), PASSWORD_DEFAULT) != Auth::user()->password) {
                return redirect()->back()->withErrors(array("Некорректный старый пароль."));
            }
            if($new_password != $new_password_confirmation){
                return redirect()->back()->withErrors(array("Введенные пароли не совпадают."));
            }
            $user->password = password_hash(Input::get('pre_password'), PASSWORD_DEFAULT);
            $user->save();
            return redirect()->back()->withInput(array("Изменения прошли успешно!"));
        }
        else{
            abort(404);
        }
    }

    public function showUserInfoAction()
    {
        $dest_user = User::where('id', '=', $_GET['id'])->first();
        return view('base.user_info', ['dest_user' => $dest_user]);
    }

    public function getSendUserMessageAction()
    {
        if (isset($_GET['id'])){
            $dest_user = User::where('id', '=', $_GET['id'])->first();
            return view('base.send_personal_message', ['dest_user' => $dest_user]);
        }
        else{
            return view('base.send_personal_message');
        }
    }

    public function postSendUserMessageAction()
    {
        $destination_user = User::where('user_name', '=', Input::get('dest_user_name'))->first();
        $source_user = Auth::user();
        if (isset($destination_user)){
            PersonalMessage::create(array(
                'source_user' => $source_user->user_name,
                'destination_user' => $destination_user->user_name,
                'content' => Input::get('content'),
            ));
            return redirect('/');
        }
        else{
            return redirect('/send_message_to_user')->withErrors(array("Пользователя с таким именем не существует."));
        }
    }

    public function showPersonalMessagesAction()
    {
        $messages = PersonalMessage::latest()->where('destination_user', '=', Auth::user()->user_name)->get();
        return view('base.personal_messages', ['messages' => $messages]);
    }

    public function viewPersonalMessageAction()
    {
        $message = PersonalMessage::where('id', '=', $_GET['id'])->first();
        $message->is_viewed = true;
        $message->save();
        return view('base.view_personal_message', ['message' => $message]);
    }

}


