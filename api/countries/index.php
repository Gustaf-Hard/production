<? require_once ('../../includes/classes/AllClasses.php');

$items = array();
$result = $db->query("SELECT * FROM country");

foreach($result as $item){
//var_dump($lesson);
    $items[] = $item;
}

echo json_encode($items);