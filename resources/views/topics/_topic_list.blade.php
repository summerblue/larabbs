@if (count($topics))
  <ul class="list-unstyled">
    @foreach ($topics as $topic)
      <li class="d-flex">
        <div class="">
          <a href="{{ route('users.show', [$topic->user_id]) }}">
            <img class="media-object img-thumbnail mr-3" style="width: 52px; height: 52px;" src="{{ $topic->user->avatar }}" title="{{ $topic->user->name }}">
          </a>
        </div>

        <div class="flex-grow-1 ms-2">

          <div class="mt-0 mb-1">
            <a href="{{ route('topics.show', [$topic->id]) }}" title="{{ $topic->title }}">
              {{ $topic->title }}
            </a>
            <a class="float-end" href="{{ route('topics.show', [$topic->id]) }}">
              <span class="badge bg-secondary rounded-pill"> {{ $topic->reply_count }} </span>
            </a>
          </div>

          <small class="media-body meta text-secondary">

            <a class="text-secondary" href="#" title="{{ $topic->category->name }}">
              <i class="far fa-folder"></i>
              {{ $topic->category->name }}
            </a>

            <span> • </span>
            <a class="text-secondary" href="{{ route('users.show', [$topic->user_id]) }}" title="{{ $topic->user->name }}">
              <i class="far fa-user"></i>
              {{ $topic->user->name }}
            </a>
            <span> • </span>
            <i class="far fa-clock"></i>
            <span class="timeago" title="最后活跃于：{{ $topic->updated_at }}">{{ $topic->updated_at->diffForHumans() }}</span>
          </small>

        </div>
      </li>

      @if ( ! $loop->last)
        <hr>
      @endif

    @endforeach
  </ul>

@else
  <div class="empty-block">暂无数据 ~_~ </div>
@endif
