<?php
	require_once("fonctions.php");
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF_8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="Projet ... ">
		<meta name="author" content="LAHLOU Abdelkarim">
		<!--<link rel="icon" href="../../favicon.ico">-->

		<title>Maximisation</title>
		
		<!-- Bootstrap core CSS -->
		<link rel="stylesheet" href="Style/CSS/Bootstrap/bootstrap.min.css">
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<link rel="stylesheet" href="Style/CSS/Bootstrap/ie10-viewport-bug-workaround.css">
		<!-- Custom Bootstrap styles for this template -->
		<link rel="stylesheet" href="Style/CSS/Bootstrap/sticky-footer.css" >
		<link rel="stylesheet" href="Style/CSS/Bootstrap/cover.css" >
		<!-- Custom styles -->
		<link rel="stylesheet" type="text/css" href="Style/CSS/stylesheet.css" />
		<link href="assets/css/bootstrap.css" rel="stylesheet">
<link href="assets/css/bootstrap-theme.min.css" rel="stylesheet">
		<!-- Custom Scripts -->
		<script type="text/javascript" src="Style/Script/jquery-1.11.3.min.js"></script>
		
		
	</head>
	<body class="site-wrapper">
		
		
	
	  <div class="site-wrapper-inner">
        <div class="cover-container">

			<div class="jumbotron" style="text-align: left; padding-left: 20px;">
				<h1>Projet SIMPHP</h1>
				<p style="font-size: 15px; color:#777;">Ce projet consiste à développer une application en PHP permettant de faire la simulation de l'algorithme du Simplexe qui sert à la  résolution des problèmes d'optimisation linéaire. 
				<Br/>
				Elle calcule en chaque sommet la valeur de la fonction objectif et prendre le sommet ou cette dernière est la plus optimale.</p>
			</div>

	  
	        <div class="page-header">
				
			</div>
			
			<div class="row">
				<div class="col-sm-12">
				  <div class="panel panel-primary">
					<div class="panel-heading">
					  <h3 class="panel-title">Maximisation</h3>
					</div>
					<div class="panel-body">
					  <div id="Content-Tag">			 
						<div class="col-md-12" style="text-align:left">
	<?php
	session_start();
	if(isset(/*$_POST['Valider']*/$_SESSION['Solution']))
    {
		/*********************************************/
		/*    AFFECTATION DES VALEURS AU TABLEAU     */
		/*********************************************/
        $k=0;
        for($i=1;$i<=$_SESSION['cont'];$i++)
        {
			for($j=1;$j<=$_SESSION['var'];$j++)
            {
              $tab[$i][$j]=$_SESSION['val'][$k];//affectation des valeurs au tableau
              $k++;
            }

			for($cpt=1+$_SESSION['var'];$cpt<=$_SESSION['cont']+$_SESSION['var'];$cpt++)//affectation des colonnes ei
            {
              if($cpt==$i+$_SESSION['var'])
                  {$tab[$i][$cpt]=1;}
              else
                  {$tab[$i][$cpt]=0;
                   }
            }
            $tab[$i][$_SESSION['cont']+$_SESSION['var']+1]=$_SESSION['val'][$k];//affectation de la colonne B
               $k++;
        }
		for($i=1;$i<=$_SESSION['cont']+1;$i++) //affectation des couts des ei=0
		{
			$tab[$_SESSION['cont']+1][$i+$_SESSION['var']]=0;
		}
		for($i=0;$i<=$_SESSION['var']-1;$i++) // affectation des couts des var
		$tab[$_SESSION['cont']+1][$i+1]=$_SESSION['cout'][$i];
		
		$z=0;// Creation d'un compteur des valeurs négatifs de B
		for($i=1;$i<=$_SESSION['cont'];$i++)
        {
           if($tab[$i][$_SESSION['cont']+$_SESSION['var']+1]<0)
              {
                $z++;
              }
        }
		if($z==0)
        {
			
		/*********************************************/
		/*          NOM DES COL ET LIGNES            */
		/*********************************************/
			
			$tab[0][0]='simplexe';
			  for($j=1;$j<=$_SESSION['var'];$j++)
				 {
					 $tab[0][$j]="X$j";// Le nom des colonnes Xj
				 }
			  for($i=1;$i<=$_SESSION['cont'];$i++)
				 {
				   $tab[0][$i+$_SESSION['var']]="e$i"; // Le nom des colonnes ei
				 }
			  for($i=1;$i<=$_SESSION['cont'];$i++)
				   {
					 $tab[$i][0]="e$i";// On écrit les variables de base
				   }
			  $tab[$_SESSION['cont']+1][0]="Cj";
			  $tab[0][$_SESSION['var']+$_SESSION['cont']+1]="B";
			  
			  
		/*********************************************/
		/*         DESSIN DU PREMIER TABLEAU         */
		/*********************************************/
		
			  echo'<caption><h4>le premier tableau du simplexe</h4></caption>';
			  afficher_tab($tab);	
			  
		/**********************************************/
		
			maximisation($tab);
			
		}
		else
        {
          echo "c'est un problème non borné";
        }
	}
	?> 
						</div>
					  </div>
					</div>
				  </div>
				</div><!-- /.col-sm-12 -->
			</div>
		  
			<div id="div_warnings" style="border-top: 1px solid #eee; padding-top: 15px; margin: 20px 0 40px; display: none;">	
			
				<div id="div_required" style="display: none" class="alert alert-danger">
					<strong>Champ(s) requis!</strong> Veuillez vérifier votre saisie!
				</div>
				<div id="div_alerts" style="display: none" class="alert alert-warning">
					<strong>Saisie invalide!</strong> Veuillez entrer un nombre!
				</div>
			
			</div>				
		  
        </div>
      </div>
    
		
		
		<!-- Custom Scripts
		<input id="btn" type="button" value="js" name="js" />		
		<script type="text/javascript">			
			
			
		</script>
		Custom Scripts -->
	 </body>
	 <script type="text/javascript" src="Style/Script/JScript2.js"></script>
 </html>