@extends('layouts.app')

@section('title', 'chumper/zipper 扩展示例')

@section('content')

<div class="row">
    <form class="form-inline pull-right" method="POST" action="{{ route('zip.upload') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <input type="file" name="logs" style="width:170px" required>
        </div>
        <button type="submit" class="btn btn-default">导入</button>
    </form>
    <form method="POST" action="{{ route('zip.download') }}">
        {{ csrf_field() }}
        <button class="btn btn-default" type="submit">批量下载</button>
        <table class="table table-striped">
            <thead>
            <tr>
                <th></th>
                <th>文件名</th>
                <th>创建时间</th>
                <th>最后修改时间</th>
            </tr>
            </thead>
            <tbody>
                @foreach($logs as $log)
                <tr>
                  <th scope="row"><input type="checkbox" name="logs[]" value="{{ $log->getBasename() }}"></th>
                  <td>{{ $log->getBasename() }}</td>
                  <td>{{ Date('Y-m-d H:i:s', $log->getCtime()) }}</td>
                  <td>{{ Date('Y-m-d H:i:s', $log->getMtime()) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </form>
</div>
@endsection