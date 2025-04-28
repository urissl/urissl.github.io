<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gauss-Jordan Paso a Paso</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        text-align: center;
        padding: 20px;
        background-color: #e6f4ea; /* Verde claro de fondo */
        color: #2e7031; /* Texto en verde oscuro */
    }

    table {
        margin: 10px auto;
        border-collapse: collapse;
        background-color: #ffffff; /* Fondo blanco para tabla */
        box-shadow: 0 0 10px rgba(46, 112, 49, 0.2);
    }

    td, th {
        border: 1px solid #4CAF50; /* Borde verde */
        padding: 8px 12px;
    }

    .error {
        color: #c62828; /* Rojo fuerte para errores */
        font-weight: bold;
    }

    .formulario {
        margin-bottom: 30px;
    }

    input[type="number"] {
        width: 60px;
        text-align: center;
        border: 1px solid #4CAF50;
        border-radius: 5px;
        padding: 5px;
    }

    input[type="number"]:focus {
        outline: none;
        box-shadow: 0 0 5px #66bb6a;
    }

    button {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 8px 16px;
        font-size: 1em;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background-color: #45a049;
    }

    .titulo {
        font-size: 1.4em;
        margin-top: 30px;
        font-weight: bold;
        color: #1b5e20;
    }
</style>

</head>
<body>

<h1>Método de Gauss-Jordan</h1>

<form method="POST" class="formulario">
    <label>Orden de la matriz (n): 
        <input type="number" name="n" min="2" max="10" required value="<?= $_POST['n'] ?? 3 ?>">
    </label><br><br>
    <button type="submit" name="generar">Generar matriz</button>
</form>

<?php
function decimalAfraccion($n, $tolerance = 1.e-6) {
    if ($n == 0) return '0';
    $h1 = 1; $h2 = 0; $k1 = 0; $k2 = 1; $b = $n;
    do {
        $a = floor($b);
        $aux = $h1; $h1 = $a * $h1 + $h2; $h2 = $aux;
        $aux = $k1; $k1 = $a * $k1 + $k2; $k2 = $aux;
        $b = 1 / ($b - $a);
    } while (abs($n - $h1 / $k1) > $n * $tolerance);
    return "$h1/$k1";
}

if (isset($_POST['generar']) || isset($_POST['resolver'])) {
    $n = intval($_POST['n']);

    if ($n >= 2 && $n <= 10) {
        if (!isset($_POST['resolver'])) {
            echo "<form method='POST'><input type='hidden' name='n' value='$n'>";
            echo "<div><strong>Ingrese los coeficientes (matriz n×n) y los términos independientes:</strong></div><br>";
            echo "<table>";
            for ($i = 0; $i < $n; $i++) {
                echo "<tr>";
                for ($j = 0; $j < $n; $j++) {
                    $name = "a{$i}_{$j}";
                    echo "<td><input type='number' step='any' name='$name' required></td>";
                }
                // Término independiente
                $name = "b{$i}";
                echo "<td><input type='number' step='any' name='$name' placeholder='TI' required></td>";
                echo "</tr>";
            }
            echo "</table><br>";
            echo "<button type='submit' name='resolver'>Resolver</button></form>";
        }
    } else {
        echo "<p class='error'>El tamaño de la matriz debe estar entre 2 y 10.</p>";
    }
}

if (isset($_POST['resolver'])) {
    $n = intval($_POST['n']);
    $matriz = [];

    // Validar y construir la matriz aumentada
    for ($i = 0; $i < $n; $i++) {
        for ($j = 0; $j < $n; $j++) {
            $val = $_POST["a{$i}_{$j}"];
            if (!is_numeric($val)) {
                echo "<p class='error'>Error: Solo se permiten números.</p>";
                exit;
            }
            $matriz[$i][$j] = floatval($val);
        }
        $valB = $_POST["b{$i}"];
        if (!is_numeric($valB)) {
            echo "<p class='error'>Error: Solo se permiten números.</p>";
            exit;
        }
        $matriz[$i][$n] = floatval($valB); // añadir término independiente
    }

    echo "<div class='titulo'>Matriz Inicial</div>";
    mostrarMatriz($matriz, $n);

    // Gauss-Jordan paso a paso
    for ($pivote = 0; $pivote < $n; $pivote++) {
        $divisor = $matriz[$pivote][$pivote];
        if (abs($divisor) < 1e-10) {
            echo "<p class='error'>División por cero detectada (pivote cero). Verifique los datos.</p>";
            exit;
        }

        // Normalizar fila pivote
        for ($j = 0; $j < $n + 1; $j++) {
            $matriz[$pivote][$j] /= $divisor;
        }
        echo "<div class='titulo'>Paso: Normalizar fila " . ($pivote + 1) . "</div>";
        mostrarMatriz($matriz, $n);

        // Hacer ceros en las demás filas
        for ($i = 0; $i < $n; $i++) {
            if ($i != $pivote) {
                $factor = $matriz[$i][$pivote];
                for ($j = 0; $j < $n + 1; $j++) {
                    $matriz[$i][$j] -= $factor * $matriz[$pivote][$j];
                }
                echo "<div class='titulo'>Paso: Hacer cero en fila " . ($i + 1) . ", columna " . ($pivote + 1) . "</div>";
                mostrarMatriz($matriz, $n);
            }
        }
    }

    // Mostrar solución
    echo "<div class='titulo'>Solución del Sistema</div>";
    for ($i = 0; $i < $n; $i++) {
        $sol = $matriz[$i][$n];
        $fr = decimalAfraccion($sol);
        echo "<p>x" . ($i + 1) . " = " . round($sol, 4) . " ($fr)</p>";
    }
}

function mostrarMatriz($matriz, $n) {
    echo "<table><tr>";
    for ($j = 0; $j < $n; $j++) echo "<th>x" . ($j + 1) . "</th>";
    echo "<th>TI</th></tr>";
    for ($i = 0; $i < $n; $i++) {
        echo "<tr>";
        for ($j = 0; $j < $n + 1; $j++) {
            echo "<td>" . round($matriz[$i][$j], 4) . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}
?>

</body>
</html>
