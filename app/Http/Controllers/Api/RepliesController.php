<?php

namespace App\Http\Controllers\Api;

<<<<<<< HEAD
use App\Http\Queries\ReplyQuery;
use App\Http\Requests\Api\ReplyRequest;
use App\Http\Resources\ReplyResource;
use App\Models\Reply;
use App\Models\Topic;
use Illuminate\Http\Request;

class RepliesController extends Controller
{
    public function index($topicId,ReplyQuery $query)
    {
        $replies = $query->where('topic_id',$topicId)->paginate();
=======
use App\Models\Topic;
use App\Models\Reply;
use Illuminate\Http\Request;
use App\Http\Queries\ReplyQuery;
use App\Http\Resources\ReplyResource;
use App\Http\Requests\Api\ReplyRequest;

class RepliesController extends Controller
{
    public function index($topicId, ReplyQuery $query)
    {
        $replies = $query->where('topic_id', $topicId)->paginate();
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531

        return ReplyResource::collection($replies);
    }

<<<<<<< HEAD
    public function userIndex($userId,ReplyQuery $query)
    {
        $replies = $query->where('user_id',$userId)->paginate();
=======
    public function userIndex($userId, ReplyQuery $query)
    {
        $replies = $query->where('user_id', $userId)->paginate();
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531

        return ReplyResource::collection($replies);
    }

<<<<<<< HEAD
    public function store(Topic $topic,ReplyRequest $request,Reply $reply)
    {
        $reply->content = $request->input('content');
        $reply->topic()->associate($topic);
        $reply->user()->associate($request->user());

        $reply->save();
        return new ReplyResource($reply);
    }

    public function destroy(Topic $topic,Reply $reply)
    {
        if($reply->topic_id != $topic->id){
            abort(404);
        }

        $this->authorize('destroy',$reply);
        $reply->delete();

        return response(null,204);
    }


=======
    public function store(ReplyRequest $request, Topic $topic, Reply $reply)
    {
        $reply->content = $request->content;
        $reply->topic()->associate($topic);
        $reply->user()->associate($request->user());
        $reply->save();

        return new ReplyResource($reply);
    }

    public function destroy(Topic $topic, Reply $reply)
    {
        if ($reply->topic_id != $topic->id) {
            abort(404);
        }

        $this->authorize('destroy', $reply);
        $reply->delete();

        return response(null, 204);
    }
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
}
