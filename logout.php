<?php

session_start();
include "path.php";

unset($_SESSION['id']); // функция unset — Удаляет переменную
unset($_SESSION['login']);
unset($_SESSION['admin']);

header('location: ' . BASE_URL);