@use(SECC\App)
@extends('templates.frontend.main') 
@section('title') @stop 
@section('content') 
<form action="" method="post">
	<input type="text" id="name" name="name" placeholder="Enter Your Name" />
	
	<input type="submit" value="Submit" />
</form>
@stop