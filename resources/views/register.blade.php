<!DOCTYPE html>
<html>
<head>
    <title>Registro - Doomsday Bank</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-900 flex items-center justify-center h-screen">

<div class="bg-gray-800 p-8 rounded shadow-lg w-96">

    <h2 class="text-2xl font-bold text-white mb-6 text-center">
        Crear Cuenta
    </h2>
    <p class="text-gray-400 text-sm mb-4 text-center ">
        Al crear tu cuenta recibirás $100 de saldo inicial
    </p>

    <form method="POST" action="/register">
        @csrf

        <input type="text" autocomplete="off"  name="name" placeholder="Nombre"
            class="w-full p-2 mb-3 rounded bg-gray-700 text-white border border-gray-600">

        <input type="email" autocomplete="off"  name="email" placeholder="Correo"
            class="w-full p-2 mb-3 rounded bg-gray-700 text-white border border-gray-600">

        <input type="password" autocomplete="off"  name="password" placeholder="Contraseña"
            class="w-full p-2 mb-4 rounded bg-gray-700 text-white border border-gray-600">

        <button class="w-full bg-green-600 p-2 rounded text-white hover:bg-green-700">
            Registrarse
        </button>
    </form>

    <p class="text-gray-400 text-sm mt-4 text-center">
        ¿Ya tienes cuenta?
        <a href="/login" class="text-blue-400">Inicia sesión</a>
    </p>

</div>

@if ($errors->any())
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