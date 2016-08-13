@extends('layouts.app')

@section('sidebarcontent')
	<h2>My Content</h2>
		<ul>
		@foreach ($subjects as $subject)
			<li><a href="subjects/{{ $subject->id }}">{{ $subject->name }}</a></li>
		@endforeach
		</ul>
@endsection
