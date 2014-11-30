<?
require_once '../../lib/mysqlConnection.php';
require_once '../../lib/CenterResearch.php';
require_once '../../lib/Reseaches.php';
require_once 'GetResearchBudgetByCenterIdAndYearFn.php';
require_once 'GetResearchCountByCenterIdAndYearFn.php';

function GetResearchBudgetAndCountByYearFn($year) {
    $centers = new CenterResearch();
    $centerLst = $centers->GetAll();
    $Researches = new Reseaches();
    $totalReseach = $Researches->GetResearchesCount($year);
    $totalBudget = $Researches->GetResearchesBudget($year);

    while ($row = mysql_fetch_array($centerLst, MYSQL_ASSOC)) {

        $center_id = $row['id'];
        $budget = GetResearchBudgetByCenterIdAndYearFn($year, $center_id);

        $count = GetResearchCountByCenterIdAndYearFn($year, $center_id);

        $list[] = array(
            'center_name' => $row['center_name'],
            'budget' => $budget,
            'count' => $count,
            'rcount_percnt' => ($count / $totalReseach) * 100,
            'budget_percent' => ($budget / $totalBudget) * 100,
            'total_budget' => $totalBudget,
            'total_count' => $totalReseach,
        );
    }
    return $list;
}

?>
