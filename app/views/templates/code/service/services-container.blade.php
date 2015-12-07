{
	"services": [
		
		@for($i = 0; $i < count($services); $i++)
		"{{$services[$i]}}"@if($i < count($services) - 1),{{"\n"}}@endif{{"\n"}}
		@endfor
	]
}