<?php
$users = getData();
$joueurs = []; $scores = [];
for($i=0; isset($users[$i]); $i++){
    if($users[$i]['profil']=='joueur'){
        //on recupère tous les joueurs d'abord
        $joueurs[] = $users[$i];
        // on recupère ensuite tous les score des joueurs
        $scores[] = $users[$i]['score'];
    }
}
arsort($scores); //on ordonne les scores dans le sens décroissant
$idDecroissant = [];
foreach($scores as $key => $val){
    $idDecroissant[] = $key;
}
define("NBRVALEURPARPAGE",1);
$TOTALVALEUR = count($joueurs);
$nbrPage = ceil( $TOTALVALEUR/NBRVALEURPARPAGE);

if (!isset($_GET['joueurs'])) 
{
    $pageActuelle = 1;
}
else
{
    $pageActuelle = $_GET['joueurs'];
    if($pageActuelle>=$nbrPage){
        $pageActuelle=$nbrPage;
    }elseif($pageActuelle<=1){
        $pageActuelle=1;
    }
}
 $min = ( $pageActuelle - 1) * NBRVALEURPARPAGE;
 $max = $min + NBRVALEURPARPAGE;
?>
<style>
    table{
        width: 100%
    }
    th{
        text-align: left;
        color:deepskyblue
    }
    td,th{
        padding:.5em
    }
    #navigation{
        width: 100%;
        display:flex;
        justify-content: space-around;
    }
</style>
<div class="middle">
      <p>liste des joueurs par score </p>
<div class="gamerscore">
    <table>
        <tr>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Score</th>
        </tr>
        <?php
            if($pageActuelle!=$nbrPage){
                for($i =$min; $i < $max; $i++)
                {
            ?>
            <tr>
                <td><?= $joueurs[$idDecroissant[$i]]['prenom'] ?></td>
                <td><?= $joueurs[$idDecroissant[$i]]['nom'] ?></td>
                <td><?= $joueurs[$idDecroissant[$i]]['score'] ?></td>
            </tr>
            <?php
                }
        }else{
            for($i =$min; isset($joueurs[$i]); $i++)
                {
            ?>
            <tr>
                <td><?= $joueurs[$idDecroissant[$i]]['prenom'] ?></td>
                <td><?= $joueurs[$idDecroissant[$i]]['nom'] ?></td>
                <td><?= $joueurs[$idDecroissant[$i]]['score'] ?></td>
            </tr>
            <?php
                }
        }
        ?>
    </table>
</div>

<div id="navigation">
    <button type="submit" class="nav" name="btn_submit" id="" value=""><a href="index.php?lien=accueil&page=joueur&joueurs=<?= $pageActuelle-1 ?>" class="dec">Précédent</a></button>
    <button type="submit" class="nav" name="btn_submit" id="" value=""><a href="index.php?lien=accueil&page=joueur&joueurs=<?= $pageActuelle+1 ?>" class="dec">Suivant</a></button>
</div>  

</div>        
 
     
          
          


              
              
         



 
