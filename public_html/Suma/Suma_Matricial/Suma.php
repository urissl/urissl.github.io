<?php
$filas = $_POST['Matriz']['filas'];
$columnas = $_POST['Matriz']['columnas'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Suma de Matrices</title>
<style type="text/css">
    body {
        font-family: Arial, sans-serif;
        background-color: rgba(142, 207, 45, 0.73);
        margin: 0;
        padding: 20px;
    }

    #Button, .submit {
        width: 8em; height: 2em;
        font-size: 20px;
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

    #Button:hover, .submit:hover {
        background-color: #68c968;
        transform: translateY(-3px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.15);
    }

    #Button:active, .submit:active {
        background-color: #5abf5a;
        transform: translateY(1px);
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    #Button:focus, .submit:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(119, 221, 119, 0.5);
    }

    .matrix-table input[type="text"] {
        width: 60px;
        height: 40px;
        text-align: center;
        font-size: 18px;
        border-radius: 8px;
        border: 2px solid #5abf5a;
        background-color: #dfffd6;
        margin: 5px;
    }

    .matrix-table {
        margin: 20px auto;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 40px;
        flex-wrap: wrap;
    }

    .matrix-container {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .button-container {
        display: flex;
        gap: 20px;
        justify-content: center;
        padding: 20px;
        flex-wrap: wrap;
    }

    h1 {
        text-align: center;
        font-family: 'Calibri', sans-serif;
        font-size: 48px;
        color: #2c3e50;
        margin-bottom: 20px;
    }

    img {
        margin: 20px auto;
        display: block;
    }
</style>
</head>
<body>

<center>
    <a href="../../">
        <img src="../../sistema.png" height="10%" width="20%">
    </a> 
</center>

<h1><b>Suma de Matrices</b></h1>

<form action="Calcular_suma.php" method="post" autocomplete="off">
    <div class="matrix-table">
        <div class="matrix-container">
            <?php for($i = 0; $i < $filas; $i++ ) { ?>
                <div>
                <?php for($j = 0; $j < $columnas; $j++ ) { ?>
                    <input type="text" name="A[<?php echo $i ?>][<?php echo $j ?>]" required />
                <?php } ?>
                </div>
            <?php } ?>
        </div>

        <img src="mas.png" alt="Suma" style="height:60px; width:auto;">

        <div class="matrix-container">
            <?php for($i = 0; $i < $filas; $i++ ) { ?>
                <div>
                <?php for($j = 0; $j < $columnas; $j++ ) { ?>
                    <input type="text" name="B[<?php echo $i ?>][<?php echo $j ?>]" required />
                <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>

    <div style="text-align:center; margin: 20px;">
        <input type="submit" class="submit" value="Calcular Suma"/>
    </div>

    <input type="hidden" name="filas" id="filas" value="<?php echo $filas ?>"/>
    <input type="hidden" name="columnas" id="columnas" value="<?php echo $columnas ?>"/>
</form>

<div class="button-container">
    <button onclick="window.location.href='../../Eliminacion/'" id="Button">Eliminación</button>
    <button onclick="window.location.href='../../Determinante/'" id="Button">Determinante</button>
</div>

</body>
</html>
