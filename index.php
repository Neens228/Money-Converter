<?php
$Name=htmlspecialchars($_GET["Name_Valute"]);
function debug_arr($arr) {
   echo '<pre>';
   print_r($arr);
   echo '</pre>';
}
$url = "https://www.cbr-xml-daily.ru/daily_json.js";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$data = json_decode(curl_exec($ch), $assoc=true);
curl_close($ch);
$Searching_Value = $data['Valute'][$Name]['Value'];
$Nom = json_decode(curl_exec($ch), $assoc=true);
$Nominal = $Nom['Valute'][$Name]['Nominal'];
$USD_SEARCH=round($Nom['Valute']["USD"]['Value'],2);
$CNY_SEARCH=round($Nom['Valute']["CNY"]['Value']/10,2);
$INR_SEARCH=round($Nom['Valute']["INR"]['Value']/100,2);
$EUR_SEARCH=round($Nom['Valute']["EUR"]['Value'],2);
$GBP_SEARCH=round($Nom['Valute']["GBP"]['Value'],2);
$UAH_SEARCH=round($Nom['Valute']["UAH"]["Value"]/10,2);
$tab="                        ";
$rubles = "руб";
$usd = "USD";
$CNY = "CNY";
$INR = "INR";
$EUR = "EUR";
$GBP = "GBP";
$UAH = "UAH";


if($Nominal==10){
   $Searching_Value = $Searching_Value/10;
}
elseif ($Nominal==100){
    $Searching_Value = $Searching_Value/100;
}
if ($_GET["go"]) {
   $Value_in_RUB = round($_GET["usd"] * $Searching_Value,2);
}
 switch ($Name) {
   case "USD":
        $Visible_Value="Доллар США";
        break;
   case "CHF":
        $Visible_Value="Швейцарских франк";
        break;
   case "CNY":
        $Visible_Value="Китайский юань";
        break;
   case "BYN":
        $Visible_Value="Белорусский рубль";
        break;
   case "SGD":
        $Visible_Value="Сингапурский доллар";
        break;
   case "TRY":
        $Visible_Value="Турецкая лира";
        break;
   case "INR":
        $Visible_Value="Индийская рупия";
        break;
   case "JPY":
        $Visible_Value="Японская иена";
        break;
   case "UAH":
        $Visible_Value="Украинская гривна";
        break;
   case "AUD":
        $Visible_Value="Австралийский доллар";
        break;
   case "GBP":
        $Visible_Value="Английский фунт ";
        break;
   case "EUR":
        $Visible_Value="Евро";
        break;
   case null:
   break;
}
 ?>
<img class="head" alt="" src="./styles/image.jpg"></img>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet"> 
<link href="./styles/styles.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
   <title>Converter</title>
</head>
<body>
 <div class="main"> 
<div class="main_line">
   <p class="words"> <?= $usd." ".$USD_SEARCH." ".$rubles.$tab ?> <?= $CNY." ".$CNY_SEARCH." ".$rubles.$tab ?> <?= $INR." ".$INR_SEARCH." ".$rubles.$tab ?> <?= $EUR." ".$EUR_SEARCH." ".$rubles.$tab ?><?= $GBP." ".$GBP_SEARCH." ".$rubles.$tab ?> <?= $UAH." ".$UAH_SEARCH." ".$rubles?></p class="words">
</div class="main_line">
<form method="get" action="kt2.php">
 <select id="nav" name="Name_Valute">
 <option class="calc_currency_name" value="USD">Доллар США <div class="abc"> USD</div> </option>
 <option value="CHF">Швейцарский франк</option>
 <option value="CNY">Китайский юань</option>
 <option value="BYN">Белорусский рубль</option>
 <option value="SGD">Сингапурский доллар</option>
 <option value="TRY">Турецкая лира</option>
 <option value="INR">Индийская рупия</option>
 <option value="JPY">Японская иена</option>
 <option value="UAH">Украинская гривна</option>
 <option value="AUD">Австралийский доллар</option>
 <option value="GBP">Английский фунт</option>
 <option value="EUR">Евро</option>
 </select>
   <p class="mo"><?=$Visible_Value ?> в Российских рублях: <?= round($Searching_Value,2) ?></p>
<p>Введите значение: </p>
   <form action="kt2.php" method="get">
   <p>Номинал: <input class="inputt" type="number" min="0.00" name="usd" value="1"></p>
   <input class="input" type="submit" value="КОНВЕРТИРОВАТЬ" name="go">
   </form>
   <p class="itog">Итог: <?= $Value_in_RUB ?>руб</p>
</div>
</body>
</html>

