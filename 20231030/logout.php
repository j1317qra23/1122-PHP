<?php
session_start();

unset($_COOKIE['login']);

header("location:login.php");



