<!DOCTYPE html>
<html>
<head>
    <title>Transacciones - Doomsday Bank</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Syne:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.44.0/tabler-icons.min.css">
<link href="https://fonts.googleapis.com/css2?family=Figtree:wght@300;400;500;600&family=IBM+Plex+Mono:wght@300;400&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
*{box-sizing:border-box;margin:0;padding:0}
:root{
  --ink:#0c0c0f;--ink2:#14141a;--ink3:#1c1c25;
  --rim:#ffffff09;--rim2:#ffffff14;--rim3:#ffffff1f;
  --dust:#2e2e40;--fog:#4a4a62;--mist:#7a7a92;
  --text:#ccc9c0;--bright:#f2ede4;
  --lime:#b8f06a;--lime2:#b8f06a18;--lime3:#b8f06a30;
  --rose:#f0716a;--rose2:#f0716a18;--rose3:#f0716a30;
  --violet:#9b8cff;--violet2:#9b8cff18;--violet3:#9b8cff30;
}
html,body{background:var(--ink);color:var(--text);font-family:'Figtree',sans-serif;min-height:100vh}
.mono{font-family:'IBM Plex Mono',monospace}
.page{max-width:940px;margin:0 auto;padding:3rem 2rem 6rem}

.nav{display:flex;align-items:center;justify-content:space-between;margin-bottom:5rem}
.logo{display:flex;align-items:center;gap:12px}
.logo-glyph{width:30px;height:30px;border:1px solid var(--rim3);border-radius:9px;display:grid;place-items:center;position:relative;overflow:hidden}
.logo-glyph::before{content:'';position:absolute;inset:6px;border:1px solid var(--violet);border-radius:3px;transform:rotate(15deg)}
.logo-glyph::after{content:'';position:absolute;width:4px;height:4px;background:var(--violet);border-radius:50%}
.logo-text{font-family:'IBM Plex Mono',monospace;font-size:0.65rem;letter-spacing:0.2em;color:var(--dust);text-transform:uppercase}
.nav-back{display:flex;align-items:center;gap:6px;font-family:'IBM Plex Mono',monospace;font-size:0.62rem;letter-spacing:0.08em;color:var(--dust);text-decoration:none;border:1px solid var(--rim2);padding:0.45rem 0.9rem 0.45rem 0.7rem;border-radius:100px;transition:all .3s;text-transform:uppercase}
.nav-back i{font-size:13px;transition:transform .3s}
.nav-back:hover{color:var(--mist);border-color:var(--rim3)}
.nav-back:hover i{transform:translateX(-3px)}

.hero{margin-bottom:4rem}
.hero-eyebrow{display:flex;align-items:center;gap:8px;margin-bottom:1.2rem}
.hero-eyebrow-line{width:24px;height:1px;background:var(--violet)}
.hero-eyebrow-txt{font-family:'IBM Plex Mono',monospace;font-size:0.62rem;letter-spacing:0.18em;color:var(--fog);text-transform:uppercase}
.hero h1{font-size:3.2rem;font-weight:300;letter-spacing:-0.05em;color:var(--bright);line-height:1;margin-bottom:1rem}
.hero h1 strong{font-weight:600;color:var(--violet)}
.hero-sub{font-size:0.82rem;color:var(--fog);font-weight:300;max-width:340px;line-height:1.7}

.kpi-row{display:grid;grid-template-columns:repeat(3,1fr);gap:1px;background:var(--rim);margin-bottom:3rem;border-radius:20px;overflow:hidden;border:1px solid var(--rim)}
.kpi{background:var(--ink2);padding:1.6rem 1.75rem;position:relative;overflow:hidden}
.kpi::before{content:'';position:absolute;top:0;left:0;right:0;height:1px;background:var(--rim2)}
.kpi-icon{width:34px;height:34px;border-radius:10px;display:grid;place-items:center;margin-bottom:1rem;font-size:16px}
.kpi-icon.v{background:var(--violet2);color:var(--violet);border:1px solid var(--violet3)}
.kpi-icon.g{background:var(--lime2);color:var(--lime);border:1px solid var(--lime3)}
.kpi-icon.r{background:var(--rose2);color:var(--rose);border:1px solid var(--rose3)}
.kpi-val{font-size:1.7rem;font-weight:300;letter-spacing:-0.04em;color:var(--bright);margin-bottom:0.3rem;font-family:'IBM Plex Mono',monospace}
.kpi-lbl{font-family:'IBM Plex Mono',monospace;font-size:0.6rem;letter-spacing:0.12em;color:var(--dust);text-transform:uppercase}

.switcher{display:grid;grid-template-columns:1fr 1fr;gap:1px;background:var(--rim2);border:1px solid var(--rim2);border-radius:16px;overflow:hidden;margin-bottom:2rem}
.sw-btn{background:var(--ink2);border:none;padding:0;cursor:pointer;transition:background .25s;display:block;width:100%}
.sw-btn-inner{display:flex;align-items:center;gap:10px;padding:1.1rem 1.5rem;transition:all .25s}
.sw-btn-icon{width:36px;height:36px;border-radius:10px;display:grid;place-items:center;font-size:17px;flex-shrink:0;transition:all .25s}
.sw-btn-icon.g{background:var(--lime2);color:var(--lime);border:1px solid var(--lime3)}
.sw-btn-icon.r{background:var(--rose2);color:var(--rose);border:1px solid var(--rose3)}
.sw-btn-texts{text-align:left}
.sw-btn-title{font-size:0.9rem;font-weight:500;color:var(--mist);letter-spacing:-0.01em;display:block;transition:color .25s;margin-bottom:2px}
.sw-btn-sub{font-family:'IBM Plex Mono',monospace;font-size:0.58rem;color:var(--dust);letter-spacing:0.06em;display:block;transition:color .25s}
.sw-btn.active-dep{background:var(--ink3)}
.sw-btn.active-dep .sw-btn-title{color:var(--lime)}
.sw-btn.active-dep .sw-btn-sub{color:var(--fog)}
.sw-btn.active-wit{background:var(--ink3)}
.sw-btn.active-wit .sw-btn-title{color:var(--rose)}
.sw-btn.active-wit .sw-btn-sub{color:var(--fog)}

.op-panel{display:none}
.op-panel.visible{display:block}

.op-card{background:var(--ink2);border:1px solid var(--rim);border-radius:20px;padding:2.25rem;position:relative;overflow:hidden;margin-bottom:1.5rem}
.op-card::before{content:'';position:absolute;top:0;left:0;right:0;height:1px}
.op-card.dep::before{background:var(--lime3)}
.op-card.wit::before{background:var(--rose3)}
.op-header{display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:2rem}
.op-tag{display:inline-flex;align-items:center;gap:5px;font-family:'IBM Plex Mono',monospace;font-size:0.58rem;letter-spacing:0.12em;text-transform:uppercase;padding:0.2rem 0.6rem;border-radius:100px;margin-bottom:0.6rem}
.op-tag.dep{background:var(--lime2);color:var(--lime);border:1px solid var(--lime3)}
.op-tag.wit{background:var(--rose2);color:var(--rose);border:1px solid var(--rose3)}
.op-name{font-size:1.2rem;font-weight:500;color:var(--bright);letter-spacing:-0.025em}
.op-badge{width:48px;height:48px;border-radius:14px;display:grid;place-items:center;font-size:22px}
.op-badge.dep{background:var(--lime2);color:var(--lime);border:1px solid var(--lime3)}
.op-badge.wit{background:var(--rose2);color:var(--rose);border:1px solid var(--rose3)}

.fields-grid{display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;margin-bottom:1.5rem}
.fld-lbl{font-family:'IBM Plex Mono',monospace;font-size:0.58rem;letter-spacing:0.12em;color:var(--dust);text-transform:uppercase;display:block;margin-bottom:0.45rem}
select,input[type=number]{width:100%;background:var(--ink);border:1px solid var(--rim2);border-radius:11px;padding:0.75rem 0.95rem;color:var(--text);font-family:'IBM Plex Mono',monospace;font-size:0.78rem;outline:none;appearance:none;-webkit-appearance:none;transition:border-color .25s,background .25s;letter-spacing:0.02em}
select:hover,input:hover{background:var(--ink3);border-color:var(--rim3)}
select:focus,input:focus{border-color:var(--rim3);background:var(--ink3)}
input::placeholder{color:var(--dust)}

.btn{padding:0.85rem 1rem;border-radius:12px;font-family:'Figtree',sans-serif;font-weight:500;font-size:0.88rem;cursor:pointer;transition:all .2s;display:inline-flex;align-items:center;justify-content:center;gap:8px;border:none;letter-spacing:-0.01em}
.btn-d{background:var(--lime);color:#0a1205;width:100%}
.btn-d:hover{opacity:.88}
.btn-d:active{transform:scale(0.98)}
.btn-w{background:transparent;color:var(--rose);border:1px solid var(--rose3);width:100%}
.btn-w:hover{background:var(--rose2);border-color:var(--rose)}
.btn-w:active{transform:scale(0.98)}
.btn i{font-size:18px}

.section-label{display:flex;align-items:center;gap:10px;margin-bottom:1rem}
.section-label span{font-family:'IBM Plex Mono',monospace;font-size:0.6rem;letter-spacing:0.16em;color:var(--dust);text-transform:uppercase}
.section-label::after{content:'';flex:1;height:1px;background:var(--rim2)}

.hist-wrap{background:var(--ink2);border:1px solid var(--rim);border-radius:20px;overflow:hidden}
.hist-head{padding:1.6rem 2rem;display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid var(--rim)}
.hist-head-l{display:flex;align-items:center;gap:12px}
.hist-title{font-size:0.95rem;font-weight:500;color:var(--bright);letter-spacing:-0.02em}
.hist-pill{font-family:'IBM Plex Mono',monospace;font-size:0.58rem;background:var(--ink3);border:1px solid var(--rim2);color:var(--fog);border-radius:100px;padding:0.18rem 0.65rem;letter-spacing:0.06em}
.hist-meta{display:flex;align-items:center;gap:6px;font-family:'IBM Plex Mono',monospace;font-size:0.58rem;color:var(--dust);letter-spacing:0.06em}

table{width:100%;border-collapse:collapse;table-layout:fixed}
thead tr{border-bottom:1px solid var(--rim)}
th{font-family:'IBM Plex Mono',monospace;font-size:0.57rem;letter-spacing:0.12em;text-transform:uppercase;color:var(--dust);padding:0.9rem 2rem;text-align:left;font-weight:400}
tbody tr{transition:background .15s;border-bottom:1px solid var(--rim)}
tbody tr:last-child{border-bottom:none}
tbody tr:hover{background:var(--ink3)}
td{padding:1.1rem 2rem;font-family:'IBM Plex Mono',monospace;font-size:0.75rem;vertical-align:middle}

.type-chip{display:inline-flex;align-items:center;gap:6px;padding:0.25rem 0.7rem 0.25rem 0.55rem;border-radius:8px;font-size:0.6rem;letter-spacing:0.08em}
.type-chip i{font-size:12px}
.chip-d{background:var(--lime2);color:var(--lime);border:1px solid var(--lime3)}
.chip-w{background:var(--rose2);color:var(--rose);border:1px solid var(--rose3)}
.amt-d{color:var(--lime)}
.amt-w{color:var(--rose)}
.bal-v{color:var(--mist)}
.dt{color:var(--dust);font-size:0.68rem}
.empty-state{text-align:center;padding:4.5rem 2rem}
.empty-icon{font-size:28px;color:var(--dust);margin-bottom:0.75rem}
.empty-txt{font-family:'IBM Plex Mono',monospace;font-size:0.65rem;color:var(--dust);letter-spacing:0.1em}

@media(max-width:640px){
  .kpi-row,.fields-grid{grid-template-columns:1fr}
  th,td{padding:0.8rem 1.25rem}
  .hist-head{padding:1.25rem}
  .hero h1{font-size:2.2rem}
}
</style>

<div class="page">

  <nav class="nav">
    <div class="logo">
      <div class="logo-glyph"></div>
      <span class="logo-text mono">Doomsday Bank</span>
    </div>
    <a href="/dashboard" class="nav-back">
      <i class="ti ti-arrow-left" aria-hidden="true"></i>
      Panel
    </a>
  </nav>

  <div class="hero">
    <div class="hero-eyebrow">
      <span class="hero-eyebrow-line"></span>
      <span class="hero-eyebrow-txt mono">Gestión financiera</span>
    </div>
    <h1>Trans<strong>acciones</strong></h1>
    <p class="hero-sub">Administra tus fondos con precisión. Cada movimiento queda registrado.</p>
  </div>

  <div class="kpi-row">
    <div class="kpi">
      <div class="kpi-icon v"><i class="ti ti-wallet" aria-hidden="true"></i></div>
      <div class="kpi-val mono">{{ $accounts->count() ?? '—' }}</div>
      <div class="kpi-lbl mono">Cuentas activas</div>
    </div>
    <div class="kpi">
      <div class="kpi-icon g"><i class="ti ti-trending-up" aria-hidden="true"></i></div>
      <div class="kpi-val mono">{{ $totalDeposits ?? '—' }}</div>
      <div class="kpi-lbl mono">Total depositado</div>
    </div>
    <div class="kpi">
      <div class="kpi-icon r"><i class="ti ti-receipt" aria-hidden="true"></i></div>
      <div class="kpi-val mono">{{ $transactions->count() ?? '—' }}</div>
      <div class="kpi-lbl mono">Operaciones</div>
    </div>
  </div>

  @if(session('error'))
  <script>Swal.fire({background:'#14141a',color:'#ccc9c0',icon:'error',title:'Error',text:'{{ session('error') }}',confirmButtonColor:'#9b8cff',iconColor:'#f0716a'})</script>
  @endif
  @if(session('success'))
  <script>Swal.fire({background:'#14141a',color:'#ccc9c0',icon:'success',title:'Completado',text:'{{ session('success') }}',confirmButtonColor:'#b8f06a',iconColor:'#b8f06a'})</script>
  @endif

  <div class="switcher" id="switcher">
    <button class="sw-btn active-dep" id="btn-dep" onclick="showPanel('dep')">
      <div class="sw-btn-inner">
        <div class="sw-btn-icon g"><i class="ti ti-arrow-down-left" aria-hidden="true"></i></div>
        <div class="sw-btn-texts">
          <span class="sw-btn-title">Depositar</span>
          <span class="sw-btn-sub mono">Ingreso de fondos</span>
        </div>
      </div>
    </button>
    <button class="sw-btn" id="btn-wit" onclick="showPanel('wit')">
      <div class="sw-btn-inner">
        <div class="sw-btn-icon r"><i class="ti ti-arrow-up-right" aria-hidden="true"></i></div>
        <div class="sw-btn-texts">
          <span class="sw-btn-title">Retirar</span>
          <span class="sw-btn-sub mono">Extracción de fondos</span>
        </div>
      </div>
    </button>
  </div>

  <div class="op-panel visible" id="panel-dep">
    <div class="op-card dep">
      <div class="op-header">
        <div>
          <div class="op-tag dep"><i class="ti ti-point-filled" style="font-size:8px" aria-hidden="true"></i> depósito</div>
          <div class="op-name">Depositar fondos</div>
        </div>
        <div class="op-badge dep"><i class="ti ti-arrow-down-left" aria-hidden="true"></i></div>
      </div>
      <form method="POST" action="/deposit">
        @csrf
        <div class="fields-grid">
          <div>
            <label class="fld-lbl mono">Cuenta destino</label>
            <select name="account_id">
              @foreach($accounts as $acc)
              <option value="{{ $acc->id }}">{{ $acc->account_number }} · ${{ $acc->balance }}</option>
              @endforeach
            </select>
          </div>
          <div>
            <label class="fld-lbl mono">Monto (USD)</label>
            <input type="number" name="amount" min="1" step="0.01" placeholder="0.00">
          </div>
        </div>
        <button class="btn btn-d" type="submit">
          <i class="ti ti-arrow-down-left" aria-hidden="true"></i>
          Confirmar depósito
        </button>
      </form>
    </div>
  </div>

  <div class="op-panel" id="panel-wit">
    <div class="op-card wit">
      <div class="op-header">
        <div>
          <div class="op-tag wit"><i class="ti ti-point-filled" style="font-size:8px" aria-hidden="true"></i> retiro</div>
          <div class="op-name">Retirar fondos</div>
        </div>
        <div class="op-badge wit"><i class="ti ti-arrow-up-right" aria-hidden="true"></i></div>
      </div>
      <form method="POST" action="/withdraw">
        @csrf
        <div class="fields-grid">
          <div>
            <label class="fld-lbl mono">Cuenta origen</label>
            <select name="account_id">
              @foreach($accounts as $acc)
              <option value="{{ $acc->id }}">{{ $acc->account_number }} · ${{ $acc->balance }}</option>
              @endforeach
            </select>
          </div>
          <div>
            <label class="fld-lbl mono">Monto (USD)</label>
            <input type="number" name="amount" min="1" step="0.01" placeholder="0.00">
          </div>
        </div>
        <button class="btn btn-w" type="submit">
          <i class="ti ti-arrow-up-right" aria-hidden="true"></i>
          Confirmar retiro
        </button>
      </form>
    </div>
  </div>

  <div class="section-label" style="margin-top:2rem"><span class="mono">Historial</span></div>
  <div class="hist-wrap">
    <div class="hist-head">
      <div class="hist-head-l">
        <span class="hist-title">Movimientos recientes</span>
        <span class="hist-pill mono">últimas transacciones</span>
      </div>
      <div class="hist-meta mono">
        <i class="ti ti-clock" aria-hidden="true"></i>
        ordenado por fecha
      </div>
    </div>
    <table>
      <colgroup>
        <col style="width:24%"><col style="width:22%"><col style="width:24%"><col style="width:30%">
      </colgroup>
      <thead>
        <tr>
          <th>Tipo</th><th>Monto</th><th>Saldo final</th><th>Fecha</th>
        </tr>
      </thead>
      <tbody>
        @forelse($transactions as $t)
        <tr>
          <td>
            <span class="type-chip {{ $t->type === 'deposit' ? 'chip-d' : 'chip-w' }}">
              <i class="ti {{ $t->type === 'deposit' ? 'ti-arrow-down-left' : 'ti-arrow-up-right' }}" aria-hidden="true"></i>
              {{ $t->type === 'deposit' ? 'depósito' : 'retiro' }}
            </span>
          </td>
          <td class="{{ $t->type === 'deposit' ? 'amt-d' : 'amt-w' }}">{{ $t->type === 'deposit' ? '+' : '−' }}${{ $t->amount }}</td>
          <td class="bal-v">${{ $t->balance_after }}</td>
          <td class="dt">{{ $t->created_at }}</td>
        </tr>
        @empty
        <tr>
          <td colspan="4">
            <div class="empty-state">
              <div class="empty-icon"><i class="ti ti-history" aria-hidden="true"></i></div>
              <div class="empty-txt mono">Sin movimientos registrados</div>
            </div>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

</div>

<script>
function showPanel(type) {
  document.getElementById('panel-dep').classList.remove('visible');
  document.getElementById('panel-wit').classList.remove('visible');
  document.getElementById('btn-dep').classList.remove('active-dep');
  document.getElementById('btn-wit').classList.remove('active-wit');
  if (type === 'dep') {
    document.getElementById('panel-dep').classList.add('visible');
    document.getElementById('btn-dep').classList.add('active-dep');
  } else {
    document.getElementById('panel-wit').classList.add('visible');
    document.getElementById('btn-wit').classList.add('active-wit');
  }
}
</script>

</body>
</html>