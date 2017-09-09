@extends('layouts.base')
@section('title','Adminsitración de roles y permisos')
@section('panel_title')
<p><h4>
	Seleccione un rol para luego indicar que permisos le serán concedidos.
</h4>
</p>
<p>
</p>
@endsection
@section('content')
<style type="text/css">
.role_button{
	cursor: hand;
}
.role_button:hover{
	background-color: rgba(0,0,0,0.125);
}

</style>

<div class="container">
	<div class="col-md-3">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Roles</h3>
				<h6>Seleccione un rol para conceder permisos.<br>Puede crear nuevos roles</h6>
			</div>
			<div class="panel-body ">
				<ul class="list-group">
					<li class="list-group-item">
					<button type="button" class="btn btn-info btn-md" style="width: 100%" data-toggle="modal" data-target="#newRoleModal"><i class="fa fa-plus" aria-hidden="true"></i> Crear nuevo rol</button>
					</li>
					@foreach($roles as $role)
					<li class="list-group-item role_button" role_id={{$role->id}} >{{$role->display_name}}</li>
					@endforeach
				</ul>
			</div>
			<div class="panel-footer">
				
			</div>
		</div>
	</div>

	<div class="col-md-8 pull-right">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="panel-title">
					Rol: <span id="role_detail_name"></span>
				</h2>
			</div>
			<div id="role_details">
			<div class="form-group">
				<label class="col-md-1 control-label" for="name">Nombre</label>
				<div class="col-md-5">
					<input type="text" class="form-control" id="role_name" name="name" readonly  value="[no seleccionado]">
				</div>
			</div>
			</div>
			<div class="panel-body">
				<span id="permisos_counter"></span>
				<h6>(Permisos concedidos serán los destacados)</h6>
			<ul id="tab_cats" class="nav nav-tabs">

			</ul>
			<div id="content_cats" class="tab-content no_selection ">

			</div>

			</div>
			<div class="panel-footer">
				<a class="btn btn-success" href="javascript: void(0)" onclick="submit_save_permissions_form()">Guardar cambios</a>
				<a class="btn btn-warning " href="javascript: void(0)" onclick="location.reload()">Descartar cambios</a>
			</div>
		</div>
	</div>


	<!-- Modal new role -->
	<div id="newRoleModal" data-backdrop="static" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title"><strong>Crear un nuevo rol</strong></h4>
	      </div>
	      <div class="modal-body">
			<form id="newRoleform" class="form" method="post"  action="{{route('post_new_role')}}">
			@if($errors)
			   @foreach ($errors->all() as $error)
			      <p class="label-danger" style="color: white">{{ $error }}</p>
			  @endforeach
			@endif 
			{{csrf_field()}}
				<div class="form-group">
					<label class="col-md-12 for="display_name">Nombre (obligatorio)</label>
					<div class="col-md-12">
						<input class="form-control text-lowercase" type="text" name="display_name" placeholder="Ej: Administrador" value="{{old('display_name')}}">
					</div>

					<label class="col-md-12" for="name">Alias</label>
					<div class="col-md-12">
						<input class="form-control text-lowercase" type="text" name="name" placeholder="Ej: admin" value="{{old('name')}}">
					</div>
					</div>
					<br>
					<div class="clearfix">
	      			<p>(*) <strong>Alias</strong> es un nombre que recibe el rol para ser tratado internamente por el sistema, mientras que <strong>nombre</strong> se utilizará para identificar el rol visualmente por los usuarios. Nombre y alias deben ser únicos (no pueden existir dos roles con los mismos nombres/alias).</p>
	      			<p>En caso de no especificar un alias, se establecerá el mismo indicado como nombre.</p>
	      			<p class="label-danger" style="color:white">Al crear un nuevo rol, la ventana se reiniciará. Se aconseja guardar cualquier cambio de permisos realizado antes de crear un nuevo rol.</p>	
					<br>
					<button class="btn btn-success">Crear rol</button>
				</div>
			</form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-warning" data-dismiss="modal" onclick="new_role_form_reset()">Cancelar y volver</button>
	      </div>
	    </div>

	  </div>
	</div>

</div>

<form style="display: none" id="savePermissionsForm" method="post" action="{{route('save_permissions')}}" >
	{{csrf_field()}}
</form>

@endsection

<script type="text/javascript">

<!-- scripts -->
@section('scripts')
	var selected_role={};
	var roles=[];
	var permissions=[];
	var categories=[]; 

	@foreach($roles as $role)
	role={
		id:{{$role->id}},
		name:"{{$role->display_name}}",
		permissions:[],
	}
	@foreach($role->permissions as $p)
	role.permissions.push('{{$p->id}}')
	@endforeach
	roles.push(role);
	@endforeach

	@foreach($permissions as $permission)
	permissions.push({
		id:{{$permission->id}},
		name:"{{$permission->display_name}}",
		category:{{$permission->category?$permission->category->id:-1}}//si el permiso esta asociado a una categoría se toma la id de la categoria, en caso contrario se tomará un -1
	});
	@endforeach

	@foreach($categories as $category)
	categories.push({
		id:{{$category->id}},
		name:"{{$category->display_name}}",
	});
	@endforeach
	categories.push({
		id:-1,
		name:"sin categoria",
	});

	/*despliega los permisos, en los que se destacaran los concedidos al rol seleccionado*/
	function load_data(){
		selected_role=undefined;
		/*limpiar antes*/
		$('#tab_cats').empty();
		$('#content_cats').empty();
		$('#permisos_counter').empty();
		$('#role_detail_name').empty();
		if($('.role_button.active').size()>0){
			/*obtener el rol seleccionado*/
			$.each(roles,function(index,val){
				if(val.id==$('.role_button.active').attr('role_id')){
					selected_role=val;
				}
			});

			//si es que se pudo obtener el rol seleccionado... 
			if(selected_role){
				$('#role_detail_name').text(selected_role.name);
				$('#role_details #role_name').val(selected_role.name)


				$('#permisos_counter').append("Permisos concedidos para el rol ["+$('.role_button.active').text()+"]: <span id='total_rpermissions_counter'>"+selected_role.permissions.length+"</span>");
				for (i in categories){
					c=categories[i];
					tab=$('<li><a class="cat_tab" data-toggle="tab" href="#content_'+c.id+'" style="text-transform:capitalize;">'+c.name+' (<span class="counter" id='+c.id+'>0</span>) </a></li>');
					content=$('<div id="content_'+c.id+'" class="tab-pane fade"></div>');
					
					if(i==0){
						tab.addClass('active');
						content.addClass('active in');
					}
					$('#tab_cats').append(tab);
					$('#content_cats').append(content);
					content.append('<ul class="nav-pills" style="list-style-type: none;"></ul>');
				}

				for(j in permissions){
					p=permissions[j];
					item=$('<li></li>');
					item.append('<span style="cursor:hand;" onclick="toggle_select('+p.id+')" id="perm_'+p.id+'" class="label label-default" p_id="'+p.id+'">'+p.name+'</span>');
					$('#content_'+p.category).find('ul').append(item);
					$.each(selected_role.permissions,function(index,val){
						if(val==p.id){
							item.find('span').removeClass('label-default')
							item.find('span').addClass('label-success');
						}
					});			
				}
				update_counters();
			}else{
				alert("Rol seleccionado no existente");
			}


		}else{
			$('#permisos_counter').text("Permisos");
			$('#role_detail_name').text("no seleccionado");
			$('#content_cats').append("<h3>Seleccione un rol en la sección de roles para poder establecer que permisos serán concedidos.</h3>")
		}
	}

	function new_role_form_reset(){
		$('#newRoleform')[0].reset();
	}

	/*actualiza los contadores de permisos, tanto global como de categorias*/
	function update_counters(){
		$('#total_rpermissions_counter').text(selected_role.permissions.length);
		for(c in categories){
			cat=categories[c];
			count=0;
			for(p in selected_role.permissions){
				perm=selected_role.permissions[p];
				current_perm={};
				for(pp in permissions){
					if(permissions[pp].id==perm){
						//console.log("j");
						current_perm=permissions[pp];
						break;
					}
				}
				if(current_perm&&current_perm.category==cat.id){
						count++;
				}
			}
			$('.counter#'+cat.id).text(""+count)
			//console.log(cat.name+":"+count);
		}
	}

	function toggle_select(id){
		/*si se marcó*/
		if($('#perm_'+id).hasClass('label-default')){
			$('#perm_'+id).removeClass('label-default')
			$('#perm_'+id).addClass('label-success')
			selected_role.permissions.push($('#perm_'+id).attr('p_id'));
		}
		/*si se desmarcó*/
		else if($('#perm_'+id).hasClass('label-success')){
			$('#perm_'+id).removeClass('label-success')
			$('#perm_'+id).addClass('label-default')
			selected_role.permissions.splice(selected_role.permissions.indexOf($('#perm_'+id).attr('p_id')),1)
		}
		update_counters();
	}

/*cuando se presionen "guardar cambios" en el formulario de permisos, se llamará a este método*/
	function submit_save_permissions_form(){
		//alert("naca naca");
		for (i in roles){
			r=roles[i];
			$('#savePermissionsForm').append('<input name="roles['+i+'][id]" value='+r.id+'\>');
			$('#savePermissionsForm').append('<input name="roles['+i+'][name]" value="'+r.name+'"\>');
			for(j in r.permissions){
				p=r.permissions[j]
				$('#savePermissionsForm').append('<input name="roles['+i+'][permissions]['+j+']" value='+p+'\>');
			}
		}
		
		//enviar el fomrulario ---->!
		$('#savePermissionsForm').submit();
	}

@endsection

<!-- scripts que corren cuando el documento este listo -->

@section('ready_scripts')
		load_data();
		
		$('.role_button').click(function(){
			$('.role_button').removeClass('active');
			$(this).addClass('active');
			load_data();
		});

		@if(count($errors)>0)
			//en caso de errores en datos del formulario enviado, mostrar el modal
			$('#newRoleModal').modal('show');
		@endif
@endsection

</script>