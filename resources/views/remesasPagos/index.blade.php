@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Lista de Remesas Pagos'])

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Lista de Remesas Pagos</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="row">
                        <div class="col-md-4">
                            <button type="button" class="btn btn-block bg-gradient-primary mb-3 ms-3"
                                data-bs-toggle="modal" data-bs-target="#modal-default">Ingresar Remesa de Pago</button>

                            <!-- Modal para ingresar una nueva Remesa de Pago -->
                            <div class="modal fade" id="modal-default" tabindex="-1" role="dialog"
                                aria-labelledby="modal-default" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="modal-title" id="modal-title-default">Ingreso de Remesa de Pago</h6>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('remesasPagos.store') }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="bancoPagadorInput">Banco Pagador</label>
                                                    <input type="text" name="bancoPagador" class="form-control" id="bancoPagadorInput"
                                                        placeholder="Banco Pagador">
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
                                                    <label for="fechaPagoInput">Fecha de Pago</label>
                                                    <input type="date" name="FechaPago" class="form-control" id="fechaPagoInput">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="tipoCuentaPagadoraInput">Tipo de Cuenta Pagadora</label>
                                                    <input type="text" name="TipoCuentaPagadora" class="form-control" id="tipoCuentaPagadoraInput"
                                                        placeholder="Tipo de Cuenta Pagadora">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="tipoPagoInput">Tipo de Pago</label>
                                                    <input type="text" name="TipoPago" class="form-control" id="tipoPagoInput"
                                                        placeholder="Tipo de Pago">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="correoBeneficiarioInput">Correo Beneficiario</label>
                                                    <input type="email" name="CorreoBeneficiario" class="form-control" id="correoBeneficiarioInput"
                                                        placeholder="Correo Beneficiario">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="conceptoPagoInput">Concepto de Pago</label>
                                                    <input type="text" name="ConceptoPago" class="form-control" id="conceptoPagoInput"
                                                        placeholder="Concepto de Pago">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="montoPagarInput">Monto a Pagar</label>
                                                    <input type="text" name="MontoPagar" class="form-control" id="montoPagarInput"
                                                        placeholder="Monto a Pagar">
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

                        <!-- Tabla de Remesas de Pago -->
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Banco Pagador</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Cuenta Cliente</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fecha de Procesamiento</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Monto a Pagar</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($remesas as $remesa)
                                    <tr>
                                        <td>{{ $remesa->bancoPagador }}</td>
                                        <td>{{ $remesa->cuentaCliente }}</td>
                                        <td>{{ $remesa->detalle->FechaProcesamiento }}</td>
                                        <td>{{ $remesa->detalle->MontoPagar }}</td>
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

                                    <!-- Modal para Editar Remesa de Pago -->
                                    <div class="modal fade" id="editRemesaModal{{ $remesa->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="modal-default" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="modal-title-default">Editar Remesa de Pago</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('remesasPagos.update', $remesa->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="bancoPagadorInput{{ $remesa->id }}">Banco Pagador</label>
                                                            <input type="text" name="bancoPagador" class="form-control"
                                                                id="bancoPagadorInput{{ $remesa->id }}" value="{{ $remesa->bancoPagador }}">
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
                                                            <label for="fechaPagoInput{{ $remesa->id }}">Fecha de Pago</label>
                                                            <input type="date" name="FechaPago" class="form-control"
                                                                id="fechaPagoInput{{ $remesa->id }}" value="{{ $remesa->detalle->FechaPago }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="tipoCuentaPagadoraInput{{ $remesa->id }}">Tipo de Cuenta Pagadora</label>
                                                            <input type="text" name="TipoCuentaPagadora" class="form-control"
                                                                id="tipoCuentaPagadoraInput{{ $remesa->id }}" value="{{ $remesa->detalle->TipoCuentaPagadora }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="tipoPagoInput{{ $remesa->id }}">Tipo de Pago</label>
                                                            <input type="text" name="TipoPago" class="form-control"
                                                                id="tipoPagoInput{{ $remesa->id }}" value="{{ $remesa->detalle->TipoPago }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="correoBeneficiarioInput{{ $remesa->id }}">Correo Beneficiario</label>
                                                            <input type="email" name="CorreoBeneficiario" class="form-control"
                                                                id="correoBeneficiarioInput{{ $remesa->id }}" value="{{ $remesa->detalle->CorreoBeneficiario }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="conceptoPagoInput{{ $remesa->id }}">Concepto de Pago</label>
                                                            <input type="text" name="ConceptoPago" class="form-control"
                                                                id="conceptoPagoInput{{ $remesa->id }}" value="{{ $remesa->detalle->ConceptoPago }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="montoPagarInput{{ $remesa->id }}">Monto a Pagar</label>
                                                            <input type="text" name="MontoPagar" class="form-control"
                                                                id="montoPagarInput{{ $remesa->id }}" value="{{ $remesa->detalle->MontoPagar }}">
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

                                    <!-- Modal para Ver Remesa de Pago -->
                                    <div class="modal fade" id="viewRemesaModal{{ $remesa->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="modal-default" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="modal-title-default">Ver Remesa de Pago</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="viewBancoPagador{{ $remesa->id }}">Banco Pagador</label>
                                                        <input type="text" class="form-control" id="viewBancoPagador{{ $remesa->id }}"
                                                            value="{{ $remesa->bancoPagador }}" readonly>
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
                                                        <label for="viewFechaPago{{ $remesa->id }}">Fecha de Pago</label>
                                                        <input type="date" class="form-control" id="viewFechaPago{{ $remesa->id }}"
                                                            value="{{ $remesa->detalle->FechaPago }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="viewTipoCuentaPagadora{{ $remesa->id }}">Tipo de Cuenta Pagadora</label>
                                                        <input type="text" class="form-control" id="viewTipoCuentaPagadora{{ $remesa->id }}"
                                                            value="{{ $remesa->detalle->TipoCuentaPagadora }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="viewTipoPago{{ $remesa->id }}">Tipo de Pago</label>
                                                        <input type="text" class="form-control" id="viewTipoPago{{ $remesa->id }}"
                                                            value="{{ $remesa->detalle->TipoPago }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="viewCorreoBeneficiario{{ $remesa->id }}">Correo Beneficiario</label>
                                                        <input type="email" class="form-control" id="viewCorreoBeneficiario{{ $remesa->id }}"
                                                            value="{{ $remesa->detalle->CorreoBeneficiario }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="viewConceptoPago{{ $remesa->id }}">Concepto de Pago</label>
                                                        <input type="text" class="form-control" id="viewConceptoPago{{ $remesa->id }}"
                                                            value="{{ $remesa->detalle->ConceptoPago }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="viewMontoPagar{{ $remesa->id }}">Monto a Pagar</label>
                                                        <input type="text" class="form-control" id="viewMontoPagar{{ $remesa->id }}"
                                                            value="{{ $remesa->detalle->MontoPagar }}" readonly>
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
