<?php
    $userName = filter_input(INPUT_GET, "userName");
    print "<h1> Hi, $userName!</h1>";


//filter_input funkcija prima tri parametra : input type constant, variable name, optional filter
//  input type constant odnosi se na mjesto pronalaska podataka - najcesce je INPUT_GET ili INPUT_POST
//  variable name ime elementa iz kojeg se vuku podaci
//  optional filtri su filtri koji imaju dvije kategorije : sanitizing filters i validation filters
//  sanitizing filtri - strip off various types of characters - FILTER_SANITIZE_STRING is applied automatically
//  validation filters - check if the value is in an acceptable form

?>

