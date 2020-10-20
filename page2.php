<?php
require_once("fonctions.php");

if(isset($_POST['Solution'])){
	session_start();
			$_SESSION['cout']=$_POST['cout'];
			$_SESSION['val']=$_POST['val'];
			$_SESSION['signe']=$_POST['signe'];
			$_SESSION['Solution']=$_POST['Solution'];
	$x=0;
	for($i=0;$i<=$_SESSION['cont']-1;$i++){
		if($_SESSION['signe'][$i] == "<="){
		$x++;
		}		
	}
	if($x==$_SESSION['cont']){
		if($_SESSION['but']=="maximisation") redirect_to("maximisation.php");
		else redirect_to("minimisation.php");
	}
	else redirect_to("page3.php");
	
}
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

		<title>Modèle linéaire</title>
		
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

			<div class="jumbotron" style="text-align: left; padding-left: 20px; padding-right: 20px;">
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
					  <h3 class="panel-title">Modèle linéaire</h3>
					</div>
					<div class="panel-body">
					  <div id="Content-Tag">			 
						<div class="col-md-12" style="text-align:left">
							<?php
									if(isset($_POST['Continuer']))
									{
									session_start();
									$_SESSION['cont']=$_POST['cont'];
									$_SESSION['var']=$_POST['var'];
									$_SESSION['but']=$_POST['but'];
									echo'<label>Entrez les donnees de votre modele lineaire</label><br/><br/>';
									echo'<form action="page2.php" method="post" >'; 
												
									for($i=1;$i<=$_POST['var'];$i++){
										if($i==1){
										echo'<label>la fonction objectif :  Z = </label>';
										}
										if($i!=$_POST['var']){
										 echo'<input type="text" size="2" name="cout[]" />'; echo "X".$i."+"; 
										}
										else{
										 echo'<input type="text" size="2" name="cout[]" />'; echo "X".$i ;
										}
									}
									echo"<br />";

									echo'<br/><label>Les contraintes sont:</label><br/>';
									for($j=1;$j<=$_POST['cont'];$j++)
									{
										for($i=1;$i<=$_POST['var'];$i++)
										{
											if($i!=$_POST['var']){
											 echo'<input type="text" size="2" name="val[]" >'; echo "X".$i."+"; 
											}
											else{
											 echo'<input type="text" size="2" name="val[]" >'; echo "X".$i;
											 echo'<select name="signe[]">
													<option value=">=" > >= </option>
													<option value="<=" selected> <= </option>
													<option value="=" > = </option>
													</selected>';
											 echo " ";
											 echo'<input type="text" size="2" name="val[]" >';
											 echo"</br><br/>";
											}				 
										}
									}
									for($i=1;$i<=$_POST['var'];$i++) echo "x".$i.">=0"." ; ";
									echo'<br/><br/><br/><input type="submit" class="btn btn-sm btn-info"  value="SOLUTION" name="Solution">';
									echo'<form />';
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