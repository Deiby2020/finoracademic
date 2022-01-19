@section('title', __('Inscripciones'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fab fa-laravel text-info"></i>
							Listado de Inscripciones </h4>
						</div>
						<div wire:poll.60s>
							<code><h5>{{ now()->format('H:i:s') }} UTC</h5></code>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar Inscripción">
						</div>
						<div class="btn btn-sm btn-info" data-toggle="modal" data-target="#exampleModal">
						<i class="fa fa-plus"></i>  Agregar Inscripciones
						</div>
					</div>
				</div>
				
				<div class="card-body">
						@include('livewire.inscripciones.create')
						@include('livewire.inscripciones.update')
					<div class="table-responsive">						
							<table class="table table-bordered table-sm">
								<thead class="thead">
									<tr> 
										<td>#</td> 
										<th>Gestion</th>
										<th>Estudiante</th>
										<td>ACCIONES</td>
									</tr>
								</thead>
								<tbody>
									@foreach($inscripciones as $row)
									<tr>
										<td>{{ $loop->iteration }}</td> 
										<td>{{ $row->gestione->descripcion }}</td>
										<td>{{ $row->estudiante->apellido_paterno. ' ' .$row->estudiante->apellido_materno. ' '.$row->estudiante->nombre }}</td>
										<td width="90">
										<div class="btn-group">
											<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											Acciones
											</button>
											<div class="dropdown-menu dropdown-menu-right">
											<a data-toggle="modal" data-target="#updateModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Editar </a>							 
											<a class="dropdown-item" onclick="confirm('Confirm Delete Inscripcione id {{$row->id}}? \nDeleted Inscripciones cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Anular </a>   
											</div>
										</div>
										</td>
									@endforeach
								</tbody>
							</table>						
						{{ $inscripciones->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>