@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Tables'])
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Lista de Cheques</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="row">
                        <div class="col-md-4">
                            <!-- Botón para abrir el modal de ingreso de cheques -->
                            <button type="button" class="btn btn-block bg-gradient-primary mb-3 ms-3"
                                data-bs-toggle="modal" data-bs-target="#modal-default">Ingresar Cheque</button>

                            <!-- Modal para ingresar un nuevo cheque -->
                            <div class="modal fade" id="modal-default" tabindex="-1" role="dialog"
                                aria-labelledby="modal-default" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="modal-title" id="modal-title-default">Ingreso de Cheque</h6>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form action="{{route('cheques.store')}}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="lugarCheque">Lugar</label>
                                                    <input type="text" name="Lugar" class="form-control" id="lugarCheque"
                                                        placeholder="Lugar">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="fechaCheque">Fecha</label>
                                                    <input type="date" name="Fecha" class="form-control" id="fechaCheque"
                                                        placeholder="Fecha">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="bancoPagador">Banco Pagador</label>
                                                    <select class="form-select" name="BancoPagador" aria-label="Seleccione un banco" id="bancoPagador">
                                                        <option selected disabled>Seleccione un Banco</option>
                                                        @foreach($bancos as $banco)
                                                            <option value="{{ $banco->idbanco }}">{{ $banco->nombre }}</option>
                                                        @endforeach
                                                    </select>                                                    
                                                </div>
                                                <div class="mb-3">
                                                    <label for="cuentaBancoPagador">Cuenta de banco Pagador</label>
                                                    <input type="text" name="CuentaBancoPagador" class="form-control"
                                                        id="cuentaBancoPagador" placeholder="Cuenta de Banco">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="montoNumeros">Monto en Números</label>
                                                    <input type="text" name="MontoNumeros" class="form-control"
                                                        id="montoNumeros" placeholder="Monto en Números">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="montoLetras">Monto en Letras</label>
                                                    <input type="text" name="MontosLetras" class="form-control"
                                                        id="montoLetras" placeholder="Monto en Letras">
                                                </div>
                                                <div class="form-group">
                                                    <label for="firmas">Firmas</label>
                                                    <div class="form-check">
                                                        <input type="checkbox" name="Firmas" class="form-check-input"
                                                            id="firmas">
                                                        <label class="form-check-label" for="firmas">Firma</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn bg-gradient-primary">Guardar
                                                    cambios</button>
                                                <button type="button" class="btn btn-link ml-auto"
                                                    data-bs-dismiss="modal">Cerrar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal para editar un cheque -->
                        @foreach ($cheques as $cheque)
                        <div class="modal fade" id="editChequeModal{{ $cheque->ID }}" tabindex="-1" role="dialog"
                            aria-labelledby="modal-default" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="modal-title-default">Editar Cheque</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('cheques.update', $cheque->ID) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="lugarCheque{{ $cheque->ID }}">Lugar</label>
                                                <input type="text" name="Lugar" class="form-control"
                                                    id="lugarCheque{{ $cheque->ID }}" value="{{ $cheque->Lugar }}"
                                                    placeholder="Lugar">
                                            </div>
                                            <div class="mb-3">
                                                <label for="fechaCheque{{ $cheque->ID }}">Fecha</label>
                                                <input type="date" name="Fecha" class="form-control"
                                                    id="fechaCheque{{ $cheque->ID }}" value="{{ $cheque->Fecha }}"
                                                    placeholder="Fecha">
                                            </div>
                                            <div class="mb-3">
                                                <label for="bancoPagador{{ $cheque->ID }}">Banco Pagador</label>
                                                <select class="form-select" name="BancoPagador" aria-label="Seleccione un banco" id="bancoPagador{{ $cheque->ID }}">
                                                    <option disabled>Seleccione un Banco</option>
                                                    @foreach($bancos as $banco)
                                                        <option value="{{ $banco->idbanco }}" {{ $cheque->BancoPagador == $banco->idbanco ? 'selected' : '' }}>
                                                            {{ $banco->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                
                                            </div>
                                            <div class="mb-3">
                                                <label for="cuentaBancoPagador{{ $cheque->ID }}">Cuenta de banco Pagador</label>
                                                <input type="text" name="CuentaBancoPagador" class="form-control"
                                                    id="cuentaBancoPagador{{ $cheque->ID }}" value="{{ $cheque->CuentaBancoPagador }}"
                                                    placeholder="Cuenta de Banco">
                                            </div>
                                            <div class="mb-3">
                                                <label for="montoNumeros{{ $cheque->ID }}">Monto en Números</label>
                                                <input type="text" name="MontoNumeros" class="form-control"
                                                    id="montoNumeros{{ $cheque->ID }}" value="{{ $cheque->MontoNumeros }}"
                                                    placeholder="Monto en Números">
                                            </div>
                                            <div class="mb-3">
                                                <label for="montoLetras{{ $cheque->ID }}">Monto en Letras</label>
                                                <input type="text" name="MontosLetras" class="form-control"
                                                    id="montoLetras{{ $cheque->ID }}" value="{{ $cheque->MontosLetras }}"
                                                    placeholder="Monto en Letras">
                                            </div>
                                            <div class="form-group">
                                                <label for="firmas{{ $cheque->ID }}">Firmas</label>
                                                <div class="form-check">
                                                    <input type="checkbox" name="Firmas" class="form-check-input"
                                                        id="firmas{{ $cheque->ID }}" {{ $cheque->Firmas ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="firmas{{ $cheque->ID }}">Firma</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn bg-gradient-primary">Guardar
                                                cambios</button>
                                            <button type="button" class="btn btn-link ml-auto"
                                                data-bs-dismiss="modal">Cerrar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <!-- Tabla con enlaces de edición -->
                        <div class="table-responsive">
                            <table class="table align-items-center">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Lugar</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Banco Pagador</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Monto</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fecha</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cheques as $cheque)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $cheque->Lugar }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $cheque->banco->nombre }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm bg-gradient-success">{{ $cheque->MontoNumeros }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $cheque->Fecha }}</span>
                                        </td>
                                        <td class="align-middle">
                                            <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editChequeModal{{ $cheque->ID }}"
                                                data-original-title="Edit cheque">
                                                Editar
                                            </a>
                                            <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                                data-bs-toggle="modal"
                                                data-bs-target="#viewChequeModal{{ $cheque->ID }}"
                                                data-original-title="View cheque">
                                                Ver
                                            </a>
                                        </td>
                                    </tr>
                                    @foreach ($cheques as $cheque)
                                        <div class="modal fade" id="viewChequeModal{{ $cheque->ID }}" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title" id="modal-title-default">Ver Cheque</h6>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="viewLugar{{ $cheque->ID }}">Lugar</label>
                                                            <input type="text" class="form-control" id="viewLugar{{ $cheque->ID }}" value="{{ $cheque->Lugar }}" readonly>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="viewFecha{{ $cheque->ID }}">Fecha</label>
                                                            <input type="date" class="form-control" id="viewFecha{{ $cheque->ID }}" value="{{ $cheque->Fecha }}" readonly>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="viewBancoPagador{{ $cheque->ID }}">Banco Pagador</label>
                                                            <input type="text" class="form-control" id="viewBancoPagador{{ $cheque->ID }}" value="{{ $cheque->banco->nombre }}" readonly>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="viewCuentaBancoPagador{{ $cheque->ID }}">Cuenta de banco Pagador</label>
                                                            <input type="text" class="form-control" id="viewCuentaBancoPagador{{ $cheque->ID }}" value="{{ $cheque->CuentaBancoPagador }}" readonly>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="viewMontoNumeros{{ $cheque->ID }}">Monto en Números</label>
                                                            <input type="text" class="form-control" id="viewMontoNumeros{{ $cheque->ID }}" value="{{ $cheque->MontoNumeros }}" readonly>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="viewMontoLetras{{ $cheque->ID }}">Monto en Letras</label>
                                                            <input type="text" class="form-control" id="viewMontoLetras{{ $cheque->ID }}" value="{{ $cheque->MontosLetras }}" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="viewFirmas{{ $cheque->ID }}">Firmas</label>
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input" id="viewFirmas{{ $cheque->ID }}" {{ $cheque->Firmas ? 'checked' : '' }} disabled>
                                                                <label class="form-check-label" for="viewFirmas{{ $cheque->ID }}">Firma</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-link ml-auto" data-bs-dismiss="modal">Cerrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach

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
