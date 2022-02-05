<?php 
    function console_log( $data ){
        echo '<script>';
        echo 'console.log('. json_encode( $data ) .')';
        echo '</script>';
    }

    session_start();
        if(isset($_SESSION['logat']) && $_SESSION['logat'] == true) {
            $nume = '<i class="fa fa-user-o" aria-hidden="true"></i>' . '  ' . $_SESSION['utilizator'];
            $cod_utilizator = $_SESSION["cod_utilizator"];
            console_log($_SESSION);
            $display_btcon = "d-none";  
            $display_btdecon = "d-block";   
        } else {
            $nume = '<i class="fa fa-user-o" aria-hidden="true"></i>Conectare';
            $cod_utilizator = null;
            $display_btcon = "d-block"; 
            $display_btdecon = "d-none";
        }

    $home_active = "";
    $proiecte_active = "";
    $echipa_active = "";
    $functii_active = "";
    include 'conectare.php';
?>