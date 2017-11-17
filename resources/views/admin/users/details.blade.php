@extends('layouts.base')
@section('title','Detalles del usuario')
@section('panel_title')
<h5><a class="btn btn-sm btn-primary" href="{{route('admin_users_index')}}"><i class="fa fa-arrow-left" aria-hidden="true"></i>
 Volver a Lista de Usuarios</a></h5>
@endsection
@section('content')
  <div class="col-md-3 col-sm-3 col-xs-12 profile_left" style="height: 100%">
    <div class="profile_img">
      <div id="crop-avatar">
        <!-- Current avatar -->
        <img class="img-responsive avatar-view" src="{{ asset('/user_avatars/'.$user->avatar) }}" alt="Avatar" title="Change the avatar">
      </div>
    </div>
    <h3><strong>{{$user->name." ".$user->lastname}}</strong></h3>

    <ul class="list-unstyled user_data">
      <li><strong>RUT:</strong> {{$user->rut?$user->rut:"No existe"}}</li>
      <li><strong>Teléfono:</strong> {{$user->phone?$user->phone:"No existe"}}</li>
      <li><strong>Email:</strong> {{$user->email?$user->email:"No existe"}}</li>
      <li><strong>Creado:</strong> {{$user->created_at->format('m/d/Y')}}</li>
      <li><strong>Modificado:</strong> {{$user->created_at->format('m/d/Y')}}</li>
      <li><strong>Roles asignados</strong></li>
      <li>
        <ul class="list-unstyledd user_data">
          @if(count($user->roles)>0)
          @foreach($user->roles as $role)
          <li style="text-transform: capitalize;">{{$role->name}}</li>
          @endforeach
          @else
          No existen roles asociados
          @endif
        </ul>
      </li>
    </ul>

    
  </div>
  <div class="col-md-9 col-sm-9 col-xs-12">
    <a class="btn btn-success" href="{{route('edit_user_form',[$user->id])}}" ><i class="fa fa-edit m-right-xs"></i> Modificar Perfil</a>

    <a class="btn btn-info" href="{{route('edit_user_roles_form',[$user->id])}}" ><i class="fa fa-edit m-right-xs"></i> Asignación de Roles</a>

    <a class="btn btn-danger" id="delete_btn" href="{{route('delete_user',[$user->id])}}" ><i class="fa fa-trash m-right-xs"></i> Eliminar Perfil</a>    
  </div>

@endsection

<script type="text/javascript">
@section('scripts')
  $(function() {
    $('#delete_btn').click(function(){
        return window.confirm("Está seguro de que desea eliminar este usuario?");
    });
  });
@endsection
</script>