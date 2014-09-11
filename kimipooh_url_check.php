<?php
/**
 * This function is for checking the url (or file) existence.
 *
 * If you want to check the file existence, you had better use 'is_file' funciton.
 *
 * Concretely, the function confirms whether one character can be read from url or file. 
 *
 * Version 1.0 on 11 September, 2014.
 * @ Kimiya Kitani (kimipooh) : https://profiles.wordpress.org/kimipooh/
**/


function kimipooh_url_exists($url){
	$context = stream_context_create(array(
		'http' => array(
			'timeout'=>1,
		)
	));


  if(file_get_contents($url, NULL, $context, 0, 1))
	return true;

  return false;
}
?>