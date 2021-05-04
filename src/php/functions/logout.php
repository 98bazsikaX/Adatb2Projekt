<?php
session_start();
unset($_SESSION['user']);
header("Location:/php/login.php");
