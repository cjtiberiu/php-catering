<?php
include '../sesiune.php';
include '../components/head.php';
include '../components/header.php';
?>
<div class="container">
    <h1 class="mt-5">Lista Produselor</h1>
    <div class="heading-divider"></div>
    <div class="row products-wrapper mt-4">
        <?php
        $query_produse = "SELECT denumire, imagine_produs, descriere, pret_unitar FROM produse";
        $produse = mysqli_query($cnx, $query_produse) or die("Eroare: " . mysqli_error($cnx));

        while($produs = mysqli_fetch_assoc($produse)) : ?>
            <div class="col col-12 col-lg-3">
                <div class="card product">
                    <img src="/catering/assets/images/<?= $produs["imagine_produs"] ?>" class="card-img-top" alt="...">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div class="card-body-upper mb-2">
                            <h4><?= $produs["denumire"] ?></h4>
                            <p class="card-text"><?= $produs["descriere"] ?></p>
                            <h5><?= $produs["pret_unitar"] ?> RON / 1kg</h5>
                        </div>
                        <button class="btn btn-primary mt-2 w-100">Comanda</button>
                    </div>
                </div>
            </div>
        <?php endwhile ?>
    </div>
</div>
</body>