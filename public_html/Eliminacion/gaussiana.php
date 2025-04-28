<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Resolución de Ecuaciones por Gauss-Jordan</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    :root {
      --verde-oscuro: #004d40;
      --verde-claro: #a5d6a7;
      --fondo-negro: #000000;
      --blanco: #ffffff;
      --rojo: #f44336;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: var(--fondo-negro);
      color: var(--blanco);
      padding: 20px;
    }

    .container {
      max-width: 850px;
      margin: 0 auto;
      background: var(--verde-oscuro);
      padding: 30px;
      border-radius: 16px;
      box-shadow: 0 0 20px rgba(0,0,0,0.7);
    }

    h1 {
      text-align: center;
      color: var(--verde-claro);
      margin-bottom: 30px;
    }

    label {
      display: block;
      margin-bottom: 10px;
      font-weight: bold;
      font-size: 1.1em;
      color: var(--verde-claro);
    }

    textarea {
      width: 100%;
      padding: 15px;
      font-size: 1em;
      border: 2px solid var(--verde-claro);
      border-radius: 10px;
      background-color: #111;
      color: var(--verde-claro);
      resize: vertical;
      margin-bottom: 20px;
    }

    .boton, input[type="submit"] {
      display: inline-block;
      background-color: var(--verde-claro);
      color: var(--fondo-negro);
      border: none;
      padding: 12px 24px;
      margin: 10px 0;
      border-radius: 10px;
      font-weight: bold;
      font-size: 1em;
      cursor: pointer;
      text-decoration: none;
      transition: transform 0.3s ease, background-color 0.3s ease;
      text-align: center;
    }

    .boton:hover, input[type="submit"]:hover {
      background-color: #81c784;
      transform: scale(1.05);
    }

    .error, .inconsistente, .infinitas {
      background: #1e1e1e;
      border-left: 5px solid var(--rojo);
      color: var(--rojo);
      padding: 15px;
      margin-bottom: 20px;
      border-radius: 10px;
      font-weight: bold;
    }

    .procedimiento {
      background: #1b1b1b;
      margin-top: 20px;
      padding: 20px;
      border-radius: 12px;
      transition: max-height 0.7s ease, opacity 0.7s ease;
      overflow: hidden;
    }

    .procedimiento.oculto {
      max-height: 0;
      opacity: 0;
      padding: 0;
      margin: 0;
      overflow: hidden;
    }

    .paso {
      margin-bottom: 20px;
    }

    .paso h3 {
      color: var(--verde-claro);
      margin-bottom: 10px;
    }

    .matriz table {
      width: 100%;
      border-collapse: collapse;
    }

    .matriz th, .matriz td {
      border: 1px solid #555;
      padding: 8px;
      text-align: center;
      color: var(--verde-claro);
    }

    .matriz th {
      background-color: #2e2e2e;
    }

    .solucion {
      background: #1b1b1b;
      padding: 20px;
      margin-top: 20px;
      border-radius: 12px;
    }

    .solucion h2 {
      color: var(--verde-claro);
    }

    .botones {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      justify-content: center;
      margin-top: 20px;
    }

    @media (max-width: 600px) {
      .botones {
        flex-direction: column;
      }
    }
  </style>
</head>

<body>
<div class="container">
  <h1>Método de Gauss-Jordan</h1>
  <form method="POST">
    <label>Ingrese las ecuaciones (una por línea):</label>
    <textarea name="equations" rows="5" placeholder="Ejemplo:
2x+3y-z=5
x-y+2z=3
3x+2y+z=10"><?php if (!empty($_POST['equations'])) echo htmlspecialchars($_POST['equations']); ?></textarea>
    
    <div class="botones">
      <input type="submit" value="Resolver">
      <a href="javascript:history.back()" class="boton">Regresar</a>
    </div>
  </form>

<?php
// ---- PHP CLASE Y LÓGICA ----
class GaussJordan {
    private $matriz = [], $pasos = [], $soluciones = [], $esSolucionUnica = true, $n;

    public function __construct($matriz, $n) { $this->matriz = $matriz; $this->n = $n; }

    public function resolver() {
        $this->pasos[] = ["Matriz inicial", $this->matriz];
        $filas = $this->n; $columnas = $this->n + 1;
        for ($pivote = 0; $pivote < min($filas, $columnas - 1); $pivote++) {
            $maxFila = $pivote;
            for ($i = $pivote + 1; $i < $filas; $i++) {
                if (abs($this->matriz[$i][$pivote]) > abs($this->matriz[$maxFila][$pivote])) $maxFila = $i;
            }
            if ($maxFila != $pivote) $this->intercambiarFilas($pivote, $maxFila);
            if (abs($this->matriz[$pivote][$pivote]) < 1e-10) { $this->esSolucionUnica = false; continue; }
            $this->dividirFila($pivote, $this->matriz[$pivote][$pivote]);
            for ($i = 0; $i < $filas; $i++) {
                if ($i != $pivote) $this->combinarFilas($i, $pivote, -$this->matriz[$i][$pivote]);
            }
        }
        $this->determinarSoluciones();
    }

