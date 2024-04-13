<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reporte de clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    {{-- <img width="50rem" src="https://images.assetsdelivery.com/compings_v2/lumut/lumut1511/lumut151100229.jpg"
    alt="logo"> --}}
    <h1 class="text-center">Clientes</h1>

    <!-- Main table custom fields-->
    <table id="clientes-tabla" class="table table-bordered table-striped shadow-lg mt-4" style="width:100%">
        <thead>
            <tr>
                <th scope="col">
                    <p class="text-center"><strong>Nombre</strong></p>
                </th>

                <th scope="col">
                    <p class="text-center"><strong>Correo</strong></p>
                </th>

                <th scope="col">
                    <p class="text-center"><strong>Teléfono</strong></p>
                </th>

                <th scope="col">
                    <p class="text-center"><strong>Dirección</strong></p>
                </th>

                <th scope="col">
                    <p class="text-center"><strong>Importe comprado</strong></p>
                </th>
            </tr>
        </thead>

        <tbody>
            @foreach ($arrayUsers as $user)
                <tr>
                    <td class="text-center">{{ $user->name }}</td>
                    <td class="text-center">{{ $user->email }}</td>
                    <td class="text-center">{{ $user->phone }}</td>
                    <td class="text-center">{{ $user->street }} {{ $user->city }} {{ $user->state }} {{ $user->CP }}</td>
                    <td class="text-center">
                        {{ $user->orders->sum('orders_product_sum_price') }} €
                    </td>
                </tr>
            @endforeach
        </tbody>

</body>

</html>
