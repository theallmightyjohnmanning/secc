{
	"commands": [
		
		@for($i = 0; $i < count($commands); $i++)
		"{{$commands[$i]}}"@if($i < count($commands) - 1),{{"\n"}}@endif{{"\n"}}
		@endfor
	]
}