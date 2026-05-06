<!DOCTYPE html>
<html>
<head>
    <title>Login - Doomsday Bank</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-900 flex items-center justify-center h-screen">

<div class="bg-gray-800 p-8 rounded shadow-lg w-96">

    <h2 class="text-2xl font-bold text-white mb-6 text-center">
        Iniciar Sesión
    </h2>

    <form method="POST" action="/login">
        @csrf

        <input type="email" autocomplete="off"  name="email" placeholder="Correo"
            class="w-full p-2 mb-3 rounded bg-gray-700 text-white border border-gray-600">

        <input type="password" autocomplete="off" name="password" placeholder="Contraseña"
            class="w-full p-2 mb-4 rounded bg-gray-700 text-white border border-gray-600">

        <button class="w-full bg-blue-600 p-2 rounded text-white hover:bg-blue-700">
            Entrar
        </button>
    </form>

    <p class="text-gray-400 text-sm mt-4 text-center">
        ¿No tienes cuenta?
        <a href="/register" class="text-blue-400">Regístrate</a>
    </p>

</div>

@if(session('error'))
<script>
Swal.fire('Error', '{{ session('error') }}', 'error');
</script>
@endif

</body>
</html>