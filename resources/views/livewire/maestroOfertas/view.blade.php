@section('title', __('Maestro Ofertas'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fab fa-laravel text-info"></i>
							Maestro Oferta de Materias </h4>
						</div>
						<div wire:poll.60s>
							<code><h5>{{ now()->format('H:i:s') }} UTC</h5></code>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar">
						</div>
						<div class="btn btn-sm btn-info" data-toggle="modal" data-target="#exampleModal">
						<i class="fa fa-plus"></i>  Agregar oferta de Materia
						</div>
					</div>
				</div>
				
				<div class="card-body">
						@include('livewire.maestroOfertas.create')
						@include('livewire.maestroOfertas.update')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr> 
								<td>#</td> 
								<th>Sigla</th>
								<th>Grupo</th>
								<th>Materia</th>
								<th>Docente</th>
								<th>Horario</th>
								<th>Modulo</th>
								<th>Aula</th>
								<th>Cupo</th>
								<td>ACCIONES</td>
							</tr>
						</thead>
						<tbody>
							@foreach($maestroOfertas as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td>{{ $row->materia->sigla}}</td>
								<td>{{ $row->grupo->descripcion }}</td>
								<td>{{ $row->materia->descripcion }}</td>
								<td>{{ $row->docente->nombre . ' ' . $row->docente->apellido_paterno. ' ' .$row->docente->apellido_materno  }}</td>
								<td>{{ $row->horario->hora_entrada.' - '.$row->horario->hora_salida}}</td>
								<td>{{ $row->modulo->descripcion }}</td>
								<td>{{ $row->aula->descripcion }}</td>
								<td>{{ $row->cupo }}</td>
								<td width="90">
								<div class="btn-group">
									<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Acciones
									</button>
									<div class="dropdown-menu dropdown-menu-right">
									<a data-toggle="modal" data-target="#updateModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Editar </a>							 
									<a class="dropdown-item" onclick="confirm('Confirm Delete Maestro Oferta id {{$row->id}}? \nDeleted Maestro Ofertas cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Eliminar </a>   
									</div>
								</div>
								</td>
							@endforeach
						</tbody>
					</table>						
					{{ $maestroOfertas->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>