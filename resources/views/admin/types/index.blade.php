@extends('admin.admintemplate')

@section('contenido')
 <!-- Modal Agregar -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Nuevo Producto</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <form action="{{action('ProductoController@store')}}" method="POST">
        {{csrf_field()}}
      <div class="modal-body">
          <div class="form-group">
            <label for="nombre">Nombre</label>
            <input name="nombre" class="form-control" placeholder="Introduzca el producto" type="text">
          </div>
          
          <div class="form-group">
            <label for="descripcion">Descripcion</label>
            <input name="descripcion" class="form-control" placeholder="Introduzca la descripcion " type="text">
          </div>
        
          <div class="form-group">
            <label for="categoria">Categoria</label>
            <input name="categoria" class="form-control" placeholder="Introduzca la categoria" type="text">
          </div>

          <div class="form-group">
            <label for="stock">Stock</label>
            <input name="stock" class="form-control" placeholder="0" type="text">
          </div>
          
          <div class="form-group">
            <label for="precio">Precio</label>
            <input name="precio" class="form-control" placeholder="0" type="text">
          </div>
      </div>
      <div class="modal-footer">
          <button type="submit" class="btn btn-default btn-primary">Guardar</button> 
        <button type="button" class="btn btn-default btn-danger" data-dismiss="modal">Close</button>
      </div>
    </form>
    </div>

  </div>
</div>

<!-- Fin de Modal Agregar-->


<!-- Modal Editar -->
<div id="EditModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Editar Producto</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <form action="" method="POST" id="editForm">
        
        {{csrf_field()}}

      <div class="modal-body">
           <div class="form-group">
            <label for="nombre">ID</label>
            <input name="id" id="editID" class="form-control" placeholder="Introduzca el producto" type="text" readonly="true">
          </div>

          <div class="form-group">
            <label for="nombre">Nombre</label>
            <input name="nombre" id="editNombre" class="form-control" placeholder="Introduzca el producto" type="text">
          </div>
          
          <div class="form-group">
            <label for="descripcion">Descripcion</label>
            <input name="descripcion" id="editDescripcion" class="form-control" placeholder="Introduzca la descripcion " type="text">
          </div>
        
          <div class="form-group">
            <label for="categoria">Categoria</label>
            <input name="categoria"  id="editCategoria" class="form-control" placeholder="Introduzca la categoria" type="text">
          </div>

          <div class="form-group">
            <label for="stock">Stock</label>
            <input name="stock" id="editStock" class="form-control" placeholder="0" type="text">
          </div>
          
          <div class="form-group">
            <label for="precio">Precio</label>
            <input name="precio" id="editPrecio" class="form-control" placeholder="0" type="text">
          </div>
      </div>
      <div class="modal-footer">
          <button type="submit" class="btn btn-default btn-primary">Guardar</button> 
        <button type="button" class="btn btn-default btn-danger" data-dismiss="modal">Close</button>
      </div>
    </form>
    </div>

  </div>
</div>

<!-- Fin de Modal Editar-->


	<div class="row">
		<div class="col-12">
			<h1>PRODUCTOS</h1>
			<button class="btn btn-primary" data-toggle="modal" data-target="#myModal"><span class="fas fa-plus"> Añadir</span></button>
      @if(count($errors) > 0)
        <div class="alert alert-danger">
          <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
          </ul>
        </div>
      @endif

      @if(\Session::has('success'))
        <div class="alert alert-success">
          <p>{{\Session::get('success')}}</p>
        </div>
      @endif
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<table  id="datatable" class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>ID</th>
						<th>Nombre</th>
						<th>Descripcion</th>
						<th>Categoría</th>
						<th>Stock</th>
                        <th>Precio</th>
					</tr>
				</thead>
				<tbody>
					@foreach($productos as $producto)
						<tr>
							<td>{{$producto->id}}</td>
							<td>{{$producto->nombre}}</td>
							<td>{{$producto->descripcion}}</td>
							<td>{{$producto->categoria}}</td>
                            <td>{{$producto->stock}}</td>
                            <td>{{$producto->precio}}</td>
							<td><a href="#" class="btn btn-secondary"><span class="fas fa-eye"></span></a>
              <!--<button class="btn btn-primary" data-toggle="modal" data-target="#EditModal"><span class="fas fa-edit"></button>-->
							<a href="{{action('ProductoController@edit($producto->id)')}}" class="btn btn-success edit"><span class="fas fa-edit"></span></a>
							<a href="#" class="btn btn-danger"><span class="fa fa-trash-alt"></span></a></td>
						</tr>

					@endforeach
				</tbody>
			</table>
            
            
		</div>
	</div>

   <script type="text/javascript">
     $(document).ready(function() {
  /**
   * for showing edit item popup
   */

  $(document).on('click', "#edit-item", function() {
    $(this).addClass('edit-item-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

    var options = {
      'backdrop': 'static'
    };
    $('#EditModal').modal(options)
  })

  // on modal show
  $('#EditModal').on('show.bs.modal', function() {
    var el = $(".edit-item-trigger-clicked"); // See how its usefull right here? 
    var row = el.closest(".data-row");

    // get the data
    var id = el.data('item-id');
    var nombre = row.children(".nombre").text();
    var descripcion = row.children(".descripcion").text();
    var categoria = row.children(".categoria").text();
    var stock = row.children(".stock").text();
    var precio = row.children(".precio").text();

    // fill the data in the input fields
    $("#editNombre").val(id);
    $("#editNombre").val(nombre);
    $("#editDescripcion").val(descripcion);
    $("#editCategoria").val(categoria);
    $("#editStock").val(stock);
    $("#editPrecio").val(precio);

  })

  // on modal hide
  $('#edit-modal').on('hide.bs.modal', function() {
    $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
    $("#edit-form").trigger("reset");
  })
})
   </script>
   <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
@endsection