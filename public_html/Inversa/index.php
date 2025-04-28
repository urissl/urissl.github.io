<?php
class Fraccion {
    public $numerador;
    public $denominador;

    public function __construct($num = 0, $den = 1) {
        $this->numerador = $num;
        $this->denominador = $den ?: 1;
        $this->simplificar();
    }

    private function simplificar() {
        $divisor = $this->mcd($this->numerador, $this->denominador);
        $this->numerador /= $divisor;
        $this->denominador /= $divisor;
        if ($this->denominador < 0) {
            $this->numerador *= -1;
            $this->denominador *= -1;
        }
    }

    private function mcd($a, $b) {
        $a = abs($a);
        $b = abs($b);
        while ($b != 0) {
            $temp = $b;
            $b = $a % $b;
            $a = $temp;
        }
        return $a;
    }

    public function sumar($other) {
        return new Fraccion(
            $this->numerador * $other->denominador + $other->numerador * $this->denominador,
            $this->denominador * $other->denominador
        );
    }

    public function restar($other) {
        return new Fraccion(
            $this->numerador * $other->denominador - $other->numerador * $this->denominador,
            $this->denominador * $other->denominador
        );
    }

    public function multiplicar($other) {
        return new Fraccion(
            $this->numerador * $other->numerador,
            $this->denominador * $other->denominador
        );
    }

    public function dividir($other) {
        return new Fraccion(
            $this->numerador * $other->denominador,
            $this->denominador * $other->numerador
        );
    }

    public function esCero() {
        return $this->numerador == 0;
    }

    public function aFloat() {
        return $this->numerador / $this->denominador;
    }

    public function __toString() {
        return $this->denominador == 1 ? (string)$this->numerador : "{$this->numerador}/{$this->denominador}";
    }
}

function imprimirMatrizBonita($matriz) {
    $n = count($matriz);
    $anchos = array_fill(0, $n, 0);
    foreach ($matriz as $fila) {
        foreach ($fila as $j => $frac) {
            $long = strlen((string)$frac);
            if ($long > $anchos[$j]) $anchos[$j] = $long;
        }
    }
    echo "<pre id='dragResult' draggable='true'>";
    foreach ($matriz as $fila) {
        foreach ($fila as $j => $frac) {
            echo str_pad($frac, $anchos[$j] + 2, ' ', STR_PAD_BOTH);
        }
        echo "\n";
    }
    echo "</pre>";
}

function intercambiarFilas(&$matriz, $fila1, $fila2) {
    $temp = $matriz[$fila1];
    $matriz[$fila1] = $matriz[$fila2];
    $matriz[$fila2] = $temp;
}

function invertirMatriz($matrizOriginal, &$inversa, &$explicacion) {
    $n = count($matrizOriginal);
    $matriz = $matrizOriginal;
    $inversa = array_fill(0, $n, array_fill(0, $n, new Fraccion(0)));
    for ($i = 0; $i < $n; $i++) $inversa[$i][$i] = new Fraccion(1);

    for ($col = 0; $col < $n; $col++) {
        $maxFila = $col;
        for ($fila = $col + 1; $fila < $n; $fila++) {
            if (abs($matriz[$fila][$col]->aFloat()) > abs($matriz[$maxFila][$col]->aFloat())) {
                $maxFila = $fila;
            }
        }

        if ($matriz[$maxFila][$col]->esCero()) {
            $explicacion = "No se puede invertir: pivote cero en columna $col. Esto implica determinante igual a 0.";
            return false;
        }

        if ($maxFila != $col) {
            intercambiarFilas($matriz, $col, $maxFila);
            intercambiarFilas($inversa, $col, $maxFila);
        }

        $pivote = $matriz[$col][$col];
        for ($j = 0; $j < $n; $j++) {
            $matriz[$col][$j] = $matriz[$col][$j]->dividir($pivote);
            $inversa[$col][$j] = $inversa[$col][$j]->dividir($pivote);
        }

        for ($fila = 0; $fila < $n; $fila++) {
            if ($fila != $col && !$matriz[$fila][$col]->esCero()) {
                $factor = $matriz[$fila][$col];
                for ($j = 0; $j < $n; $j++) {
                    $matriz[$fila][$j] = $matriz[$fila][$j]->restar($matriz[$col][$j]->multiplicar($factor));
                    $inversa[$fila][$j] = $inversa[$fila][$j]->restar($inversa[$col][$j]->multiplicar($factor));
                }
            }
        }
    }
    return true;
}