    private function intercambiarFilas($f1, $f2) { [$this->matriz[$f1], $this->matriz[$f2]] = [$this->matriz[$f2], $this->matriz[$f1]]; $this->pasos[] = ["Intercambiar fila ".($f1+1)." con fila ".($f2+1), $this->matriz]; }
    private function dividirFila($fila, $divisor) { foreach ($this->matriz[$fila] as $j => $val) { $this->matriz[$fila][$j] /= $divisor; } $this->pasos[] = ["Dividir fila ".($fila+1)." por ".round($divisor,4), $this->matriz]; }
    private function combinarFilas($destino, $fuente, $factor) { foreach ($this->matriz[$destino] as $j => $val) { $this->matriz[$destino][$j] += $factor * $this->matriz[$fuente][$j]; } $this->pasos[] = ["Sumar ".round($factor,4)."×fila ".($fuente+1)." a fila ".($destino+1), $this->matriz]; }

    private function determinarSoluciones() {
        $filas = $this->n; $cols = $this->n + 1;
        for ($i = 0; $i < $filas; $i++) {
            $todosCeros = true;
            for ($j = 0; $j < $cols - 1; $j++) if (abs($this->matriz[$i][$j]) > 1e-10) { $todosCeros = false; break; }
            if ($todosCeros && abs($this->matriz[$i][$cols-1]) > 1e-10) { $this->esSolucionUnica = false; $this->soluciones = []; return; }
        }
        for ($i = 0; $i < $cols - 1; $i++) {
            if ($i < $filas && abs($this->matriz[$i][$i]-1) < 1e-10) $this->soluciones["x".($i+1)] = $this->matriz[$i][$cols-1];
            else { $this->soluciones["x".($i+1)] = "Libre"; $this->esSolucionUnica = false; }
        }
    }

    public function mostrarProcedimiento() {
        echo '<div id="procedimiento" class="procedimiento">';
        foreach ($this->pasos as $i => $paso) {
            echo "<div class='paso'><h3>Paso ".($i+1).": ".$paso[0]."</h3>"; $this->mostrarMatriz($paso[1]); echo '</div>';
        }
        echo '</div>';
    }

    public function mostrarSolucion() {
        echo '<div class="solucion"><h2>Solución</h2>';
        if (empty($this->soluciones)) echo '<p class="inconsistente">No hay solución (sistema inconsistente).</p>';
        elseif (!$this->esSolucionUnica) echo '<p class="infinitas">Infinitas soluciones.</p>';
        foreach ($this->soluciones as $var => $valor) {
            echo "<p>".$var." = ".($valor === "Libre" ? "Variable libre" : $this->decimalAfraccion($valor))."</p>";
        }
        echo '</div>';
    }

    private function mostrarMatriz($matriz) {
        echo '<div class="matriz"><table><tr><th></th>';
        for ($j = 1; $j <= $this->n; $j++) echo "<th>x$j</th>";
        echo "<th>TI</th></tr>";
        foreach ($matriz as $i => $fila) {
            echo "<tr><th>Ecuación ".($i+1)."</th>";
            foreach ($fila as $val) echo "<td>".round($val,4)."</td>";
            echo "</tr>";
        }
        echo '</table></div>';
    }

    private function decimalAfraccion($n, $t=1e-6) {
        if ($n==0) return "0";
        $h1=1; $h2=0; $k1=0; $k2=1; $b=$n;
        do {
            $a=floor($b); [$h1,$h2]=[$a*$h1+$h2,$h1]; [$k1,$k2]=[$a*$k1+$k2,$k1];
            if (abs($b-$a) < 1e-12) break;
            $b = 1/($b-$a);
        } while (abs($n-$h1/$k1) > $n*$t);
        return $k1==1 ? "$h1" : "$h1/$k1";
    }
}

// Procesar si enviaron datos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = $_POST['equations'] ?? '';
    $lines = explode("\n", trim($input));
    $matriz = [];
    $vars = ['x','y','z'];

    foreach ($lines as $line) {
        $line = strtolower(str_replace(' ','',trim($line)));
        if (!preg_match('/^[0-9xyz\+\-\=\.]+$/',$line) || substr_count($line,'=')!=1) { echo '<div class="error">Error: formato incorrecto.</div>'; exit; }
        [$lhs,$rhs] = explode('=',$line);
        $coefs = array_fill_keys($vars,0);
        preg_match_all('/([+-]?\d*\.?\d*)([xyz])/', $lhs, $matches, PREG_SET_ORDER);
        foreach ($matches as $m) { $num = $m[1]==='' || $m[1]==='+' ? 1 : ($m[1]==='-' ? -1 : $m[1]); $coefs[$m[2]] += floatval($num); }
        $matriz[] = [$coefs['x'],$coefs['y'],$coefs['z'],floatval($rhs)];
    }

    if (count($matriz)!=3) { echo '<div class="error">Error: Ingresar exactamente 3 ecuaciones.</div>'; exit; }

    $gauss = new GaussJordan($matriz,3);
    $gauss->resolver();
    echo '<button id="btnProcedimiento" class="boton">Ver procedimiento</button>';
    $gauss->mostrarProcedimiento();
    $gauss->mostrarSolucion();
}
?>
</div>

<script>
const btn = document.getElementById('btnProcedimiento');
const procedimiento = document.getElementById('procedimiento');
if (btn && procedimiento) {
  btn.addEventListener('click', () => {
    procedimiento.classList.toggle('oculto');
    btn.textContent = procedimiento.classList.contains('oculto') ? 'Ver procedimiento' : 'Ocultar procedimiento';
  });
}
</script>
</body>
</html>

