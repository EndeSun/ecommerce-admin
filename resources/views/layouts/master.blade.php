<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ecommerce</title>
    <!-- Referencia bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Iconos de fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        
    <link rel='stylesheet' href="https://cdn.datatables.net/2.0.1/css/dataTables.bootstrap5.css" />
    <link rel='stylesheet' href="https://cdn.datatables.net/buttons/3.0.0/css/buttons.bootstrap5.css" />
    <!-- Referencia a los archivos css js y sass del proyecto -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/scss/app.scss'])
    <!-- Para llamar a los diferentes scripts desde las vistas que heredan de esta plantilla -->
    @stack('scripts')
</head>

<body>
    <div>
        <!-- El dashboard de la interfaz -->
        @extends('template.dashboard')
        @section('content')
        @yield('content-master')
    @endsection
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/2.0.1/js/dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/2.0.1/js/dataTables.bootstrap5.js">
</script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/3.0.0/js/dataTables.buttons.js">
</script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.bootstrap5.js">
</script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js">
</script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js">
</script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js">
</script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.html5.min.js">
</script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.print.min.js">
</script>
</body>

</html>
