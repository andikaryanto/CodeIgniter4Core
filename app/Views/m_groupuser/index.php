<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  
                  <div class="row">
                    <div class="col">
                      <h4 class="card-title "><?= lang('Form.data')?></h4>
                      <p class="card-category"> <?= lang('Form.master_groupuser')?></p>
                    </div>
                    
                    <div class="col">
                      <div class="text-right">
                        <button type="button" rel="tooltip" class="btn btn-primary btn-round btn-fab" title="<?= lang('Form.add')?>" onclick="window.location.href='<?= base_url('mgroupuser/add');?>'">
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
                            <table data-page-length="<?= $_SESSION[getSessionVariable_config()['usersettings']]['RowPerpage']?>" id = "tableGroupUser" class="table table-striped table-no-bordered table-hover dataTable dtr-inline collapsed" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
                              <thead class=" text-primary">
                                <tr role = "row">
                                  <!-- <th># </th> -->
                                  <th><?=  lang('Form.name')?></th>
                                  <th><?=  lang('Form.description')?></th>
                                  <th><?=  lang('Form.createat')?></th>
                                  <th class="disabled-sorting text-right"><?=  lang('Form.actions')?></th>
                                </tr>
                              </thead>
                              <tfoot class=" text-primary">
                                <tr role = "row">
                                  <!-- <th># </th> -->
                                  <th><?=  lang('Form.name')?></th>
                                  <th><?=  lang('Form.description')?></th>
                                  <th><?=  lang('Form.createat')?></th>
                                  <th class="disabled-sorting text-right"><?=  lang('Form.actions')?></th>
                                </tr>
                              </tfoot>
                              <tbody>
                              <?php
                                foreach ($model as $value)
                                {
                              ?>
                                  <tr role = "row" id = <?= $value->Id?>>
                                    <td><?= $value->GroupName?></td>
                                    <td><?= $value->Description?></td>
                                    <td><?= $value->Created?></td>
                                    <td class = "td-actions text-right">
                                      <a href="#" rel="tooltip" title="<?=  lang('Form.edit')?>" class="btn btn-link btn-primary btn-just-icon edit"><i class="material-icons">edit</i></a>
                                      <a href="#" rel="tooltip" title="<?=  lang('Form.role')?>" class="btn btn-link btn-primary btn-just-icon role"><i class="material-icons">face</i></a>
                                      <a href="#" rel="tooltip" title="<?=  lang('Form.delete')?>" class="btn btn-link btn-danger btn-just-icon delete"><i class="material-icons">delete</i></a>
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
                    <!-- <div class="row"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="datatables_info" role="status" aria-live="polite">Showing 1 to 10 of 40 entries</div></div><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_full_numbers" id="datatables_paginate"><ul class="pagination"><li class="paginate_button page-item first disabled" id="datatables_first"><a href="#" aria-controls="datatables" data-dt-idx="0" tabindex="0" class="page-link">First</a></li><li class="paginate_button page-item previous disabled" id="datatables_previous"><a href="#" aria-controls="datatables" data-dt-idx="1" tabindex="0" class="page-link">Prev</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="datatables" data-dt-idx="2" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item "><a href="#" aria-controls="datatables" data-dt-idx="3" tabindex="0" class="page-link">2</a></li><li class="paginate_button page-item "><a href="#" aria-controls="datatables" data-dt-idx="4" tabindex="0" class="page-link">3</a></li><li class="paginate_button page-item "><a href="#" aria-controls="datatables" data-dt-idx="5" tabindex="0" class="page-link">4</a></li><li class="paginate_button page-item next" id="datatables_next"><a href="#" aria-controls="datatables" data-dt-idx="6" tabindex="0" class="page-link">Next</a></li><li class="paginate_button page-item last" id="datatables_last"><a href="#" aria-controls="datatables" data-dt-idx="7" tabindex="0" class="page-link">Last</a></li></ul></div></div></div> -->
                  
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      </section>

<script>

  $(document).ready(function() {   
    
    init();
    dataTable();
  });

  function dataTable(){
    $('#tableGroupUser').DataTable({
      "pagingType": "full_numbers",
      "lengthMenu": [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],
      "order" : [[2, "desc"]],
      responsive: true,
      language: {
      search: "_INPUT_",
      searchPlaceholder: "Search records",
      }
    }); 

    var table = $('#tableGroupUser').DataTable();
     // Edit record
     table.on( 'click', '.edit', function () {
        $tr = $(this).closest('tr');

        var id = $tr.attr('id');
        window.location = "<?= base_url('mgroupuser/edit/');?>" + id;
     } );

     // Delete a record
     table.on( 'click', '.delete', function (e) {
        $tr = $(this).closest('tr');
        var data = table.row($tr).data();
        var id = $tr.attr('id');
        deleteData(data[0], function(result){
          if (result==true)
          {
            
            $.ajax({
              type : "POST",
              url : "<?= base_url('mgroupuser/delete/');?>",
              data : {id : id},
              success : function(data){
                var status = $.parseJSON(data);
                console.log(status)
                if(status['isforbidden']){
                  window.location = "<?= base_url('Forbidden');?>";
                } else {
                  if(!status['status']){
                    for(var i=0 ; i< status['msg'].length; i++){
                      var message = status['msg'][i];
                      setNotification(message, 3, "bottom", "right");
                    }
                  } else {
                    for(var i=0 ; i< status['msg'].length; i++){
                      var message = status['msg'][i];
                      setNotification(message, 2, "bottom", "right");
                    }
                    table.row($tr).remove().draw();
                    e.preventDefault();
                  }
                }
              },
              error: function (xhr, ajaxOptions, thrownError) {
                // console.log(xhr);
                setNotification("<?= lang('Error.something_went_wrong_while_delete')?>", 3, "bottom", "right");
              }
            });
          }
        });
     });

    //Like record
    table.on( 'click', '.role', function () {
        $tr = $(this).closest('tr');
        var id = $tr.attr('id');
        window.location = "<?= base_url('mgroupuser/roles/');?>" + id;
    });
  }

  function init(){
    
  }
</script>
      