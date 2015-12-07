{
	"accessors": [
		
		@for($i = 0; $i < count($accessors); $i++)
		"{{$accessors[$i]}}"@if($i < count($accessors) - 1),{{"\n"}}@endif{{"\n"}}
		@endfor
	]
}