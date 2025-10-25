<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Policía Aérea - Sistema</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600,700&display=swap" rel="stylesheet" />
    <style>
        :root{
            /* Verde olivo institucional: #808000 */
            --olivo:#808000; /* RGB(128,128,0) */
            --olivo-osc:#666600; /* tono más oscuro */
            --olivo-claro:#ececcb; /* tono más claro */
            --gris:#f5f6f7;
            --texto:#1f2937;
        }
        *{box-sizing:border-box}
        html,body{margin:0;padding:0;font-family:Figtree,system-ui,-apple-system,Segoe UI,Roboto,Ubuntu,Cantarell,Noto Sans,sans-serif;color:var(--texto);background:var(--gris)}
        a{color:inherit;text-decoration:none}
        .container{max-width:1152px;margin:0 auto;padding:0 1rem}
        header{position:sticky;top:0;z-index:50;background:#fff;border-bottom:1px solid #e9ecef}
        .nav{display:flex;align-items:center;justify-content:space-between;height:72px}
        .brand{display:flex;align-items:center;gap:.75rem}
        .brand img{width:48px;height:48px;object-fit:contain}
        .brand .title{font-weight:700;font-size:1.05rem;line-height:1.2}
        .brand .subtitle{font-size:.8rem;color:#667085}
        .btn{display:inline-flex;align-items:center;justify-content:center;padding:.7rem 1rem;border-radius:.5rem;font-weight:600;border:1px solid transparent;transition:.2s ease}
        .btn-primary{background:var(--olivo);color:#fff}
        .btn-primary:hover{background:var(--olivo-osc)}
        .btn-outline{border-color:var(--olivo);color:var(--olivo);background:#fff}
        .btn-outline:hover{background:var(--olivo-claro)}
        .hero{background:linear-gradient(135deg,var(--olivo) 0%, var(--olivo-osc) 100%);color:#fff;padding:64px 0}
        .hero-wrap{display:grid;grid-template-columns:1.1fr .9fr;gap:2rem;align-items:center}
        .hero h1{font-size:2.2rem;line-height:1.2;margin:0 0 .75rem 0}
        .hero p{opacity:.95;margin:0 0 1.25rem 0}
        .hero .actions{display:flex;gap:.75rem;flex-wrap:wrap}
        .hero .image-placeholder{width:100%;aspect-ratio:16/10;border-radius:.75rem;background:rgba(255,255,255,.12);display:flex;align-items:center;justify-content:center;border:1px dashed rgba(255,255,255,.35);}
        .hero .image-placeholder span{opacity:.9}
        .section{padding:56px 0}
        .cards{display:grid;grid-template-columns:repeat(3,1fr);gap:1rem}
        .card{background:#fff;border:1px solid #e9ecef;border-radius:.75rem;padding:1.25rem;min-height:160px;display:flex;flex-direction:column;justify-content:space-between}
        .card h3{margin:0 0 .35rem 0;font-size:1.05rem}
        .gallery{display:grid;grid-template-columns:repeat(3,1fr);gap:1rem}
        .thumb{background:#fff;border:1px dashed #cbd5e1;border-radius:.75rem;aspect-ratio:4/3;display:flex;align-items:center;justify-content:center;color:#64748b}
        footer{border-top:1px solid #e9ecef;background:#fff;padding:24px 0;color:#657187}
        .muted{color:#657187}
        @media (max-width: 960px){.hero-wrap{grid-template-columns:1fr}.cards,.gallery{grid-template-columns:1fr 1fr}}
        @media (max-width: 640px){.cards,.gallery{grid-template-columns:1fr}}
    </style>
</head>
<body>
    <header>
        <div class="container nav">
            <div class="brand">
                <!-- Logo institucional: reemplace la ruta del src cuando tenga el archivo -->
                <img src="{{ asset('images/logo-policia.png') }}" alt="Logo Policía" onerror="this.style.opacity=0.25" />
                <div>
                    <div class="title">Policía Aérea Boliviana</div>
                    <div class="subtitle">Sistema de Gestión de Aeronaves</div>
                </div>
            </div>
            <div>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url(config('filament.path', 'admin')) }}" class="btn btn-outline">Ir al sistema</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary">Ingresar</a>
                    @endauth
                @endif
            </div>
        </div>
    </header>

    <section class="hero">
        <div class="container hero-wrap">
            <div>
                <h1>Recepción, control e inventario de aeronaves</h1>
                <p>Registre y consulte datos de aeronaves, motores y repuestos. Controle recepciones con checklist de partes internas y externas, personal interviniente y documentación legal.</p>
                <div class="actions">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url(config('filament.path', 'admin')) }}" class="btn btn-primary">Ir al sistema</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary">Iniciar sesión</a>
                        @endauth
                    @endif
                    <a href="#secciones" class="btn btn-outline">Ver más</a>
                </div>
            </div>
            <div>
                <div class="image-placeholder">
                    <span>Área para imagen de portada (aeronave / hangar)</span>
                </div>
            </div>
        </div>
    </section>

    <section id="secciones" class="section">
        <div class="container">
            <div class="cards">
                <div class="card">
                    <div>
                        <h3 style="color:var(--olivo)">Aeronaves</h3>
                        <p class="muted">Inventario de avionetas y helicópteros. Matrícula, modelo, fabricante, estado y ubicación (hangar).</p>
                    </div>
                    <div><small class="muted">Espacio para ícono o imagen</small></div>
                </div>
                <div class="card">
                    <div>
                        <h3 style="color:var(--olivo)">Motores</h3>
                        <p class="muted">Registro por número de parte/serie, tipo/modelo, condición y documento legal de respaldo.</p>
                    </div>
                    <div><small class="muted">Espacio para ícono o imagen</small></div>
                </div>
                <div class="card">
                    <div>
                        <h3 style="color:var(--olivo)">Repuestos</h3>
                        <p class="muted">Control de repuestos con cantidad, condición (nuevo/usado/reparado) y ubicación actual.</p>
                    </div>
                    <div><small class="muted">Espacio para ícono o imagen</small></div>
                </div>
            </div>
        </div>
    </section>

    <section class="section" style="background:#fff">
        <div class="container">
            <h2 style="margin:0 0 1rem 0;color:var(--olivo)">Galería / Banners</h2>
            <div class="gallery">
                <div class="thumb">Lugar para imagen 1 (logo, insignia o hangar)</div>
                <div class="thumb">Lugar para imagen 2 (aeronave)</div>
                <div class="thumb">Lugar para imagen 3 (personal)</div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container" style="display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap">
            <div class="muted">© {{ date('Y') }} Policía Aérea Boliviana · Todos los derechos reservados</div>
            <div class="muted">Soporte: Tecnologías de Información</div>
        </div>
    </footer>
</body>
</html>
