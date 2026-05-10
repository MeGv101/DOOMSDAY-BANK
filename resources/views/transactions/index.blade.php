<!DOCTYPE html>
<html>
<head>
    <title>Transacciones - Doomsday Bank</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Syne:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        body {
            background: #0a0a0b;
            font-family: 'Syne', sans-serif;
            color: #e8e6e0;
            min-height: 100vh;
        }
        .mono { font-family: 'DM Mono', monospace; }
        .page-wrapper { max-width: 900px; margin: 0 auto; padding: 2.5rem 1.5rem; }

        /* Topbar */
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #1e1e22;
        }
        .topbar h1 { font-size: 1.6rem; font-weight: 700; letter-spacing: -0.02em; color: #f0ece2; }
        .back-link {
            font-family: 'DM Mono', monospace;
            font-size: 0.78rem;
            color: #5a5a6a;
            border: 1px solid #1e1e22;
            padding: 0.4rem 0.9rem;
            border-radius: 999px;
            text-decoration: none;
            transition: all .2s;
        }
        .back-link:hover { color: #c5f582; border-color: #c5f582; }

        /* Cards */
        .op-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem; }
        .card {
            background: #111114;
            border: 1px solid #1e1e22;
            border-radius: 16px;
            padding: 1.75rem;
            transition: border-color .25s;
        }
        .card:hover { border-color: #2a2a30; }
        .card-label {
            font-family: 'DM Mono', monospace;
            font-size: 0.68rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: #5a5a6a;
            margin-bottom: 0.6rem;
        }
        .card h2 { font-size: 1.05rem; font-weight: 600; color: #f0ece2; margin-bottom: 1.4rem; }

        /* Form elements */
        label {
            display: block;
            font-family: 'DM Mono', monospace;
            font-size: 0.72rem;
            color: #5a5a6a;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 0.5rem;
        }
        select, input[type=number] {
            width: 100%;
            background: #0a0a0b;
            border: 1px solid #1e1e22;
            border-radius: 8px;
            padding: 0.65rem 0.9rem;
            color: #e8e6e0;
            font-family: 'DM Mono', monospace;
            font-size: 0.85rem;
            outline: none;
            margin-bottom: 1.1rem;
            transition: border-color .2s;
            -webkit-appearance: none;
        }
        select:focus, input[type=number]:focus { border-color: #3a3a44; }

        /* Buttons */
        .btn-deposit {
            width: 100%;
            background: #c5f582;
            color: #0a0a0b;
            border: none;
            padding: 0.75rem;
            border-radius: 8px;
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 0.9rem;
            cursor: pointer;
            transition: opacity .2s;
        }
        .btn-deposit:hover { opacity: .88; }
        .btn-withdraw {
            width: 100%;
            background: transparent;
            color: #e8e6e0;
            border: 1px solid #2a2a30;
            padding: 0.75rem;
            border-radius: 8px;
            font-family: 'Syne', sans-serif;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all .2s;
        }
        .btn-withdraw:hover { border-color: #f08080; color: #f08080; }

        /* History table */
        .hist {
            background: #111114;
            border: 1px solid #1e1e22;
            border-radius: 16px;
            overflow: hidden;
        }
        .hist-header {
            padding: 1.5rem 1.75rem;
            border-bottom: 1px solid #1e1e22;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .hist-header h2 { font-size: 1.05rem; font-weight: 600; color: #f0ece2; }
        .hist-header span { font-family: 'DM Mono', monospace; font-size: 0.7rem; color: #5a5a6a; }
        table { width: 100%; border-collapse: collapse; }
        thead tr { border-bottom: 1px solid #1e1e22; }
        thead th {
            font-family: 'DM Mono', monospace;
            font-size: 0.68rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #3a3a44;
            padding: 1rem 1.75rem;
            text-align: left;
            font-weight: 500;
        }
        tbody tr { border-bottom: 1px solid #161618; transition: background .15s; }
        tbody tr:hover { background: #13131a; }
        tbody tr:last-child { border-bottom: none; }
        td { padding: 1rem 1.75rem; font-family: 'DM Mono', monospace; font-size: 0.82rem; color: #9a9a9a; }

        .badge {
            display: inline-block;
            padding: 0.25rem 0.7rem;
            border-radius: 999px;
            font-size: 0.68rem;
            font-family: 'DM Mono', monospace;
            font-weight: 500;
            letter-spacing: 0.05em;
        }
        .badge-dep { background: #1a2e10; color: #c5f582; border: 1px solid #2a4a18; }
        .badge-wit { background: #2e1010; color: #f08080; border: 1px solid #4a1a1a; }
        .amount-dep { color: #c5f582; }
        .amount-wit { color: #f08080; }
        .balance { color: #e8e6e0; }
        .date-col { color: #3a3a44; font-size: 0.75rem; }
        .empty { padding: 3rem; text-align: center; color: #3a3a44; font-family: 'DM Mono', monospace; font-size: 0.82rem; }
    </style>
</head>

<body>
<div class="page-wrapper">

    <div class="topbar">
        <h1>Transacciones</h1>
        <a href="/dashboard" class="back-link">← Volver</a>
    </div>

    @if(session('error'))
    <script>
    Swal.fire({ icon: 'error', title: 'Error', text: '{{ session('error') }}' });
    </script>
    @endif

    @if(session('success'))
    <script>
    Swal.fire({ icon: 'success', title: 'Éxito', text: '{{ session('success') }}' });
    </script>
    @endif

    <div class="op-grid">
        <div class="card">
            <div class="card-label">Operación</div>
            <h2>Depositar</h2>
            <form method="POST" action="/deposit">
                @csrf
                <label>Cuenta</label>
                <select name="account_id">
                    @foreach($accounts as $acc)
                        <option value="{{ $acc->id }}">{{ $acc->account_number }} (${{ $acc->balance }})</option>
                    @endforeach
                </select>
                <label>Monto</label>
                <input type="number" name="amount" min="1" step="0.01" placeholder="0.00">
                <button class="btn-deposit" type="submit">Depositar</button>
            </form>
        </div>

        <div class="card">
            <div class="card-label">Operación</div>
            <h2>Retirar</h2>
            <form method="POST" action="/withdraw">
                @csrf
                <label>Cuenta</label>
                <select name="account_id">
                    @foreach($accounts as $acc)
                        <option value="{{ $acc->id }}">{{ $acc->account_number }} (${{ $acc->balance }})</option>
                    @endforeach
                </select>
                <label>Monto</label>
                <input type="number" name="amount" min="1" step="0.01" placeholder="0.00">
                <button class="btn-withdraw" type="submit">Retirar</button>
            </form>
        </div>
    </div>

    <div class="hist">
        <div class="hist-header">
            <h2>Historial</h2>
            <span>últimas transacciones</span>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Monto</th>
                    <th>Saldo final</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $t)
                <tr>
                    <td>
                        <span class="badge {{ $t->type === 'deposit' ? 'badge-dep' : 'badge-wit' }}">
                            {{ $t->type === 'deposit' ? 'depósito' : 'retiro' }}
                        </span>
                    </td>
                    <td class="{{ $t->type === 'deposit' ? 'amount-dep' : 'amount-wit' }}">
                        {{ $t->type === 'deposit' ? '+' : '−' }}${{ $t->amount }}
                    </td>
                    <td class="balance">${{ $t->balance_after }}</td>
                    <td class="date-col">{{ $t->created_at }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="empty">No hay transacciones todavía</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
</body>
</html>