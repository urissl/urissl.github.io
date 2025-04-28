<html>
<body>


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
<a href="../"><img src="../sistem.png" height="10%" width="20%"></a> </br>
<font face="Calibri" size="4">Suma</font>
</center>
<font face="Calibri" size="7">

<form action="Suma_Matricial/Suma.php" method="post" autocomplete="off">
  <fieldset>
    <legend><B>Suma de Matrices</B></legend>
    <table>
      <tr>
        <td><p>Numero de filas de A y B</p></td>
        <td><p><input name="Matriz[filas]" required="required" /></p></td>
      </tr>
      <tr>
        <td><p>Numero de columnas de A y B</p></td>
        <td><p><input name="Matriz[columnas]" required="required"/></p></td><td><i> A y B deben tener las mismas dimensiones</i></td>
      </tr>
      <tr>
        <td>
          <p><input type="submit" value=" Generar matrices" required="required"></p>
        </td>
      </tr>
    </table>
    </fieldset>

</form>

</font>
<center>
<button onclick="window.location.href='../Eliminacion/'" id="Button" > GaussJordan</button>
<button onclick="window.location.href='../Determinante/'" id="Button" > Determinante</button>
</center>
</body>

</html>