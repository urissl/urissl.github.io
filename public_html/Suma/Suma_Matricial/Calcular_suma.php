
<style type="text/css">
     body {
            font-family: Arial, sans-serif;
            background-color:rgba(142, 207, 45, 0.73);
            margin: 0;
            padding: 0;
        }
  #Button {
    width: 8em;  height: 2em;
    font-size: 20;
}

 
  .button-container {
      display: flex;
      gap: 20px;
      justify-content: center;
      padding: 20px;
      flex-wrap: wrap;
  }
  
 
  #Button {
      background-color: #77dd77;  
      color: #2c3e50;           
      border: none;
      padding: 15px 30px;
      border-radius: 10px;
      font-size: 18px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      text-transform: uppercase;
      letter-spacing: 1px;
      min-width: 200px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
  }
  
  /* Efecto hover */
  #Button:hover {
      background-color: #68c968;  /* Verde un poco más oscuro */
      transform: translateY(-3px);
      box-shadow: 0 6px 12px rgba(0,0,0,0.15);
  }
  
 
  #Button:active {
      background-color: #5abf5a;  /* Verde más oscuro */
      transform: translateY(1px);
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
  }
  

  #Button:focus {
      outline: none;
      box-shadow: 0 0 0 3px rgba(119, 221, 119, 0.5);
  }

</style>

<center>
<a href="../../"><img src="../../sistema.png" height="10%" width="20%"></a> </br>
</center>
<font face="Calibri" size="7">
<B>Suma de Matrices</B>
<?php
error_reporting(0);
    $A=($_POST['A']);
    $B=($_POST['B']);
    $filas=($_POST['filas']);
    $columnas=($_POST['columnas']);
    

function recorrermatriz($matriz){
echo '<table border="1" style="display:inline-block">';

 foreach($matriz as $primer)
    {
    echo "<tr>";
    foreach($primer as $segundo)
        {
        echo "<td>" . $segundo . "</td>";
        }
    echo "</tr>";
    }
echo '</table>'; 
}
echo '<table border="0" style="text-align:center;">
<tr><td>Matriz A</td> <td></td> <td>Matriz B</td></tr>
<tr>
<td>';
recorrermatriz($A);
echo '</td><td> ';
echo '<img src="mas.png"> </td><td>';
recorrermatriz($B);
echo '</td></tr></table>';
echo '<table border="0"><tr><td>Matriz A+B</td></tr>
 <tr><td><table border="1">';
echo "<tr>";    
for($i = 0; $i < $filas; $i++) {
    for($j = 0; $j < $columnas; $j++) {
       $AB = array();
       $AB[$i][$j]= $A[$i][$j]+$B[$i][$j]; 
     echo "<td>"  .$AB[$i][$j].  "</td>";  
    }     
echo "</tr>";
}
echo '</td></tr></table></table>';



/**
*	private function mostrarMatriz(){
*		echo '<table border="1">';
*		for($i = 1; $i <= $filas; $i++ ){
*			echo '<tr>';
*			for($j = 1; $j <= $columnas; $j++ ){
*				echo '<td>';
*				echo '<p>'.round($matriz[$i][$j], 2).'</p>';
*				echo '</td>';
*			}
*			echo '</tr>';
*
*		}
*		echo '</table>';
*		echo '<style>table{margin-bottom:10px;} table tr td {width:20px;}</style>';
*	}
**/


?>
</font>
<center>
<button onclick="window.location.href='../../Suma/'" id="Button" > Suma</button>
<button onclick="window.location.href='../../Determinante/'" id="Button" > Determinante</button>
</center>