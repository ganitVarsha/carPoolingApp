<?php
if (!empty($_SESSION)) {
    session_destroy();
}
header('Location: login');
exit;
?>