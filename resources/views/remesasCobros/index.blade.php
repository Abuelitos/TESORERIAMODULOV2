@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Lista de Remesas Cobros'])

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Lista de Remesas Cobros</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="row">
                        <div class="col-md-4">
                            <button type="button" class="btn btn-block bg-gradient-primary mb-3 ms-3"
                                data-bs-toggle="modal" data-bs-target="#modal-default">Ingresar Remesa de Cobro</button>

                            <!-- Modal para ingresar una nueva Remesa de Cobro -->
                            <div class="modal fade" id="modal-default" tabindex="-1" role="dialog"
                                aria-labelledby="modal-default" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="modal-title" id="modal-title-default">Ingreso de Remesa de Cobro</h6>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('remesasCobros.store') }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="bancoColectorInput">Banco Colector</label>
                                                    <input type="text" name="bancoColector" class="form-control" id="bancoColectorInput"
                                                        placeholder="Banco Colector">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="cuentaClienteInput">Cuenta Cliente</label>
                                                    <input type="text" name="cuentaCliente" class="form-control" id="cuentaClienteInput"
                                                        placeholder="Cuenta Cliente">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="fechaProcesamientoInput">Fecha de Procesamiento</label>
                                                    <input type="date" name="FechaProcesamiento" class="form-control" id="fechaProcesamientoInput">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="fechaCobroInput">Fecha de Cobro</label>
                                                    <input type="date" name="FechaCobro" class="form-control" id="fechaCobroInput">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="tipoCuentaColectoraInput">Tipo de Cuenta Colectora</label>
                                                    <input type="text" name="TipoCuentaColectora" class="form-control" id="tipoCuentaColectoraInput"
                                                        placeholder="Tipo de Cuenta Colectora">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="tipoCobroInput">Tipo de Cobro</label>
                                                    <input type="text" name="TipoCobro" class="form-control" id="tipoCobroInput"
                                                        placeholder="Tipo de Cobro">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="correoClienteInput">Correo Cliente</label>
                                                    <input type="email" name="CorreoCliente" class="form-control" id="correoClienteInput"
                                                        placeholder="Correo Cliente">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="conceptoCobroInput">Concepto de Cobro</label>
                                                    <input type="text" name="ConceptoCobro" class="form-control" id="conceptoCobroInput"
                                                        placeholder="Concepto de Cobro">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="montoCobrarInput">Monto a Cobrar</label>
                                                    <input type="text" name="MontoCobrar" class="form-control" id="montoCobrarInput"
                                                        placeholder="Monto a Cobrar">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="autorizaInput">Nombre de quien Autoriza</label>
                                                    <input type="text" name="NombreAutoriza" class="form-control" id="autorizaInput"
                                                        placeholder="Nombre de quien Autoriza">
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

                        <!-- Tabla de Remesas de Cobro -->
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Banco Colector</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Cuenta Cliente</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fecha de Procesamiento</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Monto a Cobrar</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($remesas as $remesa)
                                    <tr>
                                        <td>{{ $remesa->bancoColector }}</td>
                                        <td>{{ $remesa->cuentaCliente }}</td>
                                        <td>{{ $remesa->detalle->FechaProcesamiento }}</td>
                                        <td>{{ $remesa->detalle->MontoCobrar }}</td>
                                        <td class="align-middle">
                                            <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                                data-bs-toggle="modal" data-bs-target="#editRemesaModal{{ $remesa->id }}">
                                                Editar
                                            </a>
                                            |
                                            <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                                data-bs-toggle="modal" data-bs-target="#viewRemesaModal{{ $remesa->id }}">
                                                Ver
                                            </a>
                                        </td>
                                    </tr>

                                    <!-- Modal para Editar Remesa de Cobro -->
                                    <div class="modal fade" id="editRemesaModal{{ $remesa->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="modal-default" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="modal-title-default">Editar Remesa de Cobro</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('remesasCobros.update', $remesa->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="bancoColectorInput{{ $remesa->id }}">Banco Colector</label>
                                                            <input type="text" name="bancoColector" class="form-control"
                                                                id="bancoColectorInput{{ $remesa->id }}" value="{{ $remesa->bancoColector }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="cuentaClienteInput{{ $remesa->id }}">Cuenta Cliente</label>
                                                            <input type="text" name="cuentaCliente" class="form-control"
                                                                id="cuentaClienteInput{{ $remesa->id }}" value="{{ $remesa->cuentaCliente }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="fechaProcesamientoInput{{ $remesa->id }}">Fecha de Procesamiento</label>
                                                            <input type="date" name="FechaProcesamiento" class="form-control"
                                                                id="fechaProcesamientoInput{{ $remesa->id }}" value="{{ $remesa->detalle->FechaProcesamiento }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="fechaCobroInput{{ $remesa->id }}">Fecha de Cobro</label>
                                                            <input type="date" name="FechaCobro" class="form-control"
                                                                id="fechaCobroInput{{ $remesa->id }}" value="{{ $remesa->detalle->FechaCobro }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="tipoCuentaColectoraInput{{ $remesa->id }}">Tipo de Cuenta Colectora</label>
                                                            <input type="text" name="TipoCuentaColectora" class="form-control"
                                                                id="tipoCuentaColectoraInput{{ $remesa->id }}" value="{{ $remesa->detalle->TipoCuentaColectora }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="tipoCobroInput{{ $remesa->id }}">Tipo de Cobro</label>
                                                            <input type="text" name="TipoCobro" class="form-control"
                                                                id="tipoCobroInput{{ $remesa->id }}" value="{{ $remesa->detalle->TipoCobro }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="correoClienteInput{{ $remesa->id }}">Correo Cliente</label>
                                                            <input type="email" name="CorreoCliente" class="form-control"
                                                                id="correoClienteInput{{ $remesa->id }}" value="{{ $remesa->detalle->CorreoCliente }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="conceptoCobroInput{{ $remesa->id }}">Concepto de Cobro</label>
                                                            <input type="text" name="ConceptoCobro" class="form-control"
                                                                id="conceptoCobroInput{{ $remesa->id }}" value="{{ $remesa->detalle->ConceptoCobro }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="montoCobrarInput{{ $remesa->id }}">Monto a Cobrar</label>
                                                            <input type="text" name="MontoCobrar" class="form-control"
                                                                id="montoCobrarInput{{ $remesa->id }}" value="{{ $remesa->detalle->MontoCobrar }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="autorizaInput{{ $remesa->id }}">Nombre de quien Autoriza</label>
                                                            <input type="text" name="NombreAutoriza" class="form-control"
                                                                id="autorizaInput{{ $remesa->id }}" value="{{ $remesa->detalle->NombreAutoriza }}">
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

                                    <!-- Modal para Ver Remesa de Cobro -->
                                    <div class="modal fade" id="viewRemesaModal{{ $remesa->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="modal-default" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="modal-title-default">Ver Remesa de Cobro</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="viewBancoColector{{ $remesa->id }}">Banco Colector</label>
                                                        <input type="text" class="form-control" id="viewBancoColector{{ $remesa->id }}"
                                                            value="{{ $remesa->bancoColector }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="viewCuentaCliente{{ $remesa->id }}">Cuenta Cliente</label>
                                                        <input type="text" class="form-control" id="viewCuentaCliente{{ $remesa->id }}"
                                                            value="{{ $remesa->cuentaCliente }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="viewFechaProcesamiento{{ $remesa->id }}">Fecha de Procesamiento</label>
                                                        <input type="date" class="form-control" id="viewFechaProcesamiento{{ $remesa->id }}"
                                                            value="{{ $remesa->detalle->FechaProcesamiento }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="viewFechaCobro{{ $remesa->id }}">Fecha de Cobro</label>
                                                        <input type="date" class="form-control" id="viewFechaCobro{{ $remesa->id }}"
                                                            value="{{ $remesa->detalle->FechaCobro }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="viewTipoCuentaColectora{{ $remesa->id }}">Tipo de Cuenta Colectora</label>
                                                        <input type="text" class="form-control" id="viewTipoCuentaColectora{{ $remesa->id }}"
                                                            value="{{ $remesa->detalle->TipoCuentaColectora }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="viewTipoCobro{{ $remesa->id }}">Tipo de Cobro</label>
                                                        <input type="text" class="form-control" id="viewTipoCobro{{ $remesa->id }}"
                                                            value="{{ $remesa->detalle->TipoCobro }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="viewCorreoCliente{{ $remesa->id }}">Correo Cliente</label>
                                                        <input type="email" class="form-control" id="viewCorreoCliente{{ $remesa->id }}"
                                                            value="{{ $remesa->detalle->CorreoCliente }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="viewConceptoCobro{{ $remesa->id }}">Concepto de Cobro</label>
                                                        <input type="text" class="form-control" id="viewConceptoCobro{{ $remesa->id }}"
                                                            value="{{ $remesa->detalle->ConceptoCobro }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="viewMontoCobrar{{ $remesa->id }}">Monto a Cobrar</label>
                                                        <input type="text" class="form-control" id="viewMontoCobrar{{ $remesa->id }}"
                                                            value="{{ $remesa->detalle->MontoCobrar }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="viewAutoriza{{ $remesa->id }}">Nombre de quien Autoriza</label>
                                                        <input type="text" class="form-control" id="viewAutoriza{{ $remesa->id }}"
                                                            value="{{ $remesa->detalle->NombreAutoriza }}" readonly>
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
