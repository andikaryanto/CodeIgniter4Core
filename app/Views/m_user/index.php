<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  
                  <div class="row">
                    <div class="col">
                      <h4 class="card-title "><?= lang('Form.data')?></h4>
                      <p class="card-category"> <?= lang('Form.master_user')?></p>
                    </div>
                    
                    <div class="col">
                      <div class="text-right">
                        <button type="button" rel="tooltip" class="btn btn-primary btn-round btn-fab" title="<?= lang('Form.add')?>" onclick="window.location.href='<?= base_url('muser/add');?>'">
                          <i class="material-icons">add</i>
                        </button>
                      </div>
                    </div>
                  </div>
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
                            <table data-page-length="<?= $_SESSION[getSessionVariable_config()['usersettings']]['RowPerpage']?>" id = "tableUser" class="table table-striped table-no-bordered table-hover dataTable dtr-inline collapsed" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
                              <thead class=" text-primary">
                                  <th><?=  lang('Form.user')?></th>
                                  <th><?=  lang('Form.group_user')?></th>
                                  <th><?=  lang('Form.isactive')?></th>
                                  <th class="disabled-sorting text-right"><?=  lang('Form.actions')?></th>
                              </thead>
                              <tfoot class=" text-primary">
                                <tr role = "row">
                                  <!-- <th># </th> -->
                                  <th><?=  lang('Form.user')?></th>
                                  <th><?=  lang('Form.group_user')?></th>
                                  <th><?=  lang('Form.isactive')?></th>
                                  <th class="disabled-sorting text-right"><?=  lang('Form.actions')?></th>
                                </tr>
                              </tfoot>
                              <tbody>
                              <?php
                              //print_r($modeldetail);
                                foreach ($model as $value)
                                {
                              ?>
                                  <tr role = "row" id = <?= $value->Id?>>
                                    <td><?= $value->Username?></td>
                                    <td><?= $value->get_M_Groupuser()->GroupName?></td>
                                    <?php 
                                    if($value->IsActive == 1 ) {
                                    ?>
                                    <td><a><i class='fa fa-check'></i></a></td>
                                    <?php
                                    } else {
                                    ?>
                                      <td><a><i class='fa fa-close'></i></a></td>
                                    <?php
                                    }  
                                    ?>
                                    
                                    <td class = "td-actions text-right">
                                      <!-- <a href="#" rel="tooltip" title="<?=  lang('Form.edit')?>" class="btn btn-link btn-success btn-just-icon edit"><i class="material-icons">edit</i></a> -->
                                      <?php $button_class = !$value->IsActive ? "btn btn-link btn-success btn-just-icon activate" : "btn btn-link btn-danger btn-just-icon" ?>
                                      <a href="#" rel="tooltip" title="<?= !$value->IsActive ? lang('Form.activate') : lang('Form.deactivate')?>" class="<?= $button_class?> activate"><i class="material-icons">power</i></a>
                                      <a href="#" rel="tooltip" title="<?=  lang('Form.delete')?>" class="btn btn-link btn-primary btn-just-icon edit"><i class="material-icons">edit</i></a>
                                    </td>
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
        </div>
      </div>
<script type = "text/javascript">
  $(document).ready(function() {    
    init();
    dataTable();
  });

  function dataTable(){
    $('#tableUser').DataTable({
      "pagingType": "full_numbers",
      "lengthMenu": [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],
      responsive: true,
      language: {
      search: "_INPUT_",
      searchPlaceholder: "Search records",
      }
    }); 

    var table = $('#tableUser').DataTable();
     // Edit record
     table.on( 'click', '.edit', function () {
        $tr = $(this).closest('tr');

        var id = $tr.attr('id');
        window.location = "<?= base_url('muser/edit/');?>" + id;
     } );

     // Delete a record
     table.on( 'click', '.activate', function (e) {
        $tr = $(this).closest('tr');
        var data = table.row($tr).data();
        var id = $tr.attr('id');
        window.location = "<?= base_url('muser/activate/');?>" + id;
     });

     
  }

  function init(){
   
  }

  function delete_user(id, name){
    deleteData(name, function(result){
      if (result==true)
        window.location = "<?= base_url('muser/delete/');?>" + id;
    });
  } 
  function activate_user(id){
    window.location = "<?= base_url('muser/activate/');?>" + id;
  }
</script>
      