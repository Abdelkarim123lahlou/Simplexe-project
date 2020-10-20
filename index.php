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

		<title>Accueil</title>
		
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
				  	<style>
                      .panel-primary>.panel-heading {
                                     color: #222;
                                    background: #00FFFF;
                             border-color: #fff;
                                        }
                    </style>
					<div class="panel-heading">
					  <h3 class="panel-title">Algorithme du simplexe</h3>
					</div>
					<div class="panel-body">
					  <div id="Content-Tag">			 
					  
							<form action="page2.php" method="post">
							
							<div class="col-md-12" style="text-align:left">
								<table class="table">
									  <tr>
										<td><label>Quel est le nombre de variables?</label></td>
										<td><input type="text" name="var" id="var" /><span id="var_error"></span></td>
									  </tr>
									  <tr>
										<td><label>Quel est le nombre de contraintes?</label></td>
										<td><input type="text" name="cont" id="cont"/><span id="cont_error"></span></td>
									  </tr>
									  <tr>
										<td><label>Quel fonction souhaitez-vous utilisez?</label></td>
										<td><select name="but">
											<option value="maximisation">Maximisation</option>
											<option value="minimisation" selected>Minimisation</option>
										</select></td>
									  </tr>
								</table>
							</div>
								 <div style="text-align:left; padding-left: 20px;" >
									<input type="submit" class="btn btn-sm btn-info" value="Continuer" name="Continuer" id="submit" />
								 </div>
							</form>	  
				  
						</div>
				
					</div>
				  </div>
				</div><!-- /.col-sm-12 -->
			</div>
		  
			<div id="div_warnings" style="border-top: 1px solid #eee; padding-top: 15px; margin: 20px 0 40px; display: none;">	
			
				<div id="div_required" style="display: none" class="alert alert-danger">
					<strong>Champ(s) requis!</strong> Veuillez v�rifier votre saisie!
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
	 <script type="text/javascript" src="Style/Script/JScript.js"></script>
 </html>