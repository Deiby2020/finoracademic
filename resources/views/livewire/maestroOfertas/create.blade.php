<!-- Modal -->
<div wire:ignore.self class="modal fade" id="exampleModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear Nuevo Maestro de Oferta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">
				<form>
            <div class="form-group">
                <label for="cupo"></label>
                <input wire:model="cupo" type="text" class="form-control" id="cupo" placeholder="Cupo">@error('cupo') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="fkid_materia">Materia</label>
                <select wire:model="fkid_materia"
                    class="form-control" id="fkid_materia"
                >
                    <option value="">Seleccionar Materia</option>
                    @foreach (  $arrayMateria as $materia )
                        <option value="{{ $materia->id }}"> {{ $materia->descripcion }} </option>
                    @endforeach
                </select>
                @error('fkid_materia') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="fkid_docente">Docente</label>
                <select wire:model="fkid_docente" class="form-control" id="fkid_docente">
                    <option value="">Seleccionar Docente</option>
                    @foreach (  $arrayDocente as $docente )
                        <option value="{{ $docente->id }}"> {{ $docente->nombre. ' ' .$docente->apellido_paterno. ' ' .$docente->apellido_materno }} </option>
                    @endforeach 
                </select>
                @error('fkid_docente') <span class="error text-danger">{{ $message }}</span> @enderror    
            </div>

            <div class="form-group">
                <label for="fkid_grupo">Grupo</label>
                <select wire:model="fkid_grupo" class="form-control" id="fkid_grupo">
                    <option value="">Seleccionar Grupo</option>
                    @foreach (  $arrayGrupo as $grupo )
                        <option value="{{ $grupo->id }}"> {{ $grupo->descripcion}} </option>
                    @endforeach 
                </select>
                @error('fkid_grupo') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="fkid_horario">Horario</label>
                <select wire:model="fkid_horario" class="form-control" id="fkid_horario">
                    <option value="">Seleccionar Horario</option>
                    @foreach (  $arrayHorario as $horario )
                        <option value="{{ $horario->id }}"> {{ $horario->hora_entrada. ' - ' .$horario->hora_salida. ' ' .$horario->dia}} </option>
                    @endforeach 
                </select>
                @error('fkid_horario') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="fkid_modulo">Módulo</label>
                <select wire:model="fkid_modulo" class="form-control" id="fkid_modulo">
                    <option value="">Seleccionar Módulo</option>
                    @foreach (  $arrayModulo as $modulo )
                        <option value="{{ $modulo->id }}"> {{ $modulo->descripcion}} </option>
                    @endforeach 
                </select>
                @error('fkid_modulo') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="fkid_aula">Aula</label>
                <select wire:model="fkid_aula" class="form-control" id="fkid_aula">
                    <option value="">Seleccionar Aula</option>
                    @foreach (  $arrayAula as $aula )
                        <option value="{{ $aula->id }}"> {{ $aula->descripcion. ' - ' .$aula->estado}} </option>
                    @endforeach 
                </select>
                @error('fkid_aula') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Cancelar</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-primary close-modal">Guardar</button>
            </div>
        </div>
    </div>
</div>