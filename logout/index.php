<?php
session_start();
session_unset();
session_destroy();
$_SESSION['logado'] = false;
header("Location: ../");
exit;
