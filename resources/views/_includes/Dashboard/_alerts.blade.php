
@if(Session::has('success'))
	<div class="row mr-2 ml-2">
		<button class="btn btn-lg btn-block btn-outline-success" id="type-error">
			{{Session::get('error')}}
		</button>
	</div>
@endif

@if(Session::has('error'))
	<div class="row mr-2 ml-2">
		<button class="btn btn-lg btn-block btn-outline-danger mb-2" id="type-error">
			{{Session::get('error')}}
		</button>
	</div>
@endif