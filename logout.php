<?php
if(isset($_POST['enterpriselogout'])) {
    // Unset all session variables
    session_unset();
    // Regenerate session ID to prevent session fixation attacks
    session_regenerate_id(true);
    // Destroy the session
    session_destroy();
    // Clear session cookie
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    // Redirect to login page after logout
    header("Location: signinent.php");
    exit();
}

if(isset($_POST['lclogout'])) {
    // Unset all session variables
    session_unset();
    // Regenerate session ID to prevent session fixation attacks
    session_regenerate_id(true);
    // Destroy the session
    session_destroy();
    // Clear session cookie
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    // Redirect to login page after logout
    header("Location: signinlc.php");
    exit();
}
if(isset($_POST['residentlogout'])) {
    // Unset all session variables
    session_unset();
    // Regenerate session ID to prevent session fixation attacks
    session_regenerate_id(true);
    // Destroy the session
    session_destroy();
    // Clear session cookie
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    // Redirect to login page after logout
    header("Location: signincons.php");
    exit();
}
?>