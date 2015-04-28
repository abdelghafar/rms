<?php

session_start();
if (isset($_GET['q'])) {
    $_SESSION['q'] = filter_input(INPUT_GET, 'q', FILTER_VALIDATE_INT);
}
