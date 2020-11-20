<?php

namespace App\Http\Controllers\Api;

<<<<<<< HEAD
use App\Http\Queries\TopicQuery;
use App\Http\Requests\Api\TopicRequest;
use App\Http\Resources\TopicResource;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;

class TopicsController extends Controller
{

    public function index(Request $request,TopicQuery $query)
=======
use App\Models\User;
use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Queries\TopicQuery;
use App\Http\Resources\TopicResource;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Http\Requests\Api\TopicRequest;

class TopicsController extends Controller
{
    public function index(Request $request, TopicQuery $query)
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
    {
        $topics = $query->paginate();

        return TopicResource::collection($topics);
    }

<<<<<<< HEAD
    public function userIndex(User $user,TopicQuery $query)
    {
        $topics = $query->where('user_id',$user->id)->paginate();
=======
    public function userIndex(Request $request, User $user, TopicQuery $query)
    {
        $topics = $query->where('user_id', $user->id)->paginate();
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531

        return TopicResource::collection($topics);
    }

<<<<<<< HEAD

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


=======
    public function show($topicId, TopicQuery $query)
    {
        $topic = $query->findOrFail($topicId);
        return new TopicResource($topic);
    }

    public function store(TopicRequest $request, Topic $topic)
    {
        $topic->fill($request->all());
        $topic->user_id = $request->user()->id;
        $topic->save();

        return new TopicResource($topic);
    }

    public function update(TopicRequest $request, Topic $topic)
	{
		$this->authorize('update', $topic);

		$topic->update($request->all());
		return new TopicResource($topic);
	}

    public function destroy(Topic $topic)
	{
		$this->authorize('destroy', $topic);

		$topic->delete();

        return response(null, 204);
	}
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
}
