<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="Algebra Lineal" content="Algebra, Lineal, gauss-jordan, determinante, matriz">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gauss Jordan - Operaciones Matriciales</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');
      
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #000;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            color: #e0f7fa;
            scroll-behavior: smooth;
        }

        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background: linear-gradient(135deg, #0d1f0d 0%, #1a3a1a 100%);
            display: flex;
            align-items: center;
            padding: 5px 20px;
            z-index: 1000;
            box-shadow: 0 4px 15px rgba(0, 80, 0, 0.3);
            height: 60px;
        }

        /* Menú hamburguesa */
        .menu-toggle {
            background: none;
            border: none;
            cursor: pointer;
            padding: 10px;
            transition: transform 0.3s;
            z-index: 1001;
        }

        .menu-toggle:hover {
            transform: scale(1.1);
        }

        .menu-toggle .bar {
            display: block;
            width: 25px;
            height: 3px;
            margin: 4px 0;
            background-color: #a3e635;
            transition: 0.3s;
        }

  
        nav {
            position: fixed;
            top: 60px;
            left: 0;
            background: linear-gradient(145deg, #1e3a1e 0%, #2a4a2a 100%);
            width: 250px;
            display: none;
            flex-direction: column;
            border-bottom-right-radius: 15px;
            box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.3);
            z-index: 999;
        }

        nav.active {
            display: flex;
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from { transform: translateX(-100%); }
            to { transform: translateX(0); }
        }

        nav a {
            padding: 15px 20px;
            text-decoration: none;
            color: #d4f8d4;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.4s;
            font-weight: 500;
            display: flex;
            align-items: center;
        }

        nav a:hover {
            background-color: #122d12;
            padding-left: 30px;
            transform: scale(1.02);
            box-shadow: inset 5px 0 0 #a3e635;
        }

        nav a::before {
            content: "→";
            margin-right: 10px;
            color: #a3e635;
            opacity: 0;
            transition: opacity 0.3s;
        }

        nav a:hover::before {
            opacity: 1;
        }

     
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 120px 20px 80px;
        }

        .title {
            font-size: 4rem;
            margin-bottom: 15px;
            background: linear-gradient(to right, #a3e635, #00b88d);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.4);
            letter-spacing: 1px;
            font-weight: 700;
            position: relative;
            padding-bottom: 15px;
        }

        .title::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 150px;
            height: 3px;
            background: linear-gradient(to right, transparent, #a3e635, transparent);
        }

        .subtitle {
            font-size: 1.8rem;
            font-style: italic;
            color: #77dd77;
            margin-bottom: 50px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
            letter-spacing: 0.5px;
        }

       
        .topic-section {
            width: 85%;
            margin: 50px auto;
            padding: 40px;
            background: rgba(30, 58, 30, 0.8);
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: transform 0.3s, box-shadow 0.3s;
            border: 1px solid rgba(163, 230, 53, 0.2);
            position: relative;
            overflow: hidden;
        }

        .topic-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(to right, #a3e635, #00b88d);
        }

        .topic-section:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        }

        .topic-title {
            font-size: 2.5rem;
            color: #a3e635;
            margin-bottom: 30px;
            text-align: center;
            position: relative;
            padding-bottom: 10px;
            font-weight: 600;
        }

        .topic-title::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 2px;
            background: linear-gradient(to right, transparent, #a3e635, transparent);
        }

        .topic-content {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 40px;
        }

        .topic-text {
            flex: 1;
            min-width: 300px;
            text-align: justify;
            line-height: 1.8;
            font-size: 1.1rem;
        }

        .topic-text p {
            margin-bottom: 20px;
        }

        .topic-text ul {
            padding-left: 20px;
            margin-bottom: 20px;
        }

        .topic-text li {
            margin-bottom: 10px;
            position: relative;
            padding-left: 15px;
        }

        .topic-text li::before {
            content: "•";
            color: #a3e635;
            position: absolute;
            left: 0;
            font-size: 1.5rem;
            line-height: 1;
        }

        .topic-image {
            flex: 1;
            min-width: 300px;
            display: flex;
            justify-content: center;
            align-items: center;
            perspective: 1000px;
        }

        .topic-image img {
            max-width: 100%;
            height: auto;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
            transition: all 0.5s ease;
            border: 2px solid rgba(163, 230, 53, 0.3);
            transform-style: preserve-3d;
        }

        .topic-image img:hover {
            transform: scale(1.05) rotateY(5deg);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
        }

        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #a3e635, #00b88d);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            z-index: 99;
        }

        .back-to-top.active {
            opacity: 1;
            visibility: visible;
        }

        .back-to-top:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
        }

        .back-to-top::before {
            content: "↑";
            color: #fff;
            font-size: 24px;
            font-weight: bold;
        }

       
        footer {
            background: linear-gradient(135deg, #0d1f0d 0%, #1a3a1a 100%);
            text-align: center;
            padding: 30px 20px;
            color: #77dd77;
            margin-top: 50px;
            position: relative;
        }

        footer::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(to right, transparent, #a3e635, transparent);
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .footer-links a {
            color: #a3e635;
            font-weight: bold;
            text-decoration: none;
            transition: all 0.3s;
            padding: 5px 10px;
            border-radius: 5px;
            position: relative;
        }

        .footer-links a::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 2px;
            background: #d4f8d4;
            transition: width 0.3s;
        }

        .footer-links a:hover {
            color: #d4f8d4;
        }
        .footer-links a:hover::after {
            width: 100%;
        }

        .copyright {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .topic-section {
            animation: fadeIn 0.6s ease-out forwards;
        }

        .topic-section:nth-child(1) { animation-delay: 0.1s; }
        .topic-section:nth-child(2) { animation-delay: 0.2s; }
        .topic-section:nth-child(3) { animation-delay: 0.3s; }
        .topic-section:nth-child(4) { animation-delay: 0.4s; }

        /* Responsive */
        @media (max-width: 992px) {
            .title {
                font-size: 3rem;
            }
            
            .subtitle {
                font-size: 1.5rem;
            }
            
            .topic-section {
                width: 90%;
                padding: 30px;
            }
            
            .topic-title {
                font-size: 2rem;
            }
        }

        @media (max-width: 768px) {
            .title {
                font-size: 2.5rem;
            }
            
            .subtitle {
                font-size: 1.2rem;
            }
            
            .topic-section {
                width: 95%;
                padding: 25px;
            }
            
            .topic-title {
                font-size: 1.8rem;
            }

            .topic-content {
                flex-direction: column;
            }

            .topic-text, .topic-image {
                min-width: 100%;
            }
        }

        @media (max-width: 576px) {
            .title {
                font-size: 2rem;
            }
            
            .subtitle {
                font-size: 1rem;
            }
            
            .topic-section {
                padding: 20px;
            }
            
            .topic-title {
                font-size: 1.5rem;
            }

            .footer-links {
                flex-direction: column;
                gap: 15px;
            }
        }
    </style>
</head>
<body>

<header>
    <button class="menu-toggle" onclick="toggleMenu()">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
    </button>
    <h1 style="margin-left: 20px; color: #a3e635; font-size: 1.8rem; text-shadow: 0 0 10px rgba(163, 230, 53, 0.5);">Álgebra Lineal</h1>
</header>

<nav id="dropdownMenu">
    <a href="public_html/Eliminacion/">Gauss-Jordan</a>
    <a href="public_html/Inversa/">Matriz Inversa</a>
    <a href="public_html/Suma/">Suma de Matrices</a>
    <a href="public_html/Determinante/">Determinantes</a>
</nav>

<div class="main-content">
    <h1 class="title">Operaciones Matriciales</h1>
    <p class="subtitle">Explora las herramientas fundamentales del álgebra lineal</p>
    
    <!-- Sección Gauss-Jordan -->
    <div class="topic-section">
        <h2 class="topic-title">Método de Gauss-Jordan</h2>
        <div class="topic-content">
            <div class="topic-text">
                <p>El método de Gauss-Jordan es un algoritmo del álgebra lineal para determinar las soluciones de un sistema de ecuaciones lineales, encontrar matrices e inversas. Es una variación del método de eliminación de Gauss donde se busca obtener la forma escalonada reducida de una matriz.</p>
                <p>Este método consiste en realizar operaciones elementales sobre las filas de la matriz hasta obtener una matriz identidad en el lado izquierdo, lo que proporciona directamente la solución en el lado derecho. Las operaciones permitidas incluyen:</p>
                <ul>
                    <li>Intercambiar filas</li>
                    <li>Multiplicar una fila por un escalar distinto de cero</li>
                    <li>Sumar a una fila un múltiplo de otra</li>
                </ul>
                <p>Es especialmente útil para resolver sistemas de ecuaciones con múltiples variables y para calcular la inversa de una matriz.</p>
            </div>
            <div class="topic-image">
                <img src="public_html/Gauss.jpg" alt="Ejemplo de Gauss-Jordan">
            </div>
        </div>
    </div>
    
    <!-- Sección Matriz Inversa -->
    <div class="topic-section">
        <h2 class="topic-title">Matriz Inversa</h2>
        <div class="topic-content">
            <div class="topic-image">
                <img src="public_html/inversa.png" alt="Ejemplo de Matriz Inversa">
            </div>
            <div class="topic-text">
                <p>Una matriz inversa de una matriz cuadrada A es otra matriz (denotada como A⁻¹) que, cuando se multiplica por A, produce la matriz identidad. No todas las matrices tienen inversa; solo las matrices cuadradas con determinante distinto de cero (matrices no singulares) son invertibles.</p>
                <p>Existen varios métodos para calcular la inversa de una matriz:</p>
                <ul>
                    <li>Método de Gauss-Jordan (ampliando la matriz con la identidad)</li>
                    <li>Usando la matriz adjunta y el determinante (A⁻¹ = adj(A)/det(A))</li>
                    <li>Descomposición LU</li>
                </ul>
                <p>Las matrices inversas son fundamentales en la resolución de sistemas de ecuaciones lineales, en gráficos por computadora y en muchos algoritmos de machine learning.</p>
            </div>
        </div>
    </div>
    
    <!-- Sección Determinantes -->
    <div class="topic-section">
        <h2 class="topic-title">Determinantes</h2>
        <div class="topic-content">
            <div class="topic-text">
                <p>El determinante es un valor escalar que se puede calcular a partir de los elementos de una matriz cuadrada. Proporciona información importante sobre la matriz y el sistema lineal asociado:</p>
                <ul>
                    <li>Si el determinante es cero, la matriz es singular (no tiene inversa)</li>
                    <li>El valor absoluto del determinante representa el factor de escala de la transformación lineal</li>
                    <li>El signo del determinante indica si la transformación preserva la orientación</li>
                </ul>
                <p>Para matrices 2x2 y 3x3 existen fórmulas directas (regla de Sarrus para 3x3). Para matrices más grandes, se puede calcular mediante:</p>
                <ul>
                    <li>Expansión por cofactores</li>
                    <li>Reducción a forma triangular</li>
                    <li>Descomposición LU</li>
                </ul>
            </div>
            <div class="topic-image">
                <img src="public_html/determin.jpg" alt="Ejemplo de Determinante">
            </div>
        </div>
    </div>
    
    <!-- Sección Operaciones con Matrices -->
    <div class="topic-section">
        <h2 class="topic-title">Operaciones con Matrices</h2>
        <div class="topic-content">
            <div class="topic-image">
                <img src="public_html/operations.jpg" alt="Operaciones con Matrices">
            </div>
            <div class="topic-text">
                <p>Las matrices admiten diversas operaciones algebraicas que son fundamentales en el álgebra lineal:</p>
                <ul>
                    <li><strong>Suma:</strong> Solo posible entre matrices del mismo tamaño, se suma elemento a elemento</li>
                    <li><strong>Multiplicación por escalar:</strong> Cada elemento se multiplica por el escalar</li>
                    <li><strong>Multiplicación de matrices:</strong> No conmutativa, el número de columnas de la primera debe coincidir con el número de filas de la segunda</li>
                    <li><strong>Transposición:</strong> Intercambio de filas por columnas</li>
                    <li><strong>Potenciación:</strong> Solo para matrices cuadradas</li>
                </ul>
                <p>Estas operaciones tienen aplicaciones en gráficos por computadora, inteligencia artificial, física cuántica y muchas otras áreas de la ciencia y la ingeniería.</p>
            </div>
        </div>
    </div>
</div>

<!-- Botón para subir -->
<div class="back-to-top" id="backToTop"></div>

<footer>
    <div class="footer-links">
        <a href="#">Inicio</a>
        <a href="#">Tutoriales</a>
        <a href="#">Ejemplos</a>
        <a href="#">Contacto</a>
    </div>
    <div class="copyright">
        &copy; 2025 Álgebra Lineal  | Todos los derechos reservados
    </div>
</footer>

<script>
    // Menú 
    function toggleMenu() {
        const menu = document.getElementById("dropdownMenu");
        menu.classList.toggle("active");
        
        const bars = document.querySelectorAll('.bar');
        if (menu.classList.contains('active')) {
            bars[0].style.transform = 'rotate(45deg) translate(5px, 5px)';
            bars[1].style.opacity = '0';
            bars[2].style.transform = 'rotate(-45deg) translate(5px, -5px)';
        } else {
            bars.forEach(bar => {
                bar.style.transform = 'none';
                bar.style.opacity = '1';
            });
        }
    }
    

    document.addEventListener('click', function(event) {
        const menu = document.getElementById('dropdownMenu');
        const toggle = document.querySelector('.menu-toggle');
        
        if (!menu.contains(event.target) && !toggle.contains(event.target)) {
            menu.classList.remove('active');
            document.querySelectorAll('.bar').forEach(bar => {
                bar.style.transform = 'none';
                bar.style.opacity = '1';
            });
        }
    });
    
    // Botón para subir
    const backToTop = document.getElementById('backToTop');
    
    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            backToTop.classList.add('active');
        } else {
            backToTop.classList.remove('active');
        }
    });
    
    backToTop.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
    
    // Animaciones al cargar
    document.addEventListener('DOMContentLoaded', function() {
        const sections = document.querySelectorAll('.topic-section');
        
        sections.forEach((section, index) => {
            section.style.animationDelay = `${index * 0.1 + 0.1}s`;
        });
    });
</script>

</body>
</html>