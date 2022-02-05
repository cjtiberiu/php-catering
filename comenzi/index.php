<?php
include '../sesiune.php';
include '../components/head.php';
include '../components/header.php';
?>
    <div class="container">
        <h1 class="mt-5">Lista Comenzilor</h1>
        <div class="heading-divider"></div>
        <?php if ($cod_utilizator != null) :?>
            <?php 
                $query_utilizatori = "SELECT utilizator, cod_utilizator from utilizatori WHERE utilizator != 'admin'";
                $utilizatori = mysqli_query($cnx, $query_utilizatori) or die("Eroare: " . mysqli_error($cnx));
            
                $query_status = "SELECT cod_status, status_comanda from status_comenzi";
                $status = mysqli_query($cnx, $query_status) or die("Eroare: " . mysqli_error($cnx));
            ?>
            <?php if ($_SESSION["rol_utilizator"] == "admin") :?>
            <form action="./formulare/filtre.php">
                <select class="form-select d-inline-block w-auto" name="cod_utilizator">
                    <option value="">Alege utilizator</option>
                    <?php while ($utilizator = mysqli_fetch_assoc($utilizatori)) :?>
                        <option value="<?= $utilizator["cod_utilizator"] ?>"><?= $utilizator["utilizator"] ?></option>
                    <?php endwhile ?>
                </select>
                <select class="form-select d-inline-block w-auto" name="cod_status">
                    <option value="">Status</option>
                    <?php while ($stat = mysqli_fetch_assoc($status)) :?>
                        <option value="<?= $stat["cod_status"] ?>"><?= $stat["status_comanda"] ?></option>
                    <?php endwhile ?>
                </select>
                <button class="btn btn-primary">Filtreaza</button>
            </form>
            <?php endif ?>

            <div class="table-wrapper mt-5">
                <?php
                $filtru_utilizator = $_SESSION["rol_utilizator"] == "admin" ? isset($_GET["utilizator"]) ? $_GET["utilizator"] : '' : $_SESSION["cod_utilizator"];
                $filtru_status = isset($_GET["status"]) ? $_GET["status"] : '';

                $conditii = array();

                if(!empty($filtru_utilizator)) {
                    $conditii[] = "utilizatori.cod_utilizator='$filtru_utilizator'";
                }
                if(!empty($filtru_status)) {
                    $conditii[] = "comenzi.cod_status='$filtru_status'";
                }

                $query_comenzi = "SELECT comenzi.cod_comanda, utilizatori.utilizator, comenzi.data_comanda, comenzi.adresa_livrare, s.status_comanda, comenzi.pret_total
                                FROM comenzi
                                INNER JOIN status_comenzi s ON comenzi.cod_status = s.cod_status
                                INNER JOIN utilizatori ON comenzi.cod_utilizator = utilizatori.COD_UTILIZATOR";

                if (count($conditii) > 0) {
                    $query_comenzi .= " WHERE " . implode(' AND ', $conditii);
                }

                $comenzi = mysqli_query($cnx, $query_comenzi) or die("Eroare: " . mysqli_error($cnx));

                if ($comenzi->num_rows != 0) :?>
                <table class="table">
                    <thead>
                        <th>Comanda</th>
                        <th>Utilizator</th>
                        <th>Data Comenzii</th>
                        <th>Adresa Livrare</th>
                        <th>Status</th>
                        <th>Pret</th>
                    </thead>
                    <tbody>
                        <?php

                        while($comanda = mysqli_fetch_assoc($comenzi)) : ?>
                        <tr>
                            <td>#<?= $comanda["cod_comanda"] ?></td>
                            <td><?= $comanda["utilizator"] ?></td>
                            <td><?= $comanda["data_comanda"] ?></td>
                            <td><?= $comanda["adresa_livrare"] ?></td>
                            <td><?= $comanda["status_comanda"] ?></td>
                            <td><?= $comanda["pret_total"] ?> RON</td>
                        </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>
                <?php else :?>
                    <p>Nu exista comenzi plasate</p>
                <?php endif ?>
            </div>
        <?php else :?>
            <p>Trebuie sa va conectati pentru a vizualiza comenzile dvs</p>
        <?php endif ?>
    </div>
</body>