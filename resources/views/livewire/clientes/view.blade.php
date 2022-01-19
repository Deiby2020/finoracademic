@section('title', __('Clientes'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fab fa-laravel text-info"></i>
							Listado de Clientes</h4>
						</div>
						<div wire:poll.60s>
							<code><h5>{{ now()->format('H:i:s') }} UTC</h5></code>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar por Nombre o Apellidos">
						</div>
						<div class="btn btn-sm btn-info" data-toggle="modal" data-target="#exampleModal">
						<i class="fa fa-plus"></i>  Adicionar Clientes
						</div>
					</div>
				</div>
				
				<div class="card-body">
						@include('livewire.clientes.create')
						@include('livewire.clientes.update')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr> 
								<td>#</td> 
								<th>Ci</th>
								<th>Nombre</th>
								<th>Apellido Paterno</th>
								<th>Apellido Materno</th>
								<th>Genero</th>
								<th>Estado Civil</th>
								<th>Telefono</th>
								<th>Correo</th>
								<th>Ciudad</th>
								<th>Direccion</th>
								<td>ACCIONES</td>
							</tr>
						</thead>
						<tbody>
							@foreach($clientes as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td>{{ $row->ci }}</td>
								<td>{{ $row->nombre }}</td>
								<td>{{ $row->apellido_paterno }}</td>
								<td>{{ $row->apellido_materno }}</td>
								<td>{{ $row->genero }}</td>
								<td>{{ $row->estado_civil }}</td>
								<td>{{ $row->telefono }}</td>
								<td>{{ $row->correo }}</td>
								<td>{{ $row->ciudad }}</td>
								<td>{{ $row->direccion }}</td>
								<td width="90">
								<div class="btn-group">
									<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Acciones
									</button>
									<div class="dropdown-menu dropdown-menu-right">
									<a data-toggle="modal" data-target="#updateModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Editar </a>							 
									<a class="dropdown-item" onclick="confirm('Confirm Delete Cliente id {{$row->id}}? \nDeleted Clientes cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Eliminar </a>   
									</div>
								</div>
								</td>
							@endforeach
						</tbody>
					</table>						
					{{ $clientes->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>