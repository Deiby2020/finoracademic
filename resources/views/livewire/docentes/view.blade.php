@section('title', __('Docentes'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fab fa-laravel text-info"></i>
							Listado de Docentes</h4>
						</div>
						<div wire:poll.60s>
							<code><h5>{{ now()->format('H:i:s') }} UTC</h5></code>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar Docentes">
						</div>
						<div class="btn btn-sm btn-info" data-toggle="modal" data-target="#exampleModal">
						<i class="fa fa-plus"></i>  Agregar Docentes
						</div>
					</div>
				</div>
				
				<div class="card-body">
						@include('livewire.docentes.create')
						@include('livewire.docentes.update')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr> 
								<td>#</td> 
								<th>Nit</th>
								<th>Nombre</th>
								<th>Apellido Paterno</th>
								<th>Apellido Materno</th>
								<th>Profesion</th>
								<th>Nacimiento</th>
								<th>Telefono</th>
								<th>Correo</th>
								<th>Genero</th>
								<th>Direccion</th>
								<th>Estado</th>
								<td>ACCIONES</td>
							</tr>
						</thead>
						<tbody>
							@foreach($docentes as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td>{{ $row->nit }}</td>
								<td>{{ $row->nombre }}</td>
								<td>{{ $row->apellido_paterno }}</td>
								<td>{{ $row->apellido_materno }}</td>
								<td>{{ $row->profesion }}</td>
								<td>{{ $row->nacimiento }}</td>
								<td>{{ $row->telefono }}</td>
								<td>{{ $row->correo }}</td>
								<td>{{ $row->genero }}</td>
								<td>{{ $row->direccion }}</td>
								<td>{{ $row->estado }}</td>
								<td width="90">
								<div class="btn-group">
									<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Acciones
									</button>
									<div class="dropdown-menu dropdown-menu-right">
									<a data-toggle="modal" data-target="#updateModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Editar </a>							 
									<a class="dropdown-item" onclick="confirm('Confirm Delete Docente id {{$row->id}}? \nDeleted Docentes cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Elimninar </a>   
									</div>
								</div>
								</td>
							@endforeach
						</tbody>
					</table>						
					{{ $docentes->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>