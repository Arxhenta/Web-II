<?php 
include('config.php');
include('includes/header.php'); 
?>
        <div class="account-page">
            <div class="container">
                <div class="row">
                    <div class="col-2">
                        <img src="images/image1.png" width="100%">
                    </div>
                    <div class="col-2">
                        <div class="login-container">
                            <div class="login-box">
                                <h2>Kyçu</h2>
                                <form action="process_login.php" method="POST">
                                    <div class="input-group">
                                        <label for="email">Shkruaje email-in:</label>
                                        <input type="email" id="email" name="email" required>
                                    </div>
                                    <div class="input-group">
                                        <label for="password">Shkruaje fjalëkalimin:</label>
                                        <input type="password" id="password" name="password" required>
                                    </div>
                                    <div class="extras">
                                        <label>
                                            <input type="checkbox" name="remember">Më mbaj në mend!
                                        </label>
                                        <a href="#" class="forgot-password">Keni harruar fjalëkalimin?</a>
                                    </div>
                                    <button type="submit">Kyçuni tani</button>
                                    <p>Nuk keni llogari? <a href="register.php">Krijoje tani</a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php include('includes/footer.php'); ?>
