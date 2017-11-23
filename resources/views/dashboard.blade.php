@extends('layouts.base')
@section('title','Inicio')
@section('panel_title')
Bienvenido, {{Auth::user()->name}}.
@endsection
@section('content')
<p>
<h3>Resumen del sistema</h3>
</p>

<div class="container well" style="padding: 2em">

@foreach($stats as $stat)
	@if($stat->type=='count')
	<div class="col-md-3">
		<div class="tile-stats">
		<div class="icon"><i class="fa {{isset($stat->icon)?$stat->icon:"fa-cog"}}"></i>
		  </div>
		  <div class="count">{{$stat->value}}</div>
		  <h3 style="text-transform: capitalize;">{{$stat->title}}</h3>
		  @if(isset($stat->manage_button))
		  <p><a href="{{$stat->manage_button['url']}}" class="btn btn-xs btn-info">{{$stat->manage_button['title']}}</a></p>
			@endif
		</div>
	</div>
	@endif
@endforeach


</div>

<div>
@foreach($stats as $stat)
	@if($stat->type=='last_activity')
	<div class="panel panel-default">
    	<div class="panel-heading">{{$stat->title}}</div>
    	<div class="panel-body">
    		
    		<table class="table" style="text-align: center;">
    			<thead>
    				<th style="text-align: center;">Fecha de registro<br/>(yyyy/mm/dd)</th>
    				<th style="text-align: center;">Responsable</th>
    				<th style="text-align: center;">Acción</th>
    				<th style="text-align: center;">Objetivo</th>
    			</thead>
	    		@foreach($stat->value as $record)
	    		<tr>
	    			<td>{{$record->created_at}}</td>
	    			<td>{!!$record->causer? Auth::user()->can('ver_usuarios')?"<a style='text-decoration:underline;' href='".route('show_user_details',[$record->causer->id])."'>".$record->causer->name." ".$record->causer->lastname."</a>":$record->causer->name." ".$record->causer->lastname:"Sistema"!!}</td>
	    			<td>{{$record->description}}</td>
	    			<td>{!!$record->subject_type=="App\User"&&$record->subject?Auth::user()->can('ver_usuarios')?"<a style='text-decoration:underline;' href='".route('show_user_details',[$record->subject->id])."'>".$record->subject->name." ".$record->subject->lastname."</a>":$record->causer->name." ".$record->causer->lastname:"<span style='color:darkgray'>-no disponible-</span>"!!}</td>
	    		</tr>
	    		@endforeach
    		</table>
    	</div>
  	</div>
	@endif
@endforeach
</div>

@endsection

@section('scripts')

@endsection