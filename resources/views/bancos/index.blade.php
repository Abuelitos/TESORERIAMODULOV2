@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Tables'])
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Lista de Bancos</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="row">
                        <div class="col-md-4">
                            <button type="button" class="btn btn-block bg-gradient-primary mb-3  ms-3"
                                data-bs-toggle="modal" data-bs-target="#modal-default">Ingresos de nuevos
                                Bancos</button>
                            <div class="modal fade" id="modal-default" tabindex="-1" role="dialog"
                                aria-labelledby="modal-default" aria-hidden="true">
                                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="modal-title" id="modal-title-default">Ingreso de Bnacos</h6>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form action="{{route('bancos.store')}}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1">Nombre del Bnaco</label>
                                                    <input type="text" name="Nombre" class="form-control"
                                                        id="exampleFormControlInput1" placeholder="Nombres">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn bg-gradient-primary">Save
                                                    changes</button>
                                                <button type="button" class="btn btn-link  ml-auto"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal for editing a bank -->
                        @foreach ($banco as $bancos)
                        <div class="modal fade" id="editBancoModal{{ $bancos->idbanco }}" tabindex="-1" role="dialog"
                            aria-labelledby="modal-default" aria-hidden="true">
                            <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="modal-title-default">Editar Banco</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('bancos.update', $bancos->idbanco) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="nombreBanco{{ $bancos->idbanco }}">Nombre del Banco</label>
                                                <input type="text" name="Nombre" class="form-control"
                                                    id="nombreBanco{{ $bancos->idbanco }}" value="{{ $bancos->nombre }}"
                                                    placeholder="Nombres">
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

                        <!-- Table with edit links -->
                        <div class="table-responsive">
                            <table class="table align-items-center">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Banco</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($banco as $bancos)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{$bancos->nombre}}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editBancoModal{{ $bancos->idbanco }}"
                                                data-original-title="Edit user">
                                                Editar
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="modal fade" id="messageModal" tabindex="-1" role="dialog"
                            aria-labelledby="messageModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="messageModalLabel">Mensaje</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @if (session('message'))
                                        {{ session('message') }}
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="modal-default" tabindex="-1" role="dialog"
                            aria-labelledby="modal-default" aria-hidden="true">
                            <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="modal-title-default">Ingreso de Bnacos</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <form action="{{route('bancos.store')}}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1">Nombre del Bnaco</label>
                                                <input type="text" name="Nombre" class="form-control"
                                                    id="exampleFormControlInput1" placeholder="Nombres">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn bg-gradient-primary">Save
                                                changes</button>
                                            <button type="button" class="btn btn-link  ml-auto"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endsection