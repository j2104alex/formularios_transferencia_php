<!DOCTYPE html>
<!-- Jessica Berrio-Curso PHP 2544645 EV-Uso de formularios para transferencia-->
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cinema</title>
        <link rel="stylesheet" href="./styles.css">
    </head>
    <body>
        <?php
        /*Llamar a la biblioteca de funciones*/
        include 'functions.php';
        /*Seccion de php donde se envia la informacion mediante el metodo POST*/
        if (isset($_POST['tablero'])) {
            $nuevoTablero = realizarTransaccion($_POST['tablero'], $_POST['fila'], $_POST['columna'], $_POST['accion']);
            $tablero = llenarTablero($nuevoTablero);
        } else {
            $tablero = llenarTablero("");
        }
        ?>
        <div class="background">
            <main class="contenedor">
                <article class="tablero">
                    <?php
                    mostrarTablero($tablero);
                    ?>
                </article>
                <article class="formulario">
                    <form action="index.php" method="post">
                        <!-- Se tiene que poner el echo en la misma linea que el textarea para evitar espacios en blanco -->
                        <textarea name="tablero" id="tablero" hidden><?php echo tableroToStr($tablero); ?></textarea>
                        <section class="formulario">
                            <label for="fila">Fila</label>
                            <input type="number" name="fila" id="fila" min="1" max="5" required>
                        </section>
                        <section class="formulario">
                            <label for="columna">Columna</label>
                            <input type="number" name="columna" id="columna" min="1" max="5" required>
                        </section>
                        <section class="formulario">
                            <label for="accion">Seleccione</label>
                            <select name="accion" id="accion" class="accion">
                                <option value="reservar">Reservar</option>
                                <option value="liberar">Liberar</option>
                                <option value="comprar">Comprar</option>
                            </select>
                        </section>
                        <section class="botones">
                            <input type="submit" value="Enviar">
                            <input type="reset" value="Borrar">
                        </section>
                    </form>
                </article>
            </main>
        </div>
    </body>
</html>