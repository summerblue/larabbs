<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReplyRequest;
use Auth;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(ReplyRequest $request, Reply $reply)
    {
        $reply->content = $request->content;
        $reply->user_id = Auth::id();
        $reply->topic_id = $request->topic_id;
        $reply->save();

        activity('reply')->performedOn($reply)->log(':causer.name 添加了一条回复: :subject.content');

        return redirect()->to($reply->topic->link())->with('success', '回复创建成功！');
    }

    public function destroy(Reply $reply)
    {
        $this->authorize('destroy', $reply);
        $reply->delete();

        activity('reply')->performedOn($reply)->log(':causer.name 删除了一条回复: :subject.content');

        return redirect()->to($reply->topic->link())->with('success', '成功删除回复！');
    }
}
