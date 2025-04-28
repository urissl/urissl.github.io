

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
<a href="../"><img src="../titulo.png" height="10%" width="20%"></a> </br>
</center>
<font face="Calibri" size="7">
<B>Determinante de una Matriz</B> 
<?php
//error_reporting(0);
    $FilasCols = $_POST['FilasCols'];
    $A=($_POST['A']);
   

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
<tr><td>Matriz</td></tr>
<tr>
<td>';
recorrermatriz($A);
echo '</td>';


echo '</tr></table>';

function det3x3($A){
        $det=0;
        $det= $A[0][0]*($A[1][1]*$A[2][2] - $A[1][2]*$A[2][1]) 
            - $A[0][1]*($A[1][0]*$A[2][2] - $A[1][2]*$A[2][0])
            + $A[0][2]*($A[1][0]*$A[2][1] - $A[1][1]*$A[2][0]);

              return $det;
        }

function det4x4($A){
        $B=array(array($A[1][1],$A[1][2],$A[1][3]),array($A[2][1],$A[2][2],$A[2][3]),array($A[3][1],$A[3][2],$A[3][3]));
        $C=array(array($A[1][0],$A[1][2],$A[1][3]),array($A[2][0],$A[2][2],$A[2][3]),array($A[3][0],$A[3][2],$A[3][3]));
        $D=array(array($A[1][0],$A[1][1],$A[1][3]),array($A[2][0],$A[2][1],$A[2][3]),array($A[3][0],$A[3][1],$A[3][3]));
        $E=array(array($A[1][0],$A[1][1],$A[1][2]),array($A[2][0],$A[2][1],$A[2][2]),array($A[3][0],$A[3][1],$A[3][2]));

        $det=0;
        $det= $A[0][0]*det3x3($B)
            - $A[0][1]*det3x3($C)
            + $A[0][2]*det3x3($D)
            - $A[0][3]*det3x3($E);

             return $det;
        }

function det5x5($A){
        $B=array(array($A[1][1],$A[1][2],$A[1][3],$A[1][4]),array($A[2][1],$A[2][2],$A[2][3],$A[2][4]),array($A[3][1],$A[3][2],$A[3][3],$A[3][4]),array($A[4][1],$A[4][2],$A[4][3],$A[4][4]));
        $C=array(array($A[1][0],$A[1][2],$A[1][3],$A[1][4]),array($A[2][0],$A[2][2],$A[2][3],$A[2][4]),array($A[3][0],$A[3][2],$A[3][3],$A[3][4]),array($A[4][0],$A[4][2],$A[4][3],$A[4][4]));
        $D=array(array($A[1][0],$A[1][1],$A[1][3],$A[1][4]),array($A[2][0],$A[2][1],$A[2][3],$A[2][4]),array($A[3][0],$A[3][1],$A[3][3],$A[3][4]),array($A[4][0],$A[4][1],$A[4][3],$A[4][4]));
        $E=array(array($A[1][0],$A[1][1],$A[1][2],$A[1][4]),array($A[2][0],$A[2][1],$A[2][2],$A[2][4]),array($A[3][0],$A[3][1],$A[3][2],$A[3][4]),array($A[4][0],$A[4][1],$A[4][2],$A[4][4]));
        $F=array(array($A[1][0],$A[1][1],$A[1][2],$A[1][3]),array($A[2][0],$A[2][1],$A[2][2],$A[2][3]),array($A[3][0],$A[3][1],$A[3][2],$A[3][3]),array($A[4][0],$A[4][1],$A[4][2],$A[4][3]));

        $det=0;
        $det= $A[0][0]*det4x4($B)
            - $A[0][1]*det4x4($C)
            + $A[0][2]*det4x4($D)
            - $A[0][3]*det4x4($E)
            + $A[0][4]*det4x4($F);
             return $det;
        }
function det6x6($A){
        $B=array(array($A[1][1],$A[1][2],$A[1][3],$A[1][4],$A[1][5]),array($A[2][1],$A[2][2],$A[2][3],$A[2][4],$A[2][5]),array($A[3][1],$A[3][2],$A[3][3],$A[3][4],$A[3][5]),array($A[4][1],$A[4][2],$A[4][3],$A[4][4],$A[4][5]),array($A[5][1],$A[5][2],$A[5][3],$A[5][4],$A[5][5]));
        $C=array(array($A[1][0],$A[1][2],$A[1][3],$A[1][4],$A[1][5]),array($A[2][0],$A[2][2],$A[2][3],$A[2][4],$A[2][5]),array($A[3][0],$A[3][2],$A[3][3],$A[3][4],$A[3][5]),array($A[4][0],$A[4][2],$A[4][3],$A[4][4],$A[4][5]),array($A[5][0],$A[5][2],$A[5][3],$A[5][4],$A[5][5]));
        $D=array(array($A[1][0],$A[1][1],$A[1][3],$A[1][4],$A[1][5]),array($A[2][0],$A[2][1],$A[2][3],$A[2][4],$A[2][5]),array($A[3][0],$A[3][1],$A[3][3],$A[3][4],$A[3][5]),array($A[4][0],$A[4][1],$A[4][3],$A[4][4],$A[4][5]),array($A[5][0],$A[5][1],$A[5][3],$A[5][4],$A[5][5]));
        $E=array(array($A[1][0],$A[1][1],$A[1][2],$A[1][4],$A[1][5]),array($A[2][0],$A[2][1],$A[2][2],$A[2][4],$A[2][5]),array($A[3][0],$A[3][1],$A[3][2],$A[3][4],$A[3][5]),array($A[4][0],$A[4][1],$A[4][2],$A[4][4],$A[4][5]),array($A[5][0],$A[5][1],$A[5][2],$A[5][4],$A[5][5]));
        $F=array(array($A[1][0],$A[1][1],$A[1][2],$A[1][3],$A[1][5]),array($A[2][0],$A[2][1],$A[2][2],$A[2][3],$A[2][5]),array($A[3][0],$A[3][1],$A[3][2],$A[3][3],$A[3][5]),array($A[4][0],$A[4][1],$A[4][2],$A[4][3],$A[4][5]),array($A[5][0],$A[5][1],$A[5][2],$A[5][3],$A[5][5]));
        $G=array(array($A[1][0],$A[1][1],$A[1][2],$A[1][3],$A[1][4]),array($A[2][0],$A[2][1],$A[2][2],$A[2][3],$A[2][4]),array($A[3][0],$A[3][1],$A[3][2],$A[3][3],$A[3][4]),array($A[4][0],$A[4][1],$A[4][2],$A[4][3],$A[4][4]),array($A[5][0],$A[5][1],$A[5][2],$A[5][3],$A[5][4]));

        $det=0;
        $det= $A[0][0]*det5x5($B)
            - $A[0][1]*det5x5($C)
            + $A[0][2]*det5x5($D)
            - $A[0][3]*det5x5($E)
            + $A[0][4]*det5x5($F)
            - $A[0][5]*det5x5($G);

             return $det;
        }
function det7x7($A){
        $B=array(array($A[1][1],$A[1][2],$A[1][3],$A[1][4],$A[1][5],$A[1][6]),array($A[2][1],$A[2][2],$A[2][3],$A[2][4],$A[2][5],$A[2][6]),array($A[3][1],$A[3][2],$A[3][3],$A[3][4],$A[3][5],$A[3][6]),array($A[4][1],$A[4][2],$A[4][3],$A[4][4],$A[4][5],$A[4][6]),array($A[5][1],$A[5][2],$A[5][3],$A[5][4],$A[5][5],$A[5][6]),array($A[6][1],$A[6][2],$A[6][3],$A[6][4],$A[6][5],$A[6][6]));
        $C=array(array($A[1][0],$A[1][2],$A[1][3],$A[1][4],$A[1][5],$A[1][6]),array($A[2][0],$A[2][2],$A[2][3],$A[2][4],$A[2][5],$A[2][6]),array($A[3][0],$A[3][2],$A[3][3],$A[3][4],$A[3][5],$A[3][6]),array($A[4][0],$A[4][2],$A[4][3],$A[4][4],$A[4][5],$A[4][6]),array($A[5][0],$A[5][2],$A[5][3],$A[5][4],$A[5][5],$A[5][6]),array($A[6][0],$A[6][2],$A[6][3],$A[6][4],$A[6][5],$A[6][6]));
        $D=array(array($A[1][0],$A[1][1],$A[1][3],$A[1][4],$A[1][5],$A[1][6]),array($A[2][0],$A[2][1],$A[2][3],$A[2][4],$A[2][5],$A[2][6]),array($A[3][0],$A[3][1],$A[3][3],$A[3][4],$A[3][5],$A[3][6]),array($A[4][0],$A[4][1],$A[4][3],$A[4][4],$A[4][5],$A[4][6]),array($A[5][0],$A[5][1],$A[5][3],$A[5][4],$A[5][5],$A[5][6]),array($A[6][0],$A[6][1],$A[6][3],$A[6][4],$A[6][5],$A[6][6]));
        $E=array(array($A[1][0],$A[1][1],$A[1][2],$A[1][4],$A[1][5],$A[1][6]),array($A[2][0],$A[2][1],$A[2][2],$A[2][4],$A[2][5],$A[2][6]),array($A[3][0],$A[3][1],$A[3][2],$A[3][4],$A[3][5],$A[3][6]),array($A[4][0],$A[4][1],$A[4][2],$A[4][4],$A[4][5],$A[4][6]),array($A[5][0],$A[5][1],$A[5][2],$A[5][4],$A[5][5],$A[5][6]),array($A[6][0],$A[6][1],$A[6][2],$A[6][4],$A[6][5],$A[6][6]));
        $F=array(array($A[1][0],$A[1][1],$A[1][2],$A[1][3],$A[1][5],$A[1][6]),array($A[2][0],$A[2][1],$A[2][2],$A[2][3],$A[2][5],$A[2][6]),array($A[3][0],$A[3][1],$A[3][2],$A[3][3],$A[3][5],$A[3][6]),array($A[4][0],$A[4][1],$A[4][2],$A[4][3],$A[4][5],$A[4][6]),array($A[5][0],$A[5][1],$A[5][2],$A[5][3],$A[5][5],$A[5][6]),array($A[6][0],$A[6][6],$A[6][2],$A[6][3],$A[6][5],$A[6][6]));
        $G=array(array($A[1][0],$A[1][1],$A[1][2],$A[1][3],$A[1][4],$A[1][6]),array($A[2][0],$A[2][1],$A[2][2],$A[2][3],$A[2][4],$A[2][6]),array($A[3][0],$A[3][1],$A[3][2],$A[3][3],$A[3][4],$A[3][6]),array($A[4][0],$A[4][1],$A[4][2],$A[4][3],$A[4][4],$A[4][6]),array($A[5][0],$A[5][1],$A[5][2],$A[5][3],$A[5][4],$A[5][6]),array($A[6][0],$A[6][1],$A[6][2],$A[6][3],$A[6][4],$A[6][6]));
        $H=array(array($A[1][0],$A[1][1],$A[1][2],$A[1][3],$A[1][4],$A[1][5]),array($A[2][0],$A[2][1],$A[2][2],$A[2][3],$A[2][4],$A[2][5]),array($A[3][0],$A[3][1],$A[3][2],$A[3][3],$A[3][4],$A[3][5]),array($A[4][0],$A[4][1],$A[4][2],$A[4][3],$A[4][4],$A[4][5]),array($A[5][0],$A[5][1],$A[5][2],$A[5][3],$A[5][4],$A[5][5]),array($A[6][0],$A[6][1],$A[6][2],$A[6][3],$A[6][4],$A[6][5]));

        $det=0;
        $det= $A[0][0]*det6x6($B)
            - $A[0][1]*det6x6($C)
            + $A[0][2]*det6x6($D)
            - $A[0][3]*det6x6($E)
            + $A[0][4]*det6x6($F)
            - $A[0][5]*det6x6($G)
            + $A[0][6]*det6x6($H);
             return $det;
        }

echo '<table border="0"><tr><td>Determinante de la Matriz</td></tr>
 <tr><td><table border="1">';
    
    if ($FilasCols == 2)
    {
        $det=0;
        $det= $A[0][0]*$A[1][1] - $A[0][1]*$A[1][0];
        echo "<tr><td>";
        echo   $det  ;
        echo "</td></tr>";
        echo '</td></tr></table></table>';

    }
    elseif($FilasCols == 3)
    { 
        
        echo "<tr><td>";
        echo  det3x3($A);
        echo "</td></tr>";
        echo '</td></tr></table></table>';

    }
    elseif($FilasCols == 4)
    {     
    
        echo "<tr><td>";
        echo  det4x4($A);
        echo "</td></tr>";
        echo '</td></tr></table></table>';
    }
    elseif($FilasCols == 5)
    {     
    
        echo "<tr><td>";
        echo  det5x5($A);
        echo "</td></tr>";
        echo '</td></tr></table></table>';
    }
    elseif($FilasCols == 6)
    {     
    
        echo "<tr><td>";
        echo  det6x6($A);
        echo "</td></tr>";
        echo '</td></tr></table></table>';
    }
    elseif($FilasCols == 7)
    {     
    
        echo "<tr><td>";
        echo  det7x7($A);
        echo "</td></tr>";
        echo '</td></tr></table></table>';
    }
    elseif($FilasCols == 8)
    {     
    
        echo "<tr><td>";
        echo  det8x8($A);
        echo "</td></tr>";
        echo '</td></tr></table></table>';
    }
    elseif($FilasCols == 9)
    {     
    
        echo "<tr><td>";
        echo  det9x9($A);
        echo "</td></tr>";
        echo '</td></tr></table></table>';
    }
    elseif($FilasCols >= 10)
    {     
    
        echo "<tr><td>";
        echo  "<i>seguimos trabajando en actualización 2.0 beta</i>";
        echo "</td></tr>";
        echo '</td></tr></table></table>';
    }

?>
</font>
<center>
<button onclick="window.location.href='../Eliminacion/'" id="Button" > GaussJordan</button>
<button onclick="window.location.href='../Suma/'" id="Button" > Suma</button>

</center>