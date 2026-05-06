<!DOCTYPE html>
<html>
<head>
    <title>Doomsday Bank</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="max-w-5xl mx-auto mt-10">

    <h1 class="text-3xl font-bold mb-6">Doomsday Bank</h1>
    @if(session('error'))
    <script>
    Swal.fire('Error', '{{ session('error') }}', 'error');
    </script>
    @endif
    <div class="grid grid-cols-3 gap-4">

        <a href="/transactions" class="bg-white p-6 rounded shadow hover:bg-gray-50">
            <h2 class="text-xl font-semibold">Transacciones</h2>
            <p class="text-gray-600">Movimientos de dinero</p>
        </a>

        <a href="/users" class="bg-white p-6 rounded shadow hover:bg-gray-50">
            <h2 class="text-xl font-semibold">Usuarios</h2>
            <p class="text-gray-600">Administración</p>
        </a>

    </div>

    <div class="mt-6">
        <a href="/logout" class="text-red-600">Cerrar sesión</a>
    </div>

</div>

</body>
</html>