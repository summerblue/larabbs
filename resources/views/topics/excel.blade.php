@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Excel</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('topics.export') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="days" class="col-md-4 control-label">多少天之内的记录</label>

                            <div class="col-md-6">
                                <input id="days" type="number" class="form-control" name="days" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    导出
                                </button>
                            </div>
                        </div>
                    </form>
                    <form class="form-horizontal" method="POST" action="{{ route('topics.import') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="excel" class="col-md-4 control-label">导入话题</label>

                            <div class="col-md-6">
                                <input id="excel" type="file" class="" name="excel" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-success">
                                    导入
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection