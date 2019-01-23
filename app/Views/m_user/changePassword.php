<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  
                  <div class="row">
                    <div class="col">
                      <h4 class="card-title "><?= lang('Form.changepassword')?></h4>
                      <p class="card-category"> <?= lang('Form.user')?></p>
                    </div>
                    <div class="col">
                      <!-- <div class="text-right">
                        <button type="button" rel="tooltip" class="btn btn-primary btn-round btn-fab" title="index" onclick="window.location.href='<?= base_url('muser');?>'">
                          <i class="material-icons">list</i>
                        </button>
                      </div> -->
                    </div>
                  </div>
                </div>
                <div class="card-body">
                 
                  <form method = "post" action = "<?= base_url('saveNewPassword');?>">
                    <div class="form-group">
                      <label><?= lang('Form.oldpassword')?></label>
                      <input id="oldpassword" type="password" class="form-control" name = "oldpassword" value="<?= $model['oldpassword']?>" required>
                    </div>
                    <div class="form-group">
                      <label><?= lang('Form.newpassword')?></label>
                      <input id="newpassword" type="password" class="form-control" name = "newpassword" value="<?= $model['newpassword']?>" required>
                    </div>
                    <div class="form-group">
                      <label><?= lang('Form.confirmpassword')?></label>
                      <input id="confirmpassword" type="password" class="form-control" name = "confirmpassword" value="<?= $model['confirmpassword']?>" required>
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

<script type = "text/javascript">
$(document).ready(function() {    
    init();
  });

  function init(){
    
  }
  
</script>