<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
{{route("api:test1")}}
	<form method="get" action={{route("api:test1")}}>
		{{csrf_field()}}
		{{csrf_token()}}
		<button type="submit">Send!</button>
	</form>
</body>
</html>