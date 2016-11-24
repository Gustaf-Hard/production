<?php

require_once ('Unirest.php');
// https://market.mashape.com/wordsapi/wordsapi
// These code snippets use an open-source library. http://unirest.io/php

if(isset($_GET['word'])){
    $response = Unirest\Request::get("https://wordsapiv1.p.mashape.com/words/{$_GET['word']}/",
        array(
            "X-Mashape-Key" => "T0kMN7u3Xcmshb8fix5egaywhN2Mp1LhOL0jsnsIADbr2i31KO",
            "Accept" => "application/json"
        )
    );

    $definitions = array();
    $synonyms = array();
    $examples = array();

    if(isset($response->body->results)){
        // DEFINITIONS
        foreach ($response->body->results as $item){
            if(isset($item->definition)){
                $definitions[] = $item->definition;
            }
        }

        // SYNONYMS
        foreach ($response->body->results as $item){
            if(isset($item->synonyms)){
                foreach ($item->synonyms as $synonym){
                    if(isset($synonym)){
                        $synonyms[] = $synonym;
                    }
                }
            }
        }

        // EXAMPLES
        foreach ($response->body->results as $item){
            if(isset($item->examples)){
                foreach ($item->examples as $example){
                    if(isset($synonym)){
                        $examples[] = $example;
                    }
                }
            }
        }
    }

    $output = array('definitions' => $definitions,
        'synonyms' => $synonyms,
        'examples' => $examples);

    echo json_encode($output);
}
