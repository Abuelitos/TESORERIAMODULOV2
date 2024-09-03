@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Reportes'])

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Generar Reporte</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <form id="reporteForm">
                        <div class="row px-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="fechaDesde" class="form-label">Fecha Desde</label>
                                    <input type="date" name="fechaDesde" class="form-control" id="fechaDesde" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="fechaHasta" class="form-label">Fecha Hasta</label>
                                    <input type="date" name="fechaHasta" class="form-control" id="fechaHasta" required>
                                </div>
                            </div>
                        </div>
                        <div class="row px-4">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="tipoReporte" class="form-label">Tipo de Reporte</label>
                                    <select class="form-select" name="tipoReporte" id="tipoReporte" required>
                                        <option value="" disabled selected>Seleccione un tipo de reporte</option>
                                        <option value="Clientes">Clientes</option>
                                        <option value="Transferencias">Transferencias</option>
                                        <option value="NotasIngresos">Notas Ingresos</option>
                                        <option value="NotasEgresos">Notas Egresos</option>
                                        <option value="Cheques">Cheques</option>
                                        <option value="RemesasCobros">Remesas Cobros</option>
                                        <option value="RemesasPagos">Remesas Pagos</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row px-4">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-block bg-gradient-primary mb-3" onclick="generarReporte()">Generar Reporte</button>
                            </div>
                        </div>
                    </form>
                    <br>
                    <br>
                    <!-- Botón de exportación a Excel -->
                    <div class="row px-4">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-block bg-gradient-success mb-3" onclick="exportarExcel()">Exportar a Excel</button>
                        </div>
                    </div>

                    <!-- Tabla de reporte -->
                    <div class="table-responsive px-4">
                        <table class="table align-items-center mb-0" id="reporteTable">
                            <thead id="reporteHeader">
                                <!-- Encabezados de la tabla generados dinámicamente -->
                            </thead>
                            <tbody id="reporteBody">
                                <!-- Datos de la tabla generados dinámicamente -->
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

<!-- Librería para exportar a Excel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>

<script>
   function generarReporte() {
    const tipoReporte = document.getElementById('tipoReporte').value;
    const fechaDesde = document.getElementById('fechaDesde').value;
    const fechaHasta = document.getElementById('fechaHasta').value;

    if (!tipoReporte || !fechaDesde || !fechaHasta) {
        alert('Por favor completa todos los campos antes de generar el reporte.');
        return;
    }

    // Hacer una petición AJAX para obtener los datos
    fetch(`/api/reportes?tipoReporte=${tipoReporte}&desde=${fechaDesde}&hasta=${fechaHasta}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                let resultados = data.resultados;
                if (resultados.length > 0) {
                    let headers = Object.keys(resultados[0]).map(key => `<th>${key}</th>`).join('');
                    document.getElementById('reporteHeader').innerHTML = `<tr>${headers}</tr>`;

                    let html = '';
                    resultados.forEach(item => {
                        html += '<tr>';
                        for (let key in item) {
                            html += `<td>${item[key]}</td>`;
                        }
                        html += '</tr>';
                    });
                    document.getElementById('reporteBody').innerHTML = html;
                } else {
                    document.getElementById('reporteBody').innerHTML = '<tr><td colspan="100%">No se encontraron resultados</td></tr>';
                }
            } else {
                console.error('Error:', error);
                alert('Hubo un error en la solicitud');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Hubo un error en la solicitud');
        });
}


    function exportarExcel() {
        let table = document.getElementById('reporteTable');
        let wb = XLSX.utils.table_to_book(table, { sheet: "Sheet JS" });
        XLSX.writeFile(wb, 'reporte.xlsx');
    }
</script>

@endsection
