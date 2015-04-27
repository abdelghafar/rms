<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 06/04/15
 * Time: 08:27 م
 */

require_once '../../lib/config.php';
require_once '../../lib/mysqlConnection.php';
$conn = new MysqlConnect();
if (isset($_GET['q'])) {
    $projectId = filter_input(INPUT_GET, 'q', FILTER_VALIDATE_INT);
    $stmt = "SELECT DISTINCT persons.Person_id,research_stuff.seq_no,persons.Nationality,persons.Position,name_ar,stuff_roles.role_name,persons.Email from persons join research_stuff on research_stuff.person_id = persons.Person_id  join stuff_roles on stuff_roles.seq_id = research_stuff.role_id where research_stuff.research_id=" . $projectId . " and research_stuff.role_id =3 ";
    $rs = $conn->ExecuteNonQuery($stmt);
    $r = 0;
    while ($row = mysql_fetch_array($rs, MYSQL_ASSOC)) {
        $result[] = array(
            'person_id' => $row['Person_id'],
            'seq_no' => $row['seq_no'],
            'name_ar' => $row['name_ar'],
            'role_name' => $row['role_name'],
            'email' => $row['Email'],
            'position' => $row['Position'],
            'major_Field' => $row['Major_Field'],
            'nationality' => $row['Nationality']
        );
    }
    echo json_encode($result);
} else {
    echo json_encode('Parameters are Required...');
}
