<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TopicRequest;
use App\Http\Resources\TopicResource;
use App\Models\Topic;
use Illuminate\Http\Request;

class TopicsController extends Controller
{
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
