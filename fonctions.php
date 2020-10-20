<?php

	function redirect_to($new_location) {
		header("Location: " . $new_location);
		exit;
	}
	
	function afficher_tab($tab){
		echo'<table border="5" class="table table-bordered table-striped tablecondensed" >'; 
		for($i=0;$i<=$_SESSION['cont']+1;$i++){
			echo '<tr>';
			for($j=0;$j<=$_SESSION['var']+$_SESSION['cont']+1;$j++)
			{
				if(($i==0) || ($j==0))
				{
					echo"<td  style='width:40px;'>".$tab[$i][$j]."</td>";
				}
				else
				{
					echo"<td  style='width:40px;'>".sprintf("%.2f",$tab[$i][$j])."</td>";
				}
			}
			echo'</tr>';
		}
		echo'</table>';
	}
	function afficher_tab_a($tab,$compteur){
		echo'<table border="5" class="table table-bordered table-striped tablecondensed" >'; 
		for($i=0;$i<=$_SESSION['cont']+1;$i++)
		{
			echo '<tr>';
			for($j=0;$j<=$_SESSION['cont']+$_SESSION['var']+$compteur+1;$j++)
			{
				if(($i==0) || ($j==0))
				{
					echo"<td  style='width:40px;'>".$tab[$i][$j]."</td>";
				}
				else
				{
					echo"<td  style='width:40px;'>".sprintf("%.2f",$tab[$i][$j])."</td>";
				}
			}
			echo'</tr>';
		}
		echo'</table>';
	}
	
	function somme($tab){ 	// calcule le cout
		$k=0;
		for($j=1;$j<=$_SESSION['var'];$j++)
		{
			$t=0;
			for($i=1;$i<=$_SESSION['cont'];$i++)
			{
				if($tab[0][$j]==$tab[$i][0])
				{
					$tab3[$k]=$tab[$i][$_SESSION['var']+$_SESSION['cont']+1];
					$k++;
					$t++;
				}
			}
			if($t==0)
			{
				$tab3[$k]=0;
				$k++;
			}
		}
		$somme=0;
		for($j=0;$j<=$_SESSION['var']-1;$j++)
		{
			$somme=$somme+$tab3[$j]*(-$_SESSION['cout'][$j]);
		}
		return $somme;
	}
	
	function minimisation($tab){
	
		$cpt1=0;// Creation d'un compteur qui compte le nombre des valeurs Cj negatifs
		  for($j=1;$j<=$_SESSION['var']+$_SESSION['cont'];$j++)
			 {
			   if($tab[$_SESSION['cont']+1][$j]<0)
				  {$cpt1++;}
			  }
		 $r=1;
		 $konteur=0;
		  while($cpt1>=1)//determination du minimum des Cj
			{
			        $z1=$tab[$_SESSION['cont']+1][$_SESSION['cont']+$_SESSION['var']+1];	 
				     $indice1=1;
					 
				     $min=$tab[$_SESSION['cont']+1][$indice1];
				     for($j=2;$j<=$_SESSION['var']+$_SESSION['cont'];$j++)
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
	                    for($j=1;$j<=$_SESSION['var']+$_SESSION['cont'];$j++)
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
						   $ratio[$i]=$tab[$i][$_SESSION['cont']+$_SESSION['var']+1]/$tab[$i][$indice1];
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
			  $tab[$_SESSION['cont']+1][$_SESSION['cont']+$_SESSION['var']+1]=somme($tab);
			  for($i=0;$i<=$_SESSION['cont']+1;$i++)
				 {
				  if($i==$indice)
					 {echo"<tr style='background:lightgreen'>";}
				  else
					 {echo'<tr>';}
				  for($j=0;$j<=$_SESSION['cont']+$_SESSION['var']+1;$j++)
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
				$tab2=$tab;
				for($j=1;$j<=$_SESSION['cont']+$_SESSION['var']+1;$j++)
					{
					   $tab[$indice][$j]=$tab[$indice][$j]/$tab2[$indice][$indice1];
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
						  for($j=1;$j<=$_SESSION['cont']+$_SESSION['var']+1;$j++)
								{

								  if($j!=$indice1)
									   {
										 $tab[$i][$j]=(($tab2[$i][$j]*$tab2[$indice][$indice1])-($tab2[$i][$indice1]*$tab2[$indice][$j]))/$tab2[$indice][$indice1];
									   }
								}
						}
					}
					echo "<br/>";
					echo "<caption><h4>le tableau de simplexe suivant</h4></caption>";
					afficher_tab($tab);
					if(Blande($tab,$_SESSION['cont']+$_SESSION['var']+1,$z1))
						{
							$konteur++;
						}
					$cpt1=0;
					for($j=1;$j<=$_SESSION['var']+$_SESSION['cont'];$j++)
						{
						  if($tab[$_SESSION['cont']+1][$j] <0)
							  {$cpt1++;}
						}
					 $r=1;
			}
		if($r!=0)
		{
		  $x="(";
		  for($i=1;$i<=$_SESSION['cont'];$i++)
			 {
			  if($i==$_SESSION['cont'])
				   {
					 $x= $x.$tab[$i][0];
				   }
			  else {$x= $x.$tab[$i][0].",";}
			 }
		  $x=$x.")";
		  $B="(";
		  for($i=1;$i<=$_SESSION['cont'];$i++)
			  {
				if($i==$_SESSION['cont'])
				   {$B= $B.sprintf("%.2f",$tab[$i][$_SESSION['cont']+$_SESSION['var']+1]);}
				else{$B= $B.sprintf("%.2f",$tab[$i][$_SESSION['cont']+$_SESSION['var']+1]).",";}
			  }
		  $B=$B.")";
		  echo "<br><br>la solution de base realisable du modele lineaire : ".$x." = ".$B."<br>";
		  $k=0;
		  for($j=1;$j<=$_SESSION['var'];$j++)
			{
			   $t=0;
			   for($i=1;$i<=$_SESSION['cont'];$i++)
				  {
					if($tab[0][$j]==$tab[$i][0])
					  {
					   $tab3[$k]=$tab[$i][$_SESSION['var']+$_SESSION['cont']+1];
					   $k++;
					   $t++;
					  }

				  }
			   if($t==0)
				 {$tab3[$k]=0;
				   $k++;
				 }
			}


		   $x="(";
		   for($i=1;$i<=$_SESSION['var'];$i++)
			   {
				 if($i==$_SESSION['var'])
					{
					 $x= $x.$tab[0][$i];
					}
				 else{$x= $x.$tab[0][$i].",";}
			   }
		   $x=$x.")";


		   $B="(";
		   for($i=0;$i<=$_SESSION['var']-1;$i++)
			 {
			   if($i==$_SESSION['var']-1)
				 {$B= $B.sprintf("%.2f",$tab3[$i]);}
			   else{$B= $B.sprintf("%.2f",$tab3[$i]).",";}
			 }
		   $B=$B.")";

		   echo "<br/>";
			echo "Ansi les  coordonnees cartesiennes de la solution : ".$x." = ".$B;
			echo "<br/><br/>";
			echo "ET la solution optimale Z = ".sprintf("%.2f",-(somme($tab)));
		}
	}

	function maximisation($tab){
		$cpt1=0;// Creation d'un compteur qui compte le nombre des valeurs Cj negatifs
		  for($j=1;$j<=$_SESSION['var']+$_SESSION['cont'];$j++)
			 {
			   if($tab[$_SESSION['cont']+1][$j]>0)
				  {$cpt1++;}
			  }
		  $r=1;
		  $konteur=0;
		  while($cpt1>=1)//determination du maximum des Cj
			{
			         $z1=$tab[$_SESSION['cont']+1][$_SESSION['cont']+$_SESSION['var']+1]; 
				     $indice1=1;
					 
				     $max=$tab[$_SESSION['cont']+1][$indice1];
				     for($j=2;$j<=$_SESSION['var']+$_SESSION['cont'];$j++)
					   {
					     if($tab[$_SESSION['cont']+1][$j]>$max)
						   {
						   $indice1=$j;
						   $max=$tab[$_SESSION['cont']+1][$indice1];
						   }
					   }
					 if($konteur>=3)
					  {
						   echo " Il y a une degenerescence";
						 $indice1=0;
	                    for($j=1;$j<=$_SESSION['var']+$_SESSION['cont'];$j++)
					    {
					     if($tab[$_SESSION['cont']+1][$j]>0)
						   {
						   $indice1=$j;
						   $max=$tab[$_SESSION['cont']+1][$indice1];
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
						   $ratio[$i]=$tab[$i][$_SESSION['cont']+$_SESSION['var']+1]/$tab[$i][$indice1];
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
				 
			  echo "<br/>"; // affichage du tableau avec pivot
			  //echo '<section class="col-lg-8 table-responsive">';
			 echo "<caption><h4>le tableau de simplexe  avec le pivot = ".sprintf("%.2f",$tab[$indice][$indice1])."</h4></caption>"; 
			  echo'<table border="5" class="table table-bordered table-striped tablecondensed">';
			  $tab[$_SESSION['cont']+1][$_SESSION['cont']+$_SESSION['var']+1]=somme($tab);
			  for($i=0;$i<=$_SESSION['cont']+1;$i++)
				 {
				  if($i==$indice)
					 {echo"<tr style='background:lightgreen'>";}
				  else
					 {echo'<tr>';}
				  for($j=0;$j<=$_SESSION['cont']+$_SESSION['var']+1;$j++)
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
				//echo'</section>';
				$tab[$indice][0]=$tab[0][$indice1];
				$tab2=$tab;
				for($j=1;$j<=$_SESSION['cont']+$_SESSION['var']+1;$j++)
					{
					   $tab[$indice][$j]=$tab[$indice][$j]/$tab2[$indice][$indice1];
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
						  for($j=1;$j<=$_SESSION['cont']+$_SESSION['var']+1;$j++)
								{

								  if($j!=$indice1)
									   {
										 $tab[$i][$j]=(($tab2[$i][$j]*$tab2[$indice][$indice1])-($tab2[$i][$indice1]*$tab2[$indice][$j]))/$tab2[$indice][$indice1];
									   }
								}
						}
					}
					echo "<br/>";
					echo "<caption><h4>le tableau de simplexe suivant</h4></caption>";
					afficher_tab($tab);
					if(Blande($tab,$_SESSION['cont']+$_SESSION['var']+1,$z1))
						{
							$konteur++;
						}
					$cpt1=0;
					for($j=1;$j<=$_SESSION['var']+$_SESSION['cont'];$j++)
						{
						  if($tab[$_SESSION['cont']+1][$j] >0)
							  {$cpt1++;}
						}
					 $r=1;
			}
		if($r!=0)
		{
		  $x="(";
		  for($i=1;$i<=$_SESSION['cont'];$i++)
			 {
			  if($i==$_SESSION['cont'])
				   {
					 $x= $x.$tab[$i][0];
				   }
			  else {$x= $x.$tab[$i][0].",";}
			 }
		  $x=$x.")";
		  $B="(";
		  for($i=1;$i<=$_SESSION['cont'];$i++)
			  {
				if($i==$_SESSION['cont'])
				   {$B= $B.sprintf("%.2f",$tab[$i][$_SESSION['cont']+$_SESSION['var']+1]);}
				else{$B= $B.sprintf("%.2f",$tab[$i][$_SESSION['cont']+$_SESSION['var']+1]).",";}
			  }
		  $B=$B.")";
		  echo "<br><br>la solution de base realisable du modele lineaire : ".$x." = ".$B."<br>";
		  $k=0;
		  for($j=1;$j<=$_SESSION['var'];$j++)
			{
			   $t=0;
			   for($i=1;$i<=$_SESSION['cont'];$i++)
				  {
					if($tab[0][$j]==$tab[$i][0])
					  {
					   $tab3[$k]=$tab[$i][$_SESSION['var']+$_SESSION['cont']+1];
					   $k++;
					   $t++;
					  }

				  }
			   if($t==0)
				 {$tab3[$k]=0;
				   $k++;
				 }
			}


		   $x="(";
		   for($i=1;$i<=$_SESSION['var'];$i++)
			   {
				 if($i==$_SESSION['var'])
					{
					 $x= $x.$tab[0][$i];
					}
				 else{$x= $x.$tab[0][$i].",";}
			   }
		   $x=$x.")";


		   $B="(";
		   for($i=0;$i<=$_SESSION['var']-1;$i++)
			 {
			   if($i==$_SESSION['var']-1)
				 {$B= $B.sprintf("%.2f",$tab3[$i]);}
			   else{$B= $B.sprintf("%.2f",$tab3[$i]).",";}
			 }
		   $B=$B.")";
			//echo "<br/><br/>";
			echo "Ansi les  coordonnees cartesiennes de la solution : ".$x." = ".$B;
			echo "<br/><br/>";
			echo "ET la solution optimale Z = ".sprintf("%.2f",-(somme($tab)));
		}
	}
		function Blande($tableau,$seize,$variabletemporaire)
	{
		
			if( $tableau[$_SESSION['cont']+1][$seize]!=$variabletemporaire)
				return False;
	    	else	
			 return True;
		
	}
	
?>