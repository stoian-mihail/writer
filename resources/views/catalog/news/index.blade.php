@extends('layouts.blog')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-9">
            @foreach ($news as $item)
            <article>
              <a href="{{route('catalog.news.show', $item)}}"> {{$item->title}}</a>

            </article>
            <hr>
            @endforeach

        </div>
        <div class="col-3">
            <aside>
                @include('sidebar')
            </aside>
        </div>
    </div>

</div>

@endsection
