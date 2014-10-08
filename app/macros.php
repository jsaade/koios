<?php

/**
 * Creates an html input with an array name identier
 * @var [type]
 */
Form::macro('TextGroup', function($name, $value, $params=[])
{
    return "<input type='text' name='{$name}[]' value='{$value}' ".extract_params($params)." />";
});

?>