<?php
class Fraccion {
    public $numerador;
    public $denominador;

    public function __construct($num = 0, $den = 1) {
        $this->numerador = $num;
        $this->denominador = $den;
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
        if ($this->denominador == 1) {
            return (string)$this->numerador;
        }
        return $this->numerador . '/' . $this->denominador;
    }
}

function imprimirMatrizBonita($matriz) {
    $n = count($matriz);
    $anchosColumnas = array_fill(0, $n, 0);
    
    // Calcular anchos máximos por columna
    foreach ($matriz as $fila) {
        foreach ($fila as $j => $fraccion) {
            $longitud = strlen((string)$fraccion);
            if ($longitud > $anchosColumnas[$j]) {
                $anchosColumnas[$j] = $longitud;
            }
        }
    }
    
    // Imprimir matriz
    echo "<pre>";
    foreach ($matriz as $fila) {
        foreach ($fila as $j => $fraccion) {
            echo str_pad($fraccion, $anchosColumnas[$j] + 2, ' ', STR_PAD_BOTH);
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

function invertirMatriz($matrizOriginal, &$inversa) {
    $n = count($matrizOriginal);
    $matriz = $matrizOriginal;
    
    // Inicializar matriz inversa como identidad
    $inversa = array_fill(0, $n, array_fill(0, $n, new Fraccion(0)));
    for ($i = 0; $i < $n; $i++) {
        $inversa[$i][$i] = new Fraccion(1);
    }
    
    for ($col = 0; $col < $n; $col++) {
        // Pivoteo parcial
        $max_fila = $col;
        for ($fila = $col + 1; $fila < $n; $fila++) {
            if (abs($matriz[$fila][$col]->aFloat()) > abs($matriz[$max_fila][$col]->aFloat())) {
                $max_fila = $fila;
            }
        }
        
        if ($matriz[$max_fila][$col]->esCero()) {
            return false; // Matriz no invertible
        }
        
        if ($max_fila != $col) {
            intercambiarFilas($matriz, $col, $max_fila);
            intercambiarFilas($inversa, $col, $max_fila);
        }
        
        // Normalizar fila del pivote
        $pivote = $matriz[$col][$col];
        for ($j = 0; $j < $n; $j++) {
            $matriz[$col][$j] = $matriz[$col][$j]->dividir($pivote);
            $inversa[$col][$j] = $inversa[$col][$j]->dividir($pivote);
        }
        
        // Eliminación gaussiana
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

// Ejemplo de uso
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $n = (int)$_POST['dimension'];
    $matriz = array_fill(0, $n, array_fill(0, $n, new Fraccion(0)));
    
    // Leer valores de la matriz del formulario
    for ($i = 0; $i < $n; $i++) {
        for ($j = 0; $j < $n; $j++) {
            $valor = (float)$_POST["matriz_{$i}_{$j}"];
            // Convertir a fracción (multiplicamos por 1000 para evitar decimales)
            $matriz[$i][$j] = new Fraccion((int)round($valor * 1000), 1000);
        }
    }
    
    echo "<h2>Matriz Original:</h2>";
    imprimirMatrizBonita($matriz);
    
    $inversa = array();
    if (invertirMatriz($matriz, $inversa)) {
        echo "<h2>Matriz Inversa:</h2>";
        imprimirMatrizBonita($inversa);
    } else {
        echo "<p>La matriz no es invertible (determinante cero).</p>";
    }
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Matriz Inversa</title>
    <style>
         body {
            font-family: Arial, sans-serif;
            background-color:rgba(142, 207, 45, 0.73);
            margin: 0;
            padding: 0;
        }
        table { border-collapse: collapse; margin: 10px 0; }
        td { padding: 5px; border: 1px solid #ddd; text-align: center; }
        input { width: 60px; text-align: center; }
        button { padding: 8px 15px; background: #4CAF50; color: white; border: none; cursor: pointer; }
        button:hover { background: #45a049; }
    </style>
</head>
<body>
    <h1>Inversa -A</h1>
    
    <form method="post" id="matrixForm">
        <label for="dimension">Dimensión de la matriz cuadrada (n):</label>
        <input type="number" id="dimension" name="dimension" min="1" max="10" value="3" required>
        <button type="button" onclick="generarMatriz()">Generar Matriz</button>
        <div id="matrixInputs"></div>
        <button type="submit">Calcular Inversa</button>
    </form>

    <script>
        function generarMatriz() {
            const n = parseInt(document.getElementById('dimension').value);
            let html = '<table>';
            
            for (let i = 0; i < n; i++) {
                html += '<tr>';
                for (let j = 0; j < n; j++) {
                    html += `<td><input type="number" step="0.01" name="matriz_${i}_${j}" value="${i === j ? 1 : 0}" required></td>`;
                }
                html += '</tr>';
            }
            html += '</table>';
            
            document.getElementById('matrixInputs').innerHTML = html;
        }
        
        // Generar matriz inicial al cargar la página
        window.onload = generarMatriz;
    </script>
</body>
</html>