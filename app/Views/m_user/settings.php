<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  
                  <div class="row">
                    <div class="col">
                      <h4 class="card-title "><?= lang('Form.usersetting')?></h4>
                    </div>
                    <div class="col">
                    </div>
                  </div>
                </div>
                <div class="card-body">                 
                  <form method = "post" action = "<?= base_url('savesettings');?>">
                    <input hidden id = "languageid" name = "languageid" type="text">
                    <input hidden id = "rowperpage" name = "rowperpage" type="text">
                    <div class="form-group">
                      <div class = "row">
                          <label class="col-sm-2 col-form-label"><?= lang('Form.language')?></label>
                          <div class="col-sm-10">
                            <select id = "language" name ="language" class="selectpicker" data-style="select-with-transition" title ="<?= $_SESSION[getSessionVariable_config()['languages']]['Name']?>" >
                              <?php 	
                              foreach (\App\Entities\G_language_entity::listAll() as $value)
                              { 
                              ?>
                                <option value ="<?= $value->Id?>"><?= $value->Name?></option>
                              <?php 
                              }
                              ?>
                            </select>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">    
                      <div class = "row">
                        <label class="col-sm-2 col-form-label label-checkbox"><?= lang('Form.color')?></label>
                        <div class="col-sm-10 checkbox-radios">
                          <?php 	
                          $i=1;
                          foreach (\App\Entities\G_color_entity::listAll() as $value)
                          { 
                            $option = "option~".$value->Id;
                          ?>
                            <div class="form-check form-check-inline">
                              <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="radiocolor" id="exampleRadios1" value="<?= $option?>" 
                                  <?php if($_SESSION[getSessionVariable_config()['usersettings']]['G_Color_Id'] == $value->Id){
                                  ?>
                                    checked
                                  <?php
                                  }?>
                                > 
                                <div style = "color : <?= $value->Value?>"><?= $value->Name?></div>
                                <span class="circle">
                                  <span class="check"></span>
                                </span>
                              </label>
                            </div>
                          <?php 
                          $i++;
                          }
                          ?>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class = "row">
                          <label class="col-sm-2 col-form-label"><?= lang('Form.rowperpage')?></label>
                          <div class="col-sm-10">
                            <select id = "rowpage" name ="rowpage" class="selectpicker" data-style="select-with-transition" title ="<?= $_SESSION[getSessionVariable_config()['usersettings']]['RowPerpage']?>" >
                              <option value ="5">5</option>
                              <option value ="10">10</option>
                              <option value ="15">15</option>
                              <option value ="20">20</option>
                            </select>
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
    $("#language").val("<?= $_SESSION[getSessionVariable_config()['languages']]['Name']?>");
    $("#languageid").val("<?= $_SESSION[getSessionVariable_config()['languages']]['Id']?>");
    $("#rowperpage").val("<?= $_SESSION[getSessionVariable_config()['usersettings']]['RowPerpage']?>");
    console.log("<?= $_SESSION[getSessionVariable_config()['usersettings']]['G_Color_Id']?>")
  });

  function init(){
    
  }
  
  $("#language").on("change", function(e){
    var data = $(this).children("option:selected").val();
    $("#languageid").val(data);
  });

  $("#rowpage").on("change", function(e){
    var data = $(this).children("option:selected").val();
    $("#rowperpage").val(data);
  });

</script>