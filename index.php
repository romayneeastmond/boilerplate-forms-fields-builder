<?php
	require_once("GeneratorModel.class.php");

	$formValues = array();
	$classStructure = array();
	$angularModelStructure = array();
	$displayErrors = false;

	if ($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$values = explode("\n", $_POST['fields']);

		if (count($values) > 0)
		{
			$displayErrors = false;
			
			foreach ($values as $value)
			{
				$parts = explode(",", $value);
				
				if (count($parts) == 4)
				{
					$temporaryValues = array($parts[0], $parts[1], $parts[2], $parts[3]);

					array_push($formValues, $temporaryValues);
					array_push($classStructure, $parts[0]);
					array_push($angularModelStructure, lcfirst($parts[0]));
				}
			}

			if (count($formValues) == 0)
			{
				$displayErrors = true;
			}
		}
		else
		{
			$displayErrors = true;
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Boilerplate - Form Fields Builder</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.3.1/styles/default.min.css" />
	<link rel="stylesheet" href="styles.css" type="text/css" />
	<link rel="icon" href="favicon.png" type="image/x-icon" sizes="48x48" />
    <link rel="shortcut icon"  href="favicon.png" type="image/x-icon" />
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>		
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js"></script>	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.3.1/highlight.min.js"></script>
	<script>hljs.initHighlightingOnLoad();</script>		
</head>

<body>
	<div class="container container-full height-100">
		<div class="row height-100">
			<div class="col-lg-4 col-md-6">
				<h1 class="h2">Form Fields Builder</h1>

				<?php if ($displayErrors == true):?>
					<div class="alert alert-danger small" role="alert">
						Uh Oh. No fields have been generated.
					</div>
				<?php endif;?>

				<form role="form" method="post">
					<div class="form-group">						
						<input type="text" id="ModuleName" name="moduleName" class="form-control" placeholder="Enter Module Name" value="<?php if (isset($_POST['moduleName'])) echo $_POST['moduleName'];?>" required />
						<small class="opacity-50">Used to describe the purpose of the fields, e.g. Contact, Company, Event, etc.</small>
					</div>			
					<div class="form-group">						
						<textarea id="Fields" name="fields" class="form-control" col="10" rows="5" placeholder="Enter Form Fields" required><?php if (isset($_POST['fields'])) echo $_POST['fields'];?></textarea>
						<small class="opacity-50">Seperate each field name with a line. Use Id, Label, Field Name, Type format.</small>
					</div>
					<input type="submit" value="Generate" class="btn btn-sm btn-secondary"	/>
				</form>
		
				<div class="highlight small mt-4">
					<h6>Examples</h6>
					
					<ol>
						<li>
							<dl>
								<dt>Normal input textbox</dt>
								<dd>FirstName, First Name, firstName, text</dd>
							</dl>
						</li>
						<li>
							<dl>
								<dt>Email input textbox</dt>
								<dd>EmailAddress, Email Address, emailAddress, email</dd>
							</dl>
						</li>
						<li>					
							<dl>					
								<dt>Checkbox</dt>
								<dd>RememberMe, Remember Me, rememberMe, checkbox</dd>
							</dl>
						</li>
						<li>					
							<dl>					
								<dt>Radio with options</dt>
								<dd>Gender, Gender, male|female, radio</dd>
							</dl>
						</li>
						<li>					
							<dl>					
								<dt>Select with options</dt>
								<dd>Province, Province, Alberta|Ontario|Quebec, select</dd>
							</dl>
						</li>				
						<li>					
							<dl>					
								<dt>Textarea</dt>
								<dd>Comments, Comments, comments, textarea</dd>
							</dl>
						</li>									
					</ol>
				</div>				
			</div>
			<div class="col-lg-8 col-md-6 right-column">
				<ul class="nav nav-tabs tabs-full" id="CodeGeneratedTabs" role="tablist">
				  <li class="nav-item">
					<a class="nav-link active" id="bootstrap-tab" data-toggle="tab" href="#bootstrap" role="tab" aria-controls="bootstrap" aria-selected="true"><i class="fab fa-bootstrap"></i> Bootstrap</a>
				  </li>
				  <li class="nav-item">
					<a class="nav-link" id="csharp-tab" data-toggle="tab" href="#csharp" role="tab" aria-controls="csharp" aria-selected="false"><i class="fas fa-code"></i> C# Class</a>
				  </li>
				  <li class="nav-item">
					<a class="nav-link" id="php-tab" data-toggle="tab" href="#php" role="tab" aria-controls="php" aria-selected="false"><i class="fab fa-php"></i> PHP Class</a>
				  </li>
				  <li class="nav-item">
					<a class="nav-link" id="angular-tab" data-toggle="tab" href="#angular" role="tab" aria-controls="angular" aria-selected="false"><i class="fab fa-angular"></i> Angular Boilerplate</a>
				  </li>	
				  <li class="nav-item">
					<a class="nav-link" id="react-tab" data-toggle="tab" href="#react" role="tab" aria-controls="react" aria-selected="false"><i class="fab fa-react"></i> React Native Boilerplate</a>
				  </li>				  				  			  
				</ul>
				<div class="tab-content" id="CodeGeneratedTabsContent">
				  <div class="tab-pane fade show active" id="bootstrap" role="tabpanel" aria-labelledby="bootstrap-tab">
					<div class="row mt-2">
						<div class="col">
						<?php if ($_SERVER['REQUEST_METHOD'] == "POST" && $displayErrors == false):
								$template = "";

								foreach ($formValues as $values)
								{
									$template .= GeneratorModel::generateBootstrapTemplate($values[0], $values[1], $values[2], $values[3], false);
								}
								
								$template = GeneratorModel::generateFormDefinition($template, $_POST['moduleName'], false);
								?>

								<div class="highlight small">
									<pre style="margin-bottom: -30px; margin-top: -50px;">
										<code class="html">
											<?php echo($template); ?>
										</code>
									</pre>
								</div>
							<?php endif;?>
						</div>
					</div>
				  </div>
				  <div class="tab-pane fade" id="csharp" role="tabpanel" aria-labelledby="csharp-tab">
				  	<div class="row mt-2">
						<div class="col">
							<?php if ($_SERVER['REQUEST_METHOD'] == "POST" && $displayErrors == false):?>
								<div class="highlight small">
									<pre style="margin-bottom: -30px; margin-top: -50px;">
										<code class="csharp">
											<?php echo(GeneratorModel::generateCSharpClass($classStructure, $_POST['moduleName'])); ?>
										</code>
									</pre>
								</div>
							<?php endif;?>
						</div>
					</div>				  
				  </div>
				  <div class="tab-pane fade" id="php" role="tabpanel" aria-labelledby="php-tab">
				  	<div class="row mt-2">
						<div class="col">
						<?php if ($_SERVER['REQUEST_METHOD'] == "POST" && $displayErrors == false):?>
								<div class="highlight small">
									<pre style="margin-bottom: -30px; margin-top: -50px;">
										<code class="php">
											<?php echo(GeneratorModel::generatePhpClass($classStructure, $_POST['moduleName'])); ?>
										</code>
									</pre>
								</div>
							<?php endif;?>
						</div>
					</div>				  
				  </div>
				  <div class="tab-pane fade" id="angular" role="tabpanel" aria-labelledby="angular-tab">
				  	<div class="row mt-2">
						<div class="col">
							<?php if ($_SERVER['REQUEST_METHOD'] == "POST" && $displayErrors == false):
								$template = "";

								foreach ($formValues as $values)
								{
									$template .= GeneratorModel::generateBootstrapTemplate($values[0], $values[1], $values[2], $values[3], true);
								}
								
								$template = GeneratorModel::generateFormDefinition($template, $_POST['moduleName'], true);
								?>

								<div class="highlight small">
									<h6>Bootstrap</h6>
									<pre style="margin-bottom: -30px; margin-top: -50px;">
										<code class="html">
											<?php echo($template); ?>
										</code>
									</pre>
								</div>							
								<div class="highlight small">
									<h6>Model</h6>
									<pre style="margin-bottom: -30px; margin-top: -50px;">
										<code class="typescript">
											<?php echo(GeneratorModel::generateAngularModel($angularModelStructure, $_POST['moduleName'])); ?>
										</code>
									</pre>
								</div>
								<div class="highlight small">
									<h6>Console Commands</h6>
									<pre style="margin-bottom: -30px; margin-top: -50px;">
										<code class="cmd">
											<?php echo(GeneratorModel::generateAngularConsoleCommands($_POST['moduleName'])); ?>
										</code>
									</pre>
								</div>
								<div class="highlight small">
									<h6><?php echo strtolower($_POST['moduleName']) ;?>-routing.module.ts</h6>
									<pre style="margin-bottom: -30px; margin-top: -50px;">
										<code class="typescript">
											<?php echo(GeneratorModel::generateAngularRouter($_POST['moduleName'])); ?>
										</code>
									</pre>
								</div>																
							<?php endif;?>
						</div>
					</div>				  
				  </div>
				  <div class="tab-pane fade" id="react" role="tabpanel" aria-labelledby="react-tab">
				  	<div class="row mt-2">
						<div class="col">
						<?php if ($_SERVER['REQUEST_METHOD'] == "POST" && $displayErrors == false):?>
								<div class="highlight small">
									<h6><?php echo ucfirst(strtolower($_POST['moduleName'])) ;?>.js</h6>
									<pre style="margin-bottom: -30px; margin-top: -50px;">
										<code class="typescript">
											<?php echo(GeneratorModel::generateReactNativeModel($formValues, $_POST['moduleName'])); ?>
										</code>
									</pre>
								</div>
								<div class="highlight small">
									<h6>index.js</h6>
									<pre style="margin-bottom: -30px; margin-top: -50px;">
										<code class="typescript">
											<?php echo(GeneratorModel::generateReactNativeIndex($_POST['moduleName'])); ?>
										</code>
									</pre>
								</div>
								<div class="highlight small">
									<h6>styles.js</h6>
									<pre style="margin-bottom: -30px; margin-top: -50px;">
										<code class="typescript">
										<?php echo(GeneratorModel::generateReactNativeStyles()); ?>
										</code>
									</pre>
								</div>
								<div class="highlight small">
									<h6>Model</h6>
									<pre style="margin-bottom: -30px; margin-top: -50px;">
										<code class="typescript">
											<?php echo(GeneratorModel::generateAngularModel($angularModelStructure, $_POST['moduleName'])); ?>
										</code>
									</pre>
								</div>																																								
							<?php endif;?>
						</div>
					</div>				  
				  </div>				  				  
				</div>			
			</div>		
		</div>
	</div>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>	
</body>
</html>