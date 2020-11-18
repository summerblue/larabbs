<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TopicRequest;
use App\Http\Resources\TopicResource;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class TopicsController extends Controller
{

    public function index(Request $request,Topic $topic)
    {
        $topics = QueryBuilder::for(Topic::class)
            ->allowedIncludes('user','category')
            ->allowedFilters([
                'title',
                AllowedFilter::exact('category_id'),
                AllowedFilter::scope('withOrder')->default('recentReplied'),
            ])
            ->paginate();
        return TopicResource::collection($topics);
    }

    public function userIndex(User $user)
    {
        $query = $user->topics()->getQuery();

        $topics = QueryBuilder::for($query)
            ->allowedIncludes('user','category')
            ->allowedFilters([
                'title',
                AllowedFilter::exact('category_id'),
                AllowedFilter::scope('withOrder')->default('recentReplied'),
            ])
            ->paginate();

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


}
