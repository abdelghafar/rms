<?php
session_start();
//Set session value from js files....
if (isset($_GET['q'])) {
    $_SESSION['q'] = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_NUMBER_INT);
}