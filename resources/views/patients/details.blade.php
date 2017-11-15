@extends('layouts.base')
@section('title','Detalles de paciente')
@section('content')
<div class="container">


<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#datos">Datos personales</a></li>
  <li><a data-toggle="tab" href="#historial">Historial</a></li>
  <li><a data-toggle="tab" href="#fotografias">Fotografías</a></li>
  <li><a data-toggle="tab" href="#docs">Documentos</a></li>
</ul>

<div class="tab-content">
  <div id="datos" class="tab-pane fade in active">
    <h3>Datos personales</h3>


<div class="col-md-8">

    <table class="table">
    	<tbody>
    		<tr>
    			<th class="col-md-3">Nombre</th>
    			<td>{{$patient->name}}</td>
    		</tr>
    		<tr>
    			<th>Apellido</th>
    			<td>{{$patient->lastname}}</td>
    		</tr>
    		<tr>
    			<th>Fecha de nacimiento (d/m/y)</th>
    			<td>{{$patient->birthday?Carbon\Carbon::parse($patient->birthday)->format('d/m/Y'):"No existe fecha registrada"}}</td>
    		</tr>
    		<tr>
    			<th>Edad (años)</th>
    			<td>{{$patient->age()?$patient->age():"N/D"}}</td>
    		</tr>
    		<tr>
    			<th>RUT</th>
    			<td>{{$patient->rut}}</td>
    		</tr>
    		<tr>
    			<th>Teléfono</th>
    			<td>{{$patient->phone?$patient->phone:"No existe teléfono registrado"}}</td>
    		</tr>
    		<tr>
    			<th>E-mail</th>
    			<td>{{$patient->email?$patient->email:"No existe e-mail registrado"}}</td>
    		</tr>
    		<tr>
    			<th>Dirección</th>
    			<td>{{$patient->address?$patient->address:"No existe dirección registrada"}}</td>
    		</tr>

    	</tbody>
    </table>
</div>
<div class="col-md-4">
	<img id="patient_picture" style="border:black 2px solid;border-radius: 10px;" alt="avatar" width="200" height="200" src="{{asset('patient_pictures/'.$patient->picture)}}" >
</div>    

  </div>
  <div id="historial" class="tab-pane fade">
    <h3>Historial</h3>
    <p>Proximamente...</p>
  </div>
  <div id="fotografias" class="tab-pane fade">
    <h3>Fotografías</h3>
    <p>Proximamente...</p>
  </div>
  <div id="docs" class="tab-pane fade">
    <h3>Documentos</h3>
    <p>Proximamente...</p>
  </div>
</div>	

</div>
@endsection