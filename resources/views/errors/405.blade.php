@extends('errors::error')

@section('message')

<div class="_404">
		<div class="main">
			<div class="_text">
				405
			</div>
			<div class="notFound">
				Data Not Found
			</div>
			<div class="_backToHome">
				<a href="{{ url('/') }}">
					Back To Home
				</a>
			</div>
		</div>
	</div>
@endsection
