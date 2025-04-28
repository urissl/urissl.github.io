<?php
// index.php
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sistema de Ecuaciones - Gauss Jordan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: rgba(142, 207, 45, 0.73);
            margin: 0;
            padding: 20px;
            text-align: center;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }
        .logo {
            margin-bottom: 20px;
        }
        .logo img {
            max-width: 200px;
            height: auto;
        }
        h1 {
            color: #2c3e50;
        }
        .options {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
            flex-wrap: wrap;
        }
        .option-card {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            width: 250px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        .option-card:hover {
            transform: translateY(-5px);
        }
        .option-card h2 {
            color: #3498db;
            margin-top: 0;
        }
        .option-card p {
            color: #666;
            margin-bottom: 20px;
        }
        .btn {
            background-color: #77dd77;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
        }
        .btn:hover {
            background-color: #68c968;
        }
        @media (max-width: 600px) {
            .options {
                flex-direction: column;
                align-items: center;
            }
            .option-card {
                width: 80%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="sistem.png" alt="Sistema de Ecuaciones">
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