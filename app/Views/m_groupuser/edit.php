<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  
                  <div class="row">
                    <div class="col">
                      <h4 class="card-title "><?= lang('Form.edit_data')?></h4>
                      <p class="card-category"> <?= lang('Form.master_groupuser')?></p>
                    </div>
                    <div class="col">
                      <div class="text-right">
                        <button type="button" rel="tooltip" class="btn btn-primary btn-round btn-fab" title="index" onclick="window.location.href='<?= base_url('mgroupuser');?>'">
                          <i class="material-icons">list</i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body">                 
                  <form method = "post" action = "<?= base_url('mgroupuser/editsave');?>">
                    <input hidden name ="idgroupuser" id="idgroupuser" value="<?= $model->Id?>">
                    <div class="form-group">
                      <label><?= lang('Form.name')?></label>
                      <input id="named" type="text"  class="form-control" name = "named" value="<?= $model->GroupName?>" required>
                    </div>
                    <div class="form-group">       
                      <label><?= lang('Form.description')?></label>
                      <textarea id="description" type="text" class="form-control" name = "description" ><?= $model->Description?></textarea>
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

  });
</script>