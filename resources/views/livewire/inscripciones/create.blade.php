<!-- Modal -->
<div wire:ignore.self class="modal fade" id="exampleModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Inscripción</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">
				<form>
            <div class="form-group">
                <label for="fkid_gestion">Gestión</label>
                <select wire:model="fkid_gestion" class="form-control" id="fkid_gestion">
                    <option value="">Seleccionar Gestión</option>
                    @foreach (  $arrayGestion as $gestion )
                    @if  ($gestion->estado == 'Activo')
                        <option value="{{ $gestion->id }}"> {{ $gestion->descripcion}} </option>
                    @endif
                    @endforeach 
                </select>
                    @error('fkid_gestion') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="fkid_estudiante">Estudiante</label>
                <select wire:model="fkid_estudiante" class="form-control" id="fkid_estudiante">
                    <option value="">Seleccionar Estudiante</option>
                    @foreach (  $arrayEstudiante as $estudiante )
                        <option value="{{ $estudiante->id }}"> {{ $estudiante->apellido_paterno. ' ' .$estudiante->apellido_materno. ' ' .$estudiante->nombre}} </option>
                    @endforeach 
                </select>    
                @error('fkid_estudiante') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>

            @foreach (  $arraayMaestroOferta as $maestrooferta )
                    <div class="form-group border">
                        <div class="icheck-primary d-inline ml-2" style="text-align: center">
                            <input type="hidden" value="{{$maestrooferta->id}}" wire:model="selectedID" id="todoCheck3">
                            <input type="checkbox" id="{{$maestrooferta->id}}">
                            <label for="{{$maestrooferta->id}}">
                                <p> {{ $maestrooferta->sigla. ' | ' .$maestrooferta->descripcion. ' | ' .$maestrooferta->materia. ' | ' .$maestrooferta->apellido_paterno.' '
                                .$maestrooferta->apellido_materno. ' ' .$maestrooferta->nombre. ' | ' .$maestrooferta->hora_entrada.' - '
                                .$maestrooferta->hora_salida. ' | ' .$maestrooferta->modulo. ' - '.$maestrooferta->aula. ' | ' .$maestrooferta->cupo }} </p>
                            </label>
                          </div>
                    </div>
            @endforeach 
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Cancelar</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-primary close-modal">Registrar</button>
            </div>
        </div>
    </div>
</div>