<?php
/*
Plugin Name: Bootstrap Helper
Plugin URI: https://github.com/thurrockdan/Wordpress-Bootstrap-Helper
Description: This plugin helps implement bootstrap 3 into Wordpress
Author: Daniel Smith
Version: 1.0
Author URI: https://github.com/thurrockdan/
*/

function add_responsive_class($content){

        $content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
        $document = new DOMDocument();
        libxml_use_internal_errors(true);
        $document->loadHTML(utf8_decode($content));

        $imgs = $document->getElementsByTagName('img');
        foreach ($imgs as $img) {
			//get the current wp classes
			$oldClass = $img->getAttribute('class');
			
			//Replace wp alignleft for pull-left
			$oldClass = str_replace("alignleft", "pull-left", $oldClass);
			//Replace wp alignright for pull-right
			$oldClass = str_replace("alignright", "pull-right", $oldClass);
			//Replace wp aligncenter for center-block
			$oldClass = str_replace("aligncenter", "center-block", $oldClass);
			
			//Set the replaced classes and also add the responsive img class 
			$img->setAttribute('class','' . $oldClass . ' img-responsive img-thumbnail');
        }

        $html = $document->saveHTML();
        return $html;   
}

add_filter('the_content', 'add_responsive_class');

?>
