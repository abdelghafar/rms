<?php

function Redirect() {
    if (isset($_SESSION['User_Id']) && $_SESSION['User_Id'] != 0) {
        $rule = $_SESSION['Rule'];

        if ($rule == 'Researcher') {
            header('Location:Researchers/index.php');
            exit();
        } else if ($rule == 'Reseach_Center') {
            header('Location:Reseach_Center/index.php');
            exit();
        } else if ($rule == 'DeanShip') {
            header('Location:DeanShip/index.php');
            exit();
        } else if ($rule == 'Archive') {
            header('Location:Archive/index.php');
            exit();
        } else if ($rule == 'Vice_Dean') {
            header('Location:Vice_Dean/index.php');
            exit();
        } else if ($rule == 'Council_board') {
            header('Location:Council_board/index.php');
            exit();
        } else {
            header('Location:index.php');
            exit();
        }
    }
}

?>
