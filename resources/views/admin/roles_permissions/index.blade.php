@extends('layouts.base')
@section('title','Adminsitración de roles y permisos')

@section('panel_title')

@endsection

@section('styles')

@endsection

@section('content')

              <div id="content" class="col-md-4 col-sm-4 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><!--i class="fa fa-align-left"--></i> Roles</h2>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <!-- start accordion -->
                    <ul style="list-style-type:none" id="roles_section">

                    </ul>
                    <!-- end of accordion -->
                  </div>
                </div>
              </div>

              <div id="content" class="col-md-8 col-sm-8 col-xs-12">
<!-- detalles -->
              <div id="content" class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><!--i class="fa fa-align-left"--></i> Detalles</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <label class="col-md-2">nombre</label>
                    <div class="col-md-8">
                      <input class="form-control" type="text" id="role_name_input" readonly="">
                    </div>
                    <a href="javascript:void(0)" id="edit_role_name" >[modificar]</a>

                  </div>
                </div>
              </div>
<!-- /detalles -->

              <div id="content" class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><!--i class="fa fa-align-left"--></i> Permisos</h2>
                    <button class="btn btn-warning pull-right">guardar permisos</button>
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


   
@endsection

<script type="text/javascript">
<!-- scripts -->
@section('scripts')
var permissions=[];
var categories=[];
var roles=[];
var selected_role=undefined;
var collapsed_categories=[]//guarda las categorias que estan colapsadas

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

function load_data(){
  $('#perms_section').empty()
  $('#roles_section').empty()
  $('#role_name_input').attr('readonly',true);
  for(i in roles){
    r=roles[i]
    $('#roles_section:last').append('<li><a href="javascript:void(0)" onClick="select_role('+r.id+')">'+r.name+'</a></li>')
  }

  if(selected_role!=undefined){//si hay algun rol seleccionado
    
    $('#role_name_input').val(selected_role.name);
    $('#edit_role_name').css('display','block');

    for (i in categories){
      cat=categories[i];
      /*CONTENT*/

      panel=$('<div id="panel_'+cat.id+'" class="panel">\
        <a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#'+cat.id+'" aria-expanded="true" aria-controls="'+cat.id+'">\
          <h4 class="panel-title">'+cat.name+'</h4>\
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
          permission_toggle=$('<div class="toggles toggle-light" data-toggle-on="true"  data-toggle-height="25" data-toggle-width="110"></div>')
          permission_label=$('<label>'+p.name+'</label>');

          permission_div.find('.first').addClass('col-sm-6');
          permission_div.find('.second').addClass('col-sm-6');
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
  }else{
    //alert("Hubo un problema con el rol seleccionado")
  }
}

@endsection

<!-- scripts que corren cuando el documento este listo -->

@section('ready_scripts')

//inicializar arreglos de permisos y roles
@foreach($categories as $c)
categories.push({
	id:{{$c->id}},
	name:"{{$c->display_name}}",
});
@endforeach
categories.push({
	id:-1,
	name:"sin categoria",
});

@foreach($permissions as $p)
permissions.push({
	id:{{$p->id}},
	name:"{{$p->display_name}}",
	cat_id:{{$p->category?$p->category->id:-1}},
});
@endforeach

@foreach($roles as $r)
tmp_role={
  id:{{$r->id}},
  name:"{{$r->display_name}}",
  permissions:[]
}
@foreach($r->permissions as $p)
  tmp_role.permissions.push({{$p->id}});
@endforeach
roles.push(tmp_role)
@endforeach
load_data();

$('#edit_role_name').click(function(){
  $('#role_name_input').removeAttr('readonly');
  $(this).css('display','none');
});

@endsection


</script>


                     