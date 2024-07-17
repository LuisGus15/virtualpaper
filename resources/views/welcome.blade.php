<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a Nuestro Sistema</title>
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
    <header class="header">
        <div class="logo">
            <img src="{{ asset('images/virtuallogo.jpeg') }}" alt="Logo">
            <span>Virtual Papers</span>
        </div>
        <nav class="nav">
            <a href="{{ route('login') }}">Inicia sesión</a>
            <a href="{{ route('register') }}" class="register-btn">Regístrate</a>
        </nav>
    </header>

    <main class="main">
        <div class="content">
            <h1>Bienvenido a Nuestro Sistema</h1>
            <p>Por favor, inicia sesión o regístrate para continuar.</p>
        </div>
    </main>

    <section class="features">
        <div class="container">
            <h2>Nuestras Características</h2>
            <div class="feature-list">
                <div class="feature-item">
                    <h3>Fácil de Usar</h3>
                    <p>Interfaz intuitiva y fácil de usar.</p>
                </div>
                <div class="feature-item">
                    <h3>Seguridad</h3>
                    <p>Tus datos están siempre seguros con nosotros.</p>
                </div>
                <div class="feature-item">
                    <h3>Soporte 24/7</h3>
                    <p>Siempre estamos aquí para ayudarte.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="testimonials">
        <div class="container">
            <h2>Testimonios</h2>
            <div class="testimonial-list">
                <div class="testimonial-item">
                    <p>"Este sistema ha mejorado nuestra productividad increíblemente."</p>
                    <span>- Usuario Satisfecho</span>
                </div>
                <div class="testimonial-item">
                    <p>"La mejor decisión que hemos tomado para nuestro negocio."</p>
                    <span>- Cliente Feliz</span>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 Virtual Papers. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
<div class="footer">
    <p>Esta vista ha sido visitada {{ $pageViews->where('route_name', \Request::route()->getName())->first()->views ?? 0 }} veces.</p>
</div>
</html>
