<?php
    require __DIR__ . '/vendor/autoload.php';
    use JalalLinuX\Pm2\Structure\Process;

    pm2()->logOut('test', 100)->toBeString();
    $project = "tsuki";
    $url = "http://127.0.0.1:8080/read/" . $project;
    $result = file_get_contents($url);
    $result = json_decode($result, true);
    $config = $result["config"];

    if (isset($_POST['modify'])) {

        $firstparam = $_POST['firstparam'] ?? "0";
        $secondparam = $_POST['secondparam'] ?? "0";
        $value = $_POST['value'];  
    
        echo $firstparam;
        echo $secondparam;
        echo $value;
    
        $url = "http://127.0.0.1:8080/write/" . $project . "/" . rawurlencode($firstparam) . "/" . rawurlencode($secondparam) . "/" . rawurlencode($value);
        $result = file_get_contents($url);
        $result = json_decode($result, true);
        print_r($result);

        $project = "tsuki";
        $url = "http://127.0.0.1:8080/read/" . $project;
        $result = file_get_contents($url);
        $result = json_decode($result, true);
        $config = $result["config"];
    };

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
    <div class="containerin">
        <h1 class="titleh"> Configuration du bot </h1>
        <div class="content">
            <?php
            foreach($config as $key => $value){
                if ( ! is_array($value)){
                    echo "<h3 class='titles'>.", $key, "<div class='inputgrp'><form action='' method='post'><input type='text' name='value' value='", $value, "'><button class='btn' name='modify' type='input'>Modifier</button><input name='firstparam' value='", $key, "' type='hidden'></form></div></h3>";
                } else {
                    echo "<h2 class='titleh'>.", $key, "</h2>";
                    foreach ($value as $keyv => $valuev) {
                        if ( ! is_array($valuev)){
                            echo "<h3 class='titles'>.", $keyv, "<div class='inputgrp'><form action='' method='post'><input name='value' type='text' value='", $valuev, "'><button class='btn' name='modify' type='input'>Modifier</button><input name='firstparam' value='", $key, "' type='hidden'><input name='secondparam' value='", $keyv, " ' type='hidden'></form></div></h3>";
                        } else {
                            echo "<h2 class='titleh'>.", $keyv, "</h2>"; 
                            foreach ($valuev as $keyvv => $valuevv) {
                                echo "<h3 class='titles'>.", $keyvv, " <div class='inputgrp'><form action='' method='post'><input name='value' type='text' value='", $valuevv, "'><button name='modify' type='input' class='btn'>Modifier</button><input name='firstparam' value='", $key, "' type='hidden'><input name='secondparam' value='", $keyvv, " ' type='hidden'></form></div></h3>";
                            }
                        }
                    }
                }
            };
            ?>
        </div>
    </div>
    <div class="containerin">
        <h1 class="titleh"> Général </h1>
        <div class="content">
            <h3 class="titles">Statut du bot: <span class="green">ON</span><br>Uptime:</h3>
        </div>
        <h2 class="titleh"> Commande </h2>
        <div class="content">
            <h3 class="titles"><div class='inputgrp'><form method='post'><button class='btng' name='startbot' type='input'>Démarrer le bot</button> <button class='btng' name='stopbot' type='input'>Éteindre le bot</button></form></div></h3>
        </div>
    </div>
    <div class="containerin">
        <h1 class="titleh"> Derniere logs </h1>
        <div class="content">
            
        </div>
    </div>
</div>
</body>
</html>
