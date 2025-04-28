<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resolución de Ecuaciones por Gauss-Jordan</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; padding: 20px; }
        .container { max-width: 800px; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h1 { text-align: center; }
        textarea { width: 100%; padding: 10px; margin: 10px 0; font-size: 1em; }
        input[type="submit"] { padding: 10px 20px; font-size: 1em; background: #007BFF; color: white; border: none; border-radius: 5px; cursor: pointer; }
        .matriz table { border-collapse: collapse; margin: 10px 0; }
        .matriz th, .matriz td { border: 1px solid #ccc; padding: 5px 10px; text-align: center; }
        .paso, .solucion { background: #eef; margin: 10px 0; padding: 10px; border-radius: 6px; }
        .error, .inconsistente, .infinitas { color: red; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Método de Gauss-Jordan</h1>
        <form method="POST">
            <label>Ingrese las ecuaciones (una por línea):</label><br>
            <textarea name="equations" rows="5" placeholder="Ejemplo:
2x+3y-z=5
x-y+2z=3
3x+2y+z=10"></textarea><br>
            <input type="submit" value="Resolver">
        </form>

<?php
class gaussiana {
    private $matriz = [], $pasos = [], $soluciones = [], $esSolucionUnica = true, $n;

    public function __construct($matriz, $n) {
        $this->matriz = $matriz;
        $this->n = $n;
    }

    public function resolver() {
        $this->pasos[] = ["Matriz inicial", $this->matriz];
        $filas = $this->n;
        $columnas = $this->n + 1;

        for ($pivote = 0; $pivote < min($filas, $columnas - 1); $pivote++) {
            $maxFila = $pivote;
            for ($i = $pivote + 1; $i < $filas; $i++) {
                if (abs($this->matriz[$i][$pivote]) > abs($this->matriz[$maxFila][$pivote])) {
                    $maxFila = $i;
                }
            }
            if ($maxFila != $pivote) {
                $this->intercambiarFilas($pivote, $maxFila);
            }
            if (abs($this->matriz[$pivote][$pivote]) < 1e-10) {
                $this->esSolucionUnica = false;
                continue;
            }

            $this->dividirFila($pivote, $this->matriz[$pivote][$pivote]);
            for ($i = $pivote + 1; $i < $filas; $i++) {
                $this->combinarFilas($i, $pivote, -$this->matriz[$i][$pivote]);
            }
        }

        for ($pivote = min($filas, $columnas - 1) - 1; $pivote >= 0; $pivote--) {
            if (abs($this->matriz[$pivote][$pivote]) < 1e-10) continue;
            for ($i = $pivote - 1; $i >= 0; $i--) {
                $this->combinarFilas($i, $pivote, -$this->matriz[$i][$pivote]);
            }
        }

        $this->determinarSoluciones();
    }

    private function intercambiarFilas($f1, $f2) {
        [$this->matriz[$f1], $this->matriz[$f2]] = [$this->matriz[$f2], $this->matriz[$f1]];
        $this->pasos[] = ["Intercambiar fila ".($f1+1)." con fila ".($f2+1), $this->matriz];
    }

    private function dividirFila($fila, $divisor) {
        foreach ($this->matriz[$fila] as $j => $val) {
            $this->matriz[$fila][$j] /= $divisor;
        }
        $this->pasos[] = ["Dividir fila ".($fila+1)." por ".round($divisor, 4), $this->matriz];
    }

    private function combinarFilas($destino, $fuente, $factor) {
        foreach ($this->matriz[$destino] as $j => $val) {
            $this->matriz[$destino][$j] += $factor * $this->matriz[$fuente][$j];
        }
        $this->pasos[] = ["Sumar ".round($factor,4)."×fila ".($fuente+1)." a fila ".($destino+1), $this->matriz];
    }

    private function determinarSoluciones() {
        $filas = $this->n; $cols = $this->n + 1;

        for ($i = 0; $i < $filas; $i++) {
            $todosCeros = true;
            for ($j = 0; $j < $cols - 1; $j++) {
                if (abs($this->matriz[$i][$j]) > 1e-10) {
                    $todosCeros = false; break;
                }
            }
            if ($todosCeros && abs($this->matriz[$i][$cols-1]) > 1e-10) {
                $this->esSolucionUnica = false;
                $this->soluciones = [];
                return;
            }
        }

        for ($i = 0; $i < $cols - 1; $i++) {
            if ($i < $filas && abs($this->matriz[$i][$i] - 1) < 1e-10) {
                $this->soluciones["x".($i+1)] = $this->matriz[$i][$cols - 1];
            } else {
                $this->soluciones["x".($i+1)] = "Libre";
                $this->esSolucionUnica = false;
            }
        }
    }

    public function mostrarProcedimiento() {
        echo '<div class="procedimiento"><h2>Procedimiento</h2>';
        foreach ($this->pasos as $i => $paso) {
            echo "<div class='paso'><h3>Paso ".($i+1).": ".$paso[0]."</h3>";
            $this->mostrarMatriz($paso[1]);
            echo '</div>';
        }
        echo '</div>';
    }

    public function mostrarSolucion() {
        echo '<div class="solucion"><h2>Solución</h2>';
        if (empty($this->soluciones)) echo '<p class="inconsistente">No hay solución (sistema inconsistente).</p>';
        elseif (!$this->esSolucionUnica) echo '<p class="infinitas">Infinitas soluciones.</p>';
        foreach ($this->soluciones as $var => $valor) {
            if ($valor === "Libre") echo "<p>$var es variable libre</p>";
            else echo "<p>$var = ".round($valor, 4)." (".$this->decimalAfraccion($valor).")</p>";
        }
        echo '</div>';
    }

    private function mostrarMatriz($matriz) {
        echo '<div class="matriz"><table><tr><th></th>';
        for ($j = 1; $j <= $this->n; $j++) echo "<th>x$j</th>";
        echo "<th>TI</th></tr>";
        foreach ($matriz as $i => $fila) {
            echo "<tr><th>Ecuación ".($i+1)."</th>";
            foreach ($fila as $val) echo "<td>".round($val, 4)."</td>";
            echo "</tr>";
        }
        echo '</table></div>';
    }

    private function decimalAfraccion($n, $t = 1.e-6) {
        if ($n == 0) return "0";
        $h1=1; $h2=0; $k1=0; $k2=1; $b=$n;
        do {
            $a = floor($b);
            [$h1, $h2] = [$a*$h1+$h2, $h1];
            [$k1, $k2] = [$a*$k1+$k2, $k1];
            $b = 1/($b - $a);
        } while (abs($n - $h1/$k1) > $n*$t);
        return $k1==1 ? "$h1" : "$h1/$k1";
    }
}

// Procesar entrada
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = $_POST['equations'];
    $lines = explode("\n", trim($input));
    $matriz = [];
    $vars = ['x', 'y', 'z'];

    foreach ($lines as $line) {
        $line = strtolower(str_replace(' ', '', trim($line)));
        if (!preg_match('/^[0-9xyz\+\-\=\.]+$/', $line)) {
            echo '<p class="error">Error: Solo se permiten números y las variables x, y, z.</p>'; exit;
        }
        if (substr_count($line, '=') != 1) {
            echo '<p class="error">Error: Cada ecuación debe contener un signo "=".</p>'; exit;
        }

        [$lhs, $rhs] = explode('=', $line);
        $coefs = array_fill_keys($vars, 0);
        preg_match_all('/([+-]?\d*\.?\d*)([xyz])/', $lhs, $matches, PREG_SET_ORDER);
        foreach ($matches as $m) {
            $num = $m[1] === '' || $m[1] === '+' ? 1 : ($m[1] === '-' ? -1 : $m[1]);
            $coefs[$m[2]] += floatval($num);
        }
        $fila = [ $coefs['x'], $coefs['y'], $coefs['z'], floatval($rhs) ];
        $matriz[] = $fila;
    }

    if (count($matriz) != 3) {
        echo '<p class="error">Error: Debes ingresar exactamente 3 ecuaciones para x, y y z.</p>'; exit;
    }

    $gauss = new gaussiana($matriz, 3);
    $gauss->resolver();
    $gauss->mostrarProcedimiento();
    $gauss->mostrarSolucion();
}
?>

    </div>
</body>
</html>
