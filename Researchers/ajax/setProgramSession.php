<?php

session_start();
if (isset($_GET['program'])) {
    if (isset($_GET['program'])) {
        require_once '../../lib/program.php';
        $t = new program();

        $program_string = filter_input(INPUT_GET, 'program', FILTER_SANITIZE_STRING);
        switch ($program_string) {
            case 'ba7th':
            {
                $program_id = $t->GetProgramId('ba7th');
                $_SESSION['program'] = $program_id;

                break;
            }
            case 'ra2d':
            {
                $program_id = $t->GetProgramId('ra2d');
                $_SESSION['program'] = $program_id;

                break;
            }
            case 'wa3da':
            {
                $program_id = $t->GetProgramId('wa3da');
                $_SESSION['program'] = $program_id;

                break;
            }
            default :
                {
                header("Location: ../index.php");
                break;
                }
        }
    } else {
        header('Location: ../selectProgram.php');
    }
}
