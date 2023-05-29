<?php

    $url = "http://127.0.0.1:8080/read";
    $result = file_get_contents($url);
    $result = json_decode($result, true);
    $config = $result["config"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Document</title>
</head>
<body>
    
<div class="container">
    <h1 class="titleh"> Configuration du bot </h1>
<?php



foreach($config as $key => $value){
    if ( ! is_array($value)){
        echo "<h3 class='titles'>.", $key, "<div class='inputgrp'><input type='text' value='", $value, "'><button class='btn' type='button'>Modifier</button></div></h3>";
    } else {
        echo "<h2 class='titleh'>.", $key, "</h2>";
        foreach ($value as $keyv => $valuev) {
            if ( ! is_array($valuev)){
                echo "<h3 class='titles'>.", $keyv, "<div class='inputgrp'><input type='text' value='", $valuev, "'><button class='btn' type='button'>Modifier</button></div></h3>";
            } else {
                echo "<h2 class='titleh'>.", $keyv, "</h2>"; 
                foreach ($valuev as $keyvv => $valuevv) {
                    echo "<h3 class='titles'>.", $keyvv, " <div class='inputgrp'><input type='text' value='", $valuevv, "'><button class='btn' type='button'>Modifier</button></div></h3>";
                }
            }
        }
    }
};

?>

</div>
</body>
</html>
