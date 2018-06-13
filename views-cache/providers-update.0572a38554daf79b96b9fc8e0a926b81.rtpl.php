<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Lista de Fornecedores
          </h1>
        </section>
        
        <!-- Main content -->
        <section class="content">
        
          <div class="row">
              <div class="col-md-12">
                  <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Editar Fornecedor</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="/admin/providers/<?php echo htmlspecialchars( $provider["idprovider"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post" enctype="multipart/form-data">
                  <div class="box-body">                      
                         <div class="form-group">
                          <label for="provider">Nome dos Fornecedores</label>
                          <input type="text" class="form-control" id="provider" name="provider" value="<?php echo htmlspecialchars( $provider["provider"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                        </div>
                  </div>
                  <div class="box-body">                      
                         <div class="form-group">
                          <label for="cnpj">CNPJ</label>
                          <input type="text" class="form-control" id="cnpj" name="cnpj" value="<?php echo htmlspecialchars( $provider["cnpj"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                        </div>
                  </div>
                  <div class="box-body">                      
                         <div class="form-group">
                          <label for="address">Endereço</label>
                          <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars( $provider["address"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
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