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
                            <button type="button" class="btn btn-block bg-gradient-primary mb-3  ms-3" data-bs-toggle="modal" data-bs-target="#modal-default">Ingresos Cheques</button>
                            <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="modal-title" id="modal-title-default">Ingreso de Cheque</h6>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form action="{{route('cheques.store')}}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1">Lugar</label>
                                                    <input type="text" name="lugar" class="form-control" id="duiInput" placeholder="Lugar" maxlength="10">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1">Fecha</label>
                                                    <input type="date" name="Fecha" class="form-control" id="exampleFormControlInput1" placeholder="Nombres">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1">Banco Pagadr</label>
                                                    <!-- <input type="text" name="apellidos" class="form-control"
                                                        id="exampleFormControlInput1" placeholder="Apellidos"> -->
                                                    <select class="form-select" name="BancoPagador" aria-label="Default select example">
                                                        <option selected>Seleccione un Banco</option>
                                                        <option value="1">Banco Agricola</option>
                                                        <option value="2">Banco Promerica</option>
                                                        <option value="3">Banco Cuscatlan</option>
                                                        <option value="4">Banco Davivienda</option>
                                                        <option value="5">Banco Azul</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1">Cuenta de banco Pagador</label>
                                                    <input type="text" class="form-control" name="cuentaBancoPagador" id="exampleFormControlInput1" placeholder="Cuenta de Banco">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1">Monto Numeros</label>
                                                    <input type="number" name="direccion" class="form-control" id="exampleFormControlInput1" placeholder="Direccion">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1">Monto Letra</label>
                                                    <input type="text" name="telefono" class="form-control" id="exampleFormControlInput1" placeholder="Celular">
                                                </div>
                                                <div class="form-group">
                                                    <label for="firmas">Firmas</label>
                                                    <div class="form-check">
                                                        <input type="checkbox" name="firma" class="form-check-input" id="firmas">
                                                        <label class="form-check-label" for="firmas">Firma</label>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn bg-gradient-primary">Save
                                                    changes</button>
                                                <button type="button" class="btn btn-link  ml-auto" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive ">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Lugar</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Banco Pagador</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Monto</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Fecha</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Firma</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cheques as $cheque)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user1">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $cheque->Lugar}}</h6>                                                    
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{$cheque->BancoPagador}}</p>                                            
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm bg-gradient-success">{{$cheque->MontoNumeros}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{$cheque->Fecha}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{$cheque->Firma}}</span>
                                        </td>
                                        <td class="align-middle">
                                            <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                Edit
                                            </a>
                                        </td>
                                    </tr> 
                                    @endforeach                                                                       
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endsection