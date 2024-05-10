<?php
// Hapus semua data session
session_destroy();

// Redirect ke halaman login
header("Location: /project01/auth/login.php");
exit;
?>