<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Lista de Produtos
  </h1>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Editar Produto</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/admin/products/<?php echo htmlspecialchars( $product["idproduct"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post" enctype="multipart/form-data">
          <div class="box-body">
              <div class="form-group">
                  <label for="drugname">Nome do Medicamento</label>
                  <input type="text" class="form-control" id="drugname" name="drugname" value="<?php echo htmlspecialchars( $product["drugname"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"placeholder="Digite o nome do medicamento">
                </div>
                <div class="form-group">
                  <label for="barcode">Codigo de Barra</label>
                  <input type="text" class="form-control" id="barcode" name="barcode" value="<?php echo htmlspecialchars( $product["barcode"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" placeholder="Codigo de barra">
                </div>
                <div class="form-group">
                  <label for="msregistry">Registro MS</label>
                  <input type="number" class="form-control" id="msregistry" name="msregistry" value="<?php echo htmlspecialchars( $product["msregistry"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" placeholder="Registro MS">
                </div>
                <div class="form-group">
                  <label for="price">Preço</label>
                  <input type="number" class="form-control" id="price" name="price" step="0.01" value="<?php echo htmlspecialchars( $product["price"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" placeholder="0.00">
                </div>
                <div class="checkbox">
                    <label>
                      <input type="checkbox" name="recipe" value="1"<?php if( $product["recipe"] == 1 ){ ?>checked<?php } ?>> Receita
                    </label>
                </div>           
                <div class="form-group">
                  <label for="discount">Desconto</label>
                  <input type="number" class="form-control" id="discount" name="discount" step="0.01" value="<?php echo htmlspecialchars( $product["discount"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" placeholder="0.00">
                </div>
                 <div class="form-group">
                  <label for="laboratory">Laboratóio</label>
                  <input type="text" class="form-control" id="laboratory" name="laboratory" value="<?php echo htmlspecialchars( $product["laboratory_idlaboratory"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                </div>
          </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Salvar</button>
          </div>
        </form>
      </div>
  	</div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
document.querySelector('#file').addEventListener('change', function(){
  
  var file = new FileReader();

  file.onload = function() {
    
    document.querySelector('#image-preview').src = file.result;

  }

  file.readAsDataURL(this.files[0]);

});
</script>