@extends('errors.layout')

@section('title', 'Acceso denegado')

@section('message', 'Error #403 - No tiene los privilegios necesarios para acceder a este contenido.')

@section('content')
<a href="{{route('dashboard')}}">[volver al inicio]</a>
@endsection
