<?php 
  require_once('functions.php'); 
  edit();
?>

<?php include(HEADER_TEMPLATE); ?>

<h4>Atualizar arquivo</h4>

<form action="edit.php?id=<?php echo $customer['id']; ?>" method="post">
  <hr />
  <div class="row">
    <div class="form-group col-md-7">
      <label for="name">Email</label>
      <input type="text" class="form-control" name="customer['email']" value="<?php echo $customer['email']; ?>">
    </div>

    <div class="col form-group col-md-7">	      
          <label for="campo3">Arquivo</label>	      
          <input type="text" class="form-control" name="customer['input_file']" value="<?php echo $customer['input_file']; ?>" disabled>	    
      </div>
      
      <div class="col form-group col-md-7">	      
          <label for="campo3">Data de Cadastro</label>	      
          <input type="text" class="form-control" name="customer['created']" value="<?php echo $customer['created']; ?>" disabled>	    
      </div>
  </div>
  <div id="actions" class="row">
    <div class="col-md-12">
      <button type="submit" class="btn btn-primary">Salvar</button>
      <a href="index.php" class="btn btn-default">Cancelar</a>
    </div>
  </div>
</form>

<?php include(FOOTER_TEMPLATE); ?>