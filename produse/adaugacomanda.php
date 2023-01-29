<?php
include '../sesiune.php';
include '../components/head.php';
include '../components/header.php';
?>
<div class="container">
    <h1 class="mt-5">Comanda</h1>
    <div class="heading-divider"></div>
    <div class="row products-wrapper mt-4">
        <?php
        $query_produse = " SELECT " . "cod_produs, denumire, imagine_produs, descriere, pret_unitar" .
                        " FROM produse " .
                        " WHERE cod_produs = " . $_GET["cod"] .
                        " LIMIT 1;";
        $produse = mysqli_query($cnx, $query_produse) or die("Eroare: " . mysqli_error($cnx));

        while($produs = mysqli_fetch_assoc($produse)) : ?>
            <h2><?= $produs["denumire"] ?></h2>
            <p>Pret Unitar: <?= $produs["pret_unitar"] ?> RON</p>
        
            <div class="row">
                <div class="col-lg-4">
                    <form action="./formulare/adaugacomanda.php" method="post" class="">
                        <div class="form-group">
                            <div class="form-holder">
                                <label class="form-label">Cantitate</label>
                                <input class="form-control bg-transparent" id="cantitate" value="1" name="cantitate" type="number" />
                                <input class="form-control bg-transparent" id="pret_unitar" value="<?= $produs["pret_unitar"] ?>" name="pret_unitar" type="hidden" />
                            </div>
                        </div>
                        <div class="form-group mt-2">
                            <div class="form-holder">
                                <label class="form-label">Adresa</label>
                                <input class="form-control bg-transparent" id="adresa" name="adresa" type="text" />
                            </div>
                        </div>
                        <button type="submit" href="#" class="btn btn-primary mt-4 w-100">Adauga Comanda</button>
                        <?php 
                            if (isset($_GET["status"]) && $_GET['status'] == 'incorrect') {
                                echo '<p class="text-center text-danger">Datele nu au fost corecte</p>';
                            }
                        ?>
                    </form>
                </div>
            </div>
        <?php endwhile ?>
    </div>
</div>
</body>