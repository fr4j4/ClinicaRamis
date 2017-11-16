@extends('layouts.base')
@section('title','Mi perfil')
@section('panel_title')

@endsection
@section('content')

<div class="container">


<div class="col-md-3">
	<img id="patient_picture" style="border:black 2px solid;border-radius: 10px;" alt="avatar" width="100%" height="100%" src="{{asset('user_avatars/'.$user->avatar)}}" >
</div>    
	<div class="col-md-9">
		<div class="col-md-4">
			<h3><strong>Datos personales</strong></h3>

		<table class="table">
	    	<tbody style="text-align: left;">
	    		<tr>
	    			<th class="col-md-2" style="text-align: right" >Nombre</th>
	    			<td class="col-md-8">{{$user->name}}</td>
	    		</tr>
		        <tr>
		          <th style="text-align: right;">Apellido</th>
		          <td>{!!$user->lastname?$user->lastname:"<span style='color:gray'>- no especificado -</span>"!!}</td>
		        </tr>
	    		<tr>
	    			<th style="text-align: right;">RUT</th>
	    			<td>{!!$user->rut?$user->rut:"<span style='color:gray'>- no especificado -</span>"!!}</td>
	    		</tr>
	    		<tr>
	    			<th style="text-align: right;">Teléfono</th>
	    			<td>{!!$user->phone?$user->phone:"<span style='color:gray'>- no especificado -</span>"!!}</td>
	    		</tr>
	    		<tr>
	    			<th style="text-align: right;">E-mail</th>
	    			<td>{!!$user->email?$user->email:"<span style='color:gray'>- no especificado -</span>"!!}</td>
	    		</tr>
	    		<tr>
	    			<th style="text-align: right;">Dirección</th>
	    			<td style="text-transform: capitalize;">{!!$user->address?$user->address:"<span style='color:gray'>- no especificado -</span>"!!}</td>
	    		</tr>

	    	</tbody>
	    </table>			
		</div>
		<div class="col-md-4 ">
			    <h3><strong>Acceso</strong></h3>
			    <table class="table">
			    	<tbody>
			    		<th>Alias</th>
			    		<td>{{$user->nickname}}</td>
			    	</tbody>
			    </table>
		</div>

    </div>
</div>



@endsection

@section('scripts')

@endsection