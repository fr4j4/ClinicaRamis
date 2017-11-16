@extends('layouts.base')
@section('title','Asignación de roles')
@section('panel_title')

<h5><a class="btn btn-sm btn-primary" href="{{route('show_user_details',$user->id)}}"><i class="fa fa-arrow-left" aria-hidden="true"></i>
 Volver a detalles</a></h5>
@endsection
@section('content')

<p><h3>Asigne aquí roles al usuario</h3></p>

<form method="POST">
{{csrf_field()}}
<input type="hidden" name="user_id" value="{{$user->id}}">
@foreach($roles as $role)
<div class="checkbox">
		<label style="text-transform: capitalize;">
	@if($user->hasRole($role->name))

			<!---
			<input name="role[]" checked="" type="checkbox" value="{{$role->name}}">{{$role->name}}
			-->
			<input type="checkbox" class="switch" name="role[]"  value="{{$role->name}}" checked="" />{{$role->name}}
	@else
			<input type="checkbox" class="switch" name="role[]"  value="{{$role->name}}"/>{{$role->name}}
  	@endif
		</label>
</div>
@endforeach

	

<button class="btn btn-success">Guardar roles</button>
</form>


@endsection


<script type="text/javascript">

@section('scripts')
@endsection
@section('ready_scripts')
	$('.switch').each(function(){
		var switchery = new Switchery(this, { size: 'small' });
	})
@endsection
</script>