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
		<meta name="author" content="Abdelkarim LAHLOU">
		<!--<link rel="icon" href="../../favicon.ico">-->

		<title>Résultats</title>
		
		<!-- Bootstrap core CSS -->
		<link rel="stylesheet" href="Style/CSS/Bootstrap/bootstrap.min.css">
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<link rel="stylesheet" href="Style/CSS/Bootstrap/ie10-viewport-bug-workaround.css">
		<!-- Custom Bootstrap styles for this template -->
		<link rel="stylesheet" href="Style/CSS/Bootstrap/sticky-footer.css" >
		<link rel="stylesheet" href="Style/CSS/Bootstrap/cover.css" >
		<!-- Custom styles -->
		<link rel="stylesheet" type="text/css" href="Style/CSS/stylesheet.css" />
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
					  <h3 class="panel-title">Les deux phases</h3>
					</div>
					<div class="panel-body">
					  <div id="Content-Tag">			 
						<div class="col-md-12" style="text-align:left">
							<section class="col-lg-7">
	<?php
	session_start();
	if(isset(/*$_POST['Solution']*/$_SESSION['Solution']))
    {
		$compteur=0;
	    for($i=1;$i<=$_SESSION['cont'];$i++)//compteur de nombre des signes différents de "<="
		   {
		      if($_SESSION['signe'][$i-1] != "<=")
			     {$compteur++;}
		   }
		    $tab[0][0]='simplexe';
                  for($j=1;$j<=$_SESSION['var'];$j++)
                     {
                         $tab[0][$j]="X$j";// Le nom des colonnes Xj
                     }
                  for($i=1;$i<=$_SESSION['cont'];$i++)
                     {
						$tab[0][$i+$_SESSION['var']]="e$i"; // Le nom des colonnes ei
                     }
					 $cc=1;
			      for($i=1;$i<=$_SESSION['cont'] ;$i++)
                     {
						if($_SESSION['signe'][$i-1] != "<="){
						$tab[0][$cc+$_SESSION['var']+$_SESSION['cont']]="a$i";$cc++;} // Le nom des colonnes ai					
					 }
					  
				  for($i=1;$i<=$_SESSION['cont'];$i++)
                       {
					     if($_SESSION['signe'][$i-1]== "<=")
						 {$tab[$i][0]="e$i";}// On écrit les variables de base ai
					   }
				  for($i=1;$i<=$_SESSION['cont'];$i++)
                       {
					     if($_SESSION['signe'][$i-1]!= "<=")
						 {
                         $tab[$i][0]="a$i";}// On écrit les variables de base ai
                       }
					   
                  $tab[$_SESSION['cont']+1][0]="Cj";
                  $tab[0][$_SESSION['var']+$_SESSION['cont']+$compteur+1]="B";
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
				   if($_SESSION['signe'][$i-1]== "<=")
					  {
						 if($cpt==$i+$_SESSION['var'])
							{$tab[$i][$cpt]=1;}
						 else
							{$tab[$i][$cpt]=0;}
					  }
					else  if($_SESSION['signe'][$i-1] == ">=")
							 {
							   if($cpt==$i+$_SESSION['var'])
								  {$tab[$i][$cpt]=-1;}
							   else
								  {$tab[$i][$cpt]=0;}  
							 }
					else $tab[$i][$cpt]=0;// le cas "="
				}
				
			
			for($cpt=1+$_SESSION['var']+$_SESSION['cont'];$cpt<=$compteur+$_SESSION['cont']+$_SESSION['var'];$cpt++)//affectation des colonnes ai 
				{
					if($tab[$i][0]==$tab[0][$cpt]) $tab[$i][$cpt]=1;
					else $tab[$i][$cpt]=0;
				}
			$tab[$i][$_SESSION['cont']+$_SESSION['var']+$compteur+1]=$_SESSION['val'][$k];//affectation de la colonne B
			$k++;
        }
			for($j=1;$j<=$_SESSION['cont']+$_SESSION['var']+$compteur+1;$j++)
			{
				if($j>$_SESSION['cont']+$_SESSION['var'] && $j<$_SESSION['cont']+$_SESSION['var']+$compteur+1)$tab[$_SESSION['cont']+1][$j]=1;
				else $tab[$_SESSION['cont']+1][$j]=0;
			}
		$z=0;// Creation d'un compteur des valeurs négatifs de B
        for($i=1;$i<=$_SESSION['cont'];$i++)
          {
             if($tab[$i][$_SESSION['cont']+$_SESSION['var']+$compteur+1]<0)
                {
                   $z++;
                }
          }
		
		if($z==0)
		{
					for($i=0;$i<=$_SESSION['cont']-1 ;$i++)
						{
							if($_SESSION['signe'][$i] != "<="){
								echo"<h2>Phase I</h2>";
								break;
							}
						}
					echo"<caption><h4>le premier tableau du simplexe</h4></caption>";
					echo "<br>";				  
					afficher_tab_a($tab,$compteur);
					echo"<br/>";
				
				
				for($t=0;$t<$_SESSION['cont']+$_SESSION['var']+$compteur+1;$t++)
					{
						$sum[$t]=0;
					}
					for($k=1;$k<=$_SESSION['cont']+$_SESSION['var']+$compteur+1;$k++)
					  {
						for($j=1+$_SESSION['cont']+$_SESSION['var'];$j<=$_SESSION['cont']+$_SESSION['var']+$compteur;$j++)
						{
							$tab2=explode("a",$tab[0][$j]);
							$sum[$k-1]=$sum[$k-1]+$tab[$tab2[1]][$k];
						}
					  }
					for($j=1;$j<=$_SESSION['cont']+$_SESSION['var']+$compteur+1;$j++)
					{
					$tab[$_SESSION['cont']+1][$j]=$tab[$_SESSION['cont']+1][$j]-$sum[$j-1];
					}
					echo"<caption><h4>Le vrai tableau de simplexe: </h4></caption>";
					afficher_tab_a($tab,$compteur);
					echo"<br/>";
					
					
				/*****************************************ALGO PHASE I*******************************************/
				
				
				$cpt1=0;// Creation d'un compteur qui compte le nombre des valeurs Cj negatifs
				  for($j=1;$j<=$_SESSION['var']+$_SESSION['cont']+$compteur+1;$j++)
					 {
					   if($tab[$_SESSION['cont']+1][$j]<0)
						  {$cpt1++;}
					  }
				 $r=1;
				 $konteur=0;
				  while($cpt1>=1)//determination du minimum des Cj
					{
					 $z1=$tab[$_SESSION['cont']+1][$_SESSION['cont']+$_SESSION['var']+$compteur+1];	 
				     $indice1=1;
					 
				     $min=$tab[$_SESSION['cont']+1][$indice1];
				     for($j=2;$j<=$_SESSION['var']+$_SESSION['cont']+$compteur;$j++)
					   {
					     if($tab[$_SESSION['cont']+1][$j]<$min)
						   {
						   $indice1=$j;
						   $min=$tab[$_SESSION['cont']+1][$indice1];
						   }
					   }
					 if($konteur>=3)
					  {
						   echo " Il y a une degenerescence";
						 $indice1=0;
	                    for($j=1;$j<=$_SESSION['var']+$_SESSION['cont']+$compteur;$j++)
					    {
					     if($tab[$_SESSION['cont']+1][$j]<0)
						   {
						   $indice1=$j;
						   $min=$tab[$_SESSION['cont']+1][$indice1];
						   }
						   if($indice1 != 0)   Break;
					    }
					  }
					  echo "<br>";
					  for($i=1;$i<=$_SESSION['cont'];$i++)
						  {
							if($tab[$i][$indice1]<=0)
							   {
								 $ratio[$i]="infini";
							   }
							else{
								   $ratio[$i]=$tab[$i][$_SESSION['cont']+$_SESSION['var']+$compteur+1]/$tab[$i][$indice1];
								}
						  }
					  $i=1;

					  while(($i<=$_SESSION['cont'])  && (gettype($ratio[$i])=="string"))
						  {
							   $i++;
						  }
					  if($i==1+$_SESSION['cont']) //Condition d'arrêt
						 {
							echo "Ce modele n'est pas borne";
							$r=0;
						   break;
						  }
					  $indice=$i;
					  $min=$ratio[$indice];

					  for($i=2;$i<=$_SESSION['cont'];$i++) //Determination du min des ratios
						 {
							 if(($ratio[$i]!="infini")  &&  ($ratio[$i]<$min))
								{
									$indice=$i;
									$min=$ratio[$i];						 
								}
						 }
					  echo "<caption><h4>le tableau de simplexe  avec le pivot = ".sprintf("%.2f",$tab[$indice][$indice1])."</h4></caption>"; // affichage du tableau avec pivot
					  echo'<table border="5" class="table table-bordered table-striped tablecondensed">';
					  //$tab[$_SESSION['cont']+1][$_SESSION['cont']+$_SESSION['var']+1]=somme($tab);
					  for($i=0;$i<=$_SESSION['cont']+1;$i++)
						 {
						  if($i==$indice)
							 {echo"<tr style='background:lightgreen'>";}
						  else
							 {echo'<tr>';}
						  for($j=0;$j<=$_SESSION['cont']+$_SESSION['var']+$compteur+1;$j++)
							 {
							   if($j==$indice1)
								  {
									if($i==0 || $j==0)
										{echo"<td  style='width:40px; background:lightgreen'>";echo $tab[$i][$j];echo"</td>";}
									else
										{echo"<td  style='width:40px; background:lightgreen'>";echo sprintf("%.2f",$tab[$i][$j]);echo"</td>";}
								  }
							   else
								  {
									if($i==0 || $j==0)
										{
											echo"<td  style='width:40px;'>";echo $tab[$i][$j];echo"</td>";
										}
									else
										{echo"<td  style='width:40px;'>";echo sprintf("%.2f",$tab[$i][$j]);echo"</td>";}
								  }
							 }
						  echo'</tr>';
						 }
						echo'</table>';
						$tab[$indice][0]=$tab[0][$indice1];
						$tab3=$tab;
						for($j=1;$j<=$_SESSION['cont']+$_SESSION['var']+$compteur+1;$j++)
							{
							   $tab[$indice][$j]=$tab[$indice][$j]/$tab3[$indice][$indice1];
							}
						for($i=1;$i<=$_SESSION['cont']+1;$i++)
							{
							   if($i!=$indice)
								   {
									  $tab[$i][$indice1]=0;
								   }
							}
						for($i=1;$i<=$_SESSION['cont']+1;$i++)//Calcul des autres elements
						   {
							 if($i!=$indice)
								{
								  for($j=1;$j<=$_SESSION['cont']+$_SESSION['var']+$compteur+1;$j++)
										{

										  if($j!=$indice1)
											   {
												 $tab[$i][$j]=(($tab3[$i][$j]*$tab3[$indice][$indice1])-($tab3[$i][$indice1]*$tab3[$indice][$j]))/$tab3[$indice][$indice1];
											   }
										}
								}
							}
							echo "<br/>";
							echo "<caption><h4>le tableau de simplexe suivant</h4></caption>";
						 	afficher_tab_a($tab,$compteur);
						if(Blande($tab,$_SESSION['cont']+$_SESSION['var']+$compteur+1,$z1))
						  {
							$konteur++;
						  }
							echo"<br/>";
							
							$cpt1=0;
							for($j=1;$j<=$_SESSION['var']+$_SESSION['cont']+$compteur;$j++)
								{
								  if($tab[$_SESSION['cont']+1][$j] <0)
									  {$cpt1++;}
								}
							 $r=1;
					}
					
					
		/*********************************************************PHASE II************************************************/

				
			if($tab[$_SESSION['cont']+1][$_SESSION['var']+$_SESSION['cont']+$compteur+1]==0)
			{
				for($i=0;$i<=$_SESSION['cont']+1;$i++)
				{
					$tab[$i][$_SESSION['var']+$_SESSION['cont']+1]=$tab[$i][$_SESSION['cont']+$_SESSION['var']+$compteur+1];
				}
				
				for($i=0;$i<=$_SESSION['var']-1;$i++) // affectation des couts des var
				{
					$tab[$_SESSION['cont']+1][$i+1]=$_SESSION['cout'][$i];
				}
				
				$tab[$_SESSION['cont']+1][$_SESSION['cont']+$_SESSION['var']+1]=somme($tab);//la case Z
					
				echo"<h2>Phase II</h2>";
				echo"<caption><h4>le premier tableau du simplexe</h4></caption>";
				afficher_tab($tab);
				echo"<br/>";
					
					for($i=1;$i<=$_SESSION['cont'];$i++)
					{
						if(substr_count($tab[$i][0],"X")!=0)
						{
							$t=explode('X',$tab[$i][0]);
							if($tab[$_SESSION['cont']+1][$t[1]]!=0)
							{
								$a=$tab[$_SESSION['cont']+1][$t[1]];
								for($j=1;$j<=$_SESSION['cont']+$_SESSION['var'];$j++)
								{
									$tab[$_SESSION['cont']+1][$j]=$tab[$_SESSION['cont']+1][$j]-($a*$tab[$i][$j]);
								}
							}
							
						}
						if(substr_count($tab[$i][0],"e")!=0)
						{
							$t=explode('e',$tab[$i][0]);
							if($tab[$_SESSION['cont']+1][$t[1]+$_SESSION['var']]!=0)
							{
								$a=$tab[$_SESSION['cont']+1][$t[1]+$_SESSION['var']];
								for($j=1;$j<=$_SESSION['cont']+$_SESSION['var'];$j++)
								{
									$tab[$_SESSION['cont']+1][$j]=$tab[$_SESSION['cont']+1][$j]-($a*$tab[$i][$j]);
								}
							}
							
						}
					}
					echo"<caption><h4>le vrai tableau du simplexe</h4></caption>";
					afficher_tab($tab);
					echo"<br/>";					
		
		
		
					/***********************************************MINIMISATION*************************************************/
			
			
					if($_SESSION['but'] == "minimisation")
					{				
						minimisation($tab);
					}
					
					
					/***********************************************MAXIMISATION*************************************************/
					
					
					else
					{						
						maximisation($tab);
					}
			}
			else
			{
				echo "pas de solution pour ce probleme";
			}
					
		}
		else
		{
			echo "c'est un problème non borné";
		}
	
	}
	?>
							</section>
				  
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