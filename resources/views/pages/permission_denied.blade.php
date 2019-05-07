@extends('layouts.app')
@section('title', '无权限访问')

@section('content')
  <div class="col-md-4 offset-md-4">
    <div class="card ">
      <div class="card-body">
        @if (Auth::check())
          <div class="alert alert-danger text-center mb-0">
            当前登录账号无后台访问权限。
          </div>
        @else
          <div class="alert alert-danger text-center">
            请登录以后再操作
          </div>

          <a class="btn btn-lg btn-primary btn-block" href="{{ route('login') }}">
            <i class="fas fa-sign-in-alt"></i>
            登 录
          </a>
        @endif
      </div>
    </div>
  </div>
@stop
