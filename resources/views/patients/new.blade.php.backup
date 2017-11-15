@extends('layouts.base')
@section('title','Registrar nuevo paciente')
@section('content')
	<div class="container">
<a href="{{route('patients_index')}}" type="button" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y volver a lista de pacientes</a>
                <div class="x_panel">
                  <div class="x_content">
                    <br />
  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
                    <form class="form-horizontal form-label-left input_mask" method="post">

                      {{csrf_field()}}
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" id="firstname" name="firstname" placeholder="Nombre">
                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" id="lastname" name="lastname" placeholder="Apellido">
                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-1 col-sm-2 col-xs-12">Género</label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <div id="gender" class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="gender" value="mujer"> &nbsp; Mujer &nbsp;
                            </label>
                            <label class="btn btn-default" data-toggle-class="btn-<" data-toggle-passive-class="btn-default">
                              <input type="radio" name="gender" value="hombre"> Hombre
                            </label>
                          </div>
                        </div>
                      </div>


                    <label class="control-label col-md-1">Fecha nac.</label>
                    <div class="col-md-3">
                        <div class="input-group date" id="myDatepicker2">
                            <span class="input-group-addon">
                               <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                            <input type='text' class="form-control" placeholder="Fecha nacimiento" name="birthday" />
                        </div>
                    </div>
                      

                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" id="rut" name="rut" placeholder="RUT">
                        <span class="fa fa-id-card-o form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" id="email" name="email" placeholder="Email">
                        <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" id="phone" name="phone" placeholder="Telefono">
                        <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" id="address" name="address" placeholder="Dirección">
                        <span class="fa fa-location-arrow form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
							             <button class="btn btn-primary" type="reset">Limpiar formulario</button>
                        	<button type="submit" class="btn btn-success">Crear nuevo usuario</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
          
              </form>
            </div>
          </div>

	</div>
@endsection
<script type="text/javascript">
@section('ready_scripts')
    $('#myDatepicker2').datetimepicker({
        format: 'DD/MM/YYYY',
        locale: 'es'
    });
@endsection
</script>