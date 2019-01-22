<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  
                  <div class="row">
                    <div class="col">
                      <h4 class="card-title "><?= lang('Form.data')?></h4>
                      <p class="card-category"> <?= lang('Form.company')?></p>
                    </div>
                    <div class="col">
                      <div class="text-right">
                        <!-- <button type="button" rel="tooltip" class="btn btn-primary btn-round btn-fab" title="index" onclick="window.location.href='<?= base_url('mcompany');?>'">
                          <i class="material-icons">list</i>
                        </button> -->
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body">                 
                  <form method = "post" action = "<?= base_url('mcompany/addsave');?>">
                    <input hidden id = "companyid" name = "companyid" value = "<?= $model->Id?>">
                    <div class="form-group">
                      <label><?= lang('Form.name')?></label>
                      <input id="named" type="text"  class="form-control" name = "named" value="<?= $model->CompanyName?>" required>
                    </div>
                    <div class="form-group">       
                      <label><?= lang('Form.address')?></label>
                      <textarea id="address" type="text" class="form-control" name = "address" ><?= $model->Address?></textarea>
                    </div>
                    <div class="form-group">
                      <label><?= lang('Form.postcode')?></label>
                      <input id="postcode" type="text"  class="form-control" name = "postcode" value="<?= $model->PostCode?>">
                    </div>
                    <div class = "row">
                      <div class="col-sm-4">
                        <div class="form-group">       
                          <label><?= lang('Form.email')?></label>
                          <input id="email" type="email" class="form-control" name = "email" value = "<?= $model->Email?>" required>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">       
                          <label><?= lang('Form.telephone')?></label>
                          <input id="phone" type="text" class="form-control" name = "phone" value = "<?= $model->Phone?>" required>
                        </div>
                      </div>
                      <div class="col-sm-4">
                      <div class="form-group">       
                          <label><?= lang('Form.fax')?></label>
                          <input id="fax" type="text" class="form-control" name = "fax" value = "<?= $model->Fax?>">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">       
                      <input type="submit" value="<?= lang('Form.save')?>" class="btn btn-primary">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

 

<script>
  $(document).ready(function() {    
    init();
  });

 

  function init(){
  }

</script>