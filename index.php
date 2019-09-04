<?php require_once 'config.php'; ?>
<?php require_once DBAPI; ?>
<?php include(HEADER_TEMPLATE); ?>

<?php $db = open_database(); ?>

<?php if ($db) : ?>
<div class="alert alert-success" style="display: none">Dados enviados com sucesso. Aguarde enquanto o download começa...</div>
<div class="d-flex justify-content-center align-items-center container "> 
  
  <div class="row">
      <form name="form_name" enctype="multipart/form-data" method="post" action="customers/add.php" id="form_index">
       
       <div class="col form-group" >
          <input class="form-control" placeholder="email@exemplo.com" width="10%" id="email" type="email" required name="customer['email']">
          <small id="emailHelp" class="form-text text-muted">Insira o email do destinário</small>
        </div>

       <div class="col form-group">
         <div class="custom-file" id="customFile" lang="pt-br">
         <input type="file" class="custom-file-input" id="input_file" aria-describedby="fileHelp" name="input_file" required>
         <label class="custom-file-label" for="exampleInputFile">Selecionar arquivo</label>
       </div>
    </div>
          <div class="d-flex justify-content-center container" style="height:25px;">
          <small id="alert_id" class="alert_class"></small>
          </div>
   <div id="actions" >
    <div class="d-flex justify-content-end container">
      <button id="submit_id" value="submit" type="submit" class="btn btn-light btn-sm btn-block">Enviar</button>
    </div>
  </div>
</form>
</div>
</div>


<?php else : ?>
	<div class="alert alert-danger" role="alert">
		<p><strong>ERRO:</strong> Não foi possível Conectar ao Banco de Dados!</p>
	</div>

<?php endif; ?>

<?php include(FOOTER_TEMPLATE); ?>