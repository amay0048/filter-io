<?php
	
	$htmlFile = './html/index.html';
	$html = file_get_contents($htmlFile,true);
	$doc = new DOMDocument();
	libxml_use_internal_errors(true);
	$doc->loadHTML($html);
	libxml_clear_errors();
	
	extract_children($doc,"wp-header");
	extract_children($doc,"wp-widget");
	extract_children($doc,"wp-body");
	extract_children($doc,"wp-footer");
	create_css($doc);
	
	$contents = $doc->saveHTML($doc);
	file_put_contents("./wordpress/index.php",$contents);
	
	function extract_children($doc,$class){
		
		$finder = new DomXPath($doc);
		$nodes = $finder->query("//*[contains(@class, '$class')]");
		
		$index = 0;
		foreach($nodes as $item) {
			if(!$index){
				create_include($item,$class);
			} else {
				create_include($item,$class."-".$index);
			}
			$index++;
		}
		
	}
	
	function create_include($node,$class){
		
		$doc = $node->ownerDocument;
		$filename = $class.".php";
		// This requires the php closing tag because of 
		// the way the createProcessingInstruction works 
		// in the saveHTML function
		$newnode = $doc->createProcessingInstruction('php','include "'.$filename.'";?');
		
		$parent = $node->parentNode;
		$fragment = $parent->replaceChild($newnode,$node);
		$contents = $doc->saveHTML($fragment);
		file_put_contents("./wordpress/".$filename,$contents);
		
	}
	
	function create_css($doc){
		$contents = "";
		$finder = new DomXPath($doc);
		$type = "text/css";
		$nodes = $finder->query("//*[contains(@type, '$type')]");
		foreach($nodes as $node){
			$parent = $node->parentNode;
			$parent->removeChild($node);
			$path = $node->getAttribute("href");
			$contents .= file_get_contents("./html/".$path);
		}
		file_put_contents("./wordpress/style.css",$contents);
	}

?>