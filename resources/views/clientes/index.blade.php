@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Lista de Clientes'])

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Lista de Clientes</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="row">
                        <div class="col-md-4">
                            <!-- Botón para abrir el modal de ingreso de clientes -->
                            <button type="button" class="btn btn-block bg-gradient-primary mb-3 ms-3"
                                data-bs-toggle="modal" data-bs-target="#modal-default">Ingresar Cliente</button>

                            <!-- Modal para ingresar un nuevo cliente -->
                            <div class="modal fade" id="modal-default" tabindex="-1" role="dialog"
                                aria-labelledby="modal-default" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="modal-title" id="modal-title-default">Ingreso de Cliente</h6>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('clientes.store') }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="duiInput">DUI</label>
                                                    <input type="text" name="dui" class="form-control" id="duiInput" placeholder="DUI" maxlength="10">
                                                </div>
                                                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                                                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7-beta.19/jquery.inputmask.min.js"></script>

                                                <script>
                                                $(document).ready(function(){
                                                    $('#duiInput').inputmask('99999999-9');  // Formato del DUI
                                                });
                                                </script>
                                                <div class="mb-3">
                                                    <label for="nombresInput">Nombres</label>
                                                    <input type="text" name="Nombres" class="form-control" id="nombresInput"
                                                        placeholder="Nombres">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="apellidosInput">Apellidos</label>
                                                    <input type="text" name="Apellidos" class="form-control" id="apellidosInput"
                                                        placeholder="Apellidos">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="telefonoInput">Teléfono</label>
                                                    <input type="text" name="Telefono" class="form-control" id="telefonoInput" placeholder="Teléfono">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="celularInput">Celular</label>
                                                    <input type="text" name="Celular" class="form-control" id="celularInput" placeholder="Celular">
                                                </div>
                                                
                                                <script>
                                                $(document).ready(function(){
                                                    $('#telefonoInput, #celularInput').inputmask('+503 9999-9999');  // Formato del teléfono y celular
                                                });
                                                </script>
                                                <div class="mb-3">
                                                    <label for="bancoPagador">Tipo Persona</label>
                                                    <select class="form-select" name="TipoPersonaId" aria-label="Seleccione un Tipo de Persona" id="tipoPersona">
                                                        <option selected disabled>Seleccione un tipo de persona</option>
                                                        @foreach($tipos as $t)
                                                            <option value="{{ $t->ID }}">{{ $t->Descripcion }}</option>
                                                        @endforeach
                                                    </select>                                                    
                                                </div>
                                                <div class="mb-3">
                                                    <label for="direccionInput">Dirección</label>
                                                    <input type="text" name="Direccion" class="form-control" id="direccionInput"
                                                        placeholder="Dirección">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="fechaNacimientoInput">Fecha de Nacimiento</label>
                                                    <input type="date" name="Fecha_nacimiento" class="form-control" id="fechaNacimientoInput">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn bg-gradient-primary">Guardar cambios</button>
                                                <button type="button" class="btn btn-link ml-auto" data-bs-dismiss="modal">Cerrar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tabla con enlaces de edición -->
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">DUI</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nombres</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Apellidos</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($clientes as $cliente)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $cliente->dui }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $cliente->Nombres }} {{ $cliente->Apellidos }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $cliente->tipoPersona->Descripcion }}</p>
                                        </td>
                                        <td class="align-middle">
                                            <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editClienteModal{{ $cliente->dui }}">
                                                Editar
                                            </a>
                                            |
                                            <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                                data-bs-toggle="modal"
                                                data-bs-target="#viewClienteModal{{ $cliente->dui }}">
                                                Ver
                                            </a>
                                        </td>
                                    </tr>

                                    <!-- Modal para Editar Cliente -->
                                    <div class="modal fade" id="editClienteModal{{ $cliente->dui }}" tabindex="-1" role="dialog"
                                        aria-labelledby="modal-default" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="modal-title-default">Editar Cliente</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('clientes.update', $cliente->dui) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="duiInput{{ $cliente->dui }}">DUI</label>
                                                            <input type="text" name="dui" class="form-control" id="duiInput{{ $cliente->dui }}"
                                                                value="{{ $cliente->dui }}" readonly>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="nombresInput{{ $cliente->dui }}">Nombres</label>
                                                            <input type="text" name="Nombres" class="form-control" id="nombresInput{{ $cliente->dui }}"
                                                                value="{{ $cliente->Nombres }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="apellidosInput{{ $cliente->dui }}">Apellidos</label>
                                                            <input type="text" name="Apellidos" class="form-control" id="apellidosInput{{ $cliente->dui }}"
                                                                value="{{ $cliente->Apellidos }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="telefonoInput{{ $cliente->dui }}">Teléfono</label>
                                                            <input type="text" name="Telefono" class="form-control" id="telefonoInput{{ $cliente->dui }}"
                                                                value="{{ $cliente->Telefono }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="celularInput{{ $cliente->dui }}">Celular</label>
                                                            <input type="text" name="Celular" class="form-control" id="celularInput{{ $cliente->dui }}"
                                                                value="{{ $cliente->Celular }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="tipoPersona{{ $cliente->dui }}">Tipo Persona</label>
                                                            <select class="form-select" name="TipoPersonaId" aria-label="Seleccione un Tipo de Persona" id="tipoPersona{{ $cliente->dui }}">
                                                                <option selected disabled>Seleccione un tipo de persona</option>
                                                                @foreach($tipos as $t)
                                                                    <option value="{{ $t->ID }}" {{ $t->ID == $cliente->TipoPersonaId ? 'selected' : '' }}>{{ $t->Descripcion }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="direccionInput{{ $cliente->dui }}">Dirección</label>
                                                            <input type="text" name="Direccion" class="form-control" id="direccionInput{{ $cliente->dui }}"
                                                                value="{{ $cliente->Direccion }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="fechaNacimientoInput{{ $cliente->dui }}">Fecha de Nacimiento</label>
                                                            <input type="date" name="Fecha_nacimiento" class="form-control" id="fechaNacimientoInput{{ $cliente->dui }}"
                                                                value="{{ $cliente->Fecha_nacimiento }}">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn bg-gradient-primary">Guardar cambios</button>
                                                        <button type="button" class="btn btn-link ml-auto" data-bs-dismiss="modal">Cerrar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal para Ver Cliente -->
                                    <div class="modal fade" id="viewClienteModal{{ $cliente->dui }}" tabindex="-1" role="dialog"
                                        aria-labelledby="modal-default" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="modal-title-default">Ver Cliente</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="viewDui{{ $cliente->dui }}">DUI</label>
                                                        <input type="text" class="form-control" id="viewDui{{ $cliente->dui }}"
                                                            value="{{ $cliente->dui }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="viewNombres{{ $cliente->dui }}">Nombres</label>
                                                        <input type="text" class="form-control" id="viewNombres{{ $cliente->dui }}"
                                                            value="{{ $cliente->Nombres }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="viewApellidos{{ $cliente->dui }}">Apellidos</label>
                                                        <input type="text" class="form-control" id="viewApellidos{{ $cliente->dui }}"
                                                            value="{{ $cliente->Apellidos }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="viewTelefono{{ $cliente->dui }}">Teléfono</label>
                                                        <input type="text" class="form-control" id="viewTelefono{{ $cliente->dui }}"
                                                            value="{{ $cliente->Telefono }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="viewCelular{{ $cliente->dui }}">Celular</label>
                                                        <input type="text" class="form-control" id="viewCelular{{ $cliente->dui }}"
                                                            value="{{ $cliente->Celular }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="viewTipoPersona{{ $cliente->dui }}">Tipo de Persona</label>
                                                        <input type="text" class="form-control" id="viewTipoPersona{{ $cliente->dui }}"
                                                            value="{{ $cliente->TipoPersona->Descripcion }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="viewDireccion{{ $cliente->dui }}">Dirección</label>
                                                        <input type="text" class="form-control" id="viewDireccion{{ $cliente->dui }}"
                                                            value="{{ $cliente->Direccion }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="viewFechaNacimiento{{ $cliente->dui }}">Fecha de Nacimiento</label>
                                                        <input type="date" class="form-control" id="viewFechaNacimiento{{ $cliente->dui }}"
                                                            value="{{ $cliente->Fecha_nacimiento }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-link ml-auto" data-bs-dismiss="modal">Cerrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection