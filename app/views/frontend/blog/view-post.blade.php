@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
{{ $post->title }} ::
@parent
@stop

{{-- Update the Meta Title --}}
@section('meta_title')

@parent
@stop

{{-- Update the Meta Description --}}
@section('meta_description')

@parent
@stop

{{-- Update the Meta Keywords --}}
@section('meta_keywords')

@parent
@stop

{{-- Page content --}}
@section('content')
<h3>{{ $post->title }}</h3>

<p>{{ $post->content() }}</p>

<div>
	<span class="badge badge-info" title="{{ $post->created_at }}">Posted {{ $post->created_at->diffForHumans() }}</span>
</div>

<hr />

<a id="comments"></a>
<h4>{{ $comments->count() }} @lang('blog.comments')</h4>

@if ($comments->count())
@foreach ($comments as $comment)
<div class="row">
	<div class="col-sm-1">
		<img class="img-thumbnail pull-left" src="{{ $comment->author->gravatar() }}" alt="">
	</div>
	<div class="col-sm-11">
				<span class="muted">{{ $comment->author->fullName() }}</span>
				&bull;
				<span title="{{ $comment->created_at }}">{{ $comment->created_at->diffForHumans() }}</span>
				<p>{{ $comment->content() }}</p>

	</div>
</div>
<hr />
@endforeach
@else
<hr />
@endif

@if ( ! Sentry::check())
You need to be logged in to add comments.<br /><br />
Click <a href="{{ route('signin') }}">here</a> to login into your account.
@else
<h4>@lang('blog.addcomment')</h4>
<form class="form-horizontal" role="form" method="post" action="{{ route('view-post', $post->slug) }}">

	<!-- CSRF Token -->
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />

	<!-- Comment -->
	<div class="form-group {{ $errors->first('comment', 'has-error') }}">
		<div class="col-sm-20">
			{{ $errors->first('comment', '<span class="help-block">:message</span>') }}
			<textarea rows="4" id="comment" name="comment" class="form-control" placeholder="Type your comment here"></textarea>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-10 col-sm-1">
		  <button type="submit" class="btn btn-default">@lang('blog.postcomment')</button>
		</div>
  	</div>

</form>
@endif
@stop
