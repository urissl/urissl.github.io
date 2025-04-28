<?php
//error_reporting(0);
$FilasCols = $_POST['FilasCols'];
$A = $_POST['A'];

function recorrermatriz($matriz) {
    echo '<table border="1" style="display:inline-block; margin:10px;">';
    foreach($matriz as $primer) {
        echo "<tr>";
        foreach($primer as $segundo) {
            echo "<td style='padding:8px;'>" . $segundo . "</td>";
        }
        echo "</tr>";
    }
    echo '</table>'; 
}

// Función para calcular el determinante usando eliminación Gaussiana
function calcularDeterminante($matriz, $n) {
    $det = 1;
    $operations = [];
    $step = 1;  // Variable para llevar el seguimiento de las operaciones
    
    for ($i = 0; $i < $n; $i++) {
        // Pivoteo parcial si el elemento diagonal es cero
        if ($matriz[$i][$i] == 0) {
            for ($j = $i + 1; $j < $n; $j++) {
                if ($matriz[$j][$i] != 0) {
                    // Intercambiar filas
                    $temp = $matriz[$i];
                    $matriz[$i] = $matriz[$j];
                    $matriz[$j] = $temp;
                    $det *= -1;
                    $operations[] = "Paso $step: Intercambio de fila ".($i+1)." con fila ".($j+1);
                    $step++;
                    break;
                }
            }
        }
        
        // Si después del pivoteo sigue siendo cero, determinante es cero
        if ($matriz[$i][$i] == 0) {
            $operations[] = "La matriz es singular, el determinante es 0.";
            return [0, $operations, $matriz];
        }
        
        // Hacer 1 el elemento diagonal (no necesario para determinante, pero útil para visualización)
        $divisor = $matriz[$i][$i];
        if ($divisor != 1) {
            $det *= $divisor;
            for ($k = $i; $k < $n; $k++) {
                $matriz[$i][$k] /= $divisor;
            }
            $operations[] = "Paso $step: Dividir fila ".($i+1)." por $divisor";
            $step++;
        }
        
        // Eliminación hacia abajo
        for ($j = $i + 1; $j < $n; $j++) {
            $factor = $matriz[$j][$i];
            for ($k = $i; $k < $n; $k++) {
                $matriz[$j][$k] -= $matriz[$i][$k] * $factor;
            }
            $operations[] = "Paso $step: Restar ".$factor." veces fila ".($i+1)." de fila ".($j+1);
            $step++;
        }
    }
    
    // El determinante es el producto de los elementos diagonales
    $resultado = $det;
    for ($i = 0; $i < $n; $i++) {
        $resultado *= $matriz[$i][$i];
    }
    
    return [$resultado, $operations, $matriz];
}

// Crear una matriz 2x2 con determinante 2
$A = [
    [2, 1],
    [1, 1]
];

$FilasCols = 2; // Definimos que la matriz es 2x2

// Mostrar la matriz original
echo '<div style="text-align:center; margin:20px;">';
echo '<h2 style="color:#2e8b57;">Matriz Ingresada</h2>';
recorrermatriz($A);
echo '</div>';

// Calcular y mostrar el determinante
echo '<div style="text-align:center; margin:20px;">';
echo '<h2 style="color:#2e8b57;">Proceso de Cálculo</h2>';

list($det, $operations, $lastMatrix) = calcularDeterminante($A, $FilasCols);

// Mostrar procedimiento
echo '<button onclick="toggleProcedure()" style="margin: 10px; padding: 10px; background-color: #2e8b57; color: white; border: none; border-radius: 5px;">Mostrar Procedimiento</button>';

echo '<div id="procedure" style="display:none; background-color:#f8f9fa; padding:15px; border-radius:5px; margin-top:20px;">';
echo '<h3 style="color:#2e8b57;">Procedimiento</h3>';
echo '<ul>';
foreach ($operations as $operation) {
    echo "<li>$operation</li>";
}
echo '</ul>';
echo '</div>';

echo '<div style="background-color:#f8f9fa; padding:15px; border-radius:5px; margin-top:20px;">';
echo '<h3 style="color:#2e8b57;">Resultado Final</h3>';
echo '<p style="font-size:1.2em;">El determinante de la matriz es: <strong>'.number_format($det, 4).'</strong></p>';
echo '</div>';

if ($det == 0) {
    // Si el determinante es 0, mostrar la última matriz obtenida antes de concluir el proceso
    echo '<div style="text-align:center; margin-top: 20px;">';
    echo '<h3 style="color:#d9534f;">Última Matriz antes de concluir</h3>';
    recorrermatriz($lastMatrix);
    echo '</div>';
}

echo '</div>';

?>

<script>
    function toggleProcedure() {
        var procedure = document.getElementById("procedure");
        if (procedure.style.display === "none") {
            procedure.style.display = "block";
        } else {
            procedure.style.display = "none";
        }
    }
</script>

