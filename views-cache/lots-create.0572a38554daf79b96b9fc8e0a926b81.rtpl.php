<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Lista de Lotes
          </h1>
          <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/admin/lots/">Lotes</a></li>
            <li class="active"><a href="/admin/lots/create">Cadastrar</a></li>
          </ol>
        </section>
        
        <!-- Main content -->
        <section class="content">
        
          <div class="row">
              <div class="col-md-12">
                  <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Novo Lot</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="/admin/lots/create" method="post">
                  <div class="box-body">                  
                     <div class="form-group col-ms-6">
                      <label for="provider">Descrição</label>
                      <input type="text" class="form-control" id="description" name="description">
                    </div>
                  </div>
                  <div class="box-body">                  
                     <div class="form-group">
                      <label for="expiration_date">Data da Validade</label>
                      <input type="date" class="form-control" id="expiration_date" name="expiration_date">
                    </div>
                  </div>
                  <div class="box-body">                  
                     <div class="form-group">
                      <label for="fabrication_date">Data da Fabricação</label>
                      <input type="date" class="form-control" id="fabrication_date" name="fabrication_date">
                    </div>
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-success">Cadastrar</button>
                  </div>
                </form>
              </div>
              </div>
          </div>
        
        </section>
        <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->