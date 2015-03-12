<!DOCTYPE html>
<?php
require_once '../../lib/controller/attachmentCatController.php';
$controller = new attachmentCatController();
$rs = $controller->GetAll();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form action="inc/test.inc.php" method="POST" enctype="multipart/form-data">
            <label>Category</label>
            <select class="form-control">
                <?php
                foreach ($rs as $obj) {
                    echo '<option value=' . $obj->getSeq_id() . '>' . $obj->getCat_name() . '</option>';
                }
                ?>
            </select>
            <br/>
            <input type="file" name="upload" accept="application/pdf"/>
            <input type="submit" value="submit" />
        </form>
    </body>
</html>
