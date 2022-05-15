@extends('layouts.blog')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-9">
            <article>
                {!! $news->text !!}

            </article>
        </div>
        <div class="col-3">
            <aside>
                @include('sidebar')
            </aside>
        </div>
    </div>

</div>
@endsection('content')
