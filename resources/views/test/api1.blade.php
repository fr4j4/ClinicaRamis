<!DOCTYPE html>
<html>
<head>
	<title>s</title>
</head>
<body>
<h1>Test API</h1>
<input id="msg" type="text" name="message" placeholder="message">
<button onclick="ajaxTest()">send!</button>

    <script src="{{asset('vendors/jquery/dist/jquery.min.js')}}"></script>
<script type="text/javascript">
	function ajaxTest(){
		/*
		data = {
	      '_token': "{{ csrf_token() }}",
	      'title': 'title',
	      'description': 'description',
	      'categories': 'categories',
	      'themes': 'themes',
	      'image': 'photo'
    	}*/


    	$.ajax({
    		async:true,
    		type:"POST",
    		url:"{{route('test_api')}}",
    		data:{'a':'aaa'},
	        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}",
        	},
    		success:function(msg){
    			console.log('done!');
    			console.log(msg);
    		},

    	})
    	//console.log('sjdh');
	}
</script>
</body>
</html>