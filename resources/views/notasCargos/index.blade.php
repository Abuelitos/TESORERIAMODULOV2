@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Lista de Notas de Cargo'])

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Lista de Notas de Cargo</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="row">
                        <div class="col-md-4">
                            <button type="button" class="btn btn-block bg-gradient-primary mb-3 ms-3"
                                data-bs-toggle="modal" data-bs-target="#modal-default">Ingresar Nota de Cargo</button>

                            <!-- Modal para ingresar una nueva Nota de Cargo -->
                            <div class="modal fade" id="modal-default" tabindex="-1" role="dialog"
                                aria-labelledby="modal-default" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="modal-title" id="modal-title-default">Ingreso de Nota de Cargo</h6>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('notasCargos.store') }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="lugarInput">Lugar</label>
                                                    <input type="text" name="Lugar" class="form-control" id="lugarInput"
                                                        placeholder="Lugar">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="fechaInput">Fecha</label>
                                                    <input type="date" name="Fecha" class="form-control" id="fechaInput"
                                                        placeholder="Fecha">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="duiInput">DUI del Cliente</label>
                                                    <input type="text" name="cliente_dui" class="form-control" id="duiInput"
                                                        placeholder="Ingrese el DUI">
                                                    <button type="button" id="buscarDuiBtn" class="btn btn-primary mt-2" onclick="buscarClientePorDui()">Buscar</button>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nombreClienteInput">Nombre del Cliente</label>
                                                    <input type="text" class="form-control" id="nombreClienteInput"
                                                        placeholder="Nombre del Cliente" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="conceptoInput">Concepto de Cobro</label>
                                                    <input type="text" class="form-control" name="ConceptoCargo" id="conceptoInput"
                                                        placeholder="Concepto de Cobro">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="facturaInput">Número de Factura</label>
                                                    <input type="text" name="NumeroFactura" class="form-control"
                                                        id="facturaInput" placeholder="Número de Factura">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="formaInput">Forma de Cobro</label>
                                                    <select class="form-select" name="FormaCobro" aria-label="Seleccione un Tipo de Persona" id="FormaAbono">
                                                        <option selected disabled>Seleccione un tipo de abono</option>
                                                        @foreach($tiposTransferencia as $t)
                                                            <option value="{{ $t->ID }}">{{ $t->Descripcion }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="comentariosInput">Comentarios</label>
                                                    <input type="text" name="Comentarios" class="form-control"
                                                        id="comentariosInput" placeholder="Comentarios">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="autorizaInput">Nombre de quien Autoriza</label>
                                                    <input type="text" name="NombreAutoriza" class="form-control"
                                                        id="autorizaInput" placeholder="Nombre de quien Autoriza">
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

                        <!-- Tabla de Notas de Cargo -->
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Lugar</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Cliente</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Fecha</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Concepto</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($notasCargo as $nota)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $nota->Lugar }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $nota->cliente->Nombres }} {{ $nota->cliente->Apellidos }}</p>
                                            <p class="text-xs text-secondary mb-0">{{ $nota->cliente_dui }}</p>
                                        </td>
                                        <td>
                                            <span class="text-secondary text-xs font-weight-bold">{{ $nota->Fecha }}</span>
                                        </td>
                                        <td>
                                            <span class="text-secondary text-xs font-weight-bold">{{ $nota->ConceptoCargo }}</span>
                                        </td>
                                        <td class="align-middle">
                                            <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                                data-bs-toggle="modal" data-bs-target="#editNotaModal{{ $nota->ID }}">
                                                Editar
                                            </a>
                                            |
                                            <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                                data-bs-toggle="modal" data-bs-target="#viewNotaModal{{ $nota->ID }}">
                                                Ver
                                            </a>
                                        </td>
                                    </tr>

                                    <!-- Modal para Editar Nota de Cargo -->
                                    <div class="modal fade" id="editNotaModal{{ $nota->ID }}" tabindex="-1" role="dialog"
                                        aria-labelledby="modal-default" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="modal-title-default">Editar Nota de Cargo</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('notasCargos.update', $nota->ID) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="lugarInput{{ $nota->ID }}">Lugar</label>
                                                            <input type="text" name="Lugar" class="form-control"
                                                                id="lugarInput{{ $nota->ID }}" value="{{ $nota->Lugar }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="fechaInput{{ $nota->ID }}">Fecha</label>
                                                            <input type="date" name="Fecha" class="form-control"
                                                                id="fechaInput{{ $nota->ID }}" value="{{ $nota->Fecha }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="clienteSelect{{ $nota->ID }}">Cliente</label>
                                                            <input type="text" name="cliente_dui" class="form-control"
                                                                id="clienteSelect{{ $nota->ID }}" value="{{ $nota->cliente_dui }}" readonly>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="conceptoInput{{ $nota->ID }}">Concepto de Cobro</label>
                                                            <input type="text" name="ConceptoCargo" class="form-control"
                                                                id="conceptoInput{{ $nota->ID }}" value="{{ $nota->ConceptoCargo }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="facturaInput{{ $nota->ID }}">Número de Factura</label>
                                                            <input type="text" name="NumeroFactura" class="form-control"
                                                                id="facturaInput{{ $nota->ID }}" value="{{ $nota->NumeroFactura }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="formaInput{{ $nota->ID }}">Forma de Cobro</label>
                                                            <select class="form-select" name="FormaCobro" aria-label="Seleccione un Tipo de Persona" id="tipoPersona{{ $nota->FormaCobro }}">
                                                                <option selected disabled>Seleccione un tipo de persona</option>
                                                                @foreach($tiposTransferencia as $t)
                                                                    <option value="{{ $t->ID }}" {{ $t->ID == $nota->FormaCobro ? 'selected' : '' }}>{{ $t->Descripcion }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="comentariosInput{{ $nota->ID }}">Comentarios</label>
                                                            <input type="text" name="Comentarios" class="form-control"
                                                                id="comentariosInput{{ $nota->ID }}" value="{{ $nota->Comentarios }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="autorizaInput{{ $nota->ID }}">Nombre de quien Autoriza</label>
                                                            <input type="text" name="NombreAutoriza" class="form-control"
                                                                id="autorizaInput{{ $nota->ID }}" value="{{ $nota->NombreAutoriza }}">
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

                                    <!-- Modal para Ver Nota de Cargo -->
                                    <div class="modal fade" id="viewNotaModal{{ $nota->ID }}" tabindex="-1" role="dialog"
                                        aria-labelledby="modal-default" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="modal-title-default">Ver Nota de Cargo</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="viewLugar{{ $nota->ID }}">Lugar</label>
                                                        <input type="text" class="form-control" id="viewLugar{{ $nota->ID }}"
                                                            value="{{ $nota->Lugar }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="viewFecha{{ $nota->ID }}">Fecha</label>
                                                        <input type="date" class="form-control" id="viewFecha{{ $nota->ID }}"
                                                            value="{{ $nota->Fecha }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="viewCliente{{ $nota->ID }}">Cliente</label>
                                                        <input type="text" class="form-control" id="viewCliente{{ $nota->ID }}"
                                                            value="{{ $nota->cliente->Nombres }} {{ $nota->cliente->Apellidos }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="viewConcepto{{ $nota->ID }}">Concepto de Cobro</label>
                                                        <input type="text" class="form-control" id="viewConcepto{{ $nota->ID }}"
                                                            value="{{ $nota->ConceptoCobro }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="viewFactura{{ $nota->ID }}">Número de Factura</label>
                                                        <input type="text" class="form-control" id="viewFactura{{ $nota->ID }}"
                                                            value="{{ $nota->NumeroFactura }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="viewForma{{ $nota->ID }}">Forma de Cobro</label>
                                                        <input type="text" class="form-control" id="viewForma{{ $nota->ID }}"
                                                            value="{{ $nota->FormaCobro }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="viewComentarios{{ $nota->ID }}">Comentarios</label>
                                                        <input type="text" class="form-control" id="viewComentarios{{ $nota->ID }}"
                                                            value="{{ $nota->Comentarios }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="viewAutoriza{{ $nota->ID }}">Nombre de quien Autoriza</label>
                                                        <input type="text" class="form-control" id="viewAutoriza{{ $nota->ID }}"
                                                            value="{{ $nota->NombreAutoriza }}" readonly>
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
<!-- Add jQuery and Inputmask here -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>

<script>
    $(document).ready(function(){
        $('#duiInput').inputmask('99999999-9');  // Formato del DUI
    });
</script>

<script>
    function buscarClientePorDui() {
        var dui = document.getElementById('duiInput').value;

        $.ajax({
            url: '{{ url('clientes/buscar') }}/' + dui, // URL is updated to include the DUI
            method: 'GET',
            success: function(response) {
                if(response.success) {
                    document.getElementById('nombreClienteInput').value = response.cliente.Nombres + ' ' + response.cliente.Apellidos;
                } else {
                    alert(response.message);
                }
            },
            error: function() {
                alert('Error al buscar el cliente.');
            }
        });
    }
</script>
@endsection


