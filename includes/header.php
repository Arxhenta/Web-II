<?php
session_start();
require_once 'ThemeManager.php';
require_once 'SessionManager.php';
require_once 'config.php';

SessionManager::init($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<style>
    <?php echo ThemeManager::getThemeStyles(); ?>
    .visit-stats {
        position: fixed;
        bottom: 10px;
        right: 10px;
        background-color: rgba(0, 0, 0, 0.8);
        color: white;
        padding: 10px;
        border-radius: 5px;
        font-size: 14px;
        z-index: 1000;
    }
    .visit-stats h4 {
        margin: 0 0 5px 0;
        font-size: 16px;
    }
    .visit-stats p {
        margin: 0;
    }
</style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <title>A-TECH | Ecommerce Website Design</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Afacad+Flux:wght@496&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body></body>
    <div class="header">
        <div class="container">
            <div class="navbar">
                <div class="logo">
                    <a href="index.php"><img src="images/logo.png" width="125px" alt="A-Tech Logo"></a>
                </div>
                <nav>
                    <ul>
                        <li><a href="products.php">Produktet</a></li>
                        <li><a href="login.php">Kyçu</a></li>
                        <?php if(isset($_SESSION['user_id'])): ?>
                            <li><a href="logout.php">Dilni</a></li>
                        <?php endif; ?>
                        <?php if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
                            <li><a href="admin/index.php">Admin</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
                <div class="header-icons">
                    <div class="theme-controls">
                        <select class="theme-select" onChange="changeTheme(this.value)">
                            <option value="default" <?php echo ThemeManager::getCurrentTheme() === 'default' ? 'selected' : ''; ?>>🎨</option>
                            <option value="light-blue" <?php echo ThemeManager::getCurrentTheme() === 'light-blue' ? 'selected' : ''; ?>>💠</option>
                            <option value="beige" <?php echo ThemeManager::getCurrentTheme() === 'beige' ? 'selected' : ''; ?>>🔸</option>
                        </select>
                        </div>
                    </div>
                    <a href="cart.php"><img src="images/cart.png" width="30px" height="30px"></a>
                    <img src="images/menu.jpg" class="menu-icon" onclick="toggleCategories()">
                </div>

                <div class="sliding-categories">
                    <div class="categories-content">
                        <h3>Kategoritë</h3>
                        <ul>
                            <li><a href="products.php?category=1">Telefon</a></li>
                            <li><a href="products.php?category=2">Laptop</a></li>
                            <li><a href="products.php?category=3">Të tjera</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): 
        $visitStats = SessionManager::getVisitStats();
    ?>
        <div class="visit-stats">
            <h4>Visit Statistics</h4>
            <p>Total Visits: <?php echo isset($visitStats['total_visits']) ? number_format($visitStats['total_visits']) : 'N/A'; ?></p>
            <p>Unique Visits: <?php echo isset($visitStats['unique_visits']) ? number_format($visitStats['unique_visits']) : 'N/A'; ?></p>
            <p>Current Page: <?php echo isset($visitStats['current_page_visits']) ? number_format($visitStats['current_page_visits']) : 'N/A'; ?></p>
            <p>First Visit: <?php echo isset($visitStats['first_visit']) ? date('Y-m-d H:i:s', strtotime($visitStats['first_visit'])) : 'N/A'; ?></p>
        </div>
    <?php endif; ?>

    <script>
        function toggleCategories() {
            document.querySelector('.sliding-categories').classList.toggle('active');
        }

        document.addEventListener('click', function(event) {
            if (!event.target.closest('.sliding-categories') && 
                !event.target.closest('.menu-icon')) {
                document.querySelector('.sliding-categories').classList.remove('active');
            }
        });

        function changeTheme(theme) {
            document.cookie = `active_theme=${theme};path=/;max-age=${30*24*60*60}`;
            location.reload();
        }
    </script>
</body>
</html>

