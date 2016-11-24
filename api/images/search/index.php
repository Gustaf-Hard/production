<? require_once ('../../../includes/classes/AllClasses.php');



$images = array();

if(isset($_GET['search'])){
    
    
    $result = $db->query("SELECT * FROM images WHERE image_name LIKE '%{$_GET['search']}%' OR tags LIKE '%{$_GET['search']}%'");

    foreach($result as $image){
        $images[] = ['id' => $image['id'], 'image_name' => str_replace(' ','%20' , $image['image_name']), 'tags' => $image['tags']];
    }

}

echo json_encode($images);
