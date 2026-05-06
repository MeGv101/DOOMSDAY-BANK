<!DOCTYPE html>
<html>
<head>
    <title>Crear usuario</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">

<div class="bg-white p-6 rounded shadow w-96">
    <a href="/users" class="text-blue-600 hover:underline mt-20">
        ← Volver
    </a>
    <h2 class="text-xl font-bold mb-4">Nuevo Usuario</h2>

    <form method="POST" action="/users">
        @csrf

        <input name="name" autocomplete="off" placeholder="Nombre"
            class="w-full mb-3 p-2 border rounded">

        <input name="email" autocomplete="off" placeholder="Email"
            class="w-full mb-3 p-2 border rounded">

        <input name="password" type="password" autocomplete="off" placeholder="Password"
            class="w-full mb-3 p-2 border rounded">

        <button class="w-full bg-blue-600 text-white p-2 rounded">
            Guardar
        </button>
    </form>

</div>

@if($errors->any())
<script>
Swal.fire({
    icon: 'error',
    title: 'Error',
    html: `{!! implode('<br>', $errors->all()) !!}`
});
</script>
@endif

</body>
</html>