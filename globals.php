<?php
/*
  Esta biblioteca agarra los nombres y valores de las variables enviados  $_ * 
  y las pasa como variables del globals simples. Hace  
  el mismo trabajo para el $PHP_SELF, $HTTP_ACCEPT_LANGUAGE y  
  Las variables de $HTTP_AUTHORIZATION.  
*/
function globals_var($array, &$target) {
    if (!is_array($array)) {
        return FALSE;
    }
    $is_magic_quotes = get_magic_quotes_gpc();
    foreach($array AS $key => $value) {
        if (is_array($value)) {
		    // podría haber una variable otra aplicación, con el mismo nombre 
            unset($target[$key]);

            globals_var($value, $target[$key]);
        } else if ($is_magic_quotes) {
            $target[$key] = stripslashes($value);
        } else {
            $target[$key] = $value;
        }
    }
    return TRUE;
}

if (!empty($_GET)) {
    globals_var($_GET, $GLOBALS);
} // end if

if (!empty($_POST)) {
    globals_var($_POST, $GLOBALS);
} // end if

if (!empty($_FILES)) {
    foreach($_FILES AS $name => $value) {
        $$name = $value['tmp_name'];
        ${$name . '_name'} = $value['name'];
    }
} // end if

if (!empty($_SERVER)) {
    $server_vars = array('PHP_SELF', 'HTTP_ACCEPT_LANGUAGE', 'HTTP_AUTHORIZATION');
    foreach ($server_vars as $current) {
        if (isset($_SERVER[$current])) {
            $$current = $_SERVER[$current];
        } elseif (!isset($$current)) {
            $$current = '';
        }
    }
    unset($server_vars, $current);
} // end if

//seguridad :pruhibir acceso archivos del servidor con "?goto="
if (isset($goto) && strpos(' ' . $goto, '/') > 0 && substr($goto, 0, 2) != './') {
    unset($goto);
} // end if

?>
