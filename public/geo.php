<?php


$a = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR']));


$countrycode= $a['geoplugin_countryCode'];

if ($countrycode=='US')
    header( 'Location: 404.php' ) ;

else if ($countrycode=='CA')
    header( 'Location: 404.php' ) ;

else
    echo "welcome to homepage";
    

;?>