// Procesar formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $n = (int)$_POST['dimension'];
    $matriz = [];
    for ($i = 0; $i < $n; $i++) {
        $fila = [];
        for ($j = 0; $j < $n; $j++) {
            $valor = $_POST["matriz_{$i}_{$j}"] ?? 0;
            if (!is_numeric($valor)) die("Error: Solo números permitidos.");
            $fila[] = new Fraccion((int)round($valor * 1000), 1000);
        }
        $matriz[] = $fila;
    }

    echo "<h2>Matriz Original:</h2>";
    imprimirMatrizBonita($matriz);

    $inversa = [];
    $explicacion = '';
    if (invertirMatriz($matriz, $inversa, $explicacion)) {
        echo "<h2>Matriz Inversa:</h2>";
        imprimirMatrizBonita($inversa);
    } else {
        echo "<h2 style='color:red'>No existe inversa.</h2>";
        echo "<p>Última matriz trabajada:</p>";
        imprimirMatrizBonita($matriz);
        echo "<p><strong>Explicación:</strong> $explicacion</p>";
    }
    echo "<div style='text-align:center;margin-top:20px;'><a href='".$_SERVER['PHP_SELF']."'><button>Regresar</button></a></div>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Matriz Inversa Mejorada</title>
<style>
    body {
        background-color: #000;
        color: #e0f7fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0; padding: 20px;
    }
    .container {
        max-width: 900px;
        margin: auto;
        background: rgba(30, 58, 30, 0.8);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 150, 0, 0.7);
    }
    h1 { text-align: center; color: #a3e635; }
    table { margin: auto; }
    td { padding: 5px; }
    input[type="text"] {
        width: 60px; background: #122d12; color: #d4f8d4; border: 1px solid #2a4a2a; border-radius: 5px; text-align: center;
    }
    button {
        background: linear-gradient(135deg, #00b88d 0%, #00785f 100%);
        color: white; border: none; padding: 10px 20px; border-radius: 5px; margin: 5px; font-weight: bold;
    }
    button:hover { transform: translateY(-2px); }
    pre#dragResult { cursor: grab; }
</style>
</head>
<body>

<div class="container">
    <h1>Calculadora de Inversa de Matrices</h1>
    <form method="post" id="matrixForm">
        <label>Dimensión de matriz (n x n):</label>
        <input type="number" id="dimension" name="dimension" min="1" max="10" value="3" required>

        <div style="text-align:center;margin:10px;">
            <button type="button" onclick="generarMatriz()">Generar Matriz</button>
            <button type="button" onclick="addRow()">Agregar Fila/Columna</button>
            <button type="button" onclick="removeRow()">Quitar Fila/Columna</button>
            <button type="button" onclick="resetZeros()">Limpiar Todo</button>
        </div>

        <div id="matrixInputs"></div>

        <div style="text-align:center;margin:10px;">
            <button type="submit">Calcular Inversa</button>
        </div>
    </form>
</div>

<script>
let currentValues = {};

function generarMatriz() {
    const n = parseInt(document.getElementById('dimension').value);
    const container = document.getElementById('matrixInputs');
    saveCurrentValues();
    let html = '<table>';
    for (let i = 0; i < n; i++) {
        html += '<tr>';
        for (let j = 0; j < n; j++) {
            const key = `${i}_${j}`;
            const value = currentValues[key] ?? (i === j ? 1 : 0);
            html += `<td><input type="text" name="matriz_${i}_${j}" class="matrix-input" value="${value}" oninput="validateNumber(this)"></td>`;
        }
        html += '</tr>';
    }
    html += '</table>';
    container.innerHTML = html;
}

function saveCurrentValues() {
    document.querySelectorAll('.matrix-input').forEach(input => {
        const key = input.name.replace('matriz_', '');
        currentValues[key] = input.value;
    });
}

function validateNumber(input) {
    input.value = input.value.replace(/[^0-9.\-]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(?!^)-/g, '');
}

function addRow() {
    const dimension = document.getElementById('dimension');
    if (dimension.value < 10) { dimension.value++; generarMatriz(); }
}

function removeRow() {
    const dimension = document.getElementById('dimension');
    if (dimension.value > 1) { dimension.value--; generarMatriz(); }
}

function resetZeros() {
    const n = document.getElementById('dimension').value;
    currentValues = {};
    for (let i = 0; i < n; i++) {
        for (let j = 0; j < n; j++) {
            currentValues[`${i}_${j}`] = 0;
        }
    }
    generarMatriz();
}

window.onload = generarMatriz;
</script>

</body>
</html>
