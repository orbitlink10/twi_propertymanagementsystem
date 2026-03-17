<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TiwiCloud | Property Management Software</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <style>
        :root{--bg:#06080b;--panel:#101418;--panel2:#131920;--ink:#f5f8fb;--muted:#9fb0c1;--line:rgba(255,255,255,.1);--green:#04c667;--green2:#00a857;--teal:#08b2b0;--blue:#2f77cc}
        *{box-sizing:border-box}html,body{margin:0;min-height:100%}body{font-family:Manrope,sans-serif;background:radial-gradient(circle at 55% 78%,rgba(2,175,145,.16),transparent 34%),radial-gradient(circle at 50% 100%,rgba(12,90,150,.16),transparent 42%),linear-gradient(180deg,#050608,#06080b 60%,#05070a);color:var(--ink)}
        a{color:inherit}
        .wrap{width:min(1240px,calc(100% - 2rem));margin:0 auto}
        .promo{background:linear-gradient(90deg,#06a85a 0%,#347cd2 100%);padding:.72rem 1rem;text-align:center;font-weight:700;display:flex;justify-content:center;gap:.8rem;align-items:center;flex-wrap:wrap}
        .promo .btn{background:#eef2f7;color:#162131;border-radius:999px;padding:.35rem .95rem;font-weight:800;text-decoration:none;line-height:1.1}
        .header{padding:1.05rem 0 0}
        .toprow{display:grid;grid-template-columns:1fr auto 1fr;align-items:center;gap:1rem}
        .brand{display:inline-flex;align-items:center;gap:.8rem;text-decoration:none;white-space:nowrap}
        .mark{position:relative;width:24px;height:44px;display:inline-block}
        .mark:before,.mark:after{content:"";position:absolute;inset:0;background:linear-gradient(160deg,var(--green),#01a95a);border-radius:3px}
        .mark:before{clip-path:polygon(0 68%,42% 44%,42% 0,100% 55%,100% 100%,42% 56%,42% 100%)}
        .mark:after{width:11px;left:-1px;clip-path:polygon(0 42%,100% 0,100% 56%,0 100%);background:linear-gradient(160deg,#03d973,#02b660)}
        .brand span:last-child{font:700 1.95rem/1 "Space Grotesk",sans-serif;letter-spacing:-.04em}
        .utility{display:flex;align-items:center;gap:.35rem;background:rgba(255,255,255,.045);border:1px solid rgba(255,255,255,.05);border-radius:999px;padding:.35rem;backdrop-filter:blur(8px);justify-self:center}
        .utility a{text-decoration:none;color:#edf2f9;padding:.55rem .9rem;border-radius:999px;font-weight:700;display:inline-flex;align-items:center;gap:.45rem}
        .utility a:hover{background:rgba(255,255,255,.06)} .ico{width:1.05rem;text-align:center;opacity:.9}
        .demo-wrap{display:flex;justify-content:flex-end}
        .demo{background:var(--green);color:#04110a;border-radius:999px;padding:.95rem 1.7rem;font-weight:800;text-decoration:none;letter-spacing:-.02em}
        .demo:hover{background:#11d675}
        .mainnav{display:flex;justify-content:center;gap:clamp(1rem,3vw,2.6rem);margin-top:1.7rem;flex-wrap:wrap}
        .mainnav a{text-decoration:none;font-weight:700;color:#eef3fa;font-size:.98rem;opacity:.96}
        .mainnav a:hover{opacity:1}
        .hero{padding:clamp(3rem,7vw,5.4rem) 0 2.2rem;text-align:center;position:relative}
        .hero .eyebrow{margin:0;color:var(--green);font-weight:700;font-size:clamp(1rem,1.8vw,1.65rem);letter-spacing:-.03em}
        .hero h1{margin:1.15rem auto 0;max-width:1120px;font:700 clamp(2.35rem,6vw,5.2rem)/1.03 "Space Grotesk",sans-serif;letter-spacing:-.055em;text-wrap:balance}
        .hero .sub{margin:1.6rem auto 0;max-width:980px;color:var(--teal);font-weight:700;font-size:clamp(1.12rem,2.5vw,2rem);letter-spacing:-.03em}
        .cta{display:flex;justify-content:center;gap:.85rem;flex-wrap:wrap;margin-top:2.2rem}
        .cta a{display:inline-flex;align-items:center;justify-content:center;text-decoration:none;border-radius:999px;padding:.95rem 1.55rem;font-weight:800;letter-spacing:-.02em;transition:.18s transform,.18s background}
        .cta a:hover{transform:translateY(-2px)}
        .cta .light{background:#f2f5f8;color:#111827;border:1px solid rgba(255,255,255,.2)}
        .cta .ghost{background:rgba(255,255,255,.02);color:#eaf0f8;border:1px solid rgba(255,255,255,.5)}
        .hero-card{margin:2.5rem auto 0;width:min(1050px,100%);border-radius:18px;border:1px solid var(--line);background:linear-gradient(180deg,rgba(255,255,255,.03),rgba(255,255,255,.01));box-shadow:0 25px 50px rgba(0,0,0,.28);padding:1rem;display:grid;grid-template-columns:1.05fr .95fr;gap:.85rem;backdrop-filter:blur(10px)}
        .kpis{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:.75rem}
        .kpi{border-radius:14px;border:1px solid rgba(255,255,255,.06);background:rgba(255,255,255,.03);padding:.9rem;text-align:left}
        .kpi small{display:block;color:var(--muted);font-size:.74rem;text-transform:uppercase;letter-spacing:.09em;font-weight:700}
        .kpi strong{display:block;margin-top:.35rem;color:#fff;font:700 1.18rem/1.2 "Space Grotesk",sans-serif;letter-spacing:-.03em}
        .chart{border-radius:14px;border:1px solid rgba(255,255,255,.06);background:rgba(255,255,255,.03);padding:.9rem;text-align:left;position:relative;overflow:hidden}
        .chart h3{margin:0;font:700 .96rem/1.15 "Space Grotesk",sans-serif;letter-spacing:-.03em}
        .chart p{margin:.35rem 0 0;color:var(--muted);font-size:.84rem;line-height:1.45}
        .chart .grid{margin-top:.8rem;height:92px;border-radius:10px;background:linear-gradient(180deg,rgba(255,255,255,.03),rgba(255,255,255,.02));border:1px solid rgba(255,255,255,.05);position:relative}
        .chart .grid:before,.chart .grid:after{content:"";position:absolute;left:0;right:0;height:1px;background:rgba(255,255,255,.06)}
        .chart .grid:before{top:33%}.chart .grid:after{top:66%}
        .line{position:absolute;inset:0}
        .line svg{width:100%;height:100%}
        .rail{border-radius:14px;border:1px solid rgba(255,255,255,.06);background:rgba(255,255,255,.03);padding:.9rem;text-align:left}
        .rail h3{margin:0;font:700 .96rem/1.15 "Space Grotesk",sans-serif;letter-spacing:-.03em}
        .item{margin-top:.75rem;display:grid;gap:.35rem}
        .item label{color:var(--muted);font-size:.8rem;font-weight:700}
        .bar{height:8px;border-radius:999px;background:rgba(255,255,255,.08);overflow:hidden}
        .bar i{display:block;height:100%;border-radius:inherit}
        .bar.g i{width:82%;background:linear-gradient(90deg,#03c667,#03ab5b)}
        .bar.t i{width:64%;background:linear-gradient(90deg,#09c0bf,#0995d1)}
        .bar.y i{width:41%;background:linear-gradient(90deg,#e8b13d,#d77a31)}
        .proof{margin:1rem 0 0;display:grid;grid-template-columns:1.1fr .9fr;gap:.9rem}
        .panel{background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.08);border-radius:18px;padding:1rem;box-shadow:0 12px 28px rgba(0,0,0,.16)}
        .panel h2{margin:0;font:700 1.08rem/1.2 "Space Grotesk",sans-serif;letter-spacing:-.03em}
        .panel p{margin:.45rem 0 0;color:var(--muted);line-height:1.52}
        .chips{display:flex;flex-wrap:wrap;gap:.45rem;margin-top:.8rem}
        .chip{border-radius:999px;border:1px solid rgba(255,255,255,.08);background:rgba(255,255,255,.03);padding:.42rem .7rem;font-size:.82rem;font-weight:700;color:#dde8f4}
        .mini{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:.6rem}
        .mini div{border-radius:14px;border:1px solid rgba(255,255,255,.07);background:rgba(255,255,255,.03);padding:.8rem}
        .mini b{display:block;font:700 .92rem/1.2 "Space Grotesk",sans-serif;letter-spacing:-.03em}
        .mini span{display:block;margin-top:.2rem;color:var(--muted);font-size:.78rem;line-height:1.35}
        .section{margin-top:1rem;background:rgba(255,255,255,.02);border:1px solid rgba(255,255,255,.08);border-radius:20px;padding:1rem}
        .sh{display:flex;align-items:flex-end;justify-content:space-between;gap:1rem;flex-wrap:wrap;margin-bottom:.85rem}
        .sh h2{margin:0;font:700 1.35rem/1.12 "Space Grotesk",sans-serif;letter-spacing:-.04em}
        .sh p{margin:.35rem 0 0;color:var(--muted);line-height:1.52}.sh a{color:var(--green);text-decoration:none;font-weight:800}
        .features{display:grid;grid-template-columns:1.15fr 1fr 1fr;gap:.75rem}
        .card{border-radius:16px;border:1px solid rgba(255,255,255,.08);background:rgba(255,255,255,.03);padding:1rem}
        .card.hl{background:radial-gradient(circle at 88% 14%,rgba(4,198,103,.08),transparent 38%),rgba(255,255,255,.03);border-color:rgba(4,198,103,.2)}
        .ic2{width:36px;height:36px;border-radius:10px;background:rgba(4,198,103,.12);color:#60f0a7;display:grid;place-items:center;font-weight:800;font-size:.84rem}
        .card h3{margin:.72rem 0 0;font:700 1rem/1.15 "Space Grotesk",sans-serif;letter-spacing:-.03em}
        .card p{margin:.45rem 0 0;color:var(--muted);font-size:.9rem;line-height:1.5}
        .card ul{list-style:none;margin:.72rem 0 0;padding:0;display:grid;gap:.4rem}
        .card li{display:flex;align-items:center;gap:.45rem;color:#d9e6f4;font-size:.85rem;font-weight:700}
        .card li:before{content:"+";width:18px;height:18px;border-radius:999px;background:rgba(4,198,103,.12);color:#66f1ab;display:grid;place-items:center;font-weight:800}
        .use{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:.75rem}
        .use .u{border-radius:16px;border:1px solid rgba(255,255,255,.08);background:rgba(255,255,255,.03);padding:1rem}
        .uh{display:flex;align-items:center;justify-content:space-between;gap:.6rem}
        .u h3{margin:0;font:700 .98rem/1.15 "Space Grotesk",sans-serif;letter-spacing:-.03em}
        .badge{border-radius:999px;border:1px solid rgba(255,255,255,.08);background:rgba(255,255,255,.03);padding:.2rem .55rem;font-size:.75rem;font-weight:800;color:#cfe0f2}
        .u p{margin:.55rem 0 0;color:var(--muted);font-size:.9rem;line-height:1.5}
        .ugrid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:.5rem;margin-top:.7rem}
        .ugrid div{border-radius:12px;border:1px solid rgba(255,255,255,.06);background:rgba(255,255,255,.025);padding:.55rem}
        .ugrid b{display:block;font:700 .86rem/1.15 "Space Grotesk",sans-serif}.ugrid span{display:block;margin-top:.15rem;color:var(--muted);font-size:.74rem}
        .footcta{margin:1rem 0 2rem;border-radius:18px;border:1px solid rgba(255,255,255,.08);background:linear-gradient(90deg,rgba(4,198,103,.06),rgba(47,119,204,.06));padding:1rem;display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap}
        .footcta p{margin:0;color:#d4e1ef;line-height:1.5;max-width:760px}
        .footcta .actions{flex-wrap:wrap}
        @media (max-width:1120px){.toprow{grid-template-columns:1fr;justify-items:center}.demo-wrap{justify-content:center}.mainnav{margin-top:1.2rem}.hero-card,.proof,.features,.use{grid-template-columns:1fr}.mini{grid-template-columns:1fr 1fr}}
        @media (max-width:760px){.wrap{width:calc(100% - 1rem)}.promo{font-size:.9rem;gap:.5rem;padding:.65rem .6rem}.brand span:last-child{font-size:1.55rem}.utility{width:100%;justify-content:center;flex-wrap:wrap;border-radius:18px}.utility a{padding:.55rem .75rem;font-size:.92rem}.hero{padding-top:2.4rem}.mini{grid-template-columns:1fr}.ugrid{grid-template-columns:1fr}.cta a{min-width:0;flex:1 1 170px}.demo{padding:.9rem 1.25rem}}
        @media (prefers-reduced-motion:reduce){*{transition:none!important}}
    </style>
</head>
<body>
    <div class="promo">
        <span><strong>Be Herd 2026 User Conference</strong> Early Bird Pricing until 2/28</span>
        <a class="btn" href="#">register now</a>
    </div>

    <header class="header wrap">
        <div class="toprow">
            <a class="brand" href="{{ route('home') }}" aria-label="TiwiCloud home">
                <span class="mark" aria-hidden="true"></span>
                <span>Tiwi Property Management System</span>
            </a>

            <nav class="utility" aria-label="Quick links">
                <a href="{{ route('admin.login') }}"><span class="ico">o</span>Login</a>
                <a href="#"><span class="ico">=</span>Pay Rent</a>
                <a href="#resources"><span class="ico">?</span>Help Center</a>
            </nav>

            <div class="demo-wrap">
                <a class="demo" href="{{ route('admin.login') }}">schedule a demo</a>
            </div>
        </div>

        <nav class="mainnav" aria-label="Main navigation">
            <a href="#features">Features</a>
            <a href="{{ route('pricing') }}">Pricing</a>
            <a href="#reviews">Reviews</a>
            <a href="#resources">Resources</a>
            <a href="#about">About</a>
        </nav>
    </header>

    <main class="wrap">
        <section class="hero">
            <p class="eyebrow">Property management software</p>
            <h1>The fastest-growing property management software.</h1>
            <p class="sub">We listen. We respond. We deliver.</p>

            <div class="cta">
                <a class="light" href="{{ route('admin.login') }}">schedule a demo</a>
                <a class="ghost" href="#features">explore features</a>
            </div>

            <div class="hero-card" id="features" aria-label="Product highlights">
                <div class="kpis">
                    <article class="kpi"><small>Portfolio</small><strong>13 Properties Live</strong></article>
                    <article class="kpi"><small>Occupancy</small><strong>87% Active Units</strong></article>
                    <article class="kpi"><small>Collections</small><strong>KES 3.4M Due</strong></article>
                    <article class="kpi"><small>Receipts</small><strong>KES 2.9M Collected</strong></article>
                </div>

                <div style="display:grid;gap:.75rem">
                    <article class="chart" id="reviews">
                        <h3>Revenue performance</h3>
                        <p>Monitor expected rent, collections, and overdue balances without leaving the dashboard.</p>
                        <div class="grid">
                            <div class="line">
                                <svg viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                                    <path d="M0,78 C10,70 20,60 30,64 C40,68 46,45 58,48 C70,51 74,35 84,36 C92,37 96,22 100,20" fill="none" stroke="#08c7ba" stroke-width="2.8" stroke-linecap="round"/>
                                    <path d="M0,86 C10,82 22,80 34,73 C45,67 53,66 62,60 C73,53 82,59 100,44" fill="none" stroke="#2f77cc" stroke-width="2.2" stroke-linecap="round" opacity=".9"/>
                                </svg>
                            </div>
                        </div>
                    </article>

                    <article class="rail">
                        <h3>Operations snapshot</h3>
                        <div class="item"><label>Rent collection</label><div class="bar g"><i></i></div></div>
                        <div class="item"><label>Ticket resolution</label><div class="bar t"><i></i></div></div>
                        <div class="item"><label>Vacancy pipeline</label><div class="bar y"><i></i></div></div>
                    </article>
                </div>
            </div>
        </section>

        <section class="proof">
            <article class="panel">
                <h2>Built for modern property operators</h2>
                <p>Run leasing, collections, payments, and reporting in one system designed for teams managing growing residential portfolios.</p>
                <div class="chips">
                    <span class="chip">Leasing</span>
                    <span class="chip">Payments</span>
                    <span class="chip">Maintenance</span>
                    <span class="chip">Accounting</span>
                    <span class="chip">Reporting</span>
                </div>
            </article>

            <article class="panel">
                <h2>What teams improve first</h2>
                <div class="mini">
                    <div><b>Faster billing</b><span>Issue and track invoices with less manual work.</span></div>
                    <div><b>Cleaner records</b><span>Standardize unit and tenant information.</span></div>
                    <div><b>Better visibility</b><span>See income and occupancy at a glance.</span></div>
                </div>
            </article>
        </section>

        <section class="section">
            <div class="sh">
                <div>
                    <h2>Professional tools for daily property work</h2>
                    <p>Designed for clarity and speed across collections, leasing, and operations.</p>
                </div>
                <a href="{{ route('pricing') }}">Explore plans</a>
            </div>

            <div class="features">
                <article class="card hl">
                    <div class="ic2">PM</div>
                    <h3>Portfolio and unit management</h3>
                    <p>Organize properties, units, occupancy, and tenant assignments in one operating system.</p>
                    <ul>
                        <li>Property and branch tracking</li>
                        <li>Unit status visibility</li>
                        <li>Tenant-to-unit linking</li>
                    </ul>
                </article>
                <article class="card">
                    <div class="ic2">RC</div>
                    <h3>Rent collection workflows</h3>
                    <p>Track due amounts, paid balances, and overdue accounts with cleaner follow-up views.</p>
                    <ul>
                        <li>Payment status monitoring</li>
                        <li>Invoice and receipt support</li>
                        <li>Collections visibility</li>
                    </ul>
                </article>
                <article class="card">
                    <div class="ic2">RP</div>
                    <h3>Reporting and oversight</h3>
                    <p>Give owners and managers a strong operational picture across income and occupancy.</p>
                    <ul>
                        <li>Portfolio snapshots</li>
                        <li>Income trend visibility</li>
                        <li>Admin monitoring tools</li>
                    </ul>
                </article>
            </div>
        </section>

        <section class="section" id="use-cases">
            <div class="sh">
                <div>
                    <h2>Use cases for agencies and landlords</h2>
                    <p>Adapt the platform to your workflow while keeping room to scale.</p>
                </div>
            </div>

            <div class="use">
                <article class="u">
                    <div class="uh"><h3>Growing agencies</h3><span class="badge">Operations</span></div>
                    <p>Coordinate teams, properties, and collection tasks without relying on disconnected spreadsheets.</p>
                    <div class="ugrid">
                        <div><b>Branches</b><span>Office-level tracking</span></div>
                        <div><b>Units</b><span>Occupancy at a glance</span></div>
                        <div><b>Teams</b><span>Shared workflows</span></div>
                    </div>
                </article>

                <article class="u" id="resources">
                    <div class="uh"><h3>Landlords & owners</h3><span class="badge">Visibility</span></div>
                    <p>Review collections, lease status, and portfolio performance from a cleaner dashboard experience.</p>
                    <div class="ugrid">
                        <div><b>Income</b><span>Track inflows</span></div>
                        <div><b>Leases</b><span>Status summaries</span></div>
                        <div><b>Reports</b><span>Faster reviews</span></div>
                    </div>
                </article>
            </div>
        </section>

        <section class="footcta" id="about">
            <p>Dark Rentvine-style visual theme applied to the homepage while preserving your Laravel routes and pricing page link.</p>
            <div class="actions">
                <a class="btn s" href="{{ route('admin.login') }}">Open dashboard</a>
                <a class="btn o" href="{{ route('pricing') }}">Pricing</a>
            </div>
        </section>
    </main>
</body>
</html>
