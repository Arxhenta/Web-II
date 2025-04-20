<?php 

class User {
    private $email;
    private $password;
    
    public function __construct($email, $password) {
        $this->email = $email;
        $this->password = $password;
    }
    
   
    public function getEmail() {
        return $this->email;
    }
    
    public function getPassword() {
        return $this->password;
    }
}


class AuthSystem {
    private $users = [];
    
    public function __construct() {
      
        $this->users = [
            new User('user1@example.com', 'password123'),
            new User('user2@example.com', 'securepass')
        ];
    }
    
    public function validateLogin($email, $password) {
       
        if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)) {
            return false;
        }
       
        foreach ($this->users as $user) {
            if ($user->getEmail() === $email && $user->getPassword() === $password) {
                return true;
            }
        }
        return false;
    }
}

$auth = new AuthSystem();
$login_error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if ($auth->validateLogin($email, $password)) {
        $_SESSION['user_email'] = $email;
        header('Location: index.php');
        exit();
    } else {
        $login_error = 'Email ose fjalëkalim i gabuar';
    }
}

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
                                <?php if ($login_error): ?>
                                    <div class="error-message" style="color: red; margin-bottom: 15px;">
                                        <?php echo htmlspecialchars($login_error); ?>
                                    </div>
                                <?php endif; ?>
                                <form action="login.php" method="POST">
                                    <div class="input-group">
                                        <label for="email">Shkruaje email-in:</label>
                                        <input type="email" id="email" name="email" required
                                            value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
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
