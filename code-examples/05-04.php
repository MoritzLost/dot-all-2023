<?php

// Replace <h4> tags with <h3>
$html = str_replace(
    ['<h4>', '</h4>'],
    ['<h3>', '</h3>'],
    $html
);

// Remove disallowed tags and decode entities
array $allowedTags = ['p', 'h3', 'em', 'strong', 'a', 'ol', 'ul', 'li', 'br'];
$html = strip_tags($html, $allowedTags);
$html = html_entity_decode($html, ENT_QUOTES | ENT_HTML5, 'UTF-8');

// Remove empty tags (like <p> tags inserted for spacing)
return preg_replace(
  	"/<[a-z]{1,10}>(?:\s|&nbsp;|·)*<\/[a-z]{1,10}>/",
  	'',
  	$html
);