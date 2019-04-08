<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="{{asset('css/app.css')}}">
	<title>Bienvenido a mi tienda</title>
</head>
<body>
	<div class="container">
		<div class="row text-center">
			<div class="col-12">
				<h1 class="alert-success">{{$nombreTienda}}</h1>
				<h3>{{$descripcion}}</h3>	
			</div>
		</div>
	</div>

</body>
</html>