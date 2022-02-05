<?php
include '../sesiune.php';
include '../components/head.php';
include '../components/header.php';
?>
    <section class="hero-component" style="background-image: url({{ asset('assets/images/banner2.jpg') }})">
        <div class="container d-flex justify-content-center">
            <div class="content-wrapper text-center p-5">
                <h1>Conectare</h1>
                <div class="content-divider"></div>
                <form action="./formulare/logare.php" method="post" class="login-form ms-auto me-auto">
                    <div class="form-group">
                        <div class="form-holder">
                            <label class="form-label">Username</label>
                            <input class="form-control bg-transparent" id="user" name="user" type="text" />
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <div class="form-holder">
                            <label class="form-label">Parola</label>
                            <input class="form-control bg-transparent" id="parola" name="parola" type="password" />
                        </div>
                    </div>
                    <button type="submit" href="#" class="btn btn-primary mt-4 w-100">Conectare</button>
                    <?php 
                        if (isset($_GET["status"]) && $_GET['status'] == 'incorrect') {
                            echo '<p class="text-center text-danger">Datele nu au fost corecte</p>';
                        }
                    ?>
                </form>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>