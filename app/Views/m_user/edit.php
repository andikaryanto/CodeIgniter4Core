      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  
                  <div class="row">
                    <div class="col">
                      <h4 class="card-title "><?= lang('Form.add_data')?></h4>
                      <p class="card-category"> <?= lang('Form.master_user')?></p>
                    </div>
                    <div class="col">
                      <div class="text-right">
                        <button type="button" rel="tooltip" class="btn btn-primary btn-round btn-fab" title="index" onclick="window.location.href='<?= base_url('muser');?>'">
                          <i class="material-icons">list</i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body">                 
                  <form method = "post" action = "<?= base_url('muser/editsave');?>">
                    <input hidden id = "userid" type="text" class="form-control" name = "userid" value="<?= $model->Id?>">
                    <input hidden id = "groupid" type="text" class="form-control" name = "groupid" value="<?= $model->M_Groupuser_Id?>">
                    <div class="form-group bmd-form-group">
                      <label class = ""><?= lang('Form.name')?></label>
                      <input id="named" type="text"  class="form-control " name = "named" value="<?= $model->Username?>" required>
                    </div>
                    <div class="form-group">
                      <label><?= lang('Form.group_user')?></label>
                      <div class="input-group has-success">
                        
                        <input id = "groupname" type="text" class="form-control custom-readonly"  value="<?= $model->get_M_Groupuser()->GroupName?>" readonly>
                        <!-- <span class="form-control-feedback text-primary">
                            <i class="material-icons">search</i>
                        </span> -->
                        <div class="input-group-append">
                          <button id="btnGroupModal" data-toggle="modal" type="button" class="btn btn-primary btn-lookup" data-target="#modalGroupUser"><i class="fa fa-search"></i></button>
                        </div>
                      </div>
                    </div>
                    <!-- <div class="form-group">       
                      <label><?= lang('Form.password')?></label>
                      <input id="password" type="password" class="form-control" name = "password" value="<?= $model->Password?>">
                    </div> -->
                    <div class="form-group">       
                      <input type="submit" value="<?= lang('Form.save')?>" class="btn btn-primary">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

<!-- modal -->
<div id="modalGroupUser" tabindex="-1" role="dialog" aria-labelledby="groupUserModalLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="groupUserModalLabel" class="modal-title">Group User</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>
      <div class="card-body">
        <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar
                                  -->
        </div>
        <div class="material-datatables">
          <div id = "datatables_wrapper" class = "dataTables_wrapper dt-bootstrap4">
            <!-- <div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="datatables_length"><label>Show <select name="datatables_length" aria-controls="datatables" class="custom-select custom-select-sm form-control form-control-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="-1">All</option></select> entries</label></div></div><div class="col-sm-12 col-md-6"><div id="datatables_filter" class="dataTables_filter"><label><span class="bmd-form-group bmd-form-group-sm"><input type="search" class="form-control form-control-sm" placeholder="Search records" aria-controls="datatables"></span></label></div></div></div> -->
            <div class="row">
              <div class="col-sm-12">
                <div class="table-responsive">
                  <table data-page-length="<?= $_SESSION[getSessionVariable_config()['usersettings']]['RowPerpage']?>" id = "tableModalGroupUser" class="table table-striped table-no-bordered table-hover dataTable dtr-inline collapsed" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
                    <thead class=" text-primary">
                        <th><?=  lang('Form.group_user')?></th>
                        <!-- <th><?=  lang('Form.description')?></th> -->
                    </thead>
                    <tfoot class=" text-primary">
                      <tr role = "row">
                        <!-- <th># </th> -->
                        <th><?=  lang('Form.group_user')?></th>
                        <!-- <th><?=  lang('Form.description')?></th> -->
                      </tr>
                    </tfoot>
                    <tbody>
                    <?php
                      //print_r($modeldetail);
                        $groupuserent = 'App\Entities\M_groupuser_entity';
                        $groupuser = new $groupuserent;
                        foreach ($groupuser->findAll() as $value)
                        {
                      ?>
                          <tr class = "rowdetail" role = "row" id = <?= $value->Id?>>
                            <td><?= $value->GroupName?></td>
                            <!-- <td><?= $value->Description?></td> -->
                          </tr>
                      <?php
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type = "text/javascript">
  $(document).ready(function() {    
    init();
    loadModalGroup("#tableModalGroupUser");
  });

  function loadModalGroup(idtable){
    console.log(idtable);
    $(idtable).DataTable({
      "pagingType": "full_numbers",
      "lengthMenu": [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],
      responsive: true,
      language: {
      search: "_INPUT_",
      searchPlaceholder: "Search records",
      }
    });

    var table = $(idtable).DataTable();
     // Edit record
     table.on( 'click', '.rowdetail', function () {
        $tr = $(this).closest('tr');

        var data = table.row($tr).data();
        var id = $tr.attr('id');

        $("#groupid").val(id);
        $("#groupname").val(data[0]);
        $('#modalGroupUser').modal('hide');
     } );
  }

  function init(){
    
  }
  
</script>