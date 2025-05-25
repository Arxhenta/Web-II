<?php
require_once 'CookieManager.php';

class ThemeManager {
    private static $availableThemes = [
        'default' => [
            'name' => 'Default Theme',
            'header' => 'radial-gradient(at center, #A7A1FA, #D3E2E0)',
            'background' => '#ffffff',
            'textColor' => '#555'
        ],
        'light-blue' => [
            'name' => 'Light Blue',
            'header' => 'radial-gradient(at center, #A7A1FA, #D3E2E0)',
            'background' => '#e6f3ff',
            'textColor' => '#333'
        ],
        'beige' => [
            'name' => 'Beige Theme',
            'header' => '#f5f5dc',
            'background' => '#f5f5dc',
            'textColor' => '#333'
        ]
    ];

    public static function setTheme($themeName) {
        if (array_key_exists($themeName, self::$availableThemes)) {
            CookieManager::set('active_theme', $themeName);
            return true;
        }
        return false;
    }

    public static function getCurrentTheme() {
        $themeName = CookieManager::get('active_theme');
        return $themeName ?? 'default';
    }

    public static function getAllThemes() {
        return self::$availableThemes;
    }

    public static function getThemeStyles() {
        $themeName = self::getCurrentTheme();
        $theme = self::$availableThemes[$themeName];

        return "
            body {
                background-color: {$theme['background']};
                color: {$theme['textColor']};
            }
            .header {
                background: {$theme['header']};
            }
            .navbar {
                background: transparent;
            }
        ";
    }
}
?>