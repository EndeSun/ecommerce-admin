<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reporte de Categorías</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    {{-- <img width="50rem" src="https://images.assetsdelivery.com/compings_v2/lumut/lumut1511/lumut151100229.jpg"
    alt="logo"> --}}
    <h1 class="text-center">Categorías</h1>

    <!-- Main table custom fields-->
    <table id="clientes-tabla" class="table table-bordered table-striped shadow-lg mt-4" style="width:100%">
        <thead>
            <tr>
                <th scope="col">
                    <p class="text-center"><strong>Nombre</strong></p>
                </th>

                <th scope="col">
                    <p class="text-center"><strong>Categoría padre</strong></p>
                </th>
            </tr>
        </thead>

        <tbody>
            @foreach ($arrayCategorias as $categoria)
                <tr>
                    <td class="text-center">{{ $categoria->name }}</td>
                    
                    @if ($categoria->category_id == null)
                        <td class="text-center">CATEGORÍA PRINCIPAL</td>
                    @else
                        <td class="text-center">{{ $categoria->category->name }}</td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
