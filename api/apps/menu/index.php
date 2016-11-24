<? require_once ('../../../includes/classes/AllClasses.php');

$menu_alternatives = array();
$result = $db->query("SELECT * FROM apps");


// First create the main header alternatives.
foreach($result as $item){
    if(!in_array($item['menu_name'], $menu_alternatives)){
        $menu_alternatives[] = $item['menu_name'];
    }
}




// Then create the sub menus
$full_menu = array();
foreach ($menu_alternatives as $menu){
    $sub_menu = array();
    foreach ($result as $item){
        if($item['menu_name'] == $menu){
            $sub_menu[] = [
                'app_name' => $item['app_name'],
                'disabled' => $item['disabled'] == 1 ? "disabled disableClick" : "",
                'url' => is_null($item['app_url']) ? "#" : $item['app_url']
            ];
        }
    }
    $full_menu[] = [
        'menu_name' => $menu,
        'sub_menu' => $sub_menu
    ];
}


echo json_encode($full_menu);







