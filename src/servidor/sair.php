<?php
session_start();
unset($_SESSION['Logado']);
session_destroy();

header('Location: ../../Login/');

?>