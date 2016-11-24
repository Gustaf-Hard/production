<? require_once ('../../../includes/classes/AllClasses.php');



$query = "SELECT * FROM country ";
$query .= isset($_GET['country_id']) ? " WHERE id = " . $_GET['country_id'] : NULL;
$country_result = $db->query($query);


foreach ($country_result as $country){
    $languages = array();
    $language_result = $db->query("
        SELECT language.id, language.code, language.language_name, language.native_name FROM 
        country_language 
        LEFT JOIN language
        ON country_language.language_id=language.id
        WHERE country_language.country_id = {$country['id']}
    ");

    foreach ($language_result as $language){
        $languages[] = $language;
    }
    $output[] = [
        'id' => $country['id'],
        'code' => $country['code'],
        'country_name' => $country['country_name'],
        'native_name' => $country['native_name'],
        'languages' => $languages
    ];
}


echo json_encode($output);



