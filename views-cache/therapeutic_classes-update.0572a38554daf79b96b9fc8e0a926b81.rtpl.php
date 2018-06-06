<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Lista de Laboratorio
          </h1>
        </section>
        
        <!-- Main content -->
        <section class="content">
        
          <div class="row">
              <div class="col-md-12">
                  <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Editar Classe Terapêuta</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="/admin/therapeutic_classes/<?php echo htmlspecialchars( $therapeutic_class["idtherapeutic_classes"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post" enctype="multipart/form-data">
                  <div class="box-body">                      
                         <div class="form-group">
                          <label for="therapeutic_class">Classe Terapêutica</label>
                          <input type="text" class="form-control" id="therapeutic_class" name="therapeutic_class" value="<?php echo htmlspecialchars( $therapeutic_class["therapeutic_class"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
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