
<?php
$dataques=file_get_contents("./data/question.json");
$dataques=json_decode($dataques,true);
$_SESSION['nbre']=$dataques["Nombre"]; 
if(isset($_POST['ok'])) 
{
$nbre=$_POST['nbre'];
if(isset($nbre) && $nbre>=5){
   $_SESSION['nbre']=$nbre; 

$dataques=file_get_contents("./data/question.json");
$dataques=json_decode($dataques,true);
      $dataques=array(
          "Nombre"=>$nbre);
$dataques=json_encode($dataques);
file_put_contents("./data/question.json",$dataques);
   }else {
      $error="la valeur doit etre superieure ou égale à 5!!!";
   }
}

?>

<?php
#================== la pagination par page de 5======================================
$question = getData('questionnaire/question');
define('NBRVALEURPARPAGE',5);
$totalValeur= count($question);
$nbredePage = ceil( $totalValeur/NBRVALEURPARPAGE);

//======================cliquez un bouton=========================

if (!isset($_GET['question'])) 
{
    $pageActuelle = 1 ;
}
else{
    $pageActuelle = $_GET['question'];
    if ($pageActuelle >= $nbrdePage) 
    {
        $pageActuelle = $nbrdePage ;
    }
 elseif($pageActuelle <= 1)
    {
        $pageActuelle = 1 ;
    }
} 
$DEBUT= ($pageActuelle -1 ) * NBRVALEURPARPAGE;
$FIN= $DEBUT+ NBRVALEURPARPAGE;

 function paginationQuestion($question,$DEBUT,$FIN){
     for ($i = $DEBUT; $i < $FIN; $i++) { 
        echo $question[$i]['enonce'];
     }
 }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>
        .btn_ok{
            height:35px;

            margin-left:1px;
            border:none;
            padding:.4rem;
            background-color:blue;
            color:#fff;
           font-size: 20px;

            
            
        }
        #liste
        {
            background-color:rgb(241, 240, 215);
            float: right;
            width:55%;
            height:80%;
            margin-top: 1%;
            margin-right: 1.5%;
            border-radius: 8px;
        box-shadow: 4px 3px 4px 2px grey;
       
        }
        .nombre{
            width:60px;
            height:30px;
           border: none;
           font-size: 20px;
        text-align: center;
        font-weight: bolder;
        border:0.5px solid rgb(151, 148, 148);


        }
        .liste-header{
        margin-top: 5px;
        margin-left: 30%;
        font-size: 30px;
        color: rgb(151, 148, 148);


        }
        .cadrage{
        border:1px solid  rgb(151, 148, 148);
        width:93%;
        height:450px;
        margin-top: 6px;
        margin-left:25px;
        border-radius: 5px;
        }
        .btn-suivant{
            background-color: aqua;
            margin-left:85%;
            margin-top: 2px;
            height: 30px;
            width: 90px;
            font-size:18px;
            border-radius: 5px;
            color: #fff;
        }
    </style>


    <div id="liste">
    <div class="liste-header">Nbre de question/jeu 
        <input type="number" class="nombre" id="nombre" name="Nbre"  value="<?= $_SESSION['nbre']?>" error="errorfq" $DEBUT=5 >
        <button class="btn_ok" type="submit" onclick="my_validate()" name="ok" value="OK">OK</button>
    </div>
    <div class="cadrage">
    <?php 

#=================================AFFICHAGE=================================
   paginationQuestion($question,$DEBUT,$FIN)
?>

    </div>
    <button class="btn-suivant" type="submit" onclick="my_validate()" name="SUIVANT">SUIVANT</button>

    </div>


</body>
</html>
