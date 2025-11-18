<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Policía Aérea Boliviana - Sistema de Gestión de Aeronaves</title>

    <!-- Fuente moderna y limpia -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</head>
<body>
    <!-- Encabezado / Navegación -->
    <header class="main-header">
        <div class="container header-inner">
            <div class="brand">
                <img class="brand-logo" src="{{ asset('storage/images/escudoPolicia.jpg') }}" alt="Escudo Policía Boliviana">
                <div class="brand-text">
                    <p class="brand-subtitle">Estado Plurinacional de Bolivia</p>
                    <h1 class="brand-title">Policía Aérea Boliviana</h1>
                    <h2 class="brand-system">Sistema de Gestión de Aeronaves</h2>
                </div>
            </div>

            <nav class="main-nav">
                <a href="#about">Nosotros</a>
                <a href="#services">Servicios</a>
                <a href="#contact">Contacto</a>
                <a href="/admin/login" class="btn btn-outline">Acceso Administrativo</a>
            </nav>
        </div>
    </header>

    <main>
        <!-- Sección Hero -->
        <section class="hero">
            <div class="container hero-grid">
                <div class="hero-content">
                    <span class="hero-badge">Vigilancia y control del espacio aéreo</span>
                    <h3>Protegiendo los cielos de Bolivia</h3>
                    <p>
                        La Policía Aérea Boliviana se dedica a la vigilancia, control y gestión de aeronaves
                        para garantizar la seguridad y el orden en el espacio aéreo nacional.
                    </p>
                    <div class="hero-buttons">
                        <a href="/admin/login" class="btn btn-primary">Ingresar al sistema</a>
                        <a href="#about" class="btn btn-secondary">Conócenos</a>
                    </div>
                </div>
                <div class="hero-image">
                    <div class="hero-image-card">
                        <img src="{{ asset('storage/images/EscuadroAeronautico.jpg') }}" alt="Escuadrón Aeronáutico">
                    </div>
                </div>
            </div>
        </section>

        <!-- Sección Acerca de -->
        <section id="about" class="section about">
            <div class="container about-grid">
                <div>
                    <h2 class="section-title">Acerca de Nosotros</h2>
                    <p>
                        La Policía Aérea Boliviana es una institución comprometida con la seguridad y el control del
                        espacio aéreo. Nuestro objetivo es garantizar operaciones aéreas seguras y eficientes,
                        apoyando a las fuerzas del orden y protegiendo a la ciudadanía en todo el territorio nacional.
                    </p>
                    <p>
                        A través de sistemas de gestión modernos, personal especializado y protocolos estrictos,
                        optimizamos el uso de aeronaves, motores y repuestos para mantener una operatividad constante.
                    </p>
                </div>
                <div class="about-image">
                    <img src="{{ asset('storage/images/EscuadroDeAviones.jpg') }}" alt="Escuadrón de Aviones">
                </div>
            </div>
        </section>

        <!-- Sección Servicios -->
        <section id="services" class="section services">
            <div class="container">
                <h2 class="section-title center">Nuestros Servicios</h2>
                <p class="section-description center">
                    Un sistema integral para la gestión, control y apoyo a las operaciones aéreas de la institución.
                </p>

                <div class="services-container">
                    <article class="service-card">
                        <div class="service-image">
                            <img src="{{ asset('storage/images/escuadroDeHelicopteros.jpg') }}" alt="Operaciones con helicópteros">
                        </div>
                        <div class="service-body">
                            <h3>Operaciones Aéreas</h3>
                            <p>
                                Coordinamos y supervisamos operaciones aéreas tácticas y estratégicas
                                para garantizar la seguridad en el espacio aéreo boliviano.
                            </p>
                        </div>
                    </article>

                    <article class="service-card">
                        <div class="service-image">
                            <img src="{{ asset('storage/images/escudoPolicia.jpg') }}" alt="Escudo de la Policía Boliviana">
                        </div>
                        <div class="service-body">
                            <h3>Gestión de Inventarios</h3>
                            <p>
                                Controlamos y gestionamos el inventario de aeronaves, motores y repuestos,
                                asegurando la trazabilidad y disponibilidad para cada misión.
                            </p>
                        </div>
                    </article>

                    <article class="service-card">
                        <div class="service-image">
                            <img src="{{ asset('storage/images/EscuadroAeronautico.jpg') }}" alt="Aeronaves en formación">
                        </div>
                        <div class="service-body">
                            <h3>Capacitación</h3>
                            <p>
                                Ofrecemos programas de capacitación para personal técnico y operativo,
                                fortaleciendo competencias en el manejo y mantenimiento de aeronaves.
                            </p>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <!-- Sección Contacto -->
        <section id="contact" class="section contact">
            <div class="container contact-grid">
                <div class="contact-info">
                    <h2 class="section-title">Contáctanos</h2>
                    <p>
                        ¿Tienes preguntas o necesitas más información sobre el sistema de gestión de aeronaves?
                        Nuestro equipo está disponible para atender tus consultas.
                    </p>
                    <ul class="contact-list">
                        <li><strong>Unidad:</strong> Policía Aérea Boliviana</li>
                        <li><strong>Uso:</strong> Sistema interno de gestión institucional</li>
                        <li><strong>Atención:</strong> Personal autorizado</li>
                    </ul>
                </div>

                <div class="contact-form-card">
                    <form action="#" method="POST" class="contact-form">
                        <div class="form-row">
                            <input type="text" name="name" placeholder="Tu nombre" required>
                        </div>
                        <div class="form-row">
                            <input type="email" name="email" placeholder="Tu correo electrónico" required>
                        </div>
                        <div class="form-row">
                            <textarea name="message" placeholder="Tu mensaje" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-full">Enviar mensaje</button>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <!-- Pie de página -->
    <footer class="main-footer">
        <div class="container footer-inner">
            <p>&copy; 2025 Policía Aérea Boliviana. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="{{ asset('js/welcome.js') }}"></script>
</body>
</html>
