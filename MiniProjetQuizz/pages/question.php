<?php
if (isset($_POST['enregistrer'])) {

    if(isset($_POST['question']))
    {
        $points=$_POST['point'];
        $type_reponse=$_POST['select'];
        if(isset($points) && $points> 1)
        {
            if(isset($type_reponse))
                  {
                  $data=file_get_contents("./data/question.json");
                  $data=json_decode($data,true);
                   $dat=array();
                   $dat['question']=$_POST['question'];
                if($type_reponse=='typ1')
                   {
                       $dat['type']='texte';
                    $dat['reponse']=$_POST['texte0'];
                    $dat['points']=$points;
                    $data[]=$dat;
                     $data=json_encode($data);
                     file_put_contents("./data/question.json",$data);
                   }
                   else if($type_reponse=="typ2")

                   {
                       $dat['type']="choix-simple";
                                $i=0; 
                                $reponse=array(); 
                                while(isset($_POST['texte'.$i]))
                                {
                                    if(isset($_POST['radio'.$i]))
                                    {
                                        $reponse['valeur']=$_POST['texte'.$i];
                                        $reponse['valide']="oui";
                                    }
                                    
                                    else
                                    {
                                        $reponse['valeur']=$_POST['texte'.$i];
                                        $reponse['valide']="non";
                                    }
                                    $dat['reponse'][]=$reponse;
                                    $i++;
                                }
                                $dat['point']=$points;
                                $data[]=$dat;
                                $data=json_encode($data);
                                file_put_contents("./data/question.json",$data);
                                
                            }
                    else if($type_reponse=="typ3")
                    {
                        $dat['type']="choix-multiple";
                                $i=0; 
                                $reponse=array();
                                while(isset($_POST['texte'.$i]))
                                {
                                    if(isset($_POST['check'.$i]))
                                    {
                                        $reponse['valeur']=$_POST['texte'.$i];
                                        $reponse['valide']="oui";
                                    }
                                    
                                    else
                                    {
                                        $reponse['valeur']=$_POST['texte'.$i];
                                        $reponse['valide']="non";
                                    }
                                    $dat['reponse'][]=$reponse;
                                    $i++;
                               
                                }
                                    $dat['point']=$points;
                                    $data[]=$dat;
                                    $data=json_encode($data);
                                    file_put_contents("./data/question.json",$data);
                                                                 
                            }
                  }
                  else{
                      echo "Choisir un type de reponse";
                  }
        }
        else{
            echo "Donner les nombre de questions a cette question";
        }
    }
    else{
        echo "Renseigner votre question";
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
    <div class="grandcadrequestion">
        <form id="formquestion" method="post">
            <div class="pa">PARAMETRER VOTRE QUESTION</div>

            <div class="cloture">

            <div class="gen">
                 <div class="group">
                    <label>Questions:</label>
                    <textarea id="ques" error="errorq" name="question"></textarea>
                    <div class="err" id="errorq"></div>
                </div>
            <div class="nb">
                <label>Nbre de Points</label>
                <input type="number" name="point" min="1" error="errorN">
                <div class="err" id="errorN"></div>
            </div>
            <div class="tp">
                <label>Type de Reponse:</label>
                <select id="type" error="errorS" name="select">
                <option value="typ0">Donnez le type de reponse</option>
                    <option value="typ1" >texte</option>
                    <option value="typ2">choix simple</option>
                    <option value="typ3">choix multiple</option>
                </select>    
                <button type="button" id="creeRep" class="creeRep" name="creeRep" ><img src="./Icones/ic-ajout-réponse.png"></button>
                <div class="err" id="errorS"></div>
            </div>
            <div class="group1" id="reponse" error="errorR">
            <div class="err" id="errorR"></div>
            </div>
            <div class="btn">
            <input type="submit" name="enregistrer" value="Enregistrer"/></div>
            </div>
            </div>
        </form>
    </div>
</body>
</html>
<script>
var bouton=document.getElementById("creeRep");
var Affichage=document.getElementById("reponse");  
 bouton.addEventListener('click', Ajout);
 
var a = document.getElementById('type');
a.addEventListener("change",function(){
 Affichage.innerHTML=" ";
 decrement();
 if (a.value!="") {
     NvelReponse();  
 }
})

 /*On initialise un compteur qui sera primordial pour nos attributs*/
 var i=0; // ICI LE COMPTEUR COMMENCE PAR ZERO

 function Ajout()
 {
   /*On recupere les options du selecte*/
   var selecteur=document.getElementById("type").value;
   var option1=document.getElementById('typ1');
   var option2=document.getElementById('typ2');
   var option3=document.getElementById('typ3');

  
 /*On cree une div dans la quel on va mettre nos element*/
        var div = document.createElement("div");
        var iddiv="div-"+i;
        div.setAttribute('id',iddiv);

        /*Maintennat on procede a la creation des inputs*/
        var texte=document.createElement("input");
        var text="texte"+i;
        texte.setAttribute('type','text');
        texte.setAttribute('id',text);
        texte.setAttribute('name',text);
        texte.style.width="71%";
        texte.style.border="blue 1px solid";

        var checkbox=document.createElement("input");
        var check="check"+i;
        checkbox.setAttribute('type','checkbox');
        checkbox.setAttribute('id',check);
        checkbox.setAttribute('name',check);

        var radio=document.createElement("input");
        var rad="radio"+i;
        radio.setAttribute('type','radio');
        radio.setAttribute('id',rad);
        radio.setAttribute('name',rad);

        var buton=document.createElement("input");
        var btn="btn"+i;
        buton.setAttribute('type','button');
        buton.setAttribute('id',btn);
        buton.setAttribute('name',btn);
        buton.setAttribute('onclick','Supp("' + iddiv + '");');
        buton.setAttribute('style', 'background-image:url("./Icones/ic-supprimer.png")');
        buton.style.width="20px";
        buton.style.height="25px";


        var label = document.createElement("input");
        var valuelabel = 'Reponse'+(i+1);
        label.setAttribute('name',valuelabel);
        label.setAttribute('type','button');
        label.setAttribute('value',valuelabel);
        label.setAttribute('id',valuelabel);
        label.setAttribute('style', 'float:left; font-weight:bold;background-color:white;border:none;margin-top:1%;width:17%;font-size:20px;text-align:left')
        
        /*generation des inputsen fonction des conditions*/
        if(selecteur=="typ1")
            {
                div.appendChild(label);
                div.appendChild(texte);
                div.appendChild(buton);
                Affichage.appendChild(div);
        }
        else if(selecteur=="typ2")
            {
     div.appendChild(label);
     div.appendChild(texte);
     div.appendChild(radio);
     div.appendChild(buton);
     Affichage.appendChild(div);
             }
        else if(selecteur=="typ3")
            {
        div.appendChild(label);
     div.appendChild(texte);
     div.appendChild(checkbox);
     div.appendChild(buton);
     Affichage.appendChild(div);
             }
i++;

 }
 function Supp(ident)
    {
        var elt = document.getElementById(ident);
        var form = elt.parentNode;
        form.removeChild(elt);   
    }
</script>
<script>
const inputs= document.getElementsByTagName("input");
for(input of inputs){
    input.addEventListener("keyup",function(e){
    if(e.target.hasAttribute("error")){
        var idDivError=input.getAttribute("error");
        document.getElementById(idDivError).innerText=""
        }     
        })
}
document.getElementById("formquestion").addEventListener("submit",function(e){
const inputs= document.getElementsByTagName("input");
      var error=false;
      for(input of inputs){
        if(input.hasAttribute("error")){
        var idDivError=input.getAttribute("error");
        if(!input.value){
            document.getElementById(idDivError).innerText="tous les champs sont obligatoires!!!"
              error=true
          }
      }
    }
    if(error){
        e.preventDefault();
        return false;
    }
  }) 
</script>

</html>