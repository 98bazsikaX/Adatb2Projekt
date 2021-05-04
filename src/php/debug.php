<?php
session_start();
echo gettype($_SESSION['user']['role']);