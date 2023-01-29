<?php
    session_start();

    function corectez($sir) {
        $sir = trim($sir);
        $sir = stripslashes($sir);
        $sir = htmlspecialchars($sir);
        return $sir;
    }

    // preiau valorile din campurile formularului (nume și parola) 
    $eroare = '';

    if(isset($_SESSION['logat']) && $_SESSION['logat'] == true) {

        // include '../../conectare.php';

        // //  Reincarc "functii.php"
        // header('Location: ../index.php?utilizator=' . $_GET["cod_utilizator"] . "&status=" . $_GET["cod_status"]);
        // } else {
        // //  Nu este logat!
        // header('Location: ../index.php');

        $int_pret_unitar = (int)$_POST['pret_unitar'];
        $pret_unitar = (float)$int_pret_unitar;
        $cod_utilizator = $_SESSION["cod_utilizator"];
        $status_initial_comanda = 3;

        if(empty($_POST['cantitate'])) {
            $eroare .= '<p>Nu ati introdus cantitatea!</p>';
          } else {
            $int_qty = (int)$_POST['cantitate'];
            $qty = (float)$int_qty;
            $pret_total = $pret_unitar * $qty;
        }
        
        if(empty($_POST['adresa'])) {
            $eroare .= '<p>Nu ati introdus nicio adresa!</p>';
        } else {
            $adresa = corectez($_POST['adresa']);
        }

        if($eroare == '') {
            //  Nu sunt mesaje de eroare
            include '../../conectare.php';
            // formulez comanda INSERT
            $comanda = "INSERT INTO comenzi (cod_utilizator, adresa_livrare, cod_status, pret_total) VALUES (?, ?, ?, ?)";
            if($stm = mysqli_prepare($cnx, $comanda)) {
              mysqli_stmt_bind_param($stm, 'isii', $cod_utilizator, $adresa, $status_initial_comanda, $pret_total);
              if(!mysqli_stmt_execute($stm)) {
                echo "Eroare la exec. INSERT: " . mysqli_error($cnx);
              }
              } else {
              echo "Eroare la crearea variabilei de tip statement.";
            }
            mysqli_close($cnx);
            //  Reincarc "echipa.php"
            header('Location: ../statuscomanda.php');
          } else {
            echo "Eroare: " . $eroare;
          }
    }
        // include '../../conectare.php';

        // //  Reincarc "functii.php"
        // header('Location: ../index.php?utilizator=' . $_GET["cod_utilizator"] . "&status=" . $_GET["cod_status"]);
        // } else {
        // //  Nu este logat!
        // header('Location: ../index.php');
        // }
?>