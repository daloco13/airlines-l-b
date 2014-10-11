@extends('layout.master')

@section('content')
<div class="container">

	{{ Session::get('summary_0') }}
	{{ Session::get('summary_1') }}
	{{ Session::get('summary_2') }}
	{{ Session::get('summary_3') }}
	{{ Session::get('summary_4') }}

	
	<?php 


		$input = Session::get('input');
	?>

	{{ $input['country'] }}

	{{ var_dump($input) }}
</div>
@endsection