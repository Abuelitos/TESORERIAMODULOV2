@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Tables'])
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
                            <button type="button" class="btn btn-block bg-gradient-primary mb-3  ms-3"
                                data-bs-toggle="modal" data-bs-target="#modal-default">Ingresos de nuevos
                                Clientes</button>
                            <div class="modal fade" id="modal-default" tabindex="-1" role="dialog"
                                aria-labelledby="modal-default" aria-hidden="true">
                                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="modal-title" id="modal-title-default">Ingreso de Clientes</h6>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form action="{{route('clientes.store')}}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1">Dui</label>
                                                    <input type="text" name="dui" class="form-control" id="duiInput"
                                                        placeholder="Dui" maxlength="10">

                                                    <script>
                                                        document.getElementById('duiInput').addEventListener('input',
                                                            function(e) {
                                                                var target = e.target,
                                                                    position = target.selectionStart,
                                                                    length = target.value.length;
                                                                if (length === 8 && e.inputType !==
                                                                    "deleteContentBackward") {
                                                                    target.value = target.value + '-';
                                                                } else if (position === 9 && e.inputType ===
                                                                    "deleteContentBackward") {
                                                                    target.value = target.value.substring(0, 8);
                                                                }
                                                            });
                                                    </script>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1">Nombres</label>
                                                    <input type="text" name="nombres" class="form-control"
                                                        id="exampleFormControlInput1" placeholder="Nombres">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1">Apellidos</label>
                                                    <input type="text" name="apellidos" class="form-control"
                                                        id="exampleFormControlInput1" placeholder="Apellidos">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1">Fecha de Nacimiento</label>
                                                    <input type="date" class="form-control" name="fecha_nacimiento"
                                                        id="exampleFormControlInput1" placeholder="Fecha de Nacimiento">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1">Direccion</label>
                                                    <input type="text" name="direccion" class="form-control"
                                                        id="exampleFormControlInput1" placeholder="Direccion">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1">Telefono</label>
                                                    <input type="text" name="telefono" class="form-control"
                                                        id="exampleFormControlInput1" placeholder="Celular">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1">Celular</label>
                                                    <input type="text" name="celular" class="form-control"
                                                        id="exampleFormControlInput1" placeholder="Celular">
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
                        <div class="table-responsive ">
                            <table class="table align-items-center">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Dui</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Nombre Completo</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Fecha Nacimiento</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Direccion</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Celular</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clientes as $cliente)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{$cliente->dui}}</h6>
                                                    {{-- <p class="text-xs text-secondary mb-0">john@creative-tim.com</p> --}}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">
                                                        {{$cliente->Nombres.' '.$cliente->Apellidos}}</h6>
                                                    {{-- <p class="text-xs text-secondary mb-0">john@creative-tim.com</p> --}}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{$cliente->Fecha_nacimiento}}</p>
                                            {{-- <p class="text-xs text-secondary mb-0">Organization</p> --}}
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span
                                                class="badge badge-sm bg-gradient-success">{{$cliente->Direccion}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{$cliente->Celular}}</span>
                                        </td>
                                        <td class="align-middle">
                                            <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                                data-toggle="tooltip" data-original-title="Edit user">
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

        <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="messageModalLabel">Mensaje</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if (session('message'))
                        {{ session('message') }}
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            @if(!session('message'))
            Swal.fire({
                title: "Good job!",
                text: "{{ session('message') }}",
                icon: "success"
            });
            @endif
        </script>

        @endsection