<!DOCTYPE html>
<html>
<head>
    <title>Editar Usuario</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100">
    @if ($errors->any())
    <script>
    Swal.fire({
        icon: 'error',
        title: 'Error de validación',
        html: `
            {!! implode('<br>', $errors->all()) !!}
        `
    });
    </script>
    @endif
    @if(session('success'))
    <script>
    Swal.fire({
        icon: 'success',
        title: 'Éxito',
        text: '{{ session('success') }}'
    });
    </script>
    @endif
<div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded shadow">

    <h1 class="text-2xl font-bold mb-6">Editar Usuario</h1>
    <form method="POST" action="/users/{{ $user->id }}/update">
        @csrf

        <input
            type="text"
            autocomplete="off"
            name="name"
            value="{{ $user->name }}"
            class="w-full border p-2 rounded mb-3"
        >

        <input
            type="email"
            autocomplete="off"
            name="email"
            value="{{ $user->email }}"
            class="w-full border p-2 rounded mb-3"
        >

        <input
            type="text"
            name="account_number"
            value="{{ $account->account_number }}"
            placeholder="Número de cuenta"
            class="w-full border p-2 rounded mb-3"
        >

        <input
            type="number"
            step="0.01"
            name="balance"
            value="{{ $account->balance }}"
            placeholder="Saldo"
            class="w-full border p-2 rounded mb-4"
        >

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
            Guardar cambios
        </button>
    </form>

</div>

</body>
</html>