{{--@if(count($errors) > 0)--}}
	{{--@foreach($errors->all() as $error)--}}
		{{--<div class="alert alert-danger alert-dismissable" role="alert">--}}
			{{--<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>--}}
			{{--{{ $error }}--}}
		{{--</div>--}}
	{{--@endforeach--}}
{{--@endif--}}

@if ($errors->has('foto'))
	<div class="alert alert-danger alert-dismissable" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		{{ $errors->first('foto') }}
	</div>
@endif

@if ($errors->has('capa'))
	<div class="alert alert-danger alert-dismissable" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		{{ $errors->first('capa') }}
	</div>
@endif

@if(session('success'))
	<div class="alert alert-success alert-dismissable" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		{{ session('success') }}
	</div>
@endif

@if(session('error'))
	<div class="alert alert-danger alert-dismissable" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		{{ session('error') }}
	</div>
@endif