@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Lista de Transferencias'])

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Lista de Transferencias</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="row">
                        <div class="col-md-4">
                            <button type="button" class="btn btn-block bg-gradient-primary mb-3 ms-3"
                                data-bs-toggle="modal" data-bs-target="#modal-default">Ingresar Transferencia</button>

                            <!-- Modal para ingresar una nueva Transferencia -->
                            <div class="modal fade" id="modal-default" tabindex="-1" role="dialog"
                                aria-labelledby="modal-default" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="modal-title" id="modal-title-default">Ingreso de Transferencia</h6>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('tranferencias.store') }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="lugarInput">Lugar</label>
                                                    <input type="text" name="Lugar" class="form-control" id="lugarInput"
                                                        placeholder="Lugar">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="fechaProcesamientoInput">Fecha de Procesamiento</label>
                                                    <input type="date" name="FechaProcesamiento" class="form-control" id="fechaProcesamientoInput">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="fechaEjecucionInput">Fecha de Ejecución</label>
                                                    <input type="date" name="FechaEjecucion" class="form-control" id="fechaEjecucionInput">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="bancoOrigenInput">Banco Origen</label>
                                                    <select class="form-select" name="BancoOrigen" id="bancoOrigenInput">
                                                        @foreach($bancos as $banco)
                                                        <option value="{{ $banco->idbanco }}">{{ $banco->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="cuentaBancoOrigenInput">Cuenta Banco Origen</label>
                                                    <input type="text" name="CuentaBancoOrigen" class="form-control" id="cuentaBancoOrigenInput">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="montoNumerosInput">Monto en Números</label>
                                                    <input type="text" name="MontoNumeros" class="form-control" id="montoNumerosInput">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="montosLetrasInput">Monto en Letras</label>
                                                    <input type="text" name="MontosLetras" class="form-control" id="montosLetrasInput">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="bancoDestinoInput">Banco Destino</label>
                                                    <select class="form-select" name="BancoDestino" id="bancoDestinoInput">
                                                        @foreach($bancos as $banco)
                                                        <option value="{{ $banco->idbanco }}">{{ $banco->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nombreReceptorInput">Nombre del Receptor</label>
                                                    <input type="text" name="NombreReceptor" class="form-control" id="nombreReceptorInput">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="cuentaBancoReceptorInput">Cuenta Banco Receptor</label>
                                                    <input type="text" name="CuentaBancoReceptor" class="form-control" id="cuentaBancoReceptorInput">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="montoNumerosDestinoInput">Monto en Números Destino</label>
                                                    <input type="text" name="MontoNumerosDestino" class="form-control" id="montoNumerosDestinoInput">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="montosLetrasDestinoInput">Monto en Letras Destino</label>
                                                    <input type="text" name="MontosLetrasDestino" class="form-control" id="montosLetrasDestinoInput">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="tipoTransferenciaInput">Tipo de Transferencia</label>
                                                    <input type="text" name="TipoTransferencia" class="form-control" id="tipoTransferenciaInput">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="conceptoTransferenciaInput">Concepto de Transferencia</label>
                                                    <input type="text" name="ConceptoTransferencia" class="form-control" id="conceptoTransferenciaInput">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="correoReceptorInput">Correo del Receptor</label>
                                                    <input type="email" name="CorreoReceptor" class="form-control" id="correoReceptorInput">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="telefonoReceptorInput">Teléfono del Receptor</label>
                                                    <input type="text" name="TelefonoReceptor" class="form-control" id="telefonoReceptorInput">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="direccionReceptorInput">Dirección del Receptor</label>
                                                    <input type="text" name="DireccionReceptor" class="form-control" id="direccionReceptorInput">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="paisInput">País</label>
                                                    <input type="text" name="Pais" class="form-control" id="paisInput">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="comisionesBancariasInput">Comisiones Bancarias</label>
                                                    <input type="text" name="ComisionesBancarias" class="form-control" id="comisionesBancariasInput">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="autorizaInput">Nombre de quien Autoriza</label>
                                                    <input type="text" name="NombreAutoriza" class="form-control" id="autorizaInput">
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

                        <!-- Tabla de Transferencias -->
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Lugar</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Banco Origen</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Monto</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Banco Destino</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Monto Destino</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($transferencias as $transferencia)
                                    <tr>
                                        <td>{{ $transferencia->Lugar }}</td>
                                        <td>{{ $transferencia->bancoOrigen->nombre }}</td>
                                        <td>{{ $transferencia->MontoNumeros }}</td>
                                        <td>{{ $transferencia->bancoDestino->nombre }}</td>
                                        <td>{{ $transferencia->MontoNumerosDestino }}</td>
                                        <td class="align-middle">
                                            {{-- <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                                data-bs-toggle="modal" data-bs-target="#editTransferenciaModal{{ $transferencia->ID }}">
                                                Editar
                                            </a> --}}
                                            {{-- | --}}
                                            <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                                data-bs-toggle="modal" data-bs-target="#viewTransferenciaModal{{ $transferencia->ID }}">
                                                Ver
                                            </a>
                                        </td>
                                    </tr>

                                    <!-- Modal para Editar Transferencia -->
                                    <div class="modal fade" id="editTransferenciaModal{{ $transferencia->ID }}" tabindex="-1" role="dialog"
                                        aria-labelledby="modal-default" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="modal-title-default">Editar Transferencia</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('tranferencias.update', $transferencia->ID) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="lugarInput{{ $transferencia->ID }}">Lugar</label>
                                                            <input type="text" name="Lugar" class="form-control"
                                                                id="lugarInput{{ $transferencia->ID }}" value="{{ $transferencia->Lugar }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="fechaProcesamientoInput{{ $transferencia->ID }}">Fecha de Procesamiento</label>
                                                            <input type="date" name="FechaProcesamiento" class="form-control"
                                                                id="fechaProcesamientoInput{{ $transferencia->ID }}" value="{{ $transferencia->FechaProcesamiento }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="fechaEjecucionInput{{ $transferencia->ID }}">Fecha de Ejecución</label>
                                                            <input type="date" name="FechaEjecucion" class="form-control"
                                                                id="fechaEjecucionInput{{ $transferencia->ID }}" value="{{ $transferencia->FechaEjecucion }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="bancoOrigenInput{{ $transferencia->ID }}">Banco Origen</label>
                                                            <select class="form-select" name="BancoOrigen" id="bancoOrigenInput{{ $transferencia->ID }}">
                                                                @foreach($bancos as $banco)
                                                                <option value="{{ $banco->idbanco }}" {{ $transferencia->BancoOrigen == $banco->idbanco ? 'selected' : '' }}>
                                                                    {{ $banco->nombre }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="cuentaBancoOrigenInput{{ $transferencia->ID }}">Cuenta Banco Origen</label>
                                                            <input type="text" name="CuentaBancoOrigen" class="form-control"
                                                                id="cuentaBancoOrigenInput{{ $transferencia->ID }}" value="{{ $transferencia->CuentaBancoOrigen }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="montoNumerosInput{{ $transferencia->ID }}">Monto en Números</label>
                                                            <input type="text" name="MontoNumeros" class="form-control"
                                                                id="montoNumerosInput{{ $transferencia->ID }}" value="{{ $transferencia->MontoNumeros }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="montosLetrasInput{{ $transferencia->ID }}">Monto en Letras</label>
                                                            <input type="text" name="MontosLetras" class="form-control"
                                                                id="montosLetrasInput{{ $transferencia->ID }}" value="{{ $transferencia->MontosLetras }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="bancoDestinoInput{{ $transferencia->ID }}">Banco Destino</label>
                                                            <select class="form-select" name="BancoDestino" id="bancoDestinoInput{{ $transferencia->ID }}">
                                                                @foreach($bancos as $banco)
                                                                <option value="{{ $banco->idbanco }}" {{ $transferencia->BancoDestino == $banco->idbanco ? 'selected' : '' }}>
                                                                    {{ $banco->nombre }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="nombreReceptorInput{{ $transferencia->ID }}">Nombre del Receptor</label>
                                                            <input type="text" name="NombreReceptor" class="form-control"
                                                                id="nombreReceptorInput{{ $transferencia->ID }}" value="{{ $transferencia->NombreReceptor }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="cuentaBancoReceptorInput{{ $transferencia->ID }}">Cuenta Banco Receptor</label>
                                                            <input type="text" name="CuentaBancoReceptor" class="form-control"
                                                                id="cuentaBancoReceptorInput{{ $transferencia->ID }}" value="{{ $transferencia->CuentaBancoReceptor }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="montoNumerosDestinoInput{{ $transferencia->ID }}">Monto en Números Destino</label>
                                                            <input type="text" name="MontoNumerosDestino" class="form-control"
                                                                id="montoNumerosDestinoInput{{ $transferencia->ID }}" value="{{ $transferencia->MontoNumerosDestino }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="montosLetrasDestinoInput{{ $transferencia->ID }}">Monto en Letras Destino</label>
                                                            <input type="text" name="MontosLetrasDestino" class="form-control"
                                                                id="montosLetrasDestinoInput{{ $transferencia->ID }}" value="{{ $transferencia->MontosLetrasDestino }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="tipoTransferenciaInput{{ $transferencia->ID }}">Tipo de Transferencia</label>
                                                            <input type="text" name="TipoTransferencia" class="form-control"
                                                                id="tipoTransferenciaInput{{ $transferencia->ID }}" value="{{ $transferencia->TipoTransferencia }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="conceptoTransferenciaInput{{ $transferencia->ID }}">Concepto de Transferencia</label>
                                                            <input type="text" name="ConceptoTransferencia" class="form-control"
                                                                id="conceptoTransferenciaInput{{ $transferencia->ID }}" value="{{ $transferencia->ConceptoTransferencia }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="correoReceptorInput{{ $transferencia->ID }}">Correo del Receptor</label>
                                                            <input type="email" name="CorreoReceptor" class="form-control"
                                                                id="correoReceptorInput{{ $transferencia->ID }}" value="{{ $transferencia->CorreoReceptor }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="telefonoReceptorInput{{ $transferencia->ID }}">Teléfono del Receptor</label>
                                                            <input type="text" name="TelefonoReceptor" class="form-control"
                                                                id="telefonoReceptorInput{{ $transferencia->ID }}" value="{{ $transferencia->TelefonoReceptor }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="direccionReceptorInput{{ $transferencia->ID }}">Dirección del Receptor</label>
                                                            <input type="text" name="DireccionReceptor" class="form-control"
                                                                id="direccionReceptorInput{{ $transferencia->ID }}" value="{{ $transferencia->DireccionReceptor }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="paisInput{{ $transferencia->ID }}">País</label>
                                                            <input type="text" name="Pais" class="form-control"
                                                                id="paisInput{{ $transferencia->ID }}" value="{{ $transferencia->Pais }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="comisionesBancariasInput{{ $transferencia->ID }}">Comisiones Bancarias</label>
                                                            <input type="text" name="ComisionesBancarias" class="form-control"
                                                                id="comisionesBancariasInput{{ $transferencia->ID }}" value="{{ $transferencia->ComisionesBancarias }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="autorizaInput{{ $transferencia->ID }}">Nombre de quien Autoriza</label>
                                                            <input type="text" name="NombreAutoriza" class="form-control"
                                                                id="autorizaInput{{ $transferencia->ID }}" value="{{ $transferencia->NombreAutoriza }}">
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

                                    <!-- Modal para Ver Transferencia -->
                                    <div class="modal fade" id="viewTransferenciaModal{{ $transferencia->ID }}" tabindex="-1" role="dialog"
                                        aria-labelledby="modal-default" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="modal-title-default">Ver Transferencia</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="viewLugar{{ $transferencia->ID }}">Lugar</label>
                                                        <input type="text" class="form-control" id="viewLugar{{ $transferencia->ID }}"
                                                            value="{{ $transferencia->Lugar }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="viewFechaProcesamiento{{ $transferencia->ID }}">Fecha de Procesamiento</label>
                                                        <input type="date" class="form-control" id="viewFechaProcesamiento{{ $transferencia->ID }}"
                                                            value="{{ $transferencia->FechaProcesamiento }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="viewFechaEjecucion{{ $transferencia->ID }}">Fecha de Ejecución</label>
                                                        <input type="date" class="form-control" id="viewFechaEjecucion{{ $transferencia->ID }}"
                                                            value="{{ $transferencia->FechaEjecucion }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="viewBancoOrigen{{ $transferencia->ID }}">Banco Origen</label>
                                                        <input type="text" class="form-control" id="viewBancoOrigen{{ $transferencia->ID }}"
                                                            value="{{ $transferencia->bancoOrigen->nombre }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="viewCuentaBancoOrigen{{ $transferencia->ID }}">Cuenta Banco Origen</label>
                                                        <input type="text" class="form-control" id="viewCuentaBancoOrigen{{ $transferencia->ID }}"
                                                            value="{{ $transferencia->CuentaBancoOrigen }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="viewMontoNumeros{{ $transferencia->ID }}">Monto en Números</label>
                                                        <input type="text" class="form-control" id="viewMontoNumeros{{ $transferencia->ID }}"
                                                            value="{{ $transferencia->MontoNumeros }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="viewMontosLetras{{ $transferencia->ID }}">Monto en Letras</label>
                                                        <input type="text" class="form-control" id="viewMontosLetras{{ $transferencia->ID }}"
                                                            value="{{ $transferencia->MontosLetras }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="viewBancoDestino{{ $transferencia->ID }}">Banco Destino</label>
                                                        <input type="text" class="form-control" id="viewBancoDestino{{ $transferencia->ID }}"
                                                            value="{{ $transferencia->bancoDestino->nombre }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="viewCuentaBancoReceptor{{ $transferencia->ID }}">Cuenta Banco Receptor</label>
                                                        <input type="text" class="form-control" id="viewCuentaBancoReceptor{{ $transferencia->ID }}"
                                                            value="{{ $transferencia->CuentaBancoReceptor }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="viewMontoNumerosDestino{{ $transferencia->ID }}">Monto en Números Destino</label>
                                                        <input type="text" class="form-control" id="viewMontoNumerosDestino{{ $transferencia->ID }}"
                                                            value="{{ $transferencia->MontoNumerosDestino }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="viewMontosLetrasDestino{{ $transferencia->ID }}">Monto en Letras Destino</label>
                                                        <input type="text" class="form-control" id="viewMontosLetrasDestino{{ $transferencia->ID }}"
                                                            value="{{ $transferencia->MontosLetrasDestino }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="viewTipoTransferencia{{ $transferencia->ID }}">Tipo de Transferencia</label>
                                                        <input type="text" class="form-control" id="viewTipoTransferencia{{ $transferencia->ID }}"
                                                            value="{{ $transferencia->TipoTransferencia }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="viewConceptoTransferencia{{ $transferencia->ID }}">Concepto de Transferencia</label>
                                                        <input type="text" class="form-control" id="viewConceptoTransferencia{{ $transferencia->ID }}"
                                                            value="{{ $transferencia->ConceptoTransferencia }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="viewCorreoReceptor{{ $transferencia->ID }}">Correo del Receptor</label>
                                                        <input type="email" class="form-control" id="viewCorreoReceptor{{ $transferencia->ID }}"
                                                            value="{{ $transferencia->CorreoReceptor }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="viewTelefonoReceptor{{ $transferencia->ID }}">Teléfono del Receptor</label>
                                                        <input type="text" class="form-control" id="viewTelefonoReceptor{{ $transferencia->ID }}"
                                                            value="{{ $transferencia->TelefonoReceptor }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="viewDireccionReceptor{{ $transferencia->ID }}">Dirección del Receptor</label>
                                                        <input type="text" class="form-control" id="viewDireccionReceptor{{ $transferencia->ID }}"
                                                            value="{{ $transferencia->DireccionReceptor }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="viewPais{{ $transferencia->ID }}">País</label>
                                                        <input type="text" class="form-control" id="viewPais{{ $transferencia->ID }}"
                                                            value="{{ $transferencia->Pais }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="viewComisionesBancarias{{ $transferencia->ID }}">Comisiones Bancarias</label>
                                                        <input type="text" class="form-control" id="viewComisionesBancarias{{ $transferencia->ID }}"
                                                            value="{{ $transferencia->ComisionesBancarias }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="viewAutoriza{{ $transferencia->ID }}">Nombre de quien Autoriza</label>
                                                        <input type="text" class="form-control" id="viewAutoriza{{ $transferencia->ID }}"
                                                            value="{{ $transferencia->NombreAutoriza }}" readonly>
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
