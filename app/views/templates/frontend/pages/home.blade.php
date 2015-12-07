@extends('templates.frontend.main') 
@section('title')Home @stop 
@section('content') 
<h1><i style="color:#aa0000;">SECC MVC</i></h1>
@if(isset($name))
{{$name}}
@endif
@stop