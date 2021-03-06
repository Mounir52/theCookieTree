<?php

if(!strstr($_SERVER['PHP_SELF'],"index.php")){
    header("Location: ./");
}

$sql = "SELECT i.produits_id, p.categ_id, p.description, p.titre, c.types, GROUP_CONCAT(i.url SEPARATOR '|||') as iurl
    FROM produits p
    LEFT JOIN categ c
        ON c.id = p.categ_id
    LEFT JOIN img i
        ON i.produits_id = p.id
    WHERE p.categ_id = 1
      GROUP BY p.id
        ORDER BY i.produits_id ASC
    ;";

$recup_sql = mysqli_query($db, $sql)or die(mysqli_error($db));



//------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------


$sql2 = "SELECT i.produits_id, p.categ_id, p.description, p.titre, c.types, GROUP_CONCAT(i.url SEPARATOR '|||') as iurl
    FROM produits p
    LEFT JOIN categ c
        ON c.id = p.categ_id
    LEFT JOIN img i
        ON i.produits_id = p.id
    WHERE p.categ_id = 2
      GROUP BY p.id
        ORDER BY i.produits_id ASC
    ;";

$recup_sql2 = mysqli_query($db, $sql2)or die(mysqli_error($db));


?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="utf-8">
  <title>Contact</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.galerie.css">
    <link href="https://fonts.googleapis.com/css?family=Paytone+One" rel="stylesheet">
  </head>
  <body>
   <?php include_once 'menu.php'; ?>
   <div class="container">
  <div class="row">

  <section class="col-md-12">
<div class="row col-md-12">
<div class="jumbotron">
  <h2>Au dela du blé</h2>
</div>
</div>


<?php

while($gluten = mysqli_fetch_assoc($recup_sql)){

    echo " <section class='col-md-12'>";
    echo "<div class='row haha' id='galerie'>";
    echo "<div class='col-lg-3 col-md-4 col-sm-6 col-xs-12'>";


    echo "<h3>{$gluten['titre']}</h3>"; 
    echo "<h3><a href='./''>Accueil</a></h3>";
    echo "<p>{$gluten['description']}</p>";

    echo "</div>";
                    $url = explode("|||",$gluten['iurl']);
                
                    for ($i=0; $i<count($url);$i++){
                      if(empty($url[$i])){

                        echo "";

                      }else{
              echo " <div class='col-lg-3 col-md-4 col-sm-6 col-xs-12'> ";

                    echo "<img src='{$url[$i]}' class='img-responsive img-thumbnail' alt='{$gluten['titre']}' title='{$gluten['titre']}'/>";

              echo "</div>";
                }
            }
  }
      echo "</section>";
  ?>
    <!-- end of Gluten free -->
    <!-- start of Vegan -->
<div class="row col-md-12">
<div class="jumbotron">
  <h2>Vegan</h2>
</div>
</div>

<?php

while($vegan = mysqli_fetch_assoc($recup_sql2)){

    echo " <section class='col-md-12'>";
    echo "<div class='row haha' id='galerie'>";
    echo "<div class='col-lg-3 col-md-4 col-sm-6 col-xs-12'>";


    echo "<h3>{$vegan['titre']}</h3>";
    echo "<p>{$vegan['description']}</p>";

    echo "</div>";
                    $url = explode("|||",$vegan['iurl']);
                
                    for ($i=0; $i<count($url);$i++){
                      if(empty($url[$i])){

                        echo "";

                      }else{
              echo " <div class='col-lg-3 col-md-4 col-sm-6 col-xs-12'> ";

                    echo "<a class='groupe-colorbox' href='{$url[$i]}'><img class='img-responsive img-thumbnail' alt='{$vegan['titre']}' title='{$vegan['titre']}' src='{$url[$i]}'></a>";

              echo "</div>";

                }
            }
  }
      echo "</section>";
  ?>
  
     <!--End ov vegan -->
   </div>
  </body>
</html>