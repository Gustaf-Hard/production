<?php




function get_bit_count($content){
    $rows = explode(PHP_EOL, $content);
    return count(explode("\t", $rows[0]));
}




?>