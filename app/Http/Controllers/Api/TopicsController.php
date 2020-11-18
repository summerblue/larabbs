<?php

namespace App\Http\Controllers\Api;

use App\Http\Queries\TopicQuery;
use App\Http\Requests\Api\TopicRequest;
use App\Http\Resources\TopicResource;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;

class TopicsController extends Controller
{

    public function index(Request $request,TopicQuery $query)
    {
        $topics = $query->paginate();

        return TopicResource::collection($topics);
    }

    public function userIndex(User $user,TopicQuery $query)
    {
        $topics = $query->where('user_id',$user->id)->paginate();

        return TopicResource::collection($topics);
    }


    public function store(TopicRequest $request,Topic $topic)
    {
        $topic->fill($request->all());
        $topic->user()->associate($request->user());
        $topic->save();

        return new TopicResource($topic);
    }

    public function update(TopicRequest $request,Topic $topic)
    {
        $this->authorize('update',$topic);
        $topic->update($request->all());
        return new TopicResource($topic);
    }

    public function destroy(Topic $topic)
    {
        $this->authorize('update',$topic);

        $topic->delete();

        return response(null,204);
    }

    public function show($topicId,TopicQuery $query)
    {
        $topic = $query->findOrFail($topicId);

        return new TopicResource($topic);
    }


}
