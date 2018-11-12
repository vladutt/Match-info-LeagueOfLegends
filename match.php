<?php 
session_start();
require_once 'Api.php';

$api = new Api();

if(!isset($_GET['summoner']) || empty($_GET['summoner'])){
  header("Location: ./");
  exit;
}

$summoner = htmlspecialchars(mb_strtolower(str_replace(" ", "",$_GET['summoner']), 'UTF-8'));

$id = $api->getSummonerIdByName($summoner);
$game = $api->currentGame($id);

$summonerSpell = [
  '21' => 'http://ddragon.leagueoflegends.com/cdn/8.11.1/img/spell/SummonerBarrier.png',
  '1' => 'http://ddragon.leagueoflegends.com/cdn/8.11.1/img/spell/SummonerBoost.png',
  '14' => 'http://ddragon.leagueoflegends.com/cdn/8.11.1/img/spell/SummonerDot.png',
  '3' => 'http://ddragon.leagueoflegends.com/cdn/8.11.1/img/spell/SummonerExhaust.png',
  '4' => 'http://ddragon.leagueoflegends.com/cdn/8.11.1/img/spell/SummonerFlash.png',
  '6' => 'http://ddragon.leagueoflegends.com/cdn/8.11.1/img/spell/SummonerHaste.png',
  '7' => 'http://ddragon.leagueoflegends.com/cdn/8.11.1/img/spell/SummonerHeal.png',
  '11' => 'http://ddragon.leagueoflegends.com/cdn/8.11.1/img/spell/SummonerSmite.png',
  '12' => 'http://ddragon.leagueoflegends.com/cdn/8.11.1/img/spell/SummonerTeleport.png',
];

$data = [
  'gameMode' => $game['gameMode'],
  'mapId' => $game['mapId'],
  'players' => $game['participants'],
  'spell' => $spell
];

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">    <title>Bootstrap 4!</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
</head>
<body>

<section class="first-page">
<div class="container">
  <div class="row h100 d-flex justify-content-center align-items-center">

        <?php $x = 0; foreach($data['players'] as $player): $x++;?>
        
        <div class="col-md-3 col-sm-4 col-lg">
            <img src="http://ddragon.leagueoflegends.com/cdn/img/champion/loading/<?php echo $api->champions($player['championId']); ?>_0.jpg" class="img-fluid" alt="">
            <div class="text-display text-center">
                <?php echo $player['summonerName']; ?>
                <br>
                <img src="<?php echo $data['spell'][$player['spell1Id']]; ?>" width="25" alt="" srcset="">
                <span class="badge badge-info"><?php echo $api->checkRank($player['summonerId']);?></span>
                <img src="<?php echo $data['spell'][$player['spell2Id']]; ?>" width="25" alt="" srcset="">
                </div>
        </div>
        <?php if($x === 5){echo '<div class="w-100 hidden-md-down"></div>';} ?>

        <?php endforeach;?>

  </div>
</div>
</section>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>
<?php if(isset($_SESSION['alert'])){ unset($_SESSION['alert']);}?>