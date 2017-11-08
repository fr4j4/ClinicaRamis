@extends('layouts.base')
@section('title','Adminsitración de roles y permisos')

@section('panel_title')

@endsection

@section('styles')

@endsection

@section('content')

<style type="text/css">

  .test_name{
    text-transform:capitalize;
  }

  .role_item{
    cursor:pointer;
    text-align: left;
    text-transform:capitalize;
  }

</style>

<div id="content" class="col-md-4 col-sm-4 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2><!--i class="fa fa-align-left"--></i>Roles</h2>
      <div class="clearfix"></div>
    </div>
    <div class="container">
      <!-- start accordion -->
      <div class="col-md-offset-1 col-md-10" id="roles_section">
      <!-- create rol and rol list section here!!!!! -->
      </div>
      <!-- end of accordion -->
    </div>
  </div>
</div>

<div id="right_panel_no_message">
  <p>
  <h1>Seleccione un rol para ver o cambiar sus permisos</h1>
  </p>
</div>

<div id="right_panel" class="col-md-8 col-sm-8 col-xs-12" style="display: none;">
 
  <div id="content" class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2><!--i class="fa fa-align-left"--></i> Permisos</h2>
        <button class="btn btn-warning pull-right" onclick="ajax_savePermissions()">Guardar permisos</button>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <!-- start accordion -->
        <div class="accordion" id="perms_section" role="tablist" aria-multiselectable="true">

        </div>
        <!-- end of accordion -->
      </div>
    </div>
  </div>
</div>

<div id="newRoleForm_modal" data-backdrop="static" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Crear Rol</h4>
      </div>
      <div class="modal-body">
        <p></p>
        <form id="newRoleForm" method="post" action="{{route('post_new_role')}}">
          <fieldset>
            {{csrf_field()}}
            @if($errors->has('name'))
                <center>
                <p class="alert alert-danger">
                    <strong>{{$errors->first('name')}}</strong>
                </p>
                </center>
            @endif
            <div class="form-group">
              <label class="col-md-2" for="name">Nombre</label>
              <div class="col-md-10">
                <input class="form-control" type="text" name="name">
              </div>
            </div>
          </fieldset>
          </div>
          <div class="modal-footer">
            <button class="btn btn-success">Crear</button>
            <button type="button" class="btn btn-warning" onclick="resetRoleForm()" data-dismiss="modal">Cancelar</button>
          </div>
      </form>
    </div>
  </div>
  </div>
</div>

<div id="newRoleForm_modal2" data-backdrop="static" class="modal fade" role="dialog" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editar nombre del rol</h4>
      </div>
      <div class="modal-body">
        <p></p>
        <form id="newRoleForm2" method="POST" action="{{route('api_change_role_name')}}">
          <fieldset>
            {{csrf_field()}}

            <input type="hidden" value="" name="role_id" id="new_role_id">
            @if($errors->has('name'))
                <center>
                <p class="alert alert-danger">
                    <strong>{{$errors->first('name')}}</strong>
                </p>
                </center>
            @endif
            <div class="form-group">
              <label class="col-md-2" for="name">Nombre</label>
              <div class="col-md-10">
                <input class="form-control" id="role_name_input" type="text" name="role_new_name">
              </div>
            </div>
          </fieldset>
          </div>
          <div class="modal-footer">
            <button class="btn btn-success" onclick="/*name_edit()*/">Aceptar</button>
            <button type="button" class="btn btn-warning" onclick="resetRoleForm2()" data-dismiss="modal">Cancelar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

   
@endsection

<script type="text/javascript">
<!-- scripts -->
@section('scripts')
var permissions=[];
var categories=[];
var roles=[];
var selected_role=undefined;
var collapsed_categories=[]//guarda las categorias que estan colapsadas

/*añade permisos si no esta o lo quita si esta*/
function toggle_permission(pid,state){
  if(selected_role!=undefined){
//    if(selected_role.permissions.includes(pid)){
    if(state===false && selected_role.permissions.includes(pid)){
      console.log("rem");
      selected_role.permissions.splice(selected_role.permissions.indexOf(pid),1);
    }else if(state==true && !selected_role.permissions.includes(pid)){
      console.log("add");
      selected_role.permissions.push(pid);
    }
  }else{
    alert("Se ha detectado un error al intentar cambiar un permiso para un rol inexistente");
    load_data();
  }
}

function name_edit(id){
  for(i in roles){
    r=roles[i];
    if(r.id===id){
      r.name=$('#role_name_input').val();
      
      break;
    }    
  }
}

function ajax_savePermissions(){
  if(selected_role!= undefined){
    console.log("reading")
        data={
          '_token':"{{csrf_token()}}",
          'roles':roles,
        };
    $.ajax({
      async:true,
      type:"POST",
      url:"{{route('update_roles')}}",
      data:data,
        headers: {
          'X-CSRF-TOKEN': "{{ csrf_token() }}",
        },
      success:function(msg){
        /*
        console.log('done!');
        console.log(msg);
        */
        alert("Cambios guardados con éxito!");
        location.reload();
      },
    });
  }else{
    alert("Debe seleccionar al menos un rol");
  }
}

function select_role(id){
  selected_role=undefined;
  for(i in roles){
    r=roles[i];
    if(r.id===id){
      selected_role=r;
      break;
    }    
  }
    load_data();
  if(selected_role==undefined){  
    alert("Hubo un problema con el rol seleccionado")
  }
}

function showNewRoleForm(){
  $('#newRoleForm_modal').modal('show');
}

function showNewRoleForm2(role_id){
  /*
  new_role_name
  new_role_id
  */

  $('#newRoleForm_modal2').modal('show');
  $('#role_name_input').attr("autofocus","false");

  for(i in roles){
    role=roles[i];
    if(role.id==role_id){
      $('#role_name_input').val(role.name);
      $('#role_name_input').attr("autofocus","true");
      $('#role_name_input').select();
      $('#new_role_id').val(role_id)
    }
  }
}

function resetRoleForm(){
  $('#newRoleForm')[0].reset();
}

function resetRoleForm2(){
  $('#newRoleForm2')[0].reset();
}

function load_data(){
  $('#perms_section').empty()
  $('#roles_section').empty()
  $('#roles_section').append('\
      <div class="row"><button class="btn btn-primary col-md-12 col-sm-12" onClick="showNewRoleForm()">\
        Crear Rol <span class="glyphicon glyphicon-plus" text-align="center"></span></button></div>')
  $('#right_panel').css('display','none');
  $('#right_panel_no_message').css('display','inherit');


  for(i in roles){
    r=roles[i]
    $('#roles_section:last').append('\
      <div class="row">\
        <div class="btn-group" style="width:100%">\
          <button class="btn btn-default role_item" style="width:70%" type="button" id="role_item_'+r.id+'" onClick="select_role('+r.id+')" >'+r.name+'</button>\
          <button class="btn btn-default role_item" style="width:15%" type="button" id="btncog_'+r.id+'" onClick="showNewRoleForm2(\''+r.id+'\');name_edit('+r.id+');;"><span class="glyphicon glyphicon-cog"></span></button>\
          <button class="btn btn-danger role_item" style="width:15%" type="button" id="btntrash_'+r.id+'"><span class="glyphicon glyphicon-trash"></span></button>\
        </div>\
      </div>')
    $('#btncog_'+r.id).height($('#role_item_'+r.id).height());
    $('#btntrash_'+r.id).height($('#role_item_'+r.id).height());
  }


  $('.role_item').removeClass('selected_role');

  if(selected_role!=undefined){//si hay algun rol seleccionado
    
    $('#right_panel').css('display','inherit');
    $('#right_panel_no_message').css('display','none');
    $('#role_item_'+selected_role.id).addClass('selected_role active');

    for (i in categories){
      cat=categories[i];
      /*CONTENT*/

      panel=$('<div id="panel_'+cat.id+'" class="panel">\
        <a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#'+cat.id+'" aria-expanded="true" aria-controls="'+cat.id+'">\
          <h4 class="panel-title">'+cat.name+'<i class="fa fa-chevron-down"></i></h4>\
        </a>\
        <div id="'+cat.id+'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">\
          <div class="panel-body">\
          </div>\
        </div>\
      </div>');

      $('#perms_section:last').append(panel)    
      for(j in permissions){
        permission_list=$('<div class="col-md-9 col-sm-9 col-xs-12"></div>');
        p=permissions[j];
        if(p.cat_id===cat.id){
          permission_item=$("<li style='min-height:3em;list-style-type:none'></li>")
          permission_item.hover(
            function(){
              $(this).css({color:'blue'})
            },function(){
              $(this).css({color:'inherit'})
            })
          permission_div=$("<div class'col-md-12'><span class='first'></span><span class='second'></span></div>")
          permission_toggle=$('<div id="toggle_'+p.id+'" perm_id="'+p.id+'"class="toggle toggle-light" data-toggle-on="true"  data-toggle-height="25" data-toggle-width="150" onClick="toggle_permission('+p.id+')" ></div>')

          permission_label=$('<label class="test_name">'+p.name+'someshit</label>');

          permission_div.find('.first').addClass('col-md-6');
          permission_div.find('.second').addClass('col-md-6');
          permission_div.find('.first').append(permission_label);
          permission_div.find('.second').append(permission_toggle);

          permission_item.append(permission_div);        
          permission_list.append(permission_item);
          
          permission_toggle.toggles({
            text:{
              on:'activado',
              off:'desactivado'
            },
          });

          permission_toggle.toggles(false);
          for (x in selected_role.permissions){
            sel_perm=selected_role.permissions[x];
            if(sel_perm==p.id){
              permission_toggle.toggles(true);
              panel.find('.panel-collapse').addClass('in')
            }
          }
        }
        $('#panel_'+cat.id).find('.panel-body').append(permission_list)
      }
    }

  $('.toggle').on('toggle', function(e, active) {
        toggle_permission(parseInt($(this).attr('perm_id')),active);
    });
  }
  else{
    //alert("Hubo un problema con el rol seleccionado")
  }
}

@endsection

<!-- scripts que corren cuando el documento este listo -->

@section('ready_scripts')
  @if($errors->has('name'))
  showNewRoleForm();
  @endif
  //inicializar arreglos de permisos y roles
  @foreach($categories as $c)
    categories.push({
    	id:{{$c->id}},
    	name:"{{$c->name}}",
    });
  @endforeach
  categories.push({
  	id:-1,
  	name:"sin categoria",
  });

  @foreach($permissions as $p)
    permissions.push({
    	id:{{$p->id}},
    	name:"{{$p->name}}",
    	cat_id:{{$p->category?$p->category->id:-1}},
    });
  @endforeach

  @foreach($roles as $r)
    tmp_role={
      id:{{$r->id}},
      name:"{{$r->name}}",
      permissions:[]
    }
    @foreach($r->permissions as $p)
      tmp_role.permissions.push({{$p->id}});
    @endforeach
    roles.push(tmp_role)
  @endforeach
  load_data();
@endsection
</script>