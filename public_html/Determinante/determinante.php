<?php
$FilasCols = $_POST['FilasCols'];

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
  

  #Button:hover {
      background-color: #68c968;  
      transform: translateY(-3px);
      box-shadow: 0 6px 12px rgba(0,0,0,0.15);
  }
  
 
  #Button:active {
      background-color: #5abf5a;  
      transform: translateY(1px);
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
  }
  

  #Button:focus {
      outline: none;
      box-shadow: 0 0 0 3px rgba(119, 221, 119, 0.5);
  }


</style> 

<center>
<a href="../"><img src="../sistema.png" height="10%" width="20%"></a> </br>
</center>
<font face="Calibri" size="7">
<B>Determinante de una Matriz</B> 

<?php if ($FilasCols < 2){ 
	echo "
	<font face='Calibri' size='5'>
	<center><b><i>Solo se puede hallar el determinante de matrices de 2x2 en adelante nxn </i></b></center>
	</font><br/>
	";
	}
	elseif($FilasCols >= 8){
    echo  "
    <font face='Calibri' size='5'>
	<center><b><i>seguimos trabajando</i>
	</b></center>
	</font><br/>";
    }
	else{
	?>
<form action="Calcular_Determinante.php" method="post" autocomplete="off">

	<table>
	<?php for($i = 1; $i <= $FilasCols; $i++ ) { ?>
		<tr>
		<?php for($j = 1; $j <= $FilasCols; $j++ ) { ?>
		    <td>
			<input type="number" name="A[<?php echo $i-1 ?>][<?php echo $j-1 ?>]" required="required"/>
		    </td>
		<?php } ?>
		</tr>
	<?php } ?>
	</table>
	<input type="hidden" name="FilasCols" id="FilasCols" value="<?php echo $FilasCols ?>"/>
	<p><input type="submit" class="submit"  value="Calcular Determinante"/></p>
</form>
<?php } ?>
</font>
<center>
<button onclick="window.location.href='../Eliminacion/'" id="Button" > GaussJordan</button>
<button onclick="window.location.href='../Suma/'" id="Button" > Suma</button>

</center>