<?php
    session_start();
    unset($_SESSION['email']);
    Unset($_SESSION['senha']);
    header('Location: index.php');