<?php
$filas = $_POST['Matriz']['filas'];
$columnas = $_POST['Matriz']['columnas'];
?>

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
<form action="Calcular_suma.php" method="post" autocomplete="off">
<TABLE>
<TR>
<TD>
	<table>
	<?php for($i = 1; $i <= $filas; $i++ ) { ?>
		<tr>
		<?php for($j = 1; $j <= $columnas; $j++ ) { ?>
		    <td>
			<input type="text" name="A[<?php echo $i-1 ?>][<?php echo $j-1 ?>]" required="required"/>
		    </td>
		<?php } ?>
		</tr>
	<?php } ?>
	</table>
</TD>
<TD>
<img src="mas.png">
</TD>
<TD>
	<table>
	<?php for($i = 1; $i <= $columnas; $i++ ) { ?>
		<tr>
		<?php for($j = 1; $j <= $columnas; $j++ ) { ?>
		    <td>
			<input type="text" name="B[<?php echo $i-1 ?>][<?php echo $j-1 ?>]" required="required"/>
		    </td>
		<?php } ?>
		</tr>
	<?php } ?>

	</table>
</TD>
</TR>
</TABLE>
	<p><input type="submit" class="submit"  value="Calcular Suma"/></p>
	<input type="hidden" name="filas" id="filas" value="<?php echo $filas ?>"/>
	<input type="hidden" name="columnas" id="columnas" value="<?php echo $columnas ?>"/>
</form>
<center>
<button onclick="window.location.href='../../Eliminacion/'" id="Button" > Eliminaci&#243;n</button>
<button onclick="window.location.href='../../Determinante/'" id="Button" > Determinante</button>
</center>