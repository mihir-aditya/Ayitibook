{{-- resources/views/seller/partials/_base.blade.php --}}
{{-- Include in <head> of every seller page --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
/* ══════════════════════════════════════════════════════════
   SELLERHUB — SHARED LIGHT-MODE DESIGN SYSTEM
   ══════════════════════════════════════════════════════════ */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
    --bg:        #f0f2f7;
    --surface:   #ffffff;
    --card:      #ffffff;
    --border:    #e4e7ef;
    --border2:   #cdd1de;
    --muted:     #e8eaf2;
    --text:      #1a1d28;
    --text2:     #3d4259;
    --sub:       #7a82a0;
    --accent:    #5b7cfa;
    --accent-bg: rgba(91,124,250,.10);
    --accent2:   #22c47a;
    --accent2-bg:rgba(34,196,122,.10);
    --accent3:   #f59e0b;
    --accent3-bg:rgba(245,158,11,.10);
    --danger:    #f43f5e;
    --danger-bg: rgba(244,63,94,.10);
    --info:      #06b6d4;
    --info-bg:   rgba(6,182,212,.10);
    --font:      'DM Sans', sans-serif;
    --mono:      'DM Mono', monospace;
    --radius:    14px;
    --radius-sm: 9px;
    --sidebar-w: 240px;
    --header-h:  64px;
    --shadow:    0 1px 3px rgba(0,0,0,.05), 0 4px 16px rgba(0,0,0,.04);
    --shadow-md: 0 2px 8px rgba(0,0,0,.08), 0 8px 24px rgba(0,0,0,.06);
    --shadow-lg: 0 4px 16px rgba(0,0,0,.10), 0 16px 40px rgba(0,0,0,.08);
}

html, body { height: 100%; background: var(--bg); color: var(--text); font-family: var(--font); font-size: 14px; line-height: 1.5; }
a { color: var(--accent); text-decoration: none; }
a:hover { text-decoration: underline; }

/* ── LAYOUT ── */
.sh-layout { display: grid; grid-template-columns: var(--sidebar-w) 1fr; grid-template-rows: var(--header-h) 1fr; min-height: 100vh; }

/* ── SIDEBAR ── */
.sh-sidebar {
    grid-row: 1 / -1; grid-column: 1;
    background: var(--surface);
    border-right: 1px solid var(--border);
    display: flex; flex-direction: column;
    position: sticky; top: 0; height: 100vh; overflow: hidden;
}
.sh-sidebar-logo {
    height: var(--header-h); flex-shrink: 0;
    display: flex; align-items: center; gap: 10px;
    padding: 0 20px;
    border-bottom: 1px solid var(--border);
    font-weight: 700; font-size: 15px; color: var(--text);
}
.sh-logo-icon {
    width: 32px; height: 32px; border-radius: 8px; flex-shrink: 0;
    background: linear-gradient(135deg, var(--accent), #8b5cf6);
    display: flex; align-items: center; justify-content: center; font-size: 16px;
}
.sh-sidebar-nav { flex: 1; padding: 14px 10px; display: flex; flex-direction: column; gap: 1px; overflow-y: auto; }
.sh-nav-label {
    font-size: 10px; font-weight: 700; letter-spacing: 1.2px;
    color: var(--sub); text-transform: uppercase;
    padding: 12px 10px 5px;
}
.sh-nav-item {
    display: flex; align-items: center; gap: 10px;
    padding: 9px 12px; border-radius: 9px;
    color: var(--sub); text-decoration: none !important;
    font-size: 13.5px; font-weight: 500;
    transition: all .15s; cursor: pointer;
}
.sh-nav-item:hover { background: var(--bg); color: var(--text2); }
.sh-nav-item.active { background: var(--accent-bg); color: var(--accent); }
.sh-nav-item .sh-icon { width: 18px; text-align: center; font-size: 15px; flex-shrink: 0; }
.sh-nav-badge {
    margin-left: auto; background: var(--danger);
    color: #fff; font-size: 10px; font-weight: 700;
    padding: 1px 6px; border-radius: 20px;
}
.sh-sidebar-footer { padding: 14px 10px; border-top: 1px solid var(--border); flex-shrink: 0; }
.sh-seller-card {
    display: flex; align-items: center; gap: 10px;
    padding: 10px 12px; border-radius: 10px;
    background: var(--bg); border: 1px solid var(--border);
}
.sh-avatar {
    width: 34px; height: 34px; border-radius: 50%; flex-shrink: 0;
    background: linear-gradient(135deg, var(--accent2), var(--accent));
    display: flex; align-items: center; justify-content: center;
    font-weight: 700; font-size: 13px; color: #fff;
}
.sh-seller-card .sh-sc-info { flex: 1; min-width: 0; }
.sh-seller-card .sh-sc-name { font-size: 13px; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; color: var(--text); }
.sh-seller-card .sh-sc-role { font-size: 11px; color: var(--sub); }
.sh-online { width: 8px; height: 8px; border-radius: 50%; background: var(--accent2); flex-shrink: 0; box-shadow: 0 0 0 2px #fff, 0 0 6px var(--accent2); }

/* ── HEADER ── */
.sh-header {
    grid-column: 2; grid-row: 1;
    height: var(--header-h);
    background: var(--surface);
    border-bottom: 1px solid var(--border);
    display: flex; align-items: center; justify-content: space-between;
    padding: 0 28px;
    position: sticky; top: 0; z-index: 100;
}
.sh-header-left { display: flex; align-items: center; gap: 12px; }
.sh-header-title { font-size: 15px; font-weight: 700; color: var(--text); }
.sh-header-sub { font-size: 12px; color: var(--sub); margin-top: 1px; }
.sh-header-right { display: flex; align-items: center; gap: 10px; }
.sh-icon-btn {
    width: 36px; height: 36px; border-radius: 9px;
    background: var(--bg); border: 1px solid var(--border);
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; color: var(--sub); font-size: 15px;
    text-decoration: none !important; transition: all .15s; position: relative;
}
.sh-icon-btn:hover { color: var(--text); border-color: var(--border2); box-shadow: var(--shadow); }
.sh-notif-dot {
    position: absolute; top: -3px; right: -3px;
    width: 14px; height: 14px; border-radius: 50%;
    background: var(--danger); border: 2px solid var(--surface);
    font-size: 8px; font-weight: 700; color: #fff;
    display: flex; align-items: center; justify-content: center;
}
.sh-btn {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 8px 16px; border-radius: 9px;
    font-size: 13px; font-weight: 600; cursor: pointer;
    transition: all .15s; border: 1px solid transparent;
    text-decoration: none !important;
}
.sh-btn-primary {
    background: var(--accent); color: #fff;
    box-shadow: 0 2px 8px rgba(91,124,250,.28);
}
.sh-btn-primary:hover { opacity:.88; transform: translateY(-1px); box-shadow: 0 4px 14px rgba(91,124,250,.35); color:#fff; }
.sh-btn-secondary {
    background: var(--bg); color: var(--text2);
    border-color: var(--border);
}
.sh-btn-secondary:hover { border-color: var(--border2); background: var(--muted); color: var(--text); }
.sh-btn-danger { background: var(--danger-bg); color: var(--danger); border-color: rgba(244,63,94,.2); }
.sh-btn-danger:hover { background: var(--danger); color: #fff; }
.sh-btn-sm { padding: 6px 12px; font-size: 12px; border-radius: 7px; }
.sh-btn-xs { padding: 4px 8px; font-size: 11px; border-radius: 6px; }

/* ── MAIN CONTENT ── */
.sh-main { grid-column: 2; grid-row: 2; padding: 28px; overflow-y: auto; }

/* ── CARDS ── */
.sh-card {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    overflow: hidden;
}
.sh-card-header {
    display: flex; align-items: center; justify-content: space-between;
    padding: 16px 22px;
    border-bottom: 1px solid var(--border);
    background: var(--surface);
}
.sh-card-title { font-size: 14px; font-weight: 700; color: var(--text); }
.sh-card-sub { font-size: 12px; color: var(--sub); margin-top: 1px; }
.sh-card-body { padding: 20px 22px; }
.sh-card-footer {
    padding: 14px 22px;
    border-top: 1px solid var(--border);
    background: var(--bg);
}

/* ── METRIC CARDS ── */
.sh-metric {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 20px;
    box-shadow: var(--shadow);
    position: relative; overflow: hidden;
    animation: shFadeUp .4s ease both;
}
.sh-metric::before {
    content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px;
}
.sh-metric.blue::before  { background: linear-gradient(90deg, var(--accent), transparent); }
.sh-metric.green::before { background: linear-gradient(90deg, var(--accent2), transparent); }
.sh-metric.amber::before { background: linear-gradient(90deg, var(--accent3), transparent); }
.sh-metric.red::before   { background: linear-gradient(90deg, var(--danger), transparent); }
.sh-metric.cyan::before  { background: linear-gradient(90deg, var(--info), transparent); }

.sh-metric-icon {
    width: 40px; height: 40px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 18px; margin-bottom: 14px;
}
.sh-metric.blue  .sh-metric-icon { background: var(--accent-bg); }
.sh-metric.green .sh-metric-icon { background: var(--accent2-bg); }
.sh-metric.amber .sh-metric-icon { background: var(--accent3-bg); }
.sh-metric.red   .sh-metric-icon { background: var(--danger-bg); }
.sh-metric.cyan  .sh-metric-icon { background: var(--info-bg); }

.sh-metric-label { font-size: 11px; color: var(--sub); font-weight: 700; text-transform: uppercase; letter-spacing: .6px; }
.sh-metric-value { font-size: 26px; font-weight: 700; font-family: var(--mono); margin: 4px 0 6px; letter-spacing: -1px; color: var(--text); }
.sh-metric-change { font-size: 11.5px; display: flex; align-items: center; gap: 4px; }
.sh-metric-change.up   { color: var(--accent2); }
.sh-metric-change.down { color: var(--danger); }

/* ── TABLE ── */
.sh-table-wrap { overflow-x: auto; }
.sh-table { width: 100%; border-collapse: collapse; }
.sh-table th {
    padding: 10px 18px; text-align: left;
    font-size: 11px; font-weight: 700; letter-spacing: .6px; text-transform: uppercase;
    color: var(--sub); background: var(--bg);
    border-bottom: 1px solid var(--border);
    white-space: nowrap;
}
.sh-table td {
    padding: 13px 18px; font-size: 13px; color: var(--text);
    border-bottom: 1px solid var(--border); vertical-align: middle;
}
.sh-table tr:last-child td { border-bottom: none; }
.sh-table tbody tr:hover td { background: rgba(91,124,250,.03); }

/* ── BADGES / PILLS ── */
.sh-pill {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 3px 9px; border-radius: 20px;
    font-size: 11px; font-weight: 700; white-space: nowrap;
}
.sh-pill::before { content: ''; width: 5px; height: 5px; border-radius: 50%; background: currentColor; }
.sh-pill-delivered, .sh-pill-success { background: var(--accent2-bg); color: #14a05a; }
.sh-pill-pending  { background: var(--accent3-bg); color: #c47d0a; }
.sh-pill-shipped, .sh-pill-confirmed, .sh-pill-info { background: var(--accent-bg); color: var(--accent); }
.sh-pill-cancelled, .sh-pill-danger, .sh-pill-rejected { background: var(--danger-bg); color: var(--danger); }
.sh-pill-placed, .sh-pill-secondary { background: var(--muted); color: var(--sub); }
.sh-pill-refunded { background: var(--info-bg); color: var(--info); }
.sh-pill-approved { background: var(--accent2-bg); color: #14a05a; }

/* ── FORM ELEMENTS ── */
.sh-input, .sh-select, .sh-textarea {
    width: 100%; padding: 8px 12px;
    border: 1px solid var(--border); border-radius: 9px;
    background: var(--surface); color: var(--text);
    font-family: var(--font); font-size: 13px;
    transition: all .15s; outline: none;
    appearance: none;
}
.sh-input:focus, .sh-select:focus, .sh-textarea:focus {
    border-color: var(--accent);
    box-shadow: 0 0 0 3px rgba(91,124,250,.12);
}
.sh-input::placeholder, .sh-textarea::placeholder { color: var(--sub); }
.sh-label { display: block; font-size: 11.5px; font-weight: 600; color: var(--sub); margin-bottom: 5px; text-transform: uppercase; letter-spacing: .4px; }
.sh-select { background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%237a82a0' d='M6 8L1 3h10z'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 12px center; padding-right: 32px; }

/* ── BREADCRUMB ── */
.sh-breadcrumb { display: flex; align-items: center; gap: 6px; font-size: 12.5px; color: var(--sub); margin-bottom: 20px; flex-wrap: wrap; }
.sh-breadcrumb a { color: var(--sub); font-weight: 500; }
.sh-breadcrumb a:hover { color: var(--accent); text-decoration: none; }
.sh-breadcrumb .sep { color: var(--border2); }
.sh-breadcrumb .current { color: var(--text); font-weight: 600; }

/* ── PAGE HEADER ── */
.sh-page-header { display: flex; align-items: flex-start; justify-content: space-between; gap: 16px; margin-bottom: 24px; flex-wrap: wrap; }
.sh-page-title { font-size: 20px; font-weight: 700; color: var(--text); letter-spacing: -.4px; }
.sh-page-sub { font-size: 13px; color: var(--sub); margin-top: 3px; }
.sh-page-actions { display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }

/* ── FILTER BAR ── */
.sh-filter-bar {
    background: var(--surface); border: 1px solid var(--border);
    border-radius: var(--radius); padding: 18px 22px;
    box-shadow: var(--shadow); margin-bottom: 20px;
}
.sh-filter-row { display: flex; gap: 12px; flex-wrap: wrap; align-items: flex-end; }
.sh-filter-group { display: flex; flex-direction: column; gap: 4px; min-width: 160px; flex: 1; }
.sh-filter-actions { display: flex; gap: 8px; align-items: flex-end; flex-shrink: 0; }

/* ── TOAST ── */
.sh-toast-container { position: fixed; bottom: 24px; right: 24px; z-index: 9999; display: flex; flex-direction: column; gap: 10px; }
.sh-toast {
    display: flex; align-items: center; gap: 10px;
    padding: 12px 16px; border-radius: 10px;
    background: var(--surface); border: 1px solid var(--border);
    box-shadow: var(--shadow-lg); font-size: 13px; font-weight: 500;
    color: var(--text); min-width: 260px; max-width: 380px;
    animation: shSlideIn .25s ease;
}
.sh-toast.success { border-left: 3px solid var(--accent2); }
.sh-toast.error   { border-left: 3px solid var(--danger); }
.sh-toast.info    { border-left: 3px solid var(--accent); }
.sh-toast.warning { border-left: 3px solid var(--accent3); }

/* ── EMPTY STATE ── */
.sh-empty {
    padding: 60px 20px; text-align: center;
    display: flex; flex-direction: column; align-items: center; gap: 12px;
}
.sh-empty-icon { font-size: 48px; opacity: .4; }
.sh-empty-title { font-size: 15px; font-weight: 600; color: var(--text); }
.sh-empty-sub { font-size: 13px; color: var(--sub); }

/* ── ANIMATIONS ── */
@keyframes shFadeUp {
    from { opacity: 0; transform: translateY(12px); }
    to   { opacity: 1; transform: translateY(0); }
}
@keyframes shSlideIn {
    from { opacity: 0; transform: translateX(20px); }
    to   { opacity: 1; transform: translateX(0); }
}

/* ── SCROLLBAR ── */
::-webkit-scrollbar { width: 5px; height: 5px; }
::-webkit-scrollbar-track { background: transparent; }
::-webkit-scrollbar-thumb { background: var(--border2); border-radius: 99px; }
::-webkit-scrollbar-thumb:hover { background: var(--sub); }

/* ── RESPONSIVE ── */
@media (max-width: 1024px) {
    .sh-filter-group { min-width: 120px; }
}
@media (max-width: 768px) {
    :root { --sidebar-w: 0px; }
    .sh-sidebar { display: none; }
    .sh-layout { grid-template-columns: 1fr; }
    .sh-header { grid-column: 1; }
    .sh-main { grid-column: 1; padding: 16px; }
    .sh-page-header { flex-direction: column; }
    .sh-filter-row { flex-direction: column; }
}

/* ── PRINT ── */
@media print {
    .sh-sidebar, .sh-header, .sh-btn, .sh-filter-bar, .sh-page-actions { display: none !important; }
    .sh-layout { grid-template-columns: 1fr; }
    .sh-main { padding: 0; }
    .sh-card { box-shadow: none; border: 1px solid #ddd; }
}
</style>