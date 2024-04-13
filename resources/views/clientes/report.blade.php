<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Report de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <!-- Main table custom fields-->
    <table id="clientes-tabla" class="table table-striped table-borderer shadow-lg mt-4" style="width:100%">
        <thead class="bg-info">
            <tr>
                <th>
                        <p class="mb-0">Nombre</p>
                </th>

                <th>
                        <p class="mb-0">Correo</p>
                </th>

                <th>
                        <p class="mb-0">Teléfono</p>
                </th>

                <th>
                    <p>Dirección</p>
                </th>

                <th>
                    <p>Importe comprado</p>
                </th>
            </tr>
        </thead>

        <tbody>
            @foreach ($arrayUsers as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->street }} {{ $user->city }} {{ $user->state }} {{ $user->CP }}</td>
                    <td>
                        {{-- {{ $user->orders->sum('orders_product_sum_price') }} € --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    
</body>
</html>
