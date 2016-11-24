<? require_once ('../../includes/classes/AllClasses.php');



function getTags($file){
    $myfile = fopen($file, "r") or die("Unable to open file!");
    $text = fread($myfile,filesize($file));
    fclose($myfile);

    $texts = explode('<rdf:Bag>', $text);
    if(isset($texts[1])){
        $texts = explode('</rdf:Bag>', $texts[1]);
        return explode('</rdf:li>', str_replace('<rdf:li>', '', $texts[0]));
    }

}


$i = 0;



$db->query("DROP TABLE IF EXISTS images");

$query = "CREATE TABLE IF NOT EXISTS images (
		`id`   		            int(11) unsigned 	    NULL 	auto_increment,
        `image_name`            VARCHAR(256)     	    NULL 	default NULL,
        `tags`                  VARCHAR (500)         	NULL 	default NULL,
		`added_by` 	            int (11) unsigned       NULL 	default NULL,
		`created_at`            DATETIME,
		`updated_at`            DATETIME,

		PRIMARY KEY  (`id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ";

$db->query($query);








$query = "INSERT INTO images (image_name, tags) VALUES ";

$images = array();
foreach (scandir('../../search') as $image){
    if(strpos($image, '.pdf') !== false) {
        $tags = getTags('../../search/' . $image);
        $clean_tags = array();
        if (isset($tags) && is_array($tags)) {
            foreach ($tags as $tag) {
                if (!empty(trim($tag)))
                    $clean_tags[] = trim($tag);
            }
            $query .= "('" . trim($db->mysql_prep($image)) . "', '" . $db->mysql_prep(implode(',', $clean_tags)) . "'),";
            $images[] = ['tags' => $clean_tags, 'image_name' => trim($image)];
        }
        // RENAME FROM .AI to .PDF also you need to change from .pdf to .ai above.
        //$new_filename = trim(substr($image, 0, -2) . "pdf");
        //rename("../../search/".trim($image), "../../search/".$new_filename);
    }
}

$query = rtrim($query,',');
$db->query($query);

echo $query;







//echo json_encode($images);