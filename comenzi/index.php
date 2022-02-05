<?php
include '../sesiune.php';
include '../components/head.php';
include '../components/header.php';
?>
    <div class="container">
        <h1 class="mt-5">Lista Comenzilor</h1>
        <div class="heading-divider"></div>
        <?php if ($cod_utilizator != null) :?>
        <div class="table-wrapper mt-5">
            <?php
            $query_comenzi = "SELECT comenzi.cod_comanda, comenzi.data_comanda, comenzi.adresa_livrare, s.status_comanda, comenzi.pret_total
                            FROM comenzi
                            INNER JOIN status_comenzi s ON comenzi.cod_status = s.cod_status
                            INNER JOIN utilizatori ON comenzi.cod_utilizator = utilizatori.COD_UTILIZATOR
                            WHERE comenzi.cod_utilizator = $cod_utilizator";
            $comenzi = mysqli_query($cnx, $query_comenzi) or die("Eroare: " . mysqli_error($cnx));

            if ($comenzi->num_rows != 0) :?>
            <table class="table">
                <thead>
                    <th>Comanda</th>
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
                        <td><?= $comanda["data_comanda"] ?></td>
                        <td><?= $comanda["adresa_livrare"] ?></td>
                        <td><?= $comanda["status_comanda"] ?></td>
                        <td><?= $comanda["pret_total"] ?> RON</td>
                    </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
            <?php else :?>
                <p>Nu aveti nici o comanda plasata</p>
            <?php endif ?>
        </div>
        <?php else :?>
            <p>Trebuie sa va conectati pentru a vizualiza comenzile dvs</p>
        <?php endif ?>
    </div>
</body>