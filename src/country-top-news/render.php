<?php
$country_code = $attributes['countryCode'];
$articles     = TNB_Top_News\API\get_articles( $country_code );
var_dump($articles);
?>

