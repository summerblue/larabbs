<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\TopicRequest;
use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Resources\TopicResource;

class TopicsController extends Controller
{
    /*
     * 发布话题
     */
    public function store(TopicRequest $request,Topic $topic){
        $topic->fill($request->all());
        $topic->user_id = $request->user()->id;
        $topic->save();
        return new TopicResource($topic);
    }

    /*
     * 编辑话题
     */
    public function update(TopicRequest $request,Topic $topic){
        $this->authorize('update',$topic);
        $topic->update($request->all());
        return new TopicResource($topic);
    }

    /*
     * 删除话题
     */
    public function destroy(Topic $topic){
        $this->authorize('destroy',$topic);
        $topic->delete();
        return response(null,204);
    }
}
