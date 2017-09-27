@extends('layouts.base')
@section('title','Registrar nuevo usuario')
@section('panel_title')
<h4>Por favor, complete el formulario de registro.</h4>
@endsection
@section('content')

<div class="container">
Los campos con <span class="required">*</span> son <strong>obligatorios</strong>.

<form  data-parsley-validate class="form-horizontal form-label-left input_mask" method="POST">
{{csrf_field()}}

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group">
	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">RUT <span class="required">*</span></label>
	<div class="col-md-6 col-sm-6 col-xs-12">
		<input type="text" id="rut" name="rut" required class="form-control col-md-7 col-xs-12">
	</div>
</div>

<div class="form-group">
	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nombre <span class="required">*</span></label>
	<div class="col-md-6 col-sm-6 col-xs-12">
		<input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" name="firstname">
	</div>
</div>
  
<div class="form-group">
	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="lastname">Apellido <span class="required">*</span></label>
	<div class="col-md-6 col-sm-6 col-xs-12">
		<input type="text" id="last-name" name="lastname" required="required" class="form-control col-md-7 col-xs-12">
	</div>
</div>
  
<div class="form-group">
	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Teléfono <span class="required"></span></label>
	<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
		<input type="text" class="form-control has-feedback-left" id="inputSuccess5" name="phone">
		<span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
	</div>
</div>

<div class="form-group">
	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Alias <span class="required">*</span></label>
	<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
		<input type="text" class="form-control has-feedback-left" id="inputSuccess4" name="nickname">
		<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
	</div>
</div>

<div class="form-group">
	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">E-mail <span class="required">*</span></label>
	<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
		<input type="email" class="form-control has-feedback-left" id="inputSuccess4" name="email">
		<span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
	</div>
</div>

<div class="form-group">
	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Contraseña <span class="required">*</span></label>
	<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
		<input type="password" class="form-control has-feedback-left" id="password" name="password">
		<span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
	</div>
</div>

<div class="form-group">
	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Reingresar contraseña <span class="required">*</span></label>
	<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
		<input type="password" class="form-control has-feedback-left" id="password" name="password_confirmation">
		<span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
	</div>
</div>

  <div class="ln_solid"></div>
  <div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
      <!--button class="btn btn-primary" type="button">Cancel</button-->
	  <button class="btn btn-primary" type="reset">Limpiar</button>
      <button type="submit" class="btn btn-success">Registrar nuevo usuario</button>
    </div>
  </div>

</form>

</div>
@endsection
@section('scripts')

@endsection