<html>
<head>
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="registrar.css" rel="stylesheet">
</head>
<body>
      <script src="http://code.jquery.com/jquery-1.12.3.js"></script>
  <script type="text/javascript" src="http://www.clubdesign.at/floatlabels.js"></script>

<div class="container">
        <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<h3 class="panel-title">Entre seus dados de cadastro</h3>
			 			</div>
			 			<div class="panel-body">
			    		<form role="form" id="formulario">
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			                <input type="text" name="first_name" id="first_name" class="form-control input-sm floatlabel" placeholder="Nome" required="true">
			    					</div>
			    				</div>

			    			</div>

			    			<div class="form-group">
			    				<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email" type="email" required="true">
			    			</div>

			    			<div class="form-group">
  			    			<input type="text" name="cnpj" id="cnpj" class="form-control input-sm" placeholder="CNPJ"  required="true">
                </div>


			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="password" name="password" id="password" class="form-control input-sm" placeholder="Senha" required="true">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-sm" placeholder="Confirmar senha" required="true">
			    					</div>
			    				</div>
			    			</div>

                <div class="row">
                  <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                      <input type="password" name="password" id="password_adm" class="form-control input-sm" placeholder="Senha de admministrador" required="true">
                    </div>
                  </div>
                  <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                      <input type="password" name="password_adm_confirmation" id="password_adm_confirmation" class="form-control input-sm" placeholder="Confirmar senha de administrador" required="true">
                    </div>
                  </div>
                </div>

			    			<input type="submit" value="Register" class="btn btn-info btn-block">

			    		</form>
			    	</div>
	    		</div>
    		</div>
    	</div>
    </div>
    <script src="node_modules/gerador-validador-cpf/dist/js/CPF.js"></script>
    <script src="registrar_editora.js"></script>
</body>
</html>
