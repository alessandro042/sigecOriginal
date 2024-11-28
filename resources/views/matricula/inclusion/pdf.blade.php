<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte de Igualdad de Género</title>
    <style>
        /* Estilos globales */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 5px;
            /* Reducido para ahorrar espacio */
            line-height: 1.3;
        }

        .page {
            page-break-after: always;
            margin-bottom: 5px;
            /* Reducido el espacio entre páginas */
        }

        .card {
            background-color: #fff;
            box-shadow: 0 0 3px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            padding: 5px;
            /* Reducido para compactar */
            margin-bottom: 8px;
            page-break-inside: avoid;
            /* Evita que se divida entre páginas */
        }

        .card-title {
            font-size: 1.3rem;
            /* Tamaño del título reducido */
            margin-bottom: 3px;
            border-bottom: 2px solid #3498db;
            /* Línea separadora */
            padding-bottom: 3px;
            color: #3498db;
            /* Color del título */
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 3px;
            /* Espacio sobre la tabla reducido */
        }

        .table th,
        .table td {
            padding: 4px;
            /* Reducido el padding */
            text-align: center;
            border: none;
            /* Eliminado el borde para una apariencia más limpia */
        }

        .table th {
            background-color: #f0f0f0;
            font-size: 0.9rem;
            /* Tamaño de la fuente reducido */
            color: #333;
        }

        .table td {
            font-size: 0.85rem;
            /* Tamaño de la fuente reducido */
        }

        .table tr:nth-child(even) {
            background-color: #f9f9f9;
            /* Fondo alternado para filas pares */
        }
    </style>

</head>

<body>
    @php
    $sumaTotalMotriz=0;
    $sumaTotalVisual=0;
    $sumaTotalAuditiva=0;
    $sumaTotalCognitiva=0;
    $sumaTotalTranstornoConducta=0;
    $sumaTotalOtros = 0;
    $sumaTotalTotal = 0;
    @endphp

    <!-- Tabla general de totales por institución -->
    <div class="card">
        <h2 class="card-title">Totales por Institución</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Institución</th>
                    <th>Motriz</th>
                    <th>Visual</th>
                    <th>Auditiva</th>
                    <th>Cognitiva</th>
                    <th>Transtorno de Conducta</th>
                    <th>Otros</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reportData->groupBy('programaEducativo.unidadAcademica.institucion.institucion') as $institucion => $dataGroup)
                @php
                $totalMotriz= $dataGroup->sum('motriz');
                $totalVisual = $dataGroup->sum('visual');
                $totalAuditiva = $dataGroup->sum('auditiva');
                $totalCognitiva = $dataGroup->sum('cognitiva');
                $totalTranstornoConducta = $dataGroup->sum('transtorno_conducta');
                $totalOtros = $dataGroup->sum('otros');
                $totalTotal = $totalMotriz + $totalVisual + $totalAuditiva + $totalCognitiva + $totalTranstornoConducta + $totalOtros;
                $sumaTotalMotriz += $totalMotriz;
                $sumaTotalVisual += $totalVisual;
                $sumaTotalAuditiva += $totalAuditiva;
                $sumaTotalCognitiva += $totalCognitiva;
                $sumaTotalTranstornoConducta += $totalTranstornoConducta;
                $sumaTotalOtros += $totalOtros;
                $sumaTotalTotal += $totalTotal;
                @endphp
                <tr>
                    <td>{{ $institucion }}</td>
                    <td>{{ $totalMotriz }}</td>
                    <td>{{ $totalVisual }}</td>
                    <td>{{ $totalAuditiva }}</td>
                    <td>{{ $totalCognitiva }}</td>
                    <td>{{ $totalTranstornoConducta }}</td>
                    <td>{{ $totalOtros }}</td>
                    <td>{{ $totalTotal }}</td>
                </tr>
                @endforeach
                <tr>
                    <th>Total General</th>
                    <th>{{ $sumaTotalMotriz }}</th>
                    <th>{{ $sumaTotalVisual }}</th>
                    <th>{{ $sumaTotalAuditiva }}</th>
                    <th>{{ $sumaTotalCognitiva }}</th>
                    <th>{{ $sumaTotalTranstornoConducta }}</th>
                    <th>{{ $sumaTotalOtros }}</th>
                    <th>{{ $sumaTotalTotal }}</th>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Secciones individuales por institución -->
    @foreach ($reportData->groupBy('programaEducativo.unidadAcademica.institucion.institucion') as $institucion => $dataGroup)
    <div class="page">
        <div class="card">
            <h2 class="card-title">{{ $institucion }}</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Unidad Académica</th>
                        <th>Programa Educativo</th>
                        <th>Motriz</th>
                        <th>Visual</th>
                        <th>Auditiva</th>
                        <th>Cognitiva</th>
                        <th>Transtorno de Conducta</th>
                        <th>Otros</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataGroup as $data)
                    <tr>
                        <td>{{ $data->programaEducativo->unidadAcademica->unidad_academica }}</td>
                        <td>{{ $data->programaEducativo->programa_educativo }}</td>
                        <td>{{ $data->motriz }}</td>
                        <td>{{ $data->visual }}</td>
                        <td>{{ $data->auditiva }}</td>
                        <td>{{ $data->cognitiva }}</td>
                        <td>{{ $data->transtorno_conducta }}</td>
                        <td>{{ $data->otros }}</td>
                        <td>{{ $data->motriz + $data->visual + $data->auditiva + $data->cognitiva + $data->transtorno_conducta + $data->otros }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endforeach
</body>

</html>