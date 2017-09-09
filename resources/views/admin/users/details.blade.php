@extends('layouts.base')
@section('title','Detalles del usuario')
@section('panel_title','')
@section('content')
  <div class="col-md-3 col-sm-3 col-xs-12 profile_left" style="height: 100%">
    <div class="profile_img">
      <div id="crop-avatar">
        <!-- Current avatar -->
        <img class="img-responsive avatar-view" src="{{asset('img/avatar.png')}}" alt="Avatar" title="Change the avatar">
      </div>
    </div>
    <h3>{{$user->name." ".$user->lastname}}</h3>

    <ul class="list-unstyled user_data">
      <li><i class="fa fa-mobile user-profile-icon"></i> {{$user->phone?$user->phone:"No existe número telefónico asociado"}}</li>

      <li>Creado: {{$user->created_at->format('m/d/Y')}}</li>
      <li>Modificado: {{$user->created_at->format('m/d/Y')}}</li>

<!--
      <li class="m-top-xs">
        <i class="fa fa-external-link user-profile-icon"></i>
        <a href="http://www.kimlabs.com/profile/" target="_blank">www.kimlabs.com</a>
      </li>
-->
    </ul>

    <a class="btn btn-success" href="{{route('edit_user_form',[$user->id])}}" style="width: 100%;"><i class="fa fa-edit m-right-xs"></i> Modificar Perfil</a>

    <a class="btn btn-danger" style="width: 100%;"><i class="fa fa-trash m-right-xs"></i> Eliminar Perfil</a>

    <br />

    <!-- start roles -->
    <h4>Roles asignados</h4>
    <ul class="list-unstyled user_data">
      @if(count($user->roles)>0)
      @foreach($user->roles as $role)
      <li>{{$role->display_name}}</li>
      @endforeach
      @else
      No existen roles asociados
      @endif
    </ul>
    <!-- end of roles -->

    
  </div>

@endsection


@section('scripts')

@endsection