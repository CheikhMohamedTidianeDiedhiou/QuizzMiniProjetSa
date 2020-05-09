
<?php
is_connect();
$connectedUser = getData()[$_SESSION['id']];

$questionNumber = $question = $checkbox = [];
define("NBRVALPARPAGE",1);
$totalval = count($questionNumber);
$nPage = ceil( $totalval/NBRVALPARPAGE);

if (!isset($_GET['questionNumber'])) 
{
    $pageActu = 1;
}
else 
{
    $pageActu = $_GET['questionNumber'];
    if($pageActu>=$nPage){
        $pageActu=$nPage;
    }elseif($pageActu<=1){
        $pageActu=1;
    }
}
 $iD = ( $pageActu - 1) * NBRVALPARPAGE;
 $iF = $iD + NBRVALPARPAGE;
?>
<style>
 #navigation
     {
        position: relative; 
        width: 100%;
        display:flex;
        top: 11.7rem;
        justify-content: space-around
    }
    input
    {
        position: relative;
        width: 2rem;
        height: 2rem;
        margin-left: 8rem;
        top: 6.2rem;
    }
    label
    {
        position: relative;
        top: 6rem;
        text-transform: uppercase;
        font-weight: bold;
        font-size: 2rem 
    }
   /* .nav1
   {
       left: 3rem
   }  */
</style>


<div class="wrapper">
    <div class="wrapper-header">
        <img src="<?php echo $connectedUser['photo'];?>" class="picture-form" style="float:left; width:66px; height:66px; border-color:#fff">
        <div class="up-title" style="padding: 20px; font-size: 23px;"><?php echo $texte;?></div>
        <div>
        <div><a href="index.php?statut=logout" class="btn-position deconnexion" style=" top: -85px;">Deconnexion</a></div>
        </div>
        </div>
     <div class="wrapper-body">
      <div class="interface">
          <div class="ask">
              <div class="ask-side"><h4>Question<?php echo $questionNumber;?>:</h4><br><p></p></div>
              <div class="ask-value">4pts</div>
          
              <input type="checkbox" id="" name="">
              <label for=""></label>
          <br>
          
              <input type="checkbox" id="" name="">
              <label for=""></label>
          <br>
         
          
              <input type="checkbox" id="ask" name="">
              <label for="ask"></label>
         
          <div id="navigation">
              <button type="submit" class="nav" name="btn_submit" id="" value=""><a href="index.php?lien=jeux" class="dec">Précédent</a></button>
              <button type="submit" class="nav" name="btn_submit" id="" value=""><a href="index.php?lien=jeux" class="dec">Suivant</a></button>
          </div> 
          <div class="under"><div class="score"></div></div> 
     </div>
   </div>
    </div>   
</div>




