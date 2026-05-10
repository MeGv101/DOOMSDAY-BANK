<!DOCTYPE html>
<html>
<head>
    <title>Transacciones - Doomsday Bank</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100">

<div class="max-w-5xl mx-auto mt-10">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Transacciones</h1>

        <a href="/dashboard" class="text-blue-600 hover:underline">
            ← Volver
        </a>
    </div>
    @if(session('error'))
    <script>
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: '{{ session('error') }}'
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
    <div class="bg-white p-6 rounded shadow mb-6">
        <h2 class="text-lg font-semibold mb-4">Depositar dinero</h2>

        <form method="POST" action="/deposit">
            @csrf

            <label class="block mb-2">Cuenta</label>
            <select name="account_id" class="w-full p-2 border rounded mb-3">
                @foreach($accounts as $acc)
                    <option value="{{ $acc->id }}">
                        {{ $acc->account_number }} (${{ $acc->balance }})
                    </option>
                @endforeach
            </select>

            <label class="block mb-2">Monto</label>
            <input type="number" name="amount" min="1" step="0.01"
                class="w-full p-2 border rounded mb-4"
                placeholder="Ej: 50">

            <button class="w-full bg-green-600 text-white p-2 rounded hover:bg-green-700">
                Depositar
            </button>
        </form>
    </div>
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-lg font-semibold mb-4">Retirar dinero</h2>

        <form method="POST" action="/withdraw">
            @csrf

            <label class="block mb-2">Cuenta</label>
            <select name="account_id" class="w-full p-2 border rounded mb-3">
                @foreach($accounts as $acc)
                    <option value="{{ $acc->id }}">
                        {{ $acc->account_number }} (${{ $acc->balance }})
                    </option>
                @endforeach
            </select>

            <label class="block mb-2">Monto</label>
            <input type="number" name="amount" min="1" step="0.01"
                class="w-full p-2 border rounded mb-4"
                placeholder="Ej: 50">

            <button class="w-full bg-green-600 text-white p-2 rounded hover:bg-green-700">
                Retirar
            </button>
        </form>
    </div>

</div>
<div class="bg-white p-6 rounded shadow mt-6">

    <h2 class="text-2xl font-bold mb-4">
        Historial de Transacciones
    </h2>

    <table class="w-full border-collapse">

        <thead>
            <tr class="bg-gray-200">
                <th class="p-2 text-left">Tipo</th>
                <th class="p-2 text-left">Monto</th>
                <th class="p-2 text-left">Saldo Final</th>
                <th class="p-2 text-left">Fecha</th>
            </tr>
        </thead>

        <tbody>

            @forelse($transactions as $t)
            <tr class="border-b">

                <td class="p-2">
                    {{ $t->type }}
                </td>

                <td class="p-2">
                    ${{ $t->amount }}
                </td>

                <td class="p-2">
                    ${{ $t->balance_after }}
                </td>

                <td class="p-2">
                    {{ $t->created_at }}
                </td>

            </tr>
            @empty

            <tr>
                <td colspan="4" class="p-4 text-center text-gray-500">
                    No hay transacciones todavía
                </td>
            </tr>

            @endforelse

        </tbody>

    </table>

</div>
</body>
</html>