<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Determinante</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #000; /* fondo negro */
            margin: 0;
            padding: 0;
            color: #d4f8d4;
            font-size: 1em; /* Tamaño de fuente ajustado */
        }

        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #0d1f0d;
            display: flex;
            align-items: center;
            padding: 15px 30px;
            z-index: 1000;
        }

        .menu-toggle {
            background: none;
            border: none;
            cursor: pointer;
            padding: 10px;
        }

        .menu-toggle .bar {
            display: block;
            width: 30px;
            height: 4px;
            margin: 5px 0;
            background-color: #a3e635;
            transition: 0.3s;
        }

        nav {
            position: absolute;
            top: 60px;
            left: 0;
            background-color: #1e3a1e;
            width: 250px;
            display: none;
            flex-direction: column;
            border-bottom-right-radius: 10px;
        }

        nav.active {
            display: flex;
        }

        nav a {
            padding: 15px 20px;
            text-decoration: none;
            color: #d4f8d4;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            transition: background 0.3s;
            font-size: 1.2em; /* Tamaño de fuente ajustado */
        }

        nav a:hover {
            background-color: #122d12;
        }

        main {
            padding-top: 90px;
            text-align: center;
            padding: 20px;
        }

        .button-container {
            display: flex;
            gap: 30px;
            justify-content: center;
            padding: 20px;
            flex-wrap: wrap;
            margin-top: 30px;
        }

        #Button {
            background-color: #1e3a1e;
            color: #d4f8d4;
            border: none;
            padding: 15px 30px;
            border-radius: 10px;
            font-size: 1.2em; /* Tamaño de fuente ajustado */
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 6px 12px rgba(0,0,0,0.3);
            text-transform: uppercase;
            letter-spacing: 1px;
            min-width: 220px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
        }

        #Button:hover {
            background-color: #2a522a;
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.4);
        }

        #Button:active {
            background-color: #5abf5a;
            transform: translateY(2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        #Button:focus {
            outline: none;
            box-shadow: 0 0 0 4px rgba(119, 221, 119, 0.5);
        }

        table {
            margin: 0 auto;
            width: 70%;
            font-size: 1.1em; /* Tamaño de letra ajustado */
            color: #d4f8d4;
        }

        table td {
            padding: 10px;
            text-align: center;
        }

        table input {
            padding: 10px;
            font-size: 1.1em;
            width: 50%;
            border-radius: 5px;
            border: 2px solid #d4f8d4;
            background-color: transparent;
            color: #d4f8d4;
        }

        table input:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(119, 221, 119, 0.5);
        }

        footer {
            background-color: #0d1f0d;
            text-align: center;
            padding: 20px;
            font-size: 1em;
        }

        footer a {
            color: #a3e635;
            font-weight: bold;
            text-decoration: none;
            margin: 0 15px;
        }

        footer a:hover {
            text-decoration: underline;
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
</header>

<nav id="dropdownMenu">
    <a href="../Eliminacion/">Gauss-Jordan</a>
    <a href="../Inversa/">Matriz Inversa</a>
    <a href="../Suma/">Suma de Matrices</a>
    <a href="../Determinante/">Determinantes</a>
</nav>

<main>
    <a href="../"><img src="../sistema.png" height="10%" width="20%"></a> <br>
    <font face="Calibri" size="5">Determinante</font>
    <br><br>

    <form action="determinante.php" method="post" autocomplete="off">
        <fieldset>
            <legend><b>Determinante de una Matriz</b></legend>
            <table>
                <tr>
                    <td><p>Número de filas y columnas</p></td>
                    <td><input type="number" name="FilasCols" id="FilasCols" required /></td>
                    <td><i>La matriz debe tener el mismo número de filas y columnas</i></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <p><input type="submit" value="Generar matriz" required></p>
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>

    <div class="button-container">
        <button onclick="window.location.href='../Eliminacion/'" id="Button">Gauss-Jordan</button>
        <button onclick="window.location.href='../Suma/'" id="Button">Suma</button>
    </div>
</main>

<footer>
    <a href="#">Inicio</a> | <a href="#">Contacto</a>
    <div>&copy; 2025 Gauss Jordan</div>
</footer>

<script>
    function toggleMenu() {
        const menu = document.getElementById("dropdownMenu");
        menu.classList.toggle("active");
    }
</script>

</body>
</html>
