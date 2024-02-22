<?php

if (isset($_SESSION['success_melding'])) {
    echo '<div class="alert alert-success" role="alert">' . $_SESSION['success_melding'] . '</div>';
    $_SESSION['success_melding'] = null;
}
if (isset($_SESSION['error_melding'])) {
    echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error_melding'] . '</div>';
    $_SESSION['error_melding'] = null;
}
?>

<style>
    .portfolioBtn {
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
        border: 1px solid transparent;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: 0.25rem;
        display: inline-block;
        font-weight: 400;
        vertical-align: middle;
        cursor: pointer;
    }
</style>

<form action="php/login.php" method="POST">
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <a class="portfolioBtn" href="/Portfolio/dist/portfolio.html">Terug naar portfolio</a>
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <div class="mb-md-5 mt-md-4 pb-5">

                                <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                                <p class="text-white-50 mb-5">Voer hier je email en wachtwoord in</p>

                                <div class="form-outline form-white mb-4">
                                    <input name="email" type="email" id="email" class="form-control form-control-lg" placeholder="Voer je email in" required />
                                    <br>
                                    <label class="form-label" for="email">Email</label>
                                </div>

                                <div class="form-outline form-white mb-4">
                                    <input name="wachtwoord" type="password" id="wachtwoord" class="form-control form-control-lg" placeholder="Voer je wachtwoord in" required />
                                    <br>
                                    <label class="form-label" for="wachtwoord">Wachtword</label>
                                </div>

                                <button class="btn btn-outline-light btn-lg px-5" type="submit" name="login-submit">Login</button>

                                <div class="d-flex justify-content-center text-center mt-4 pt-1">
                                    <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                                    <a href="#!" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                                    <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
                                </div>

                            </div>
                            <div>
                                <p class="mb-0">Heb je nog geeen account? <a href="index.php?page=register" class="text-white-50 fw-bold">Registreer</a>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>