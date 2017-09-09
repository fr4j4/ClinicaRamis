@extends('layouts.base')
@section('title','Adminsitración de roles y permisos')
@section('panel_title')

@endsection
@section('content')
<style type="text/css">

</style>



   
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2> Permisos <small>Float left</small></h2>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="permissions_tabs" class="nav nav-tabs bar_tabs" role="tablist">
                      </ul>
                <!--
                        <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Home</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Profile</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Profile</a>
                        </li>
                -->

                      <div id="permissions_tab_content" class="tab-content">
                <!--
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                          
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                          
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                -->
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>

@endsection

<script type="text/javascript">
var permissions=[];
var categories=[];
var roles=[];
<!-- scripts -->
@section('scripts')

function load_data(){

	for (i in categories){
		cat=categories[i];
		/*TABS*/
		tab=$('<li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">'+cat.name+'</a></li>');
		$('#permissions_tabs:last').append(tab);


		$('#permissions_tab_content:last').append('<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab"><p>'+cat.name+'</p></div>')

		/*CONTENT*/
		for(j in permissions){
			perm=permissions[j];

		}
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
load_data();

@endsection

</script>