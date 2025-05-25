<?php
class SessionManager {
    private static $conn;

    public static function init($conn) {
        self::$conn = $conn;

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        self::trackVisit();
    }

    private static function trackVisit() {
        if (!self::$conn) {
            error_log("Database connection not established.");
            return;
        }

        // Log visit to database
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
        $page_url = $_SERVER['PHP_SELF'];
        $session_id = session_id();
        $is_logged_in = isset($_SESSION['user_id']) ? 1 : 0;

        $sql = "INSERT INTO visits (user_id, page_url, session_id, is_logged_in) 
                VALUES (?, ?, ?, ?)";
        $stmt = self::$conn->prepare($sql);
        if (!$stmt) {
            error_log("Failed to prepare statement: " . self::$conn->error);
            return;
        }
        $stmt->bind_param("issi", $user_id, $page_url, $session_id, $is_logged_in);
        if (!$stmt->execute()) {
            error_log("Failed to execute statement: " . $stmt->error);
        }
    }

    public static function getVisitStats() {
        if (!self::$conn) {
            error_log("Database connection not established.");
            return [];
        }

        $sql = "SELECT 
                (SELECT COUNT(*) FROM visits) as total_visits,
                (SELECT COUNT(DISTINCT session_id) FROM visits) as unique_visits,
                (SELECT COUNT(*) FROM visits WHERE page_url = ?) as current_page_visits,
                (SELECT MIN(visit_timestamp) FROM visits) as first_visit";

        $stmt = self::$conn->prepare($sql);
        if (!$stmt) {
            error_log("Failed to prepare statement: " . self::$conn->error);
            return [];
        }

        $currentPage = $_SERVER['PHP_SELF'];
        $stmt->bind_param("s", $currentPage);
        if (!$stmt->execute()) {
            error_log("Failed to execute statement: " . $stmt->error);
            return [];
        }

        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
?>