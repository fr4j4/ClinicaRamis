@extends('errors.layout')

@section('title', 'No encontrado')

@section('message', 'Error #404 - El contenido solicitado no ha sido encontrado.')

@section('content')
<a href="{{route('dashboard')}}">[volver al inicio]</a>
@endsection
