@extends('layouts.base')
@section('title','Asignación de roles')
@section('panel_title','Asigne aquí roles al usuario.')
@section('content')

<form method="POST">
{{csrf_field()}}
<input type="hidden" name="user_id" value="{{$user->id}}">
@foreach($roles as $role)
<div class="checkbox">
	@if($user->hasRole($role->name))
		<label style="text-transform: capitalize;"><input name="role[]" checked="" type="checkbox" value="{{$role->name}}">{{$role->name}}</label>
	@else
  		<label style="text-transform: capitalize;"><input name="role[]" type="checkbox" value="{{$role->name}}">{{$role->name}}</label>
  	@endif
</div>
@endforeach

<button class="btn btn-success">Guardar roles</button>
</form>


@endsection


@section('scripts')

@endsection