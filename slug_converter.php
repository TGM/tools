<?php

function slugify($text)
{ 
	// replace non letter or digits by -
	$text = preg_replace('~[^\\pL\d]+~u', '-', $text);

	// trim
	$text = trim($text, '-');

	// transliterate
	$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

	// lowercase
	$text = strtolower($text);

	// remove unwanted characters
	$text = preg_replace('~[^-\w]+~', '', $text);

	if (empty($text))
	{
		return 'n-a';
	}

	return $text;
}
	


$link = mysqli_connect("localhost", "user", "pass", "db");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$query = "SELECT link_id, link_name FROM et_links LIMIT 1000";

if ($result = mysqli_query($link, $query)) {

    /* fetch associative array */
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<pre>';
		$slug = slugify($row['link_name']);
		echo $slug;
		$sql = "UPDATE et_links SET link_internal_name ='".$slug."' WHERE link_id =".$row['link_id'];
		mysqli_query($link, $sql);
    }

    /* free result set */
    mysqli_free_result($result);
}

/* close connection */
mysqli_close($link);


?>
