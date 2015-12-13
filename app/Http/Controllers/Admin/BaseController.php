<?php

namespace App\Http\Controllers\Admin;

use App\ForumPage;
use App\Page;
use App\User;
use App\Fish;
use App\News;
use App\ForumPageMessage;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;

class BaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function indexAction()
    {
        return view('admin.home');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|string
     */

    public function showContentManagementAction()
    {
        return view('admin.contents');
    }

    public function getEditHomeAction()
    {
        $page = Page::where('title', '=', 'Главная')->first();
        return view('admin.editing_home', ['page' => $page]);
    }

    public function postEditHomeAction()
    {
        $page = Page::where('title', '=', 'Главная')->first();
        $page->content = Input::get('content');
        $page->save();
        return redirect('admin/contents');
    }

    public function showFishesAction()
    {
        $fishes = Fish::all();
        return view('admin.show_fishes', ['fishes' => $fishes]);
    }

    public function getAddFishAction()
    {
        return view('admin.adding_fish');
    }

    public function postAddFishAction()
    {
        Fish::create(array(
            'title' => Input::get('title'),
            'content' => Input::get('content'),
        ));
        return redirect('/admin/contents/fishes');
    }

    public function getEditFishAction()
    {
        if (isset($_GET['id'])){
            $fish = Fish::where('id', '=', $_GET['id'])->first();
            return view('admin.editing_fish', ['fish' => $fish]);
        }
        else{
            abort(404);
        }

    }

    public function postEditFishAction()
    {
        $fish = Fish::where('id', '=', Input::get('id'))->first();
        $fish->title = Input::get('title');
        $fish->content = Input::get('content');
        $fish->save();
        return redirect('/admin/contents/fishes');
    }

    public function deleteFishAction()
    {
        $id = Request::input('id');
        Fish::destroy($id);
        return redirect('/admin/contents/fishes');
    }

    public function getEditAboutAction()
    {
        $page = Page::where('title', '=', 'О клубе')->first();
        return view('admin.editing_about', ['page' => $page]);
    }

    public function postEditAboutAction()
    {
        $page = Page::where('title', '=', 'О клубе')->first();
        $page->content = Input::get('content');
        $page->save();
        return redirect('admin/contents');
    }

    public function getEditContactsAction()
    {
        $page = Page::where('title', '=', 'Контакты')->first();
        return view('admin.editing_contacts', ['page' => $page]);
    }

    public function postEditContactsAction()
    {
        $page = Page::where('title', '=', 'Контакты')->first();
        $page->content = Input::get('content');
        $page->save();
        return redirect('admin/contents');
    }

    public function showForumAction($id = null, $page_number = 1)
    {
        if(isset($id)){
            $parent = Page::where('id', '=', $id)->first();
            if ($parent->is_sheet){
                return redirect('/admin/contents/forum/'.$id.'/edit');
            }
            $childs = Page::where('parent_id', '=', $id)->get();
        }
        else{
            $parent = Page::where('title', '=', 'Форум')->first();
            $childs = Page::where('parent_id', '=', $parent->id)->get();
        }
        $messages_count = ForumPageMessage::all()->count();
        if (isset($_GET['page_number'])){
            $page_number = $_GET['page_number'];
        }
        $messages = ForumPageMessage::latest('created_at')->take(10)->skip(($page_number - 1) * 10)->get();
        return view('admin.show_forum', ['parent' => $parent,
                                                'childs' => $childs,
                                                'messages' => $messages,
                                                'page_number' => $page_number, 'messages_count' => $messages_count]);
    }

    public function getEditForumAction($id)
    {
        $messages = ForumPageMessage::where('page_id', '=', $id)->get();
        $users = User::all();
        return view('admin.editing_forum', ['messages' => $messages, 'users' => $users, 'page_id' => $id]);
    }

    public function postEditForumAction($id)
    {
        $page = Page::where('id', '=', $id)->first();
        $page->title = Input::get('title');
        $page->content = Input::get('content');
        $page->save();
        return redirect('admin/contents');
    }

    public function getAddForumNewTopicAction($id)
    {
        $parentPage = Page::where('id', '=', $id)->first();
        return view('admin.add_forum_topic', ['parent_page' => $parentPage]);
    }

    public function postAddForumNewTopicAction()
    {
        $user = Auth::getUser();
        Page::create(array(
            'title' => Input::get('title'),
            'parent_id' => Input::get('parent_page_id'),
            'is_sheet' => false,
            'is_protected' => false,
        ));
      /*  ForumPageMessage::create(array(
            'page_title' => Input::get('title'),
            'content' => Input::get('content'),
            'page_id' => Input::get('parent_page_id'),
            'user' => $user->name,
        ));*/
        return redirect('/admin/contents');
    }

    public function deleteForumTopicAction($page_id)
    {
        $page = Page::where('id', '=', $page_id)->first();
        if($page->is_sheet){
            $messages = ForumPageMessage::where('page_id', '=', $page->id)->get();
            foreach($messages as $message)
            {
                ForumPageMessage::destroy($message->id);
            }
        }
        else{
            $child_pages = Page::where('parent_id', '=', $page->id)->get();
            foreach($child_pages as $child_page)
            {
                $messages = ForumPageMessage::where('page_id', '=', $child_page->id);
                foreach($messages as $message)
                {
                    ForumPageMessage::destroy($message->id);
                }
                Page::destroy($child_page->id);
            }
        }
        Page::destroy($page->id);
        return redirect('/admin/contents/forum/'.$page->parent_id);
    }

    public function deleteForumTopicMessageAction()
    {
        $message_id = Input::get('message_id');
        $page_id = Input::get('page_id');
        ForumPageMessage::destroy($message_id);
        return redirect('/admin/contents/forum/'.$page_id.'/edit');
    }

    public function getAddNewsAction()
    {
        return view('admin.add_news');
    }

    public function postAddNewsAction()
    {
        News::create(array(
            'title' => Input::get('title'),
            'description' => Input::get('description'),
            'content' => Input::get('content'),
            'is_imported' => false,
        ));
        return redirect('admin/contents/news');
    }

    public function showNewsAction()
    {
        if (!isset($_GET['page_number'])){
            $page_number = 1;
        }
        else{
            $page_number = $_GET['page_number'];
        }
        $news = News::latest('created_at')->skip(($page_number - 1) * 5)->take(5)->get();
        $news_count = News::count();
        return view('admin.show_news', ['news' => $news, 'page_number' => $page_number, 'news_count' => $news_count]);
    }

    public function getEditNewsAction()
    {
        $news = News::where('id', '=', $_GET['id'])->first();
        return view('admin.edit_news', ['news' => $news]);
    }

    public function postEditNewsAction()
    {
        $news = News::where('id', '=', Input::get('id'))->first();
        $news->title = Input::get('title');
        $news->content = Input::get('content');
        $news->save();
        return redirect('admin/contents/news');
    }

    public function deleteNewsAction()
    {
        $news = News::where('id', '=', Input::get('id'))->first();
        $news->delete();
        return redirect('admin/contents/news');
    }

    public function updateNewsAction()
    {
        News::where('is_imported', '=', '1')->delete();
        $url = "http://rybaksverdlovsk.at.ua/news/rss/";
        $rss = simplexml_load_file($url);
        foreach ($rss->channel->item as $item) {
            $namespaces = $item->getNameSpaces(true);
            News::create(array(
                'title' => $item->title,
                'description' => $item->description,
                'content' => $item->children($namespaces['content'])->encoded,
                'created_at' => strtotime($item->pubDate),
            ));
        }
        return redirect()->back();
    }

    public function showUsersManagementAction()
    {
        $users = User::where('isAdmin', '=', false)->get();
        return view('admin.users_management', ['users' => $users]);
    }

    public function showUserInfoAction($id)
    {
        $user = User::where('id', '=', $id)->first();
        $messages = ForumPageMessage::where('user', '=', $user->user_name)->get();
        return view('admin.show_user', ['user' => $user, 'messages' => $messages]);
    }

    public function giveWarningAction($id)
    {
        $user = User::where('id', '=', $id)->first();
        $user->banning_points += Input::get('points');
        $user->save();
        return redirect('/admin/users/'.$user->id);
    }

    public function giveAdminRightsAction($id)
    {
        $user = User::where('id', '=', $id)->first();
        $user->isAdmin = true;
        $user->save();
        return redirect('/admin/users/'.$user->id);
    }
}
