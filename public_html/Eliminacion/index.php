<?php
// Código PHP 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Ecuaciones - Gauss Jordan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Roboto+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #00c853;
            --secondary-color: #1e1e1e;
            --accent-color: #68c968;
            --dark-bg: #121212;
            --card-bg: #1e1e1e;
            --text-light: #e0e0e0;
            --text-muted: #9e9e9e;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--dark-bg);
            margin: 0;
            padding: 0;
            color: var(--text-light);
            min-height: 100vh;
            position: relative;
        }

        /* Menú superior mejorado */
        .top-menu {
            width: 100%;
            background: linear-gradient(135deg, #0d1f0d 0%, #1a3a1a 100%);
            padding: 15px 30px;
            box-shadow: 0 4px 20px rgba(0, 80, 0, 0.4);
            display: flex;
            justify-content: flex-start;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        .menu-button {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 200, 83, 0.3);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .menu-button:hover {
            background-color: var(--accent-color);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(104, 201, 104, 0.4);
        }

        .menu-button::before {
            content: "←";
            font-weight: bold;
        }

        /* Contenedor principal */
        .container {
            max-width: 1000px;
            margin: 100px auto 40px;
            background-color: var(--card-bg);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.6);
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(0, 200, 83, 0.1);
        }

        .container::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--primary-color), #00b88d);
        }

        /* Imagen centrada - versión mejorada */
.matrix-image {
    display: flex;
    justify-content: center;
    align-items: center; /* Añadido para centrado vertical */
    margin: 0 auto 30px;
    width: 300px; /* Cambiado de max-width a width fijo */
    height: 200px; /* Altura fija para contenedor */
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
    transition: transform 0.3s ease;
    border: 2px solid rgba(0, 200, 83, 0.3);
    background-color: #1a1a1a; /* Fondo por si falla la imagen */
    position: relative; /* Para mensaje de error */
}

.matrix-image:hover {
    transform: scale(1.03) rotate(1deg);
}

.matrix-image img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Asegura que la imagen cubra el espacio */
    display: block;
}

/* Mensaje de error si la imagen no carga */
.matrix-image::after {
    content: "Imagen no disponible";
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: #ff5555;
    font-weight: bold;
    display: none;
}

.matrix-image img[src=""]::after, 
.matrix-image img:not([src])::after {
    display: block;
}

        /* Títulos */
        h1 {
            color: var(--primary-color);
            margin-bottom: 20px;
            font-size: 2.5rem;
            font-weight: 700;
            text-align: center;
            position: relative;
            padding-bottom: 15px;
        }

        h1::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--primary-color), transparent);
        }

        p {
            color: var(--text-muted);
            font-size: 1.1rem;
            line-height: 1.6;
            text-align: center;
            max-width: 700px;
            margin: 0 auto 30px;
        }

        /* Opciones */
        .options {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 40px;
            flex-wrap: wrap;
        }

        .option-card {
            background: linear-gradient(145deg, #1e3a1e, #1a2e1a);
            border-radius: 12px;
            padding: 30px;
            width: 300px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(0, 200, 83, 0.2);
        }

        .option-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: var(--primary-color);
        }

        .option-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
            background: linear-gradient(145deg, #1e4a1e, #1a3e1a);
        }

        .option-card h2 {
            color: var(--primary-color);
            margin-top: 0;
            font-size: 1.5rem;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .option-card p {
            color: var(--text-light);
            font-size: 1rem;
            margin-bottom: 25px;
            text-align: left;
        }

        /* Botones */
        .btn {
            background: linear-gradient(135deg, var(--primary-color), #00b88d);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            box-shadow: 0 4px 10px rgba(0, 200, 83, 0.3);
            width: 100%;
            text-align: center;
        }

        .btn:hover {
            background: linear-gradient(135deg, var(--accent-color), #00c896);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(104, 201, 104, 0.4);
        }

        /* Efectos de hover para las tarjetas */
        .option-card:hover h2 {
            color: #a3e635;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                margin-top: 120px;
                padding: 30px 20px;
                border-radius: 0;
            }

            .options {
                flex-direction: column;
                align-items: center;
                gap: 20px;
            }

            .option-card {
                width: 100%;
                max-width: 350px;
            }

            h1 {
                font-size: 2rem;
            }
        }

        @media (max-width: 480px) {
            .top-menu {
                justify-content: center;
                padding: 15px;
            }

            .menu-button {
                padding: 10px 20px;
                font-size: 14px;
            }

            .container {
                margin-top: 100px;
            }

            .matrix-image {
                max-width: 250px;
            }
        }

        /* Animaciones */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .container {
            animation: fadeIn 0.6s ease-out;
        }

        .option-card:nth-child(1) {
            animation: fadeIn 0.6s ease-out 0.1s forwards;
            opacity: 0;
        }

        .option-card:nth-child(2) {
            animation: fadeIn 0.6s ease-out 0.2s forwards;
            opacity: 0;
        }
    </style>
</head>
<body>

    <!-- MENÚ SUPERIOR MEJORADO -->
    <div class="top-menu">
        <a href="../../" class="menu-button">Menú Principal</a>
    </div>

    <!-- CONTENIDO PRINCIPAL -->
    <div class="container">
    <div class="matrix-image">
    <img src="../matriz.png" alt="Operaciones con Matrices">
</div>

        
        <h1>Método de Gauss-Jordan</h1>
        <p>Seleccione el tipo de sistema que desea resolver:</p>
        
        <div class="options">
            <div class="option-card">
                <h2>Con Ecuaciones</h2>
                <p>Ingrese ecuaciones con variables x, y, z en formato: 2x+3y-z=5</p>
                <form action="gaussiana.php" method="get">
                    <button type="submit" class="btn">Seleccionar</button>
                </form>
            </div>
            
            <div class="option-card">
                <h2>Con Matriz</h2>
                <p>Ingrese una matriz cuadrada n×n para resolver el sistema</p>
                <form action="gauss.php" method="get">
                    <button type="submit" class="btn">Seleccionar</button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>