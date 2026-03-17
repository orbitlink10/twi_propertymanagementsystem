<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TiwiCloud Pricing | Plans & Pricing</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #f5f7f9;
            --surface: #ffffff;
            --ink: #14365a;
            --muted: #506986;
            --line: #dbe5ee;
            --green: #3cab42;
            --green-deep: #2f9737;
            --hero-left: #ece8e2;
            --hero-right: #dcecef;
            --dark-card: #05343c;
            --dark-card-2: #042b31;
            --yellow: #f2b600;
            --shadow: 0 18px 36px rgba(12, 34, 61, 0.06);
        }

        * {
            box-sizing: border-box;
        }

        html, body {
            margin: 0;
            min-height: 100%;
        }

        body {
            font-family: "Plus Jakarta Sans", sans-serif;
            background: var(--bg);
            color: var(--ink);
        }

        a {
            color: inherit;
        }

        .wrap {
            width: min(1400px, calc(100% - 2rem));
            margin: 0 auto;
        }

        .header-shell {
            padding: 1rem 0;
            background: rgba(255, 255, 255, 0.9);
            border-bottom: 1px solid rgba(219, 229, 238, 0.95);
            position: sticky;
            top: 0;
            z-index: 20;
            backdrop-filter: blur(8px);
        }

        .header-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 0.65rem;
            text-decoration: none;
            font-weight: 800;
            font-size: 1.15rem;
            letter-spacing: -0.03em;
            white-space: nowrap;
        }

        .brand-cloud {
            position: relative;
            width: 38px;
            height: 22px;
            border: 3px solid var(--green);
            border-radius: 999px;
        }

        .brand-cloud::before,
        .brand-cloud::after {
            content: "";
            position: absolute;
            border: 3px solid var(--green);
            border-radius: 999px;
            background: #fff;
        }

        .brand-cloud::before {
            width: 14px;
            height: 14px;
            left: 5px;
            top: -10px;
        }

        .brand-cloud::after {
            width: 16px;
            height: 16px;
            right: 4px;
            top: -12px;
        }

        .brand-text {
            display: inline-flex;
            gap: 0.15rem;
            align-items: baseline;
        }

        .brand-text .green {
            color: var(--green);
        }

        .main-nav {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            flex-wrap: wrap;
            justify-content: center;
        }

        .main-nav a {
            text-decoration: none;
            font-weight: 700;
            color: var(--ink);
            padding: 0.55rem 0.75rem;
            border-radius: 12px;
        }

        .main-nav a:hover {
            background: rgba(20, 54, 90, 0.05);
        }

        .chev {
            margin-left: 0.25rem;
            font-size: 0.85em;
            opacity: 0.75;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            white-space: nowrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            padding: 0.82rem 1.45rem;
            text-decoration: none;
            font-weight: 800;
            border: 1px solid transparent;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn-solid {
            background: linear-gradient(180deg, #45b649, var(--green-deep));
            color: #fff;
            box-shadow: 0 10px 22px rgba(60, 172, 66, 0.24);
        }

        .btn-outline {
            background: #fff;
            color: var(--green-deep);
            border-color: rgba(60, 172, 66, 0.9);
        }

        .hero-band {
            margin-top: 0;
            background: linear-gradient(90deg, var(--hero-left) 0%, var(--hero-right) 100%);
            border-bottom: 1px solid rgba(219, 229, 238, 0.8);
        }

        .hero-inner {
            min-height: 390px;
            display: grid;
            place-items: center;
            text-align: center;
            padding: 2.5rem 0;
        }

        .hero-copy {
            max-width: 1060px;
        }

        .hero-copy h1 {
            margin: 0;
            font-size: clamp(2.6rem, 5.2vw, 4.1rem);
            line-height: 1.05;
            letter-spacing: -0.05em;
            color: #153759;
        }

        .hero-copy h2 {
            margin: 1rem 0 0;
            font-size: clamp(1.4rem, 3vw, 2.15rem);
            line-height: 1.2;
            font-weight: 500;
            letter-spacing: -0.03em;
            color: #223f62;
        }

        .hero-copy p {
            margin: 1.5rem auto 0;
            max-width: 1100px;
            font-size: clamp(1rem, 1.45vw, 1.2rem);
            line-height: 1.7;
            color: #2b476a;
        }

        .pricing-shell {
            padding: 2.2rem 0 3rem;
        }

        .billing-row {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.65rem;
            flex-wrap: wrap;
            margin-bottom: 2rem;
        }

        .billing-label {
            font-size: 1.1rem;
            color: #25486d;
            letter-spacing: -0.02em;
        }

        .billing-label.strong {
            font-weight: 800;
            color: #1a395c;
        }

        .toggle {
            width: 70px;
            height: 38px;
            border-radius: 999px;
            border: 1px solid rgba(60, 172, 66, 0.9);
            background: linear-gradient(180deg, #3ba842, #318c37);
            position: relative;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.18);
        }

        .toggle::before {
            content: "";
            position: absolute;
            width: 30px;
            height: 30px;
            top: 3px;
            right: 3px;
            border-radius: 999px;
            background: #f8fbff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        .free-pill {
            border: 1px solid rgba(60, 172, 66, 0.6);
            background: rgba(60, 172, 66, 0.08);
            color: var(--green-deep);
            border-radius: 6px;
            padding: 0.25rem 0.55rem;
            font-weight: 700;
            line-height: 1.2;
        }

        .plans-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 0.9rem;
            align-items: stretch;
        }

        .plan {
            background: #fff;
            border: 1px solid #dbe5ee;
            border-radius: 14px;
            padding: 0;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(12, 34, 61, 0.03);
            display: flex;
            flex-direction: column;
        }

        .plan .top-accent {
            height: 5px;
            background: #153d67;
        }

        .plan-body {
            padding: 1.25rem 1.25rem 1.15rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            height: 100%;
        }

        .plan-title-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.5rem;
        }

        .plan h3 {
            margin: 0;
            font-size: 1.05rem;
            color: #183b60;
            letter-spacing: -0.03em;
        }

        .badge {
            background: var(--yellow);
            color: #fff;
            font-size: 0.8rem;
            font-weight: 800;
            border-radius: 6px;
            padding: 0.25rem 0.45rem;
            line-height: 1.1;
            white-space: nowrap;
        }

        .desc {
            margin: 0;
            color: #55708f;
            font-size: 0.92rem;
            line-height: 1.45;
            min-height: 4.2em;
        }

        .price-block {
            margin-top: 0.2rem;
        }

        .price {
            margin: 0;
            color: #153759;
            font-weight: 800;
            font-size: 1.1rem;
            letter-spacing: -0.03em;
        }

        .price .major {
            font-size: 2.15rem;
        }

        .price .minor {
            font-size: 1.05rem;
            font-weight: 700;
            vertical-align: super;
        }

        .price-note {
            margin: 0.3rem 0 0;
            color: #55708f;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .plan-btn {
            margin-top: 0.2rem;
            text-decoration: none;
            border-radius: 8px;
            border: 1px solid rgba(60, 172, 66, 0.8);
            color: var(--green-deep);
            font-weight: 800;
            text-align: center;
            padding: 0.8rem 0.85rem;
            background: #fff;
        }

        .plan-btn:hover {
            background: rgba(60, 172, 66, 0.04);
        }

        .includes {
            margin: 0.55rem 0 0;
            font-weight: 700;
            color: #1f4065;
        }

        .feature-list {
            list-style: none;
            margin: 0.25rem 0 0;
            padding: 0;
            display: grid;
            gap: 0.65rem;
            color: #27486d;
        }

        .feature-list li {
            display: flex;
            align-items: flex-start;
            gap: 0.55rem;
            line-height: 1.35;
            font-weight: 600;
        }

        .feature-list li::before {
            content: "✓";
            color: var(--green);
            font-weight: 800;
            line-height: 1;
            margin-top: 0.1rem;
        }

        .plan.pro {
            background: linear-gradient(180deg, var(--dark-card) 0%, var(--dark-card-2) 100%);
            border-color: #1ea23f;
            box-shadow: 0 20px 34px rgba(3, 28, 33, 0.2);
            transform: translateY(-14px);
        }

        .plan.pro .top-accent {
            background: #2cb143;
        }

        .plan.pro h3,
        .plan.pro .price,
        .plan.pro .includes,
        .plan.pro .feature-list {
            color: #eff9fb;
        }

        .plan.pro .desc,
        .plan.pro .price-note {
            color: rgba(236, 248, 252, 0.86);
        }

        .plan.pro .plan-btn {
            background: linear-gradient(180deg, #42bb49, #31983a);
            color: #fff;
            border-color: transparent;
        }

        .plan.pro .plan-btn:hover {
            filter: brightness(1.03);
        }

        .plan.business .price .major {
            font-size: 2rem;
        }

        .plan.business .price {
            font-size: 1.5rem;
        }

        .footer-note {
            margin-top: 1.2rem;
            text-align: center;
            color: #5a738f;
            font-size: 0.92rem;
        }

        @media (max-width: 1200px) {
            .plans-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .plan.pro {
                transform: none;
            }
        }

        @media (max-width: 900px) {
            .header-row {
                flex-wrap: wrap;
                justify-content: center;
            }

            .main-nav {
                order: 3;
                width: 100%;
            }

            .hero-inner {
                min-height: 320px;
            }
        }

        @media (max-width: 700px) {
            .wrap {
                width: calc(100% - 1rem);
            }

            .nav-actions {
                width: 100%;
                justify-content: center;
                flex-wrap: wrap;
            }

            .nav-actions .btn {
                flex: 1 1 145px;
            }

            .plans-grid {
                grid-template-columns: 1fr;
            }

            .hero-copy p {
                line-height: 1.55;
            }

            .billing-row {
                gap: 0.45rem;
            }
        }
    </style>
</head>
<body>
    <header class="header-shell">
        <div class="wrap header-row">
            <a class="brand" href="{{ route('home') }}" aria-label="TiwiCloud home">
                <span class="brand-cloud" aria-hidden="true"></span>
                <span class="brand-text"><span class="green">Tiwi</span><span>Cloud</span></span>
            </a>

            <nav class="main-nav" aria-label="Primary navigation">
                <a href="{{ route('home') }}#features">Features <span class="chev">v</span></a>
                <a href="{{ route('home') }}#use-cases">Use Cases <span class="chev">v</span></a>
                <a href="{{ route('home') }}#resources">Resources <span class="chev">v</span></a>
                <a href="{{ route('pricing') }}">Pricing</a>
            </nav>

            <div class="nav-actions">
                <a class="btn btn-solid" href="{{ route('admin.login') }}">Log in</a>
                <a class="btn btn-outline" href="{{ route('admin.login') }}">Sign up</a>
            </div>
        </div>
    </header>

    <section class="hero-band">
        <div class="wrap hero-inner">
            <div class="hero-copy">
                <h1>Plans & Pricing</h1>
                <h2>Scalable plans for every stage of your growth</h2>
                <p>
                    Trusted by 100,000+ landlords to manage everything from a single condo to an entire portfolio. Starting at just $15/month, or upgrade to a premium plan to unlock advanced accounting and team tools.
                </p>
            </div>
        </div>
    </section>

    <main class="wrap pricing-shell">
        <div class="billing-row" aria-label="Billing frequency selector">
            <span class="billing-label">Monthly</span>
            <span class="toggle" aria-hidden="true"></span>
            <span class="billing-label strong">Yearly</span>
            <span class="free-pill">Two months free</span>
        </div>

        <section class="plans-grid" aria-label="Pricing plans">
            <article class="plan starter">
                <div class="top-accent"></div>
                <div class="plan-body">
                    <div>
                        <div class="plan-title-row">
                            <h3>Starter</h3>
                        </div>
                        <p class="desc">Designed for DIY landlords looking to automate tasks and simplify their portfolios.</p>
                    </div>

                    <div class="price-block">
                        <p class="price"><span class="major">$15</span><span class="minor">.00</span>/m</p>
                        <p class="price-note">$180.00 if billed annually</p>
                    </div>

                    <a class="plan-btn" href="{{ route('admin.login') }}">Start 14-day trial</a>

                    <p class="includes">Includes:</p>
                    <ul class="feature-list">
                        <li>Online Rent Payments</li>
                        <li>Maintenance Management</li>
                        <li>Listing Syndication</li>
                    </ul>
                </div>
            </article>

            <article class="plan growth">
                <div class="top-accent"></div>
                <div class="plan-body">
                    <div>
                        <div class="plan-title-row">
                            <h3>Growth</h3>
                        </div>
                        <p class="desc">Designed for mid-to-large landlords looking for additional organization and tenant tools.</p>
                    </div>

                    <div class="price-block">
                        <p class="price"><span class="major">$29</span><span class="minor">.17</span>/m</p>
                        <p class="price-note">$350.00 if billed annually</p>
                    </div>

                    <a class="plan-btn" href="{{ route('admin.login') }}">Start 14-day trial</a>

                    <p class="includes">Everything in Starter, plus:</p>
                    <ul class="feature-list">
                        <li>Enhanced Reporting</li>
                        <li>Move In/Out Inspections</li>
                        <li>Team Activity Tracking</li>
                    </ul>
                </div>
            </article>

            <article class="plan pro">
                <div class="top-accent"></div>
                <div class="plan-body">
                    <div>
                        <div class="plan-title-row">
                            <h3>Pro</h3>
                            <span class="badge">Most popular</span>
                        </div>
                        <p class="desc">Designed for mid-to-large landlords looking for premium features and efficiency.</p>
                    </div>

                    <div class="price-block">
                        <p class="price"><span class="major">$50</span><span class="minor">.00</span>/m</p>
                        <p class="price-note">$600.00 if billed annually</p>
                    </div>

                    <a class="plan-btn" href="{{ route('admin.login') }}">Start 14-day trial</a>

                    <p class="includes">Everything in Growth, plus:</p>
                    <ul class="feature-list">
                        <li>Tax Reports</li>
                        <li>Bank Reconciliation</li>
                        <li>Advanced Accounting Tools</li>
                    </ul>
                </div>
            </article>

            <article class="plan business">
                <div class="top-accent"></div>
                <div class="plan-body">
                    <div>
                        <div class="plan-title-row">
                            <h3>Business</h3>
                        </div>
                        <p class="desc">Designed for large companies looking for advanced features tailored to their needs.</p>
                    </div>

                    <div class="price-block">
                        <p class="price"><span class="major">Custom</span></p>
                        <p class="price-note">Starting at $100.00/mo</p>
                    </div>

                    <a class="plan-btn" href="{{ route('admin.login') }}">Start 14-day trial</a>

                    <p class="includes">Everything in Pro, plus:</p>
                    <ul class="feature-list">
                        <li>Team Management & Tools</li>
                        <li>Multi-portfolio Permissions</li>
                        <li>Priority Support</li>
                    </ul>
                </div>
            </article>
        </section>

        <p class="footer-note">Pricing layout styled after your reference and adapted to the current TiwiCloud theme.</p>
    </main>
</body>
</html>
