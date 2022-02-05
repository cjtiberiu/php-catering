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

  if(empty($_POST['user'])) {
    $eroare .= '<p>Nu ați introdus numele!</p>';
  } else {
    $user = corectez($_POST['user']);
  }

  if(empty($_POST['parola'])) {
    $eroare .= '<p>Nu ați introdus parola!</p>';
  } else {
    $parola = corectez($_POST['parola']);
  }

  //  Verific daca preluarea datelor s-a derulat corect
  if($eroare == '') {
    //  Nu sunt mesaje de eroare
    include '../../conectare.php';

    // formulez comanda SELECT
    $comanda = "SELECT utilizatori.cod_utilizator, utilizatori.utilizator, utilizatori.parola, roluri_utilizatori.rol
                FROM utilizatori 
                INNER JOIN roluri_utilizatori ON utilizatori.rol_utilizator = roluri_utilizatori.cod_rol_utilizator
                where utilizatori.utilizator = ? 
                and utilizatori.parola = ?";
    if ($stm = mysqli_prepare($cnx, $comanda)) {
      mysqli_stmt_bind_param($stm, 'ss', $user, $parola);
      mysqli_stmt_execute($stm);
      $rez = mysqli_stmt_get_result($stm); // obtin multimea de selectie
      if ($linie = mysqli_fetch_assoc($rez)) {
        $_SESSION['logat'] = true;
        $_SESSION['utilizator'] = $linie['utilizator'];
        $_SESSION['cod_utilizator'] = $linie['cod_utilizator'];
        $_SESSION['rol_utilizator'] = $linie['rol'];
      } else {
        $eroare_user = '<p class="error">Datele nu au fost corecte</p>';
      }

      mysqli_free_result($rez);
    }

    mysqli_close($cnx);
    
    if ($_SESSION["logat"] == true) {
        header('Location: ../../index.php');
    } else {
        header('Location: ../index.php?status=incorrect');
    }

  } else {
    echo "Eroare: " . $eroare;
  }
?>