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
                                                    <input type="text" name="FormaCobro" class="form-control" id="formaInput"
                                                        placeholder="Forma de Cobro">
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
                                                            <input type="text" name="FormaCobro" class="form-control"
                                                                id="formaInput{{ $nota->ID }}" value="{{ $nota->FormaCobro }}">
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
<script>
    document.getElementById('duiInput').addEventListener('input', function() {
        let dui = this.value;
        if (dui.length === 10) {  // Asumiendo que el DUI tiene exactamente 10 caracteres
            fetch(`/clientes/buscar?dui=${dui}`)  // Aquí se envía el DUI como un parámetro en la URL
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('nombreClienteInput').value = `${data.cliente.Nombres} ${data.cliente.Apellidos}`;
                    } else {
                        document.getElementById('nombreClienteInput').value = 'Cliente no encontrado';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('nombreClienteInput').value = 'Error en la búsqueda';
                });
        } else {
            document.getElementById('nombreClienteInput').value = '';
        }
    });

</script>
@endsection


