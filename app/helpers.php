<?php
/**
 * Returns public upload path, if uplaod folder does not exist, create it
 * @return [type] [description]
 */
function uploads_path()
{
	$path = public_path()."/uploads/";
	File::exists($path) or File::makeDirectory($path);

	return $path;
}


function uploads_relative_url()
{
	return "uploads/";
}

function extract_params($array)
{
	$str = "";
	
	foreach($array as $key => $val)
		$str .= "{$key} = '{$val}' ";

	return $str;
}
?>