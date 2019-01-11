<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use App\Models\Category;
use Auth;
use App\Handlers\ImageUploadHandler;
use App\Models\User;
use App\Models\Link;
use PDF;
use SnappyImage;
use Excel;
use App\Exports\TopicsExport;
use App\Imports\TopicsImport;
use App\ViewModels\TopicViewModel;

class TopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show', 'pdf', 'image']]);
    }

    public function pdf(Topic $topic)
    {
        if (app()->isLocal()) {
            config(['sudosu.enable' => false]);
        }

        return PDF::loadView('topics.show', compact('topic'))->inline('topics-'.$topic->id.'.pdf');
    }

    public function image(Topic $topic)
    {
        if (app()->isLocal()) {
            config(['sudosu.enable' => false]);
        }

        return SnappyImage::loadView('topics.show', compact('topic'))
            ->setOption('width', 595)
            ->setOption('format', 'png')
            ->inline('topics-'.$topic->id.'.png');
    }

	public function index(Request $request)
    {
        $viewModel = new TopicViewModel($request->order);
        return view('topics.index', $viewModel);
    }

    public function show(Request $request, Topic $topic)
    {
        // URL 矫正
        if ( ! empty($topic->slug) && $topic->slug != $request->slug) {
            return redirect($topic->link(), 301);
        }

        $topic->visits()->increment();

        logger('referer =====>');
        logger($topic->visits()->refs());
        logger('<====== referer');

        logger('countries =====>');
        logger($topic->visits()->countries());
        logger('<====== countries');

        return view('topics.show', compact('topic'));
    }

    public function create(Topic $topic)
    {
        $categories = Category::all();
        return view('topics.create_and_edit', compact('topic', 'categories'));
    }

    public function store(TopicRequest $request, Topic $topic)
    {
        $topic->fill($request->all());
        $topic->user_id = Auth::id();
        $topic->save();

        return redirect()->to($topic->link())->with('success', '成功创建主题！');
    }

	public function edit(Topic $topic)
    {
        $this->authorize('update', $topic);
        $categories = Category::all();
        return view('topics.create_and_edit', compact('topic', 'categories'));
    }

	public function update(TopicRequest $request, Topic $topic)
	{
		$this->authorize('update', $topic);
		$topic->update($request->all());

		return redirect()->to($topic->link())->with('success', '更新成功！');
	}

	public function destroy(Topic $topic)
	{
		$this->authorize('destroy', $topic);
		$topic->delete();

		return redirect()->route('topics.index')->with('success', '成功删除！');
	}

    public function uploadImage(Request $request, ImageUploadHandler $uploader)
    {
        // 初始化返回数据，默认是失败的
        $data = [
            'success'   => false,
            'msg'       => '上传失败!',
            'file_path' => ''
        ];
        // 判断是否有上传文件，并赋值给 $file
        if ($file = $request->upload_file) {
            // 保存图片到本地
            $result = $uploader->save($request->upload_file, 'topics', \Auth::id(), 1024);
            // 图片保存成功的话
            if ($result) {
                $data['file_path'] = $result['path'];
                $data['msg']       = "上传成功!";
                $data['success']   = true;
            }
        }
        return $data;
    }

    public function excel()
    {
        return view('topics.excel');
    }

    public function export(Request $request, TopicsExport $topicsExport)
    {
        return $topicsExport->withinDays($request->days);
    }

    public function import(Request $request, TopicsImport $topicsImport)
    {
        $topicsImport->import($request->file('excel'));
        return back()->with('success', '导入成功');
    }
}
