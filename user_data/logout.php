<?php
session_start();
session_unset();
session_destroy();

// Delete cookies
setcookie('user_id', '', time() - 3600, '/');
setcookie('username', '', time() - 3600, '/');

echo "Logged out successfully.";
header('Location: login.html');
exit();
?>
