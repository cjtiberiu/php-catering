<?php
    session_start();
    if(isset($_SESSION['logat']) && $_SESSION['logat'] == true && $_SESSION["rol_utilizator"] == 'admin') {

        include '../../conectare.php';

        //  Reincarc "functii.php"
        header('Location: ../index.php?utilizator=' . $_GET["cod_utilizator"] . "&status=" . $_GET["cod_status"]);
        } else {
        //  Nu este logat!
        header('Location: ../index.php');
        }
?>