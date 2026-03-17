<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Tiwi PMS</title>
    <style>
        :root { --bg:#eaf2ec; --panel:#f5faf6; --white:#fff; --ink:#1b2640; --muted:#5b6a87; --brand:#22ac15; --line:#d4e2d5; --stroke:#d3dfe0; }
        * { box-sizing:border-box; }
        html, body { height:100%; margin:0; font-family:Arial, sans-serif; font-size:15px; color:var(--ink); background:var(--bg); }
        body { overflow:hidden; }
        .page { height:100vh; display:flex; flex-direction:column; }
        .topbar { height:84px; display:flex; align-items:center; justify-content:space-between; gap:1rem; padding:.8rem 1rem; background:var(--white); border-bottom:1px solid var(--line); }
        .tenant { font-size:1.65rem; color:#3d8d10; font-weight:700; }
        .top-actions { display:flex; align-items:center; gap:.6rem; flex-wrap:wrap; justify-content:flex-end; }
        .search { width:min(480px,56vw); display:flex; border:1px solid #ccd8ce; border-radius:999px; overflow:hidden; background:#f5f8f7; }
        .search input { border:0; width:100%; padding:.8rem 1rem; font:inherit; background:transparent; }
        .search button { border:0; width:64px; color:#fff; background:var(--brand); font-weight:700; cursor:pointer; }
        .pill { border:1px solid #cfd9d5; border-radius:999px; padding:.6rem 1rem; text-decoration:none; color:var(--ink); background:var(--white); font-weight:700; }
        .pill.strong { border:0; color:#fff; background:linear-gradient(135deg,#22ac15,#0f7f07); }
        .layout { min-height:0; flex:1; display:grid; grid-template-columns:330px minmax(0,1fr); }
        .sidebar { padding:1rem .8rem 1.4rem; border-right:1px solid var(--line); background:#f4f9f4; overflow-y:auto; }
        .group { margin-bottom:1rem; }
        .group h3 { margin:.2rem 0 .55rem; font-size:.68rem; letter-spacing:.2em; text-transform:uppercase; color:#6f7e97; }
        .menu-item { display:flex; align-items:center; gap:.65rem; margin-bottom:.35rem; padding:.5rem .6rem; border-radius:12px; color:#4f5f80; text-decoration:none; font-size:.95rem; font-weight:700; }
        .menu-item:hover { background:#edf6ef; }
        .menu-item.active { background:linear-gradient(135deg,rgba(34,172,21,.1),rgba(74,203,131,.14)); box-shadow:inset 0 0 0 1px #b3e5ba; color:#1c2a47; }
        .menu-item.sub-item { margin-left:1.35rem; padding-left:.45rem; }
        .menu-item.sub-item .icon { width:32px; height:32px; font-size:.65rem; }
        .icon { width:38px; height:38px; border-radius:999px; display:grid; place-items:center; background:#e8edf2; font-size:.72rem; font-weight:800; }
        .badge { margin-left:auto; min-width:36px; text-align:center; border-radius:999px; padding:.2rem .45rem; font-size:.78rem; background:#c7e8cd; color:#1d5f2f; }
        .main { overflow-y:auto; background:radial-gradient(circle at 0% 18%,rgba(72,170,19,.16),transparent 40%), radial-gradient(circle at 80% -10%,rgba(49,189,214,.2),transparent 44%), var(--panel); }
        .promo { background:#1396de; color:#fff; padding:.75rem 1rem; display:flex; align-items:center; justify-content:space-between; gap:.7rem; flex-wrap:wrap; font-weight:700; }
        .btn { border:0; border-radius:10px; padding:.5rem .95rem; text-decoration:none; color:#fff; font-weight:700; display:inline-block; }
        .btn.blue { background:linear-gradient(135deg,#4967ff,#477fff); }
        .btn.green { background:linear-gradient(135deg,#24b313,#149906); }
        .content { padding:1rem; }
        .section { background:rgba(255,255,255,.78); border:1px solid #d6e4d6; border-radius:18px; padding:1rem; margin-bottom:.9rem; }
        .section h2 { margin:0; font-size:1.55rem; }
        .sub { margin:.35rem 0 0; color:#657593; font-size:.92rem; }
        .cards { display:grid; grid-template-columns:repeat(3,minmax(0,1fr)); gap:.75rem; margin-bottom:.9rem; }
        .card { background:#fff; border:1px solid #d8e4d8; border-radius:14px; padding:.9rem; }
        .kicker { margin:0; color:#4e5a75; text-transform:uppercase; letter-spacing:.16em; font-size:.62rem; font-weight:700; }
        .value { margin:.4rem 0 .2rem; font-size:1.7rem; font-weight:700; color:#2f3550; }
        .eyebrow { margin:0; color:#25a20f; letter-spacing:.2em; text-transform:uppercase; font-size:.68rem; font-weight:700; }
        .prop-actions { display:flex; flex-wrap:wrap; gap:.55rem; margin:.9rem 0 .5rem; }
        .prop-btn { text-decoration:none; border-radius:12px; border:1px solid #8ccf96; color:#1f9810; font-weight:700; padding:.68rem 1rem; background:#f8fff9; }
        .prop-btn.light { border-color:#a8bac4; color:#27344c; background:#f7fbf8; }
        .prop-btn.active, .prop-btn.solid { background:linear-gradient(135deg,#24b313,#159704); color:#fff; border:0; }
        .search-label { margin:0 0 .45rem; color:#586783; font-size:.8rem; text-transform:uppercase; letter-spacing:.07em; font-weight:700; }
        .search-row { display:grid; grid-template-columns:minmax(0,1fr) auto; gap:.6rem; align-items:center; }
        .search-input { display:flex; border:1px solid var(--stroke); border-radius:10px; overflow:hidden; background:#fff; min-height:50px; }
        .search-input span { width:54px; display:grid; place-items:center; border-right:1px solid var(--stroke); color:#637188; font-weight:700; }
        .search-input input { border:0; width:100%; padding:.8rem; font:inherit; }
        .search-cta { border:0; border-radius:999px; padding:.72rem 1.5rem; color:#fff; background:linear-gradient(135deg,#22b211,#159906); font-weight:700; cursor:pointer; }
        table { width:100%; border-collapse:collapse; min-width:560px; }
        th, td { text-align:left; padding:.75rem .45rem; border-bottom:1px solid #d9e5d9; }
        th { text-transform:uppercase; font-size:.66rem; letter-spacing:.06em; color:#50607b; }
        .status { display:inline-block; padding:.16rem .5rem; border-radius:999px; font-size:.8rem; background:#caebd1; color:#1f6f31; }
        .notice { padding:.75rem .85rem; border-radius:10px; font-weight:700; margin-bottom:.75rem; }
        .notice.success { color:#195d2d; background:#d7f1dc; border:1px solid #a9deba; }
        .notice.error { color:#7d1f1f; background:#f8dede; border:1px solid #edbbbb; }
        .property-form { display:grid; gap:.85rem; }
        .field-grid { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:.75rem; }
        .field { display:grid; gap:.35rem; }
        .field.full { grid-column:1 / -1; }
        .field label { font-size:.85rem; text-transform:uppercase; font-weight:700; color:#586783; }
        .field input, .field select { border:1px solid var(--stroke); border-radius:10px; padding:.75rem .8rem; font:inherit; background:#fff; color:#2f3f5a; width:100%; }
        .field-note { margin:0; color:#5f6e87; font-size:.95rem; }
        .form-divider { margin:.25rem 0; border-top:1px solid #d9e5d9; padding-top:.75rem; }
        .form-actions { display:flex; justify-content:flex-end; gap:.6rem; margin-top:.35rem; }
        .btn-secondary { border:1px solid #9eacb9; border-radius:12px; padding:.68rem 1rem; color:#2d3b52; background:#fff; text-decoration:none; font-weight:700; }
        .btn-primary { border:0; border-radius:999px; padding:.72rem 1.25rem; color:#fff; background:linear-gradient(135deg,#24b313,#149906); font-weight:700; cursor:pointer; }
        .modal-backdrop { position:fixed; inset:0; background:rgba(12,22,40,.52); backdrop-filter: blur(3px); display:flex; align-items:center; justify-content:center; padding:1rem; z-index:80; }
        .modal-sheet { width:min(1040px, 100%); max-height:calc(100vh - 2rem); display:flex; flex-direction:column; background:#f6f8fc; border:1px solid #d5deea; border-radius:16px; box-shadow:0 30px 90px rgba(13,22,39,.35); overflow:hidden; }
        .modal-head { display:flex; align-items:center; justify-content:space-between; padding:.95rem 1.15rem; border-bottom:1px solid #d9e2ed; background:#fff; }
        .modal-head h3 { margin:0; font-size:1.35rem; line-height:1.1; color:#394662; }
        .modal-close { text-decoration:none; color:#62708a; font-size:1.7rem; line-height:1; width:34px; height:34px; display:grid; place-items:center; border-radius:10px; }
        .modal-close:hover { background:#edf3f9; }
        .modal-body { overflow-y:auto; padding:1rem 1.15rem 1.15rem; font-size:.86rem; scrollbar-gutter: stable; }
        .modal-form { min-height:0; height:100%; display:flex; flex-direction:column; }
        .modal-body { flex:1; min-height:0; }
        .modal-intro { margin:0 0 .8rem; color:#586885; font-size:.86rem; }
        .modal-section { background:#fff; border:1px solid #dbe4ee; border-radius:14px; padding:.88rem; margin-bottom:.8rem; }
        .modal-section-title { margin:0 0 .3rem; font-size:1.02rem; color:#2b3c59; }
        .modal-section-sub { margin:.15rem 0 .72rem; }
        .modal-form .field label { font-size:.75rem; letter-spacing:.03em; color:#5f6d87; }
        .modal-form .field input, .modal-form .field select, .modal-form .field textarea { font-size:.84rem; padding:.6rem .72rem; border:1px solid #ccd7e4; border-radius:11px; background:#fff; color:#2f3f5a; font-family:inherit; width:100%; }
        .modal-form .field textarea { min-height:94px; resize:vertical; }
        .modal-form .field input:focus, .modal-form .field select:focus, .modal-form .field textarea:focus { outline:none; border-color:#2db511; box-shadow:0 0 0 3px rgba(45,181,17,.12); }
        .modal-form input[type=\"file\"] { padding:.45rem .55rem; }
        .modal-form .field-note, .modal-form .sub { font-size:.8rem; color:#66758f; }
        .modal-foot { position:sticky; bottom:0; z-index:2; border-top:1px solid #d9e2ed; padding:.75rem 1.15rem; display:flex; justify-content:flex-end; gap:.55rem; background:#fff; box-shadow:0 -10px 25px rgba(24,38,59,.08); }
        .modal-foot .btn-primary { min-width:168px; }
        .action-box { border:1px solid #d9e6da; border-radius:14px; padding:.85rem; background:#fff; margin-bottom:.9rem; }
        .action-box h3 { margin:0 0 .25rem; font-size:1.08rem; }
        .action-form { display:grid; gap:.65rem; }
        .action-grid { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:.65rem; }
        .action-list { margin-top:.6rem; border-top:1px solid #d9e5d9; padding-top:.55rem; }
        .action-list ul { margin:.2rem 0 0; padding-left:1rem; color:#465875; }
        .float-actions { position:sticky; bottom:.8rem; margin-top:.7rem; display:grid; justify-content:end; gap:.5rem; }
        .float-actions a { text-decoration:none; color:#fff; font-weight:700; border-radius:999px; padding:.75rem 1.1rem; background:linear-gradient(135deg,#2db511,#1f930b); }
        .hero-head { display:flex; align-items:flex-start; justify-content:space-between; gap:.8rem; flex-wrap:wrap; }
        .hero-metric { text-align:right; min-width:130px; }
        .hero-metric .kicker { font-size:.7rem; }
        .hero-metric strong { display:block; font-size:1.6rem; line-height:1.05; color:#182640; }
        .report-grid { display:grid; grid-template-columns:repeat(3,minmax(0,1fr)); gap:.75rem; margin-bottom:.9rem; }
        .report-card { background:#fff; border:1px solid #dbe8db; border-radius:16px; padding:.95rem; display:grid; gap:.45rem; }
        .report-title { margin:0; font-size:.9rem; letter-spacing:.09em; text-transform:uppercase; color:#3d4a66; }
        .report-body { margin:0; color:#556580; font-size:.9rem; min-height:52px; }
        .report-foot { display:flex; align-items:center; justify-content:space-between; gap:.45rem; }
        .tag { display:inline-flex; align-items:center; border-radius:8px; padding:.23rem .5rem; font-size:.74rem; color:#fff; font-weight:700; background:#2f74ff; }
        .tag.green { background:#29b512; }
        .tag.orange { background:#e88614; }
        .tag.red { background:#ef4e43; }
        .tag.slate { background:#374059; }
        .open-btn { text-decoration:none; border:1px solid #89c596; color:#1b8b10; border-radius:9px; padding:.32rem .75rem; font-weight:700; font-size:.8rem; }
        .stats-grid { display:grid; grid-template-columns:repeat(4,minmax(0,1fr)); gap:.75rem; margin-bottom:.9rem; }
        .status-grid { display:grid; grid-template-columns:repeat(6,minmax(0,1fr)); gap:.75rem; margin-bottom:.9rem; }
        .metric-card { background:#fff; border:1px solid #d8e4d8; border-radius:16px; padding:.9rem; }
        .metric-card .value { font-size:1.55rem; margin:.25rem 0 0; }
        .metric-card .mini { margin:.25rem 0 0; color:#5f6f88; }
        .metric-card .mini-btn { float:right; text-decoration:none; color:#fff; background:#22a614; border-radius:8px; padding:.24rem .5rem; font-size:.8rem; font-weight:700; }
        .unit-list { display:grid; gap:.75rem; }
        .unit-card { background:#fff; border:1px solid #d8e4d8; border-radius:18px; padding:.9rem; display:grid; grid-template-columns:1.2fr .8fr .8fr; gap:.8rem; align-items:start; }
        .unit-card h3 { margin:.2rem 0 .25rem; font-size:1.55rem; color:#2b3550; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
        .unit-meta { margin:0; color:#5f6f87; }
        .chip-row { display:flex; flex-wrap:wrap; gap:.35rem; margin-bottom:.35rem; }
        .chip { display:inline-flex; align-items:center; border-radius:6px; padding:.18rem .45rem; font-size:.82rem; font-weight:700; color:#344258; background:#e7ecf1; }
        .chip.green { background:#25ad13; color:#fff; }
        .chip.orange { background:#e58411; color:#fff; }
        .chip.dark { background:#2f3a52; color:#fff; }
        .progress-track { width:100%; height:12px; border-radius:999px; background:#e3ece4; overflow:hidden; margin-top:.4rem; }
        .progress-track span { display:block; height:100%; border-radius:inherit; background:linear-gradient(90deg,#1fae0c,#2dbf14); }
        .muted-list { margin:.5rem 0 0; color:#5a6984; font-weight:700; }
        .unit-actions { display:flex; flex-wrap:wrap; gap:.45rem; margin-top:.75rem; }
        .soft-btn { text-decoration:none; border:1px solid #90cf9b; color:#1d9710; border-radius:10px; padding:.5rem .95rem; font-weight:700; }
        .soft-btn.dark { border-color:#aab8c2; color:#2d3c55; }
        .filters-bar { background:#fff; border:1px solid #d7e4d7; border-radius:16px; padding:.9rem; margin-bottom:.9rem; display:grid; gap:.65rem; }
        .filters-grid { display:grid; grid-template-columns:2fr 1fr 1fr 1fr auto; gap:.6rem; }
        .filters-grid input, .filters-grid select { border:1px solid #cfdae4; border-radius:10px; padding:.68rem .75rem; font:inherit; background:#fff; color:#34435e; width:100%; }
        .filters-grid button { border:0; border-radius:999px; padding:.68rem 1.1rem; color:#fff; background:linear-gradient(135deg,#24b313,#159704); font-weight:700; cursor:pointer; }
        .empty-state { background:#fff; border:1px dashed #b8cabc; border-radius:14px; padding:1rem; color:#5a6880; text-align:center; }
        .approval-list, .activity-list { background:#fff; border:1px solid #d8e4d8; border-radius:16px; padding:.9rem; margin-bottom:.9rem; }
        .approval-item, .activity-item { display:flex; align-items:center; justify-content:space-between; gap:.7rem; padding:.62rem 0; border-bottom:1px solid #e2ece2; }
        .approval-item:last-child, .activity-item:last-child { border-bottom:0; padding-bottom:0; }
        .approval-item:first-child, .activity-item:first-child { padding-top:0; }
        .approval-label { margin:0; font-weight:700; color:#23334e; }
        .approval-sub { margin:.2rem 0 0; color:#63738d; font-size:.84rem; }
        .pipeline { display:grid; grid-template-columns:repeat(4,minmax(0,1fr)); gap:.7rem; margin-bottom:.9rem; }
        .pipeline-step { background:#fff; border:1px solid #d7e3d8; border-radius:14px; padding:.8rem; }
        .pipeline-step h4 { margin:0 0 .28rem; font-size:.82rem; text-transform:uppercase; letter-spacing:.06em; color:#4f607d; }
        .pipeline-step p { margin:0; font-size:1.15rem; font-weight:700; color:#253651; }
        .table-wrap { overflow-x:auto; }
        .table-wrap table { min-width:680px; }
        .settings-shell { display:grid; gap:1rem; }
        .settings-panel { background:#fff; border:1px solid #d6e0ec; border-radius:20px; box-shadow:0 10px 28px rgba(21,42,74,.06); }
        .settings-hero { background:
            radial-gradient(circle at 88% 18%, rgba(57,174,233,.14), transparent 44%),
            radial-gradient(circle at 8% 12%, rgba(72,180,22,.12), transparent 46%),
            #fff; }
        .settings-panel h3 { margin:0; font-size:1.3rem; line-height:1.2; color:#11213d; }
        .settings-top-meta { text-align:right; min-width:130px; color:#5f6f89; }
        .settings-top-meta strong { display:block; margin-top:.2rem; font-size:1.8rem; line-height:1; color:#132746; }
        .settings-title { margin:0; font-size:1.75rem; color:#101f39; letter-spacing:-.01em; }
        .settings-subtitle { margin:.35rem 0 0; color:#5f718d; font-size:.92rem; max-width:620px; }
        .settings-card-title { margin:0; font-size:1.48rem; color:#081a3d; letter-spacing:-.01em; }
        .settings-card-sub { margin:.3rem 0 .9rem; color:#5f7290; font-size:.92rem; }
        .settings-stats { display:grid; grid-template-columns:repeat(4,minmax(0,1fr)); gap:.7rem; margin-bottom:.95rem; }
        .settings-stat { background:#f5f8fd; border:1px solid #d7e1ee; border-radius:14px; padding:.85rem; }
        .settings-stat h4 { margin:0; font-size:.66rem; letter-spacing:.12em; text-transform:uppercase; color:#61718c; }
        .settings-stat p { margin:.32rem 0 0; font-size:1.15rem; color:#102244; font-weight:700; line-height:1.2; }
        .settings-plan-amount { font-size:.84rem !important; color:#5d6e8a !important; font-weight:600 !important; margin-top:.18rem !important; }
        .settings-actions { display:flex; gap:.6rem; flex-wrap:wrap; }
        .settings-btn { border:1px solid transparent; border-radius:12px; padding:.58rem .95rem; font-weight:700; font-size:.86rem; text-decoration:none; display:inline-flex; align-items:center; justify-content:center; cursor:pointer; }
        .settings-btn.dark { background:#2c3652; color:#fff; border-color:#2c3652; }
        .settings-btn.dark:hover { background:#253049; border-color:#253049; }
        .settings-btn.primary { color:#fff; background:linear-gradient(135deg,#2f73ff,#3f56f6); border-color:#2f73ff; }
        .settings-btn.primary:hover { filter:brightness(.96); }
        .settings-btn.ghost { background:#fff; color:#2c3953; border-color:#c8d4e5; }
        .settings-btn.ghost:hover { background:#f6f9fc; }
        .settings-form-grid { display:grid; grid-template-columns:1fr 1fr; gap:.8rem; }
        .settings-field { display:grid; gap:.35rem; }
        .settings-field label { font-size:.82rem; font-weight:700; color:#24334f; }
        .settings-field input, .settings-field select { border:1px solid #cbd7e7; border-radius:12px; padding:.68rem .82rem; font:inherit; color:#2a3b57; background:#fff; }
        .settings-field input:focus, .settings-field select:focus { outline:none; border-color:#3f69f4; box-shadow:0 0 0 3px rgba(63,105,244,.12); }
        .settings-field-note { margin:0; color:#6a7b95; font-size:.78rem; line-height:1.4; }
        .settings-subdomain { display:grid; grid-template-columns:minmax(0,1fr) auto; align-items:center; gap:.5rem; }
        .settings-subdomain span { color:#627491; font-size:.88rem; }
        .settings-inline-grid { display:grid; grid-template-columns:repeat(3,minmax(0,1fr)); gap:.75rem; margin-bottom:.1rem; }
        .settings-inline-card { background:#fff; border:1px solid #d9e3ef; border-radius:16px; padding:.95rem; }
        .settings-inline-card h4 { margin:0; font-size:1.08rem; color:#0f2344; }
        .settings-inline-card p { margin:.32rem 0 .62rem; color:#5f7290; font-size:.84rem; }
        .settings-toggle-row { display:flex; align-items:center; gap:.55rem; flex-wrap:wrap; color:#617391; font-size:.84rem; }
        .settings-toggle-row strong { font-size:.92rem; color:#0f203e; font-weight:700; }
        .settings-toggle-row input { width:22px; height:22px; accent-color:#2b7eff; }
        .settings-inline-actions { margin-top:.8rem; display:flex; gap:.6rem; flex-wrap:wrap; }
        .settings-collections-grid { display:grid; grid-template-columns:repeat(3,minmax(0,1fr)); gap:.7rem; margin-bottom:.7rem; }
        @media (max-width:1024px) { .layout { grid-template-columns:1fr; } .sidebar { max-height:260px; } body { overflow:auto; } .main, .sidebar { overflow:visible; } }
        @media (max-width:760px) { .cards, .search-row, .field-grid, .action-grid, .report-grid, .stats-grid, .status-grid, .pipeline, .settings-stats, .settings-inline-grid, .settings-collections-grid, .settings-form-grid { grid-template-columns:1fr; } .section h2 { font-size:1.25rem; } .prop-actions { flex-direction:column; } .search { width:100%; } .form-actions { justify-content:stretch; } .btn-secondary, .btn-primary { text-align:center; } .modal-head h3 { font-size:1.2rem; } .unit-card { grid-template-columns:1fr; } .filters-grid { grid-template-columns:1fr; } .hero-metric { text-align:left; } .settings-subdomain { grid-template-columns:1fr; } .settings-top-meta { text-align:left; } .settings-title { font-size:1.35rem; } }
    </style>
</head>
<body>
@php
    $section = $section ?? 'dashboard';
    $activeAction = $activeAction ?? request('action');
    $query = request('q');
    $portfolioProperties = collect($portfolioProperties ?? []);
    $tenantLinks = collect($tenantLinks ?? []);
    $totalUnits = (int) ($totalUnits ?? $portfolioProperties->sum('total_units'));
    $occupiedUnits = (int) ($occupiedUnits ?? $portfolioProperties->sum('occupied_units'));
    $vacantUnits = (int) ($vacantUnits ?? $portfolioProperties->sum('vacant_units'));
    $tenantTotal = (int) $tenantLinks->count();
    $leasesTotal = (int) ($leasesTotal ?? 0);
    $invoiceTotal = (int) ceil($tenantTotal / 4);
    $collectionTotal = (int) ceil($occupiedUnits / 6);
    $documentsTotal = (int) ($documentsTotal ?? 10);
    $settingsData = (array) ($settingsData ?? []);
    $sectionLabels = [
        'dashboard' => 'Dashboard', 'reports' => 'Reports', 'approvals' => 'Approvals', 'properties' => 'Properties',
        'units' => 'Units', 'vacant-units' => 'Vacant Units', 'tenants' => 'Tenants', 'leases' => 'Leases', 'bookings' => 'Bookings',
        'invoices' => 'Invoices', 'collections' => 'Collections', 'utility-readings' => 'Utility Readings', 'accounting' => 'Accounting',
        'expenses' => 'Expenses', 'leads' => 'Leads', 'lead-pipeline' => 'Lead Pipeline', 'cases' => 'Cases', 'security-logbook' => 'Security Logbook',
        'tickets' => 'Tickets', 'documents' => 'Documents', 'audit-logs' => 'Audit Logs', 'teams' => 'Teams', 'departments' => 'Departments',
        'commissions' => 'Commissions', 'commission-payouts' => 'Commission Payouts', 'users' => 'Users', 'settings' => 'Settings', 'billing-invoices' => 'Billing Invoices',
    ];
    $actionLabels = [
        'new-property' => 'New Property', 'import-data' => 'Import Data', 'link-tenant' => 'Link Tenant to Unit', 'branches' => 'Branches', 'utility-accounts' => 'Utility Accounts',
    ];
    $currentLabel = $sectionLabels[$section] ?? 'Module';
@endphp
    <div class="page">
        <header class="topbar">
            <div class="tenant">Demo Business 1035</div>
            <div class="top-actions">
                <form class="search" method="GET" action="{{ route('admin.properties') }}">
                    <input type="text" name="q" placeholder="Search tenant or unit" value="{{ request('q') }}">
                    <button type="submit">Go</button>
                </form>
                <a href="{{ route('admin.properties', ['action' => 'new-property']) }}" class="pill strong">+ Add</a>
                <a href="{{ route('admin.security-logbook') }}" class="pill">Watchman</a>
                <form method="POST" action="{{ route('admin.logout') }}">@csrf<button type="submit" class="pill">Logout</button></form>
            </div>
        </header>

        <div class="layout">
            <aside class="sidebar">
                <div class="group">
                    <h3>Owner</h3>
                    <a class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}"><span class="icon">DB</span>Dashboard</a>
                    <a class="menu-item {{ request()->routeIs('admin.reports') ? 'active' : '' }}" href="{{ route('admin.reports') }}"><span class="icon">RP</span>Reports</a>
                    <a class="menu-item {{ request()->routeIs('admin.approvals') ? 'active' : '' }}" href="{{ route('admin.approvals') }}"><span class="icon">AP</span>Approvals</a>
                </div>
                <div class="group">
                    <h3>Properties</h3>
                    <a class="menu-item {{ request()->routeIs('admin.properties') ? 'active' : '' }}" href="{{ route('admin.properties') }}"><span class="icon">PR</span>Properties <span class="badge">{{ $propertyTotal ?? 13 }}</span></a>
                    <a class="menu-item {{ request()->routeIs('admin.units') ? 'active' : '' }}" href="{{ route('admin.units') }}"><span class="icon">UN</span>Units <span class="badge">{{ $totalUnits }}</span></a>
                    <a class="menu-item {{ request()->routeIs('admin.vacant-units') ? 'active' : '' }}" href="{{ route('admin.vacant-units') }}"><span class="icon">VU</span>Vacant Units <span class="badge">{{ $vacantUnits }}</span></a>
                    <a class="menu-item {{ request()->routeIs('admin.tenants') ? 'active' : '' }}" href="{{ route('admin.tenants') }}"><span class="icon">TN</span>Tenants <span class="badge">{{ $tenantTotal }}</span></a>
                    <a class="menu-item {{ request()->routeIs('admin.leases') ? 'active' : '' }}" href="{{ route('admin.leases') }}"><span class="icon">LS</span>Leases <span class="badge">{{ $leasesTotal }}</span></a>
                    <a class="menu-item {{ request()->routeIs('admin.bookings') ? 'active' : '' }}" href="{{ route('admin.bookings') }}"><span class="icon">BK</span>Bookings</a>
                </div>
                <div class="group">
                    <h3>Utilities</h3>
                    <a class="menu-item {{ request()->routeIs('admin.invoices') ? 'active' : '' }}" href="{{ route('admin.invoices') }}"><span class="icon">IN</span>Invoices <span class="badge">{{ $invoiceTotal }}</span></a>
                    <a class="menu-item {{ request()->routeIs('admin.collections') ? 'active' : '' }}" href="{{ route('admin.collections') }}"><span class="icon">CL</span>Collections <span class="badge">{{ $collectionTotal }}</span></a>
                    <a class="menu-item {{ request()->routeIs('admin.utility-readings') ? 'active' : '' }}" href="{{ route('admin.utility-readings') }}"><span class="icon">UR</span>Utility Readings</a>
                </div>
                <div class="group">
                    <h3>Accounting</h3>
                    <a class="menu-item {{ request()->routeIs('admin.accounting') ? 'active' : '' }}" href="{{ route('admin.accounting') }}"><span class="icon">AC</span>Accounting</a>
                </div>
                <div class="group">
                    <h3>Operations</h3>
                    <a class="menu-item {{ request()->routeIs('admin.expenses') ? 'active' : '' }}" href="{{ route('admin.expenses') }}"><span class="icon">EX</span>Expenses</a>
                    <a class="menu-item {{ request()->routeIs('admin.leads') ? 'active' : '' }}" href="{{ route('admin.leads') }}"><span class="icon">LD</span>Leads <span class="badge">{{ $vacantProperties ?? 0 }}</span></a>
                    <a class="menu-item {{ request()->routeIs('admin.lead-pipeline') ? 'active' : '' }}" href="{{ route('admin.lead-pipeline') }}"><span class="icon">LP</span>Lead Pipeline</a>
                    <a class="menu-item {{ request()->routeIs('admin.cases') ? 'active' : '' }}" href="{{ route('admin.cases') }}"><span class="icon">CS</span>Cases</a>
                    <a class="menu-item {{ request()->routeIs('admin.security-logbook') ? 'active' : '' }}" href="{{ route('admin.security-logbook') }}"><span class="icon">SL</span>Security Logbook</a>
                </div>
                <div class="group">
                    <h3>Administration</h3>
                    <a class="menu-item {{ request()->routeIs('admin.tickets') ? 'active' : '' }}" href="{{ route('admin.tickets') }}"><span class="icon">TK</span>Tickets</a>
                    <a class="menu-item {{ request()->routeIs('admin.documents') ? 'active' : '' }}" href="{{ route('admin.documents') }}"><span class="icon">DC</span>Documents <span class="badge">{{ $documentsTotal }}</span></a>
                    <a class="menu-item {{ request()->routeIs('admin.audit-logs') ? 'active' : '' }}" href="{{ route('admin.audit-logs') }}"><span class="icon">AL</span>Audit Logs</a>
                    <a class="menu-item {{ request()->routeIs('admin.teams') ? 'active' : '' }}" href="{{ route('admin.teams') }}"><span class="icon">TM</span>Teams</a>
                    <a class="menu-item {{ request()->routeIs('admin.departments') ? 'active' : '' }}" href="{{ route('admin.departments') }}"><span class="icon">DP</span>Departments</a>
                    <a class="menu-item {{ request()->routeIs('admin.commissions') ? 'active' : '' }}" href="{{ route('admin.commissions') }}"><span class="icon">CM</span>Commissions</a>
                    <a class="menu-item {{ request()->routeIs('admin.commission-payouts') ? 'active' : '' }}" href="{{ route('admin.commission-payouts') }}"><span class="icon">CP</span>Commission Payouts</a>
                    <a class="menu-item {{ request()->routeIs('admin.users') ? 'active' : '' }}" href="{{ route('admin.users') }}"><span class="icon">US</span>Users</a>
                    <a class="menu-item sub-item {{ request()->routeIs('admin.settings') ? 'active' : '' }}" href="{{ route('admin.settings') }}"><span class="icon">ST</span>Settings</a>
                    <a class="menu-item sub-item {{ request()->routeIs('admin.billing-invoices') ? 'active' : '' }}" href="{{ route('admin.billing-invoices') }}"><span class="icon">BI</span>Billing Invoices</a>
                </div>
            </aside>

            <main class="main">
                <section class="promo">
                    <span>This is a live demo. Want this system set up for your own property?</span>
                    <div>
                        <a href="#" class="btn blue">Activate Your Account</a>
                        <a href="#" class="btn green">WhatsApp Us</a>
                    </div>
                </section>
                <div class="content">
                    @if ($section === 'dashboard')
                        <section class="section filters">
                            <div>
                                <h2>Dashboard filters</h2>
                                <p class="sub">This month . 01 Feb, 2026 - 09 Feb, 2026 . All properties</p>
                            </div>
                            <a href="#" class="pill">Change</a>
                        </section>

                        <section class="cards">
                            <article class="card"><p class="kicker">Total Properties</p><p class="value">13</p><p class="sub">Active now</p></article>
                            <article class="card"><p class="kicker">Total Units</p><p class="value">17</p><p class="sub">Occupied: 12 | Vacant: 5</p></article>
                            <article class="card"><p class="kicker">Occupancy</p><p class="value">70.6%</p><p class="sub">12/17 units</p><div class="bar"><span></span></div></article>
                        </section>

                        <section class="cards">
                            <article class="card"><p class="kicker">Rent Invoices</p><p class="value">4</p><p class="sub">Issued this month</p></article>
                            <article class="card"><p class="kicker">Collected</p><p class="value">KES 190,402</p><p class="sub">In month</p></article>
                            <article class="card"><p class="kicker">Outstanding</p><p class="value">KES 429,967</p><p class="sub">Current arrears</p></article>
                        </section>

                        <section class="split">
                            <article class="section chart">
                                <p class="kicker" style="color:#23a613">Rent Collection Trend</p>
                                <h3 style="margin:.35rem 0 0;font-size:1.8rem;">Collected</h3>
                                <div class="chart-grid"></div>
                                <div class="chart-line"></div>
                            </article>
                            <article class="section">
                                <h3 style="margin:0;font-size:1.8rem;">Payment Status</h3>
                                <p class="sub" style="margin-top:.35rem;">Invoices breakdown (This month)</p>
                                <p class="sub" style="margin-top:.15rem;">Total invoices: <strong style="color:#456dff">4</strong></p>
                                <div class="donut"></div>
                            </article>
                        </section>
                    @elseif ($section === 'properties')
                        <section class="section module">
                            <p class="eyebrow">Portfolio</p>
                            <h2>Properties</h2>
                            <p class="module-lead">Monitor occupancy health across every building and act fast where it matters.</p>

                            <div class="prop-actions">
                                <a href="{{ route('admin.properties', ['action' => 'new-property']) }}" class="prop-btn {{ $activeAction === 'new-property' ? 'active' : '' }}">+ New Property</a>
                                <a href="{{ route('admin.properties', ['action' => 'import-data']) }}" class="prop-btn {{ $activeAction === 'import-data' ? 'active' : '' }}">Import data</a>
                                <a href="{{ route('admin.properties', ['action' => 'link-tenant']) }}" class="prop-btn {{ $activeAction === 'link-tenant' ? 'active' : '' }}">Link tenant to unit</a>
                                <a href="{{ route('admin.properties', ['action' => 'branches']) }}" class="prop-btn light {{ $activeAction === 'branches' ? 'active' : '' }}">Branches</a>
                                <a href="{{ route('admin.properties', ['action' => 'utility-accounts']) }}" class="prop-btn light {{ $activeAction === 'utility-accounts' ? 'active' : '' }}">Utility accounts</a>
                            </div>

                            @if ($activeAction && $activeAction !== 'new-property')
                                <p class="sub" style="color:#208f12;font-weight:700;">Selected: {{ $actionLabels[$activeAction] ?? ucwords(str_replace('-', ' ', $activeAction)) }}</p>
                            @endif
                        </section>

                        @if (session('status'))
                            <div class="notice success">{{ session('status') }}</div>
                        @endif

                        @if ($errors->any() && $activeAction !== 'new-property')
                            <div class="notice error">{{ $errors->first() }}</div>
                        @endif

                        @if ($activeAction === 'import-data')
                            <section class="action-box">
                                <h3>Import property data</h3>
                                <p class="sub">Upload a CSV/Excel file to bulk-add properties.</p>
                                <form method="POST" action="{{ route('admin.properties.import') }}" enctype="multipart/form-data" class="action-form">
                                    @csrf
                                    <div class="field">
                                        <label for="import_file">Data File</label>
                                        <input id="import_file" type="file" name="import_file" accept=".csv,.txt,.xls,.xlsx" required>
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn-primary">Upload file</button>
                                    </div>
                                </form>
                            </section>
                        @endif

                        @if ($activeAction === 'link-tenant')
                            <section class="action-box">
                                <h3>Link tenant to unit</h3>
                                <p class="sub">Assign a tenant name to a specific unit for one property.</p>
                                <form method="POST" action="{{ route('admin.properties.link-tenant') }}" class="action-form">
                                    @csrf
                                    <div class="action-grid">
                                        <div class="field">
                                            <label for="property_id">Property</label>
                                            <select id="property_id" name="property_id" required>
                                                <option value="">Select property</option>
                                                @foreach (($properties ?? collect()) as $propertyOption)
                                                    <option value="{{ $propertyOption->id }}" @selected(old('property_id') == $propertyOption->id)>{{ $propertyOption->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="field">
                                            <label for="unit_number">Unit Number</label>
                                            <input id="unit_number" type="text" name="unit_number" value="{{ old('unit_number') }}" placeholder="e.g. A-03" required>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label for="tenant_name">Tenant Name</label>
                                        <input id="tenant_name" type="text" name="tenant_name" value="{{ old('tenant_name') }}" placeholder="e.g. John Doe" required>
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn-primary">Save link</button>
                                    </div>
                                </form>
                                <div class="action-list">
                                    <strong>Recent links</strong>
                                    <ul>
                                        @forelse (($tenantLinks ?? collect())->take(5) as $link)
                                            <li>{{ $link->tenant_name }} -> Unit {{ $link->unit_number }}</li>
                                        @empty
                                            <li>No tenant-unit links yet.</li>
                                        @endforelse
                                    </ul>
                                </div>
                            </section>
                        @endif

                        @if ($activeAction === 'branches')
                            <section class="action-box">
                                <h3>Branch management</h3>
                                <p class="sub">Create and manage branch offices.</p>
                                <form method="POST" action="{{ route('admin.properties.branches.store') }}" class="action-form">
                                    @csrf
                                    <div class="action-grid">
                                        <div class="field">
                                            <label for="branch_name">Branch Name</label>
                                            <input id="branch_name" type="text" name="branch_name" value="{{ old('branch_name') }}" placeholder="e.g. Westlands Branch" required>
                                        </div>
                                        <div class="field">
                                            <label for="branch_location">Branch Location</label>
                                            <input id="branch_location" type="text" name="branch_location" value="{{ old('branch_location') }}" placeholder="e.g. Waiyaki Way">
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn-primary">Save branch</button>
                                    </div>
                                </form>
                                <div class="action-list">
                                    <strong>Saved branches</strong>
                                    <ul>
                                        @forelse (($branches ?? collect())->take(6) as $branchItem)
                                            <li>{{ $branchItem->name }} @if($branchItem->location) ({{ $branchItem->location }}) @endif</li>
                                        @empty
                                            <li>No branches saved yet.</li>
                                        @endforelse
                                    </ul>
                                </div>
                            </section>
                        @endif

                        @if ($activeAction === 'utility-accounts')
                            <section class="action-box">
                                <h3>Utility accounts</h3>
                                <p class="sub">Capture utility billing accounts for properties.</p>
                                <form method="POST" action="{{ route('admin.properties.utility-accounts.store') }}" class="action-form">
                                    @csrf
                                    <div class="action-grid">
                                        <div class="field">
                                            <label for="utility_property_id">Property (Optional)</label>
                                            <select id="utility_property_id" name="property_id">
                                                <option value="">No property</option>
                                                @foreach (($properties ?? collect()) as $propertyOption)
                                                    <option value="{{ $propertyOption->id }}" @selected(old('property_id') == $propertyOption->id)>{{ $propertyOption->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="field">
                                            <label for="provider">Provider</label>
                                            <input id="provider" type="text" name="provider" value="{{ old('provider') }}" placeholder="e.g. Kenya Power" required>
                                        </div>
                                        <div class="field">
                                            <label for="account_number">Account Number</label>
                                            <input id="account_number" type="text" name="account_number" value="{{ old('account_number') }}" placeholder="e.g. KPLC-7782" required>
                                        </div>
                                        <div class="field">
                                            <label for="utility_paybill">Paybill Number</label>
                                            <input id="utility_paybill" type="text" name="utility_paybill" value="{{ old('utility_paybill') }}" placeholder="e.g. 888880">
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn-primary">Save utility account</button>
                                    </div>
                                </form>
                                <div class="action-list">
                                    <strong>Recent utility accounts</strong>
                                    <ul>
                                        @forelse (($utilityAccounts ?? collect())->take(6) as $utility)
                                            <li>{{ $utility->provider }} - {{ $utility->account_number }}</li>
                                        @empty
                                            <li>No utility accounts saved yet.</li>
                                        @endforelse
                                    </ul>
                                </div>
                            </section>
                        @endif

                        <section class="section">
                            <form method="GET" action="{{ route('admin.properties') }}">
                                @if ($activeAction)
                                    <input type="hidden" name="action" value="{{ $activeAction }}">
                                @endif
                                <p class="search-label">Search Property</p>
                                <div class="search-row">
                                    <div class="search-input">
                                        <span>Q</span>
                                        <input type="text" name="q" placeholder="Property name" value="{{ $query }}">
                                    </div>
                                    <button type="submit" class="search-cta">Search</button>
                                </div>
                            </form>
                            @if ($query)
                                <p class="sub" style="margin-top:.6rem;">Search keyword: "{{ $query }}"</p>
                            @endif
                        </section>

                        <section class="section property-list">
                            <table>
                                <thead>
                                    <tr><th>Property</th><th>Type</th><th>Location</th><th>Paybill</th><th>Service Charge</th><th>Tax</th><th>Status</th></tr>
                                </thead>
                                <tbody>
                                    @forelse (($properties ?? collect()) as $property)
                                        <tr>
                                            <td>{{ $property->name }}</td>
                                            <td>{{ str_replace('_', ' ', ucfirst($property->property_type ?? '-')) }}</td>
                                            <td>{{ $property->location ?: '-' }}</td>
                                            <td>{{ $property->paybill_number ?: '-' }}</td>
                                            <td>{{ number_format((float) $property->service_charge, 2) }}%</td>
                                            <td>{{ number_format((float) $property->income_tax, 2) }}%</td>
                                            <td><span class="status">{{ ucfirst($property->status) }}</span></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7">No properties saved yet.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </section>

                        @if ($activeAction === 'new-property')
                            <div class="modal-backdrop">
                                <section class="modal-sheet" role="dialog" aria-modal="true" aria-label="Add property">
                                    <header class="modal-head">
                                        <h3>Add property</h3>
                                        <a href="{{ route('admin.properties') }}" class="modal-close" aria-label="Close">x</a>
                                    </header>
                                    <form method="POST" action="{{ route('admin.properties.store') }}" enctype="multipart/form-data" class="modal-form">
                                        @csrf
                                        <div class="modal-body">
                                            <p class="modal-intro">Capture the building name and (optionally) assign to a landlord profile.</p>

                                            @if ($errors->any())
                                                <div class="notice error">{{ $errors->first() }}</div>
                                            @endif

                                            <section class="modal-section">
                                                <h4 class="modal-section-title">Property details</h4>
                                                <div class="field-grid">
                                                    <div class="field full">
                                                        <label for="name">Property Name</label>
                                                        <input id="name" type="text" name="name" placeholder="e.g. Parklands Plaza" value="{{ old('name') }}" required>
                                                    </div>

                                                    <div class="field">
                                                        <label for="landlord_assignment">Assign To Landlord</label>
                                                        <select id="landlord_assignment" name="landlord_assignment" required>
                                                            <option value="use_my_business" @selected(old('landlord_assignment', 'use_my_business') === 'use_my_business')>Use my business</option>
                                                            <option value="landlord_1" @selected(old('landlord_assignment') === 'landlord_1')>Landlord profile 1</option>
                                                            <option value="landlord_2" @selected(old('landlord_assignment') === 'landlord_2')>Landlord profile 2</option>
                                                        </select>
                                                    </div>

                                                    <div class="field">
                                                        <label for="agent_assignment">Assign To Agent</label>
                                                        <select id="agent_assignment" name="agent_assignment" required>
                                                            <option value="no_agent" @selected(old('agent_assignment', 'no_agent') === 'no_agent')>No agent</option>
                                                            <option value="agent_1" @selected(old('agent_assignment') === 'agent_1')>Agent 1</option>
                                                            <option value="agent_2" @selected(old('agent_assignment') === 'agent_2')>Agent 2</option>
                                                        </select>
                                                        <p class="field-note">Agents receive alerts for payouts and tenant escalations.</p>
                                                    </div>

                                                    <div class="field">
                                                        <label for="branch">Branch (Optional)</label>
                                                        <select id="branch" name="branch">
                                                            <option value="no_branch" @selected(old('branch', 'no_branch') === 'no_branch')>No branch</option>
                                                            <option value="westlands" @selected(old('branch') === 'westlands')>Westlands</option>
                                                            <option value="kilimani" @selected(old('branch') === 'kilimani')>Kilimani</option>
                                                            <option value="karen" @selected(old('branch') === 'karen')>Karen</option>
                                                        </select>
                                                    </div>

                                                    <div class="field">
                                                        <label for="property_type">Property Type</label>
                                                        <select id="property_type" name="property_type" required>
                                                            <option value="" @selected(old('property_type') === null)>Select type</option>
                                                            <option value="apartment" @selected(old('property_type') === 'apartment')>Apartment</option>
                                                            <option value="bedsitter" @selected(old('property_type') === 'bedsitter')>Bedsitter</option>
                                                            <option value="mixed_use" @selected(old('property_type') === 'mixed_use')>Mixed use</option>
                                                            <option value="commercial" @selected(old('property_type') === 'commercial')>Commercial</option>
                                                            <option value="maisonette" @selected(old('property_type') === 'maisonette')>Maisonette</option>
                                                        </select>
                                                    </div>

                                                    <div class="field">
                                                        <label for="units_count">Total Units (Optional)</label>
                                                        <input id="units_count" type="number" min="0" name="units_count" value="{{ old('units_count') }}" placeholder="e.g. 24">
                                                    </div>

                                                    <div class="field full">
                                                        <label for="location">Location</label>
                                                        <input id="location" type="text" name="location" placeholder="e.g. Upper Hill Road" value="{{ old('location') }}">
                                                    </div>

                                                    <div class="field">
                                                        <label for="contact_phone">Contact Phone (Optional)</label>
                                                        <input id="contact_phone" type="text" name="contact_phone" placeholder="e.g. +254700000000" value="{{ old('contact_phone') }}">
                                                    </div>

                                                    <div class="field">
                                                        <label for="contact_email">Contact Email (Optional)</label>
                                                        <input id="contact_email" type="email" name="contact_email" placeholder="e.g. property@company.com" value="{{ old('contact_email') }}">
                                                    </div>

                                                    <div class="field full">
                                                        <label for="description">Property Description (Optional)</label>
                                                        <textarea id="description" name="description" placeholder="Short summary of the property, amenities, and management notes.">{{ old('description') }}</textarea>
                                                    </div>
                                                </div>
                                            </section>

                                            <section class="modal-section">
                                                <h4 class="modal-section-title">Payment instructions</h4>
                                                <p class="sub modal-section-sub">Shown on invoice messages for this property.</p>
                                                <div class="field-grid">
                                                    <div class="field">
                                                        <label for="paybill_number">Paybill Number</label>
                                                        <input id="paybill_number" type="text" name="paybill_number" placeholder="e.g. 123456" value="{{ old('paybill_number') }}">
                                                    </div>

                                                    <div class="field">
                                                        <label for="account_format">Account Format</label>
                                                        <select id="account_format" name="account_format" required>
                                                            <option value="unit_number" @selected(old('account_format', 'unit_number') === 'unit_number')>Unit number</option>
                                                            <option value="tenant_name" @selected(old('account_format') === 'tenant_name')>Tenant name</option>
                                                            <option value="manual_reference" @selected(old('account_format') === 'manual_reference')>Manual reference</option>
                                                        </select>
                                                    </div>

                                                    <div class="field full">
                                                        <label for="featured_image">Featured Image</label>
                                                        <input id="featured_image" type="file" name="featured_image" accept="image/*">
                                                        <p class="field-note">Upload a cover photo for this property (optional).</p>
                                                    </div>

                                                    <div class="field">
                                                        <label for="service_charge">Service Charge (%)</label>
                                                        <input id="service_charge" type="number" step="0.01" min="0" max="100" name="service_charge" value="{{ old('service_charge', '0') }}" required>
                                                    </div>

                                                    <div class="field">
                                                        <label for="income_tax">Income Tax (%)</label>
                                                        <input id="income_tax" type="number" step="0.01" min="0" max="100" name="income_tax" value="{{ old('income_tax', '0') }}" required>
                                                    </div>

                                                    <div class="field full">
                                                        <label for="notes">Additional Notes (Optional)</label>
                                                        <textarea id="notes" name="notes" placeholder="Any additional instructions for this property setup.">{{ old('notes') }}</textarea>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>

                                        <footer class="modal-foot">
                                            <a href="{{ route('admin.properties') }}" class="btn-secondary">Cancel</a>
                                            <button type="submit" class="btn-primary">Save property</button>
                                        </footer>
                                    </form>
                                </section>
                            </div>
                        @endif
                    @elseif ($section === 'reports')
                        @php
                            $reportCards = [
                                ['title' => 'Tenant Statements', 'description' => 'Statement library for every tenant.', 'tag' => 'Report', 'tone' => 'blue'],
                                ['title' => 'Booking Report', 'description' => 'Short-stay bookings with revenue and channel mix.', 'tag' => 'Report', 'tone' => 'green'],
                                ['title' => 'Payments by Month', 'description' => 'Monthly revenue grouped by service category.', 'tag' => 'Report', 'tone' => 'blue'],
                                ['title' => 'Invoices by Month', 'description' => 'Full invoice issuance trend each month.', 'tag' => 'Report', 'tone' => 'orange'],
                                ['title' => 'Payments by Bank', 'description' => 'Bank performance and inflows.', 'tag' => 'Report', 'tone' => 'green'],
                                ['title' => 'Tenant Balances', 'description' => 'Outstanding vs prepaid tenants by branch/property.', 'tag' => 'Report', 'tone' => 'red'],
                                ['title' => 'Opening Balance Report', 'description' => 'Month-end arrears and opening balance roll-forward.', 'tag' => 'Report', 'tone' => 'orange'],
                                ['title' => 'Analytics Dashboard', 'description' => 'Visual KPIs and portfolio insights.', 'tag' => 'Featured', 'tone' => 'green'],
                                ['title' => 'Security Deposits', 'description' => 'Single view: missing vs unrefunded deposits.', 'tag' => 'Report', 'tone' => 'red'],
                            ];
                        @endphp
                        <section class="section">
                            <div class="hero-head">
                                <div>
                                    <p class="eyebrow">Insights</p>
                                    <h2>Reports</h2>
                                    <p class="sub">Quick access to summary reports and dashboards.</p>
                                </div>
                                <div class="hero-metric">
                                    <p class="kicker">Available</p>
                                    <strong>{{ count($reportCards) }}</strong>
                                </div>
                            </div>
                        </section>
                        <section class="report-grid">
                            @foreach ($reportCards as $card)
                                <article class="report-card">
                                    <p class="report-title">{{ $card['title'] }}</p>
                                    <p class="report-body">{{ $card['description'] }}</p>
                                    <div class="report-foot">
                                        <span class="tag {{ $card['tone'] !== 'blue' ? $card['tone'] : '' }}">{{ $card['tag'] }}</span>
                                        <a class="open-btn" href="#">Open -></a>
                                    </div>
                                </article>
                            @endforeach
                        </section>
                    @elseif ($section === 'approvals')
                        @php
                            $approvalQueue = $portfolioProperties->values()->take(6)->map(function (array $property, int $index): array {
                                return [
                                    'title' => $index % 2 === 0 ? 'Vacancy listing approval' : 'Lease status update',
                                    'subject' => $property['name'],
                                    'submitted' => now()->subDays($index + 1)->format('d M Y'),
                                    'priority' => $index === 0 ? 'High' : 'Normal',
                                ];
                            });

                            if ($approvalQueue->isEmpty()) {
                                $approvalQueue = collect([
                                    ['title' => 'No pending items', 'subject' => 'Your queue is clear.', 'submitted' => now()->format('d M Y'), 'priority' => 'Normal'],
                                ]);
                            }
                        @endphp
                        <section class="section">
                            <div class="hero-head">
                                <div>
                                    <p class="eyebrow">Workflow</p>
                                    <h2>Approvals</h2>
                                    <p class="sub">Review updates waiting for sign-off before they go live.</p>
                                </div>
                                <div class="hero-metric">
                                    <p class="kicker">Pending</p>
                                    <strong>{{ $approvalQueue->count() }}</strong>
                                </div>
                            </div>
                        </section>
                        <section class="stats-grid">
                            <article class="metric-card"><p class="kicker">New today</p><p class="value">{{ min($approvalQueue->count(), 3) }}</p><p class="mini">Requires manager review</p></article>
                            <article class="metric-card"><p class="kicker">High priority</p><p class="value">{{ $approvalQueue->where('priority', 'High')->count() }}</p><p class="mini">Time-sensitive items</p></article>
                            <article class="metric-card"><p class="kicker">Avg. age</p><p class="value">2d</p><p class="mini">Across open requests</p></article>
                            <article class="metric-card"><p class="kicker">Completed</p><p class="value">0</p><p class="mini">This session</p></article>
                        </section>
                        <section class="approval-list">
                            @foreach ($approvalQueue as $approval)
                                <article class="approval-item">
                                    <div>
                                        <p class="approval-label">{{ $approval['title'] }}</p>
                                        <p class="approval-sub">{{ $approval['subject'] }} . Submitted {{ $approval['submitted'] }}</p>
                                    </div>
                                    <a class="open-btn" href="#">Review</a>
                                </article>
                            @endforeach
                        </section>
                    @elseif ($section === 'units')
                        <section class="stats-grid">
                            <article class="metric-card">
                                <a href="{{ route('admin.units', ['focus' => 'occupied']) }}" class="mini-btn">Filter</a>
                                <p class="kicker">Total Occupied</p>
                                <p class="value">{{ $occupiedUnits }}</p>
                                <p class="mini">Show properties with occupied units.</p>
                            </article>
                            <article class="metric-card">
                                <a href="{{ route('admin.units', ['focus' => 'vacant']) }}" class="mini-btn">Filter</a>
                                <p class="kicker">Total Vacant</p>
                                <p class="value">{{ $vacantUnits }}</p>
                                <p class="mini">Show properties with vacant units.</p>
                            </article>
                            <article class="metric-card">
                                <p class="kicker">Total Properties</p>
                                <p class="value">{{ $portfolioProperties->count() }}</p>
                                <p class="mini">Portfolio cards in this view.</p>
                            </article>
                            <article class="metric-card">
                                <p class="kicker">Occupancy</p>
                                <p class="value">{{ $totalUnits > 0 ? number_format(($occupiedUnits / $totalUnits) * 100, 1) : '0.0' }}%</p>
                                <p class="mini">{{ $occupiedUnits }} occupied of {{ $totalUnits }} units.</p>
                            </article>
                        </section>
                        <section class="unit-list">
                            @forelse ($portfolioProperties as $propertyCard)
                                <article class="unit-card">
                                    <div>
                                        <div class="chip-row">
                                            <span class="chip">{{ $propertyCard['type_label'] }}</span>
                                            <span class="chip">{{ $propertyCard['branch_label'] }}</span>
                                        </div>
                                        <h3 title="{{ $propertyCard['name'] }}">{{ $propertyCard['name'] }}</h3>
                                        <p class="unit-meta">Branch: {{ $propertyCard['location'] }}</p>
                                        <div class="unit-actions">
                                            <a href="{{ route('admin.properties') }}" class="soft-btn">View property</a>
                                            <a href="{{ route('admin.properties', ['action' => 'new-property']) }}" class="soft-btn dark">+ Add units</a>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="chip-row">
                                            <span class="chip dark">Total {{ $propertyCard['total_units'] }}</span>
                                            <span class="chip green">Occupied {{ $propertyCard['occupied_units'] }}</span>
                                            <span class="chip orange">Vacant {{ $propertyCard['vacant_units'] }}</span>
                                        </div>
                                        <p class="unit-meta">Occupancy</p>
                                        <div class="progress-track"><span style="width: {{ $propertyCard['occupancy_rate'] }}%;"></span></div>
                                        <p class="muted-list">{{ $propertyCard['vacant_units'] }} vacant of {{ $propertyCard['total_units'] }}</p>
                                    </div>
                                    <div>
                                        <p class="kicker">Occupied</p>
                                        <div class="chip-row">
                                            @forelse ($propertyCard['occupied_labels'] as $label)
                                                <span class="chip green">{{ $label }}</span>
                                            @empty
                                                <span class="chip">No occupied units</span>
                                            @endforelse
                                        </div>
                                        <p class="kicker" style="margin-top:.55rem;">Vacant</p>
                                        <p class="unit-meta">{{ $propertyCard['vacant_units'] > 0 ? $propertyCard['vacant_units'].' units available' : 'Fully occupied' }}</p>
                                    </div>
                                </article>
                            @empty
                                <div class="empty-state">No property/unit records yet. Add properties to start tracking occupancy.</div>
                            @endforelse
                        </section>
                    @elseif ($section === 'vacant-units')
                        @php
                            $vacantQuery = strtolower(trim((string) request('vacant_q', '')));
                            $vacantPropertyFilter = (string) request('vacant_property', 'all');
                            $vacantCategoryFilter = (string) request('vacant_category', 'all');
                            $vacantListingFilter = (string) request('vacant_listing', 'all');

                            $vacantRows = $portfolioProperties
                                ->filter(fn (array $property): bool => ($property['vacant_units'] ?? 0) > 0)
                                ->filter(function (array $property) use ($vacantQuery, $vacantPropertyFilter, $vacantCategoryFilter, $vacantListingFilter): bool {
                                    if ($vacantQuery !== '' && ! str_contains(strtolower($property['name'].' '.$property['location']), $vacantQuery)) {
                                        return false;
                                    }

                                    if ($vacantPropertyFilter !== 'all' && (string) $property['id'] !== $vacantPropertyFilter) {
                                        return false;
                                    }

                                    if ($vacantCategoryFilter !== 'all' && $property['type_label'] !== $vacantCategoryFilter) {
                                        return false;
                                    }

                                    if ($vacantListingFilter !== 'all' && $property['public_listing'] !== $vacantListingFilter) {
                                        return false;
                                    }

                                    return true;
                                })
                                ->values();
                        @endphp
                        <section class="section">
                            <div class="hero-head">
                                <div>
                                    <p class="eyebrow">Availability</p>
                                    <h2>Vacant Units</h2>
                                    <p class="sub">Focus on unoccupied spaces and keep public listings accurate.</p>
                                </div>
                                <div class="hero-metric">
                                    <p class="kicker">Total Vacant</p>
                                    <strong>{{ $vacantUnits }}</strong>
                                </div>
                            </div>
                        </section>
                        <section class="stats-grid">
                            <article class="metric-card"><p class="kicker">Listed publicly</p><p class="value">{{ $listedPublicly ?? 0 }}</p><p class="mini">Visible on your public units page.</p></article>
                            <article class="metric-card"><p class="kicker">Hidden / Internal</p><p class="value">{{ $hiddenInternally ?? 0 }}</p><p class="mini">Not shown publicly.</p></article>
                            <article class="metric-card"><p class="kicker">Fresh updates</p><p class="value">{{ $freshUpdates ?? 0 }}</p><p class="mini">Results in the current view.</p></article>
                            <article class="metric-card"><p class="kicker">Pending approvals</p><p class="value">{{ $pendingApprovalsTotal ?? 0 }}</p><p class="mini">Listings waiting for sign-off.</p></article>
                        </section>
                        <section class="filters-bar">
                            <form method="GET" action="{{ route('admin.vacant-units') }}" class="filters-grid">
                                <input type="text" name="vacant_q" placeholder="Unit, property or location" value="{{ request('vacant_q') }}">
                                <select name="vacant_property">
                                    <option value="all">All properties</option>
                                    @foreach ($portfolioProperties as $propertyOption)
                                        <option value="{{ $propertyOption['id'] }}" @selected($vacantPropertyFilter === (string) $propertyOption['id'])>{{ $propertyOption['name'] }}</option>
                                    @endforeach
                                </select>
                                <select name="vacant_category">
                                    <option value="all">All categories</option>
                                    @foreach ($portfolioProperties->pluck('type_label')->unique()->sort()->values() as $categoryOption)
                                        <option value="{{ $categoryOption }}" @selected($vacantCategoryFilter === $categoryOption)>{{ $categoryOption }}</option>
                                    @endforeach
                                </select>
                                <select name="vacant_listing">
                                    <option value="all" @selected($vacantListingFilter === 'all')>All listing statuses</option>
                                    <option value="listed" @selected($vacantListingFilter === 'listed')>Listed publicly</option>
                                    <option value="hidden" @selected($vacantListingFilter === 'hidden')>Hidden / internal</option>
                                </select>
                                <button type="submit">Apply</button>
                            </form>
                        </section>
                        <section class="unit-list">
                            @forelse ($vacantRows as $propertyCard)
                                <article class="unit-card">
                                    <div>
                                        <div class="chip-row">
                                            <span class="chip">{{ $propertyCard['type_label'] }}</span>
                                            <span class="chip">{{ $propertyCard['branch_label'] }}</span>
                                        </div>
                                        <h3 title="{{ $propertyCard['name'] }}">{{ $propertyCard['name'] }}</h3>
                                        <p class="unit-meta">{{ $propertyCard['location'] }}</p>
                                    </div>
                                    <div>
                                        <div class="chip-row">
                                            <span class="chip orange">Vacant {{ $propertyCard['vacant_units'] }}</span>
                                            <span class="chip dark">Total {{ $propertyCard['total_units'] }}</span>
                                        </div>
                                        <p class="unit-meta">Occupancy {{ $propertyCard['occupancy_rate'] }}%</p>
                                        <div class="progress-track"><span style="width: {{ $propertyCard['occupancy_rate'] }}%;"></span></div>
                                    </div>
                                    <div>
                                        <p class="kicker">Public Listing</p>
                                        <span class="chip {{ $propertyCard['public_listing'] === 'listed' ? 'green' : '' }}">{{ $propertyCard['public_listing'] === 'listed' ? 'Listed' : 'Hidden' }}</span>
                                        <div class="unit-actions">
                                            <a href="#" class="open-btn">Open -></a>
                                        </div>
                                    </div>
                                </article>
                            @empty
                                <div class="empty-state">No vacant units match the selected filters.</div>
                            @endforelse
                        </section>
                    @elseif ($section === 'leases')
                        @php
                            $selectedLeaseStatus = (string) request('lease_status', 'all');
                            $leaseRows = $portfolioProperties->map(function (array $property): array {
                                $status = 'inactive';
                                if (($property['occupied_units'] ?? 0) > 0) {
                                    $status = 'occupied';
                                }
                                if (($property['vacant_units'] ?? 0) > 0) {
                                    $status = 'vacated';
                                }

                                return [
                                    'property_name' => $property['name'],
                                    'status' => $status,
                                    'occupied_units' => $property['occupied_units'],
                                    'vacant_units' => $property['vacant_units'],
                                    'location' => $property['location'],
                                ];
                            });

                            if ($selectedLeaseStatus !== 'all') {
                                $leaseRows = $leaseRows->where('status', $selectedLeaseStatus)->values();
                            }
                        @endphp
                        <section class="section">
                            <div class="hero-head">
                                <div>
                                    <p class="eyebrow">Portfolio</p>
                                    <h2>Leases</h2>
                                    <p class="sub">A clear ledger of tenant-unit relationships and lease status health.</p>
                                </div>
                                <div class="hero-metric">
                                    <p class="kicker">Total Leases</p>
                                    <strong>{{ $leasesTotal }}</strong>
                                </div>
                            </div>
                        </section>
                        <section class="status-grid">
                            <article class="metric-card"><p class="kicker">Occupied</p><p class="value">{{ $leasesByStatus['occupied'] ?? 0 }}</p><p class="mini"><a class="open-btn" href="{{ route('admin.leases', ['lease_status' => 'occupied']) }}">View</a></p></article>
                            <article class="metric-card"><p class="kicker">Vacated</p><p class="value">{{ $leasesByStatus['vacated'] ?? 0 }}</p><p class="mini"><a class="open-btn" href="{{ route('admin.leases', ['lease_status' => 'vacated']) }}">View</a></p></article>
                            <article class="metric-card"><p class="kicker">Pending</p><p class="value">{{ $leasesByStatus['pending'] ?? 0 }}</p><p class="mini"><a class="open-btn" href="{{ route('admin.leases', ['lease_status' => 'pending']) }}">View</a></p></article>
                            <article class="metric-card"><p class="kicker">Pending move-out</p><p class="value">{{ $leasesByStatus['pending_move_out'] ?? 0 }}</p><p class="mini"><a class="open-btn" href="{{ route('admin.leases', ['lease_status' => 'pending_move_out']) }}">View</a></p></article>
                            <article class="metric-card"><p class="kicker">Inactive</p><p class="value">{{ $leasesByStatus['inactive'] ?? 0 }}</p><p class="mini"><a class="open-btn" href="{{ route('admin.leases', ['lease_status' => 'inactive']) }}">View</a></p></article>
                            <article class="metric-card"><p class="kicker">All statuses</p><p class="value">{{ $leasesTotal }}</p><p class="mini"><a class="open-btn" href="{{ route('admin.leases') }}">Reset</a></p></article>
                        </section>
                        <section class="section">
                            <div class="table-wrap">
                                <table>
                                    <thead>
                                        <tr><th>Property</th><th>Status</th><th>Occupied</th><th>Vacant</th><th>Branch/Location</th></tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($leaseRows as $row)
                                            <tr>
                                                <td>{{ $row['property_name'] }}</td>
                                                <td><span class="status">{{ ucfirst(str_replace('_', ' ', $row['status'])) }}</span></td>
                                                <td>{{ $row['occupied_units'] }}</td>
                                                <td>{{ $row['vacant_units'] }}</td>
                                                <td>{{ $row['location'] }}</td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="5">No lease rows available for this status.</td></tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </section>
                    @elseif ($section === 'tenants')
                        @php
                            $propertyNames = $portfolioProperties->pluck('name', 'id');
                        @endphp
                        <section class="section">
                            <div class="hero-head">
                                <div>
                                    <p class="eyebrow">Residents</p>
                                    <h2>Tenants</h2>
                                    <p class="sub">Track tenant to unit relationships and keep account ownership accurate.</p>
                                </div>
                                <div class="hero-metric">
                                    <p class="kicker">Total Tenants</p>
                                    <strong>{{ $tenantTotal }}</strong>
                                </div>
                            </div>
                        </section>
                        <section class="section">
                            <div class="table-wrap">
                                <table>
                                    <thead>
                                        <tr><th>Tenant</th><th>Unit</th><th>Property</th><th>Last updated</th></tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($tenantLinks as $link)
                                            <tr>
                                                <td>{{ $link->tenant_name }}</td>
                                                <td>{{ $link->unit_number }}</td>
                                                <td>{{ $propertyNames[$link->property_id] ?? 'Property #'.$link->property_id }}</td>
                                                <td>{{ $link->updated_at?->format('d M Y') }}</td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="4">No tenant records found. Use "Link tenant to unit" in Properties.</td></tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </section>
                    @elseif ($section === 'settings')
                        @php
                            $settings = array_merge([
                                'plan_name' => 'Business Plan',
                                'billed_plan' => 'Business Plan',
                                'plan_status' => 'Active',
                                'plan_amount' => 'KES 9,500 / month',
                                'valid_until' => '2026-12-17',
                                'public_subdomain' => 'youragency',
                                'public_theme' => 'Default',
                                'require_login_code' => false,
                                'auto_generate_invoices' => true,
                                'hide_brought_forward' => false,
                                'auto_close_pending' => true,
                                'collections_grace_days' => 0,
                                'collections_upcoming_due' => '5,3,1',
                                'collections_overdue' => '1,3,7,14,30',
                                'collections_auto_escalate' => 60,
                            ], $settingsData);
                        @endphp
                        <div class="settings-shell">
                        <section class="section settings-panel settings-hero">
                            <div class="hero-head">
                                <div>
                                    <p class="eyebrow">Controls</p>
                                    <h2 class="settings-title">Settings</h2>
                                    <p class="settings-subtitle">Manage system configurations.</p>
                                </div>
                                <div class="settings-top-meta">
                                    <p class="kicker">Sections</p>
                                    <strong>8</strong>
                                </div>
                            </div>
                        </section>

                        @if (session('settings_status'))
                            <div class="notice success">{{ session('settings_status') }}</div>
                        @endif
                        @if (session('settings_error'))
                            <div class="notice error">{{ session('settings_error') }}</div>
                        @endif
                        @if ($errors->any())
                            <div class="notice error">{{ $errors->first() }}</div>
                        @endif

                        <section class="section settings-panel">
                            <h3 class="settings-card-title">Subscription Plan</h3>
                            <p class="settings-card-sub">Your current plan and subscription status.</p>
                            <div class="settings-stats">
                                <article class="settings-stat">
                                    <h4>Selected Plan</h4>
                                    <p>{{ $settings['plan_name'] }}</p>
                                </article>
                                <article class="settings-stat">
                                    <h4>Billed At</h4>
                                    <p>{{ $settings['billed_plan'] }}</p>
                                    <p class="settings-plan-amount">{{ $settings['plan_amount'] }}</p>
                                </article>
                                <article class="settings-stat">
                                    <h4>Status</h4>
                                    <p>{{ $settings['plan_status'] }}</p>
                                </article>
                                <article class="settings-stat">
                                    <h4>Valid Until</h4>
                                    <p>{{ $settings['valid_until'] }}</p>
                                </article>
                            </div>
                            <div class="settings-actions">
                                <button class="settings-btn dark" type="button">Change plan</button>
                                <a class="settings-btn dark" href="{{ route('admin.billing-invoices') }}">View billing invoices</a>
                            </div>
                        </section>

                        <section class="section settings-panel">
                            <h3 class="settings-card-title">Public Site</h3>
                            <p class="settings-card-sub">Set the subdomain and theme for your agency-facing landing page.</p>
                            <form method="POST" action="{{ route('admin.settings.save') }}">
                                @csrf
                                <input type="hidden" name="form_key" value="public-site">
                                <div class="settings-form-grid">
                                    <div class="settings-field">
                                        <label for="public_subdomain">Subdomain</label>
                                        <div class="settings-subdomain">
                                            <input id="public_subdomain" type="text" name="public_subdomain" value="{{ old('public_subdomain', $settings['public_subdomain']) }}" required>
                                            <span>.rentaldesk.co.ke</span>
                                        </div>
                                        <p class="settings-field-note">Must be unique; use letters, numbers, and dashes only.</p>
                                    </div>
                                    <div class="settings-field">
                                        <label for="public_theme">Theme</label>
                                        <select id="public_theme" name="public_theme">
                                            @foreach (['Default', 'Ocean', 'Forest', 'Slate'] as $themeOption)
                                                <option value="{{ $themeOption }}" @selected(old('public_theme', $settings['public_theme']) === $themeOption)>{{ $themeOption }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="settings-inline-actions">
                                    <button type="submit" class="settings-btn primary">Save public site settings</button>
                                </div>
                            </form>
                        </section>

                        <section class="settings-inline-grid">
                            <article class="settings-inline-card">
                                <h4>Services</h4>
                                <p>Update available service types.</p>
                                <button class="settings-btn dark" type="button">Manage Services</button>
                            </article>
                            <article class="settings-inline-card">
                                <h4>Banks</h4>
                                <p>Manage bank names and account numbers.</p>
                                <button class="settings-btn dark" type="button">Manage Banks</button>
                            </article>
                            <article class="settings-inline-card">
                                <h4>Payment Modes</h4>
                                <p>Manage allowed payment methods.</p>
                                <button class="settings-btn dark" type="button">Manage Payment Modes</button>
                            </article>
                        </section>

                        <section class="section settings-panel">
                            <h3 class="settings-card-title">Two-step verification</h3>
                            <p class="settings-card-sub">Control the extra login step (one-time code) for your account.</p>
                            <form method="POST" action="{{ route('admin.settings.save') }}">
                                @csrf
                                <input type="hidden" name="form_key" value="two-factor">
                                <label class="settings-toggle-row">
                                    <input type="checkbox" name="require_login_code" value="1" @checked(old('require_login_code', $settings['require_login_code']))>
                                    <strong>Require a code at login</strong>
                                    <span>{{ $settings['require_login_code'] ? 'Enabled' : 'Disabled' }}</span>
                                </label>
                                <div class="settings-inline-actions">
                                    <button type="submit" class="settings-btn dark">Save verification setting</button>
                                </div>
                            </form>
                        </section>

                        <section class="section settings-panel">
                            <h3 class="settings-card-title">Generate Monthly Invoices</h3>
                            <p class="settings-card-sub">Create rent invoices for a selected month. If the previous month is unpaid, a balance brought forward will be added.</p>
                            <form method="POST" action="{{ route('admin.settings.save') }}">
                                @csrf
                                <input type="hidden" name="form_key" value="invoice-generation">
                                <label class="settings-toggle-row">
                                    <input type="checkbox" name="auto_generate_invoices" value="1" @checked(old('auto_generate_invoices', $settings['auto_generate_invoices']))>
                                    <strong>Auto-generate invoices (every 5 minutes)</strong>
                                    <span>{{ $settings['auto_generate_invoices'] ? 'Enabled (default)' : 'Disabled' }}</span>
                                </label>
                                <div class="settings-inline-actions">
                                    <button type="submit" class="settings-btn dark">Generate Invoices</button>
                                </div>
                            </form>
                        </section>

                        <section class="section settings-panel">
                            <h3 class="settings-card-title">Invoice Print & PDF</h3>
                            <p class="settings-card-sub">Control whether "Balance brought forward" appears on printed and PDF invoices.</p>
                            <form method="POST" action="{{ route('admin.settings.save') }}">
                                @csrf
                                <input type="hidden" name="form_key" value="invoice-pdf">
                                <label class="settings-toggle-row">
                                    <input type="checkbox" name="hide_brought_forward" value="1" @checked(old('hide_brought_forward', $settings['hide_brought_forward']))>
                                    <strong>Hide balance brought forward on print/PDF</strong>
                                    <span>{{ $settings['hide_brought_forward'] ? 'Hidden' : 'Visible' }}</span>
                                </label>
                                <div class="settings-inline-actions">
                                    <button type="submit" class="settings-btn dark">Save invoice print setting</button>
                                </div>
                            </form>
                        </section>

                        <section class="section settings-panel">
                            <h3 class="settings-card-title">Close Zero-Balance Invoices</h3>
                            <p class="settings-card-sub">Automatically close all pending invoices for tenants whose statement balance is zero or a credit (&lt;= 0).</p>
                            <form method="POST" action="{{ route('admin.settings.save') }}">
                                @csrf
                                <input type="hidden" name="form_key" value="close-zero-balance">
                                <label class="settings-toggle-row">
                                    <input type="checkbox" name="auto_close_pending" value="1" @checked(old('auto_close_pending', $settings['auto_close_pending']))>
                                    <strong>Auto-close pending invoices</strong>
                                    <span>{{ $settings['auto_close_pending'] ? 'Enabled (default)' : 'Disabled' }}</span>
                                </label>
                                <div class="settings-inline-actions">
                                    <button type="submit" class="settings-btn dark">Close Pending Invoices</button>
                                </div>
                            </form>
                        </section>

                        <section class="section settings-panel">
                            <h3 class="settings-card-title">Collections reminders</h3>
                            <p class="settings-card-sub">Configure when the system sends upcoming-due, overdue, promise-to-pay, and escalation reminders.</p>
                            <form method="POST" action="{{ route('admin.settings.save') }}">
                                @csrf
                                <input type="hidden" name="form_key" value="collections-reminders">
                                <div class="settings-collections-grid">
                                    <div class="settings-field">
                                        <label for="collections_grace_days">Grace period (days)</label>
                                        <input id="collections_grace_days" type="number" min="0" max="365" name="collections_grace_days" value="{{ old('collections_grace_days', $settings['collections_grace_days']) }}">
                                        <p class="settings-field-note">Invoice becomes overdue after due date + grace period.</p>
                                    </div>
                                    <div class="settings-field">
                                        <label for="collections_upcoming_due">Upcoming due (days before)</label>
                                        <input id="collections_upcoming_due" type="text" name="collections_upcoming_due" value="{{ old('collections_upcoming_due', $settings['collections_upcoming_due']) }}">
                                        <p class="settings-field-note">Comma list. Example: 5,3,1 sends 5/3/1 days before due.</p>
                                    </div>
                                    <div class="settings-field">
                                        <label for="collections_overdue">Overdue (days after)</label>
                                        <input id="collections_overdue" type="text" name="collections_overdue" value="{{ old('collections_overdue', $settings['collections_overdue']) }}">
                                        <p class="settings-field-note">Comma list. Example: 1,3,7 sends after overdue starts.</p>
                                    </div>
                                </div>
                                <div class="settings-form-grid">
                                    <div class="settings-field">
                                        <label for="collections_auto_escalate">Auto-escalate after (days overdue)</label>
                                        <input id="collections_auto_escalate" type="number" min="0" max="365" name="collections_auto_escalate" value="{{ old('collections_auto_escalate', $settings['collections_auto_escalate']) }}">
                                        <p class="settings-field-note">Set 0 to disable auto-escalation.</p>
                                    </div>
                                </div>
                                <div class="settings-inline-actions">
                                    <button type="submit" class="settings-btn primary">Save collections reminders</button>
                                </div>
                            </form>
                        </section>
                        </div>
                    @elseif ($section === 'lead-pipeline')
                        @php
                            $pipelineSteps = [
                                ['label' => 'New leads', 'value' => max(0, (int) ($vacantProperties ?? 0))],
                                ['label' => 'Contacted', 'value' => max(0, (int) ($vacantProperties ?? 0) - 1)],
                                ['label' => 'Viewing booked', 'value' => max(0, (int) floor(($vacantProperties ?? 0) / 2))],
                                ['label' => 'Ready to lease', 'value' => max(0, (int) floor(($vacantProperties ?? 0) / 3))],
                            ];
                        @endphp
                        <section class="section">
                            <p class="eyebrow">Sales</p>
                            <h2>Lead Pipeline</h2>
                            <p class="sub">Monitor demand from first inquiry to signed lease.</p>
                        </section>
                        <section class="pipeline">
                            @foreach ($pipelineSteps as $step)
                                <article class="pipeline-step">
                                    <h4>{{ $step['label'] }}</h4>
                                    <p>{{ $step['value'] }}</p>
                                </article>
                            @endforeach
                        </section>
                        <section class="activity-list">
                            @forelse ($portfolioProperties->take(5) as $propertyCard)
                                <article class="activity-item">
                                    <div>
                                        <p class="approval-label">Lead update for {{ $propertyCard['name'] }}</p>
                                        <p class="approval-sub">Next action: follow-up call for available units.</p>
                                    </div>
                                    <a class="open-btn" href="#">Open</a>
                                </article>
                            @empty
                                <div class="empty-state">No lead activity yet.</div>
                            @endforelse
                        </section>
                    @elseif (in_array($section, ['bookings', 'invoices', 'collections', 'utility-readings', 'accounting', 'expenses', 'leads', 'cases', 'security-logbook', 'tickets', 'documents', 'audit-logs', 'teams', 'departments', 'commissions', 'commission-payouts', 'users', 'settings', 'billing-invoices'], true))
                        @php
                            $moduleConfigs = [
                                'bookings' => ['eyebrow' => 'Reservations', 'title' => 'Bookings', 'lead' => 'Track reservation requests and occupancy conversion.'],
                                'invoices' => ['eyebrow' => 'Billing', 'title' => 'Invoices', 'lead' => 'Manage invoice flow, due dates, and issuance quality.'],
                                'collections' => ['eyebrow' => 'Receipts', 'title' => 'Collections', 'lead' => 'Follow incoming payments and unresolved balances.'],
                                'utility-readings' => ['eyebrow' => 'Metering', 'title' => 'Utility Readings', 'lead' => 'Capture meter readings and usage-based charges.'],
                                'accounting' => ['eyebrow' => 'Finance', 'title' => 'Accounting', 'lead' => 'Review cash positions, journals, and reconciliation summaries.'],
                                'expenses' => ['eyebrow' => 'Spend', 'title' => 'Expenses', 'lead' => 'Track operations spend and approval status by property.'],
                                'leads' => ['eyebrow' => 'Pipeline', 'title' => 'Leads', 'lead' => 'Manage prospective tenant inquiries and conversion actions.'],
                                'cases' => ['eyebrow' => 'Support', 'title' => 'Cases', 'lead' => 'Handle maintenance and tenant support cases in one queue.'],
                                'security-logbook' => ['eyebrow' => 'Operations', 'title' => 'Security Logbook', 'lead' => 'Capture gate activity, incidents, and watchman notes.'],
                                'tickets' => ['eyebrow' => 'Support', 'title' => 'Tickets', 'lead' => 'Track support tickets, ownership, and resolution SLAs.'],
                                'documents' => ['eyebrow' => 'Files', 'title' => 'Documents', 'lead' => 'Store contracts, reports, and tenant-facing documents.'],
                                'audit-logs' => ['eyebrow' => 'Compliance', 'title' => 'Audit Logs', 'lead' => 'Review system actions, edits, and sensitive workflow events.'],
                                'teams' => ['eyebrow' => 'People', 'title' => 'Teams', 'lead' => 'Organize users into teams for accountability and assignment.'],
                                'departments' => ['eyebrow' => 'Organization', 'title' => 'Departments', 'lead' => 'Manage operational departments and ownership boundaries.'],
                                'commissions' => ['eyebrow' => 'Payroll', 'title' => 'Commissions', 'lead' => 'Monitor commission accruals from collections and deals.'],
                                'commission-payouts' => ['eyebrow' => 'Payroll', 'title' => 'Commission Payouts', 'lead' => 'Track approved commission payouts and payment history.'],
                                'users' => ['eyebrow' => 'Access', 'title' => 'Users', 'lead' => 'Manage user accounts, roles, and portal permissions.'],
                                'settings' => ['eyebrow' => 'Access', 'title' => 'Settings', 'lead' => 'Configure user defaults, alerts, and security preferences.'],
                                'billing-invoices' => ['eyebrow' => 'Access', 'title' => 'Billing Invoices', 'lead' => 'Review plan invoices tied to user and account subscriptions.'],
                            ];
                            $module = $moduleConfigs[$section];
                            $activityRows = $portfolioProperties->values()->take(5)->map(function (array $property, int $index) use ($module): array {
                                return [
                                    'title' => $module['title'].' update for '.$property['name'],
                                    'meta' => 'Recorded '.now()->subHours($index + 2)->format('d M Y, H:i'),
                                ];
                            });
                        @endphp
                        <section class="section">
                            <p class="eyebrow">{{ $module['eyebrow'] }}</p>
                            <h2>{{ $module['title'] }}</h2>
                            <p class="sub">{{ $module['lead'] }}</p>
                        </section>
                        <section class="stats-grid">
                            <article class="metric-card"><p class="kicker">Open items</p><p class="value">{{ max(0, $vacantUnits) }}</p><p class="mini">Needs action this week</p></article>
                            <article class="metric-card"><p class="kicker">In progress</p><p class="value">{{ max(0, $occupiedProperties ?? 0) }}</p><p class="mini">Assigned to team</p></article>
                            <article class="metric-card"><p class="kicker">Closed</p><p class="value">{{ max(0, ($propertyTotal ?? 0) - ($vacantProperties ?? 0)) }}</p><p class="mini">Resolved this cycle</p></article>
                            <article class="metric-card"><p class="kicker">Watchlist</p><p class="value">{{ max(0, $vacantProperties ?? 0) }}</p><p class="mini">Requires follow-up</p></article>
                        </section>
                        <section class="activity-list">
                            @forelse ($activityRows as $activity)
                                <article class="activity-item">
                                    <div>
                                        <p class="approval-label">{{ $activity['title'] }}</p>
                                        <p class="approval-sub">{{ $activity['meta'] }}</p>
                                    </div>
                                    <a class="open-btn" href="#">Open</a>
                                </article>
                            @empty
                                <div class="empty-state">No activity logged yet.</div>
                            @endforelse
                        </section>
                    @else
                        <section class="section module">
                            <p class="eyebrow">Module</p>
                            <h2>{{ $currentLabel }}</h2>
                            <p class="module-lead">This section is routed and ready for extended workflows.</p>
                            <a class="open-btn" href="{{ route('admin.dashboard') }}">Back to Dashboard</a>
                        </section>
                    @endif

                    <div class="float-actions">
                        <a href="#">Live Chat</a>
                        <a href="#">WhatsApp Us</a>
                    </div>
                </div>
            </main>
        </div>
    </div>
    @if ($section === 'properties' && $activeAction === 'new-property')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const modalBody = document.querySelector('.modal-body');
                if (modalBody) {
                    modalBody.scrollTop = 0;
                }

                const firstField = document.getElementById('name');
                if (firstField) {
                    firstField.focus({ preventScroll: true });
                }
            });
        </script>
    @endif
</body>
</html>
