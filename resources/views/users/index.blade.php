
<!DOCTYPE html>
<html>
<head>
    <title>Usuarios - Doomsday Bank</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="max-w-5xl mx-auto mt-10">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Usuarios</h1>

        <a href="/users/create"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Nuevo usuario
        </a>
    </div>
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-200 text-gray-700">
                <tr>
                    <th class="p-3">Nombre</th>
                    <th class="p-3">Email</th>
                    <th class="p-3">Rol</th>
                    <th class="p-3 text-center">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $user)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">{{ $user->name }}</td>
                    <td class="p-3">{{ $user->email }}</td>
                    <td class="p-3">{{ $user->role }}</td>

                    <td class="p-3 text-center">

                        <a href="#" onclick="deleteUser({{ $user->id }})" class="text-red-600 hover:underline">
                            Eliminar
                            </a>

                            <script>
                            function deleteUser(id) {
                                Swal.fire({
                                    title: '¿Eliminar usuario?',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonText: 'Sí'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = '/users/delete/' + id;
                                    }
                                });
                            }
                            </script>
                        <a href="/users/{{ $user->id }}/edit" class="bg-blue-600 text-white px-3 py-1 rounded">
                            Editar
                        </a>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>
    <a href="/dashboard" class="text-blue-600 hover:underline mt-20">
        ← Volver
    </a>
</div>

</body>
</html>