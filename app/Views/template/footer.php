   
      <footer class="footer">
        <div class="container-fluid">
          <nav class="float-left">
            <ul>
              <li>
                <a href="https://www.creative-tim.com">
                  Creative Tim
                </a>
              </li>
              <li>
                <a href="https://creative-tim.com/presentation">
                  About Us
                </a>
              </li>
              <li>
                <a href="http://blog.creative-tim.com">
                  Blog
                </a>
              </li>
              <li>
                <a href="https://www.creative-tim.com/license">
                  Licenses
                </a>
              </li>
            </ul>
          </nav>
          <div class="copyright float-right">
            &copy;
            <script>
              document.write(new Date().getFullYear())
            </script>, made with <i class="material-icons">favorite</i> by
            <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a> for a better web.
          </div>
        </div>
      </footer>
      <!-- <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div>
      <div class="ps-scrollbar-y-rail" style="top: 0px; right: 0px; height: 626px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 317px;"></div></div> -->
    </div>
  </div>
  
  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
    <script src="<?= base_url('assets/material-dashboard/assets/js/plugins/jquery.mask.js');?>"></script>
  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="<?= base_url('assets/material-dashboard/assets/js/plugins/bootstrap-datetimepicker.min.js');?>"></script>
  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
  <script src="<?= base_url('assets/material-dashboard/assets/js/plugins/jquery.dataTables.min.js');?>"></script>
  <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="<?= base_url('assets/material-dashboard/assets/js/plugins/bootstrap-tagsinput.js');?>"></script>
  
  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="<?= base_url('assets/material-dashboard/assets/js/plugins/jasny-bootstrap.min.js');?>"></script>
  <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
  <script src="<?= base_url('assets/material-dashboard/assets/js/plugins/fullcalendar.min.js');?>"></script>
  <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
  <script src="<?= base_url('assets/material-dashboard/assets/js/plugins/jquery-jvectormap.js');?>"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="<?= base_url('assets/material-dashboard/assets/js/plugins/nouislider.min.js');?>"></script>
  <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script> -->
  <!-- Library for adding dinamically elements -->
  <script src="<?= base_url('assets/material-dashboard/assets/js/plugins/arrive.min.js');?>"></script>
  <!--  Google Maps Plugin    -->
  <!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <script async="" defer="" src="https://buttons.github.io/buttons.js"></script> -->
  <!-- Chartist JS -->
  <script src="<?= base_url('assets/material-dashboard/assets/js/plugins/chartist.min.js');?>"></script>
  <!--  Notifications Plugin    -->
  <!-- <script src="<?= base_url('assets/material-dashboard/assets/js/plugins/bootstrap-notify.js');?>"></script> -->
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="<?= base_url('assets/material-dashboard/assets/js/material-dashboard.min.js');?>"></script>
  <!-- <script src="<?= base_url('assets/material-dashboard/assets/js/material-dashboard.js');?>"></script> -->
  
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <script src="<?= base_url('assets/material-dashboard/assets/demo/demo.js');?>"></script>
  <script src="<?= base_url('assets/material-dashboard/assets/demo/jquery.sharrre.js');?>"></script>
  <script>
    $(document).ready(function() {
      $().ready(function() {
        $sidebar = $('.sidebar');
        $sidebar_img_container = $sidebar.find('.sidebar-background');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');

        window_width = $(window).width();

        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

        if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
          if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
            $('.fixed-plugin .dropdown').addClass('open');
          }

        }

        $('.fixed-plugin a').click(function(event) {
          // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });

        $('.fixed-plugin .active-color span').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-color', new_color);
          }

          if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data-color', new_color);
          }
        });

        $('.fixed-plugin .background-color .badge').click(function() {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('background-color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-background-color', new_color);
          }
        });

        $('.fixed-plugin .img-holder').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).parent('li').siblings().removeClass('active');
          $(this).parent('li').addClass('active');


          var new_image = $(this).find("img").attr('src');

          if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            $sidebar_img_container.fadeOut('fast', function() {
              $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
              $sidebar_img_container.fadeIn('fast');
            });
          }

          if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $full_page_background.fadeOut('fast', function() {
              $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
              $full_page_background.fadeIn('fast');
            });
          }

          if ($('.switch-sidebar-image input:checked').length == 0) {
            var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
            $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
          }
        });

        $('.switch-sidebar-image input').change(function() {
          $full_page_background = $('.full-page-background');

          $input = $(this);

          if ($input.is(':checked')) {
            if ($sidebar_img_container.length != 0) {
              $sidebar_img_container.fadeIn('fast');
              $sidebar.attr('data-image', '#');
            }

            if ($full_page_background.length != 0) {
              $full_page_background.fadeIn('fast');
              $full_page.attr('data-image', '#');
            }

            background_image = true;
          } else {
            if ($sidebar_img_container.length != 0) {
              $sidebar.removeAttr('data-image');
              $sidebar_img_container.fadeOut('fast');
            }

            if ($full_page_background.length != 0) {
              $full_page.removeAttr('data-image', '#');
              $full_page_background.fadeOut('fast');
            }

            background_image = false;
          }
        });

        $('.switch-sidebar-mini input').change(function() {
          $body = $('body');

          $input = $(this);

          if (md.misc.sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            md.misc.sidebar_mini_active = false;

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

          } else {

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

            setTimeout(function() {
              $('body').addClass('sidebar-mini');

              md.misc.sidebar_mini_active = true;
            }, 300);
          }

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function() {
            window.dispatchEvent(new Event('resize'));
          }, 180);

          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function() {
            clearInterval(simulateWindowResize);
          }, 1000);

        });
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();

    });
  </script>
  <script type = "text/javascript">
    function setNotification(message, title, position, align){

      if(title == 1){
        var titlestr = "<?= lang('Form.warning') ?>";
        var type = "warning";
      }
      else if(title == 2){
        var titlestr = "<?= lang('Form.success') ?>";
        var type = "success";
      }
      else if(title == 3){
        var titlestr = "<?= lang('Form.danger') ?>";
        var type = "danger";
      }
      else{
        var titlestr = "<?= lang('Form.info') ?>";
        var type = "info";
      }

      $.notify({
        // options
        icon: 'glyphicon glyphicon-warning-sign',
        title: titlestr + " : ",//'Bootstrap notify',
        message: message //'Turning standard Bootstrap alerts into "notify" like notifications',
        //url: 'https://github.com/mouse0270/bootstrap-notify',
        //target: '_blank'
      },{
        // settings
        element: 'body',
        position: null,
        type: type,
        allow_dismiss: true,
        newest_on_top: false,
        showProgressbar: false,
        placement: {
          from: position,
          align: align
        },
        offset: 20,
        spacing: 10,
        z_index: 1031,
        delay: 5000,
        timer: 1000,
        url_target: '_blank',
        mouse_over: 'pause',
        animate: {
          enter: 'animated fadeInRight',
          exit: 'animated fadeOutRight'
        },
        onShow: null,
        onShown: null,
        onClose: null,
        onClosed: null,
        icon_type: 'class',
        template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
          '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
          '<span data-notify="icon"></span> ' +
          '<span data-notify="title"><b>{1}</b></span> ' +
          '<span data-notify="message">{2}</span>' +
          '<div class="progress" data-notify="progressbar">' +
            '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
          '</div>' +
          '<a href="{3}" target="{4}" data-notify="url"></a>' +
        '</div>' 
      });
      }

      function deleteData(name, callback){
      bootbox.confirm({
      //title: "Destroy planet?",
      message: "<div class='text-center'><?= lang('Form.want_delete')?> <b><text class = 'text-primary'>" + name + "</text></b> ?</div>",
        buttons: {
            cancel: {
                className: 'btn btn-link',
                label: "<?= lang('Form.cancel')?>"
            },
            confirm: {
                className: 'btn btn-primary btn-link',
                label: "<?= lang('Form.confirm')?>"
            }
        },
        callback: function (result) {
          callback(result);
        }
      });
      }
  </script>
   <script>
    $(document).ready(function() {
      // initialise Datetimepicker and Sliders
      md.initFormExtendedDatetimepickers("DD-MM-YYYY");
      if ($('.slider').length != 0) {
        md.initSliders();
      }
    });
  </script>
  <script>

      $('.transnumberformat').inputmask({
        mask: 'aaa/{YYYY}{MM}/9'
      });
  
  
    // $(document).ready(function() {
    //   $('.date').mask('00/00/0000');
    //   $('.time').mask('00:00:00');
    //   $('.date_time').mask('00/00/0000 00:00:00');
    //   $('.cep').mask('00000-000');
    //   $('.membernumformat').mask('AAA/{YYYY}{MM}/0', {placeholder: "AAA/{YY}{MM}/0"});
    //   $('.submissionnumformat').mask('AAA/{YYYY}{MM}/0', {placeholder: "AAA/{YY}{MM}/0"});
    //   $('.phone').mask('0000-0000');
    //   $('.phone_with_ddd').mask('(00) 0000-0000');
    //   $('.phone_us').mask('(000) 000-0000');
    //   $('.mixed').mask('AAA 000-S0S');
    //   $('.cpf').mask('000.000.000-00', {reverse: true});
    //   $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
      $('.money').mask('000.000.000.000.000,00', {reverse: true});
      $('.money2').mask("#.##0,00", {reverse: true});
    //   $('.ip_address').mask('0ZZ.0ZZ.0ZZ.0ZZ', {
    //     translation: {
    //       'Z': {
    //         pattern: /[0-9]/, optional: true
    //       }
    //     }
    //   });
    //   $('.ip_address').mask('099.099.099.099');
      $('.percent').mask('##0,00 %', {reverse: true});
    //   $('.clear-if-not-match').mask("00/00/0000", {clearIfNotMatch: true});
    //   $('.placeholder').mask("00/00/0000", {placeholder: "__/__/____"});
    //   $('.fallback').mask("00r00r0000", {
    //       translation: {
    //         'r': {
    //           pattern: /[\/]/,
    //           fallback: '/'
    //         },
    //         placeholder: "__/__/____"
    //       }
    //     });
    //   $('.selectonfocus').mask("00/00/0000", {selectOnFocus: true});
    // });
  </script>
  <script>
  Dropzone.autoDiscover = false;
  function dropzoneUpload(id, url, paramName, maxfiles, acceptedfiles, buttonUpload = null, autoprocessqueue = false){
    var mydropzone = $(id).dropzone({ 
      url: url,
      paramName: paramName,
      maxFilesize: 1,
      uploadMultiple: true,
      maxFiles: maxfiles ,
      parallelUploads: maxfiles,
      acceptedFiles: acceptedfiles,
      addRemoveLinks: true,
      dictDefaultMessage: "<?= lang('Form.uploadhere')?>",
      autoProcessQueue: autoprocessqueue,
      init:function(){
        myDropzone = this;

        if(buttonUpload != null){
          $(buttonUpload).on("click", function(e){
            myDropzone.processQueue();
          })
        }
      },
      success:function(file, response){
        console.log(response);

      },
      error: function (request, error) {
        console.log(arguments);
        alert(" Can't do because: " + error);
      }
    });

    return mydropzone;
  }
  </script>
  <script>
  
    $(document).ready(function() {
      // Initialise the wizard
      demo.initMaterialWizard();
      setTimeout(function() {
        $('.card.card-wizard').addClass('active');
      }, 600);
    });
  
  </script>
  <script>
    // function init(){
      <?php 
      $session = \Config\Services::session();

      if($session->getFlashdata(transactionMessage_config()['success']))
      {
        $msgsuc = $session->getFlashdata(transactionMessage_config()['success']);
        for($i=0 ; $i<count($msgsuc); $i++)
        {
      ?>
          setNotification("<?= lang($msgsuc[$i]); ?>", 2, "bottom", "right");
      <?php 
        }
      }
    ?>
    
    <?php 
    if($session->getFlashdata(transactionMessage_config()['add']))
    {
      $msgadd = $session->getFlashdata(transactionMessage_config()['add']);
      for($i=0 ; $i<count($msgadd); $i++)
      {
    ?>
        setNotification("<?= lang($msgadd[$i]); ?>", 3, "bottom", "right");
    <?php 
      }
    }

    if($session->getFlashdata(transactionMessage_config()['edit']))
    {
      $msgedit = $session->getFlashdata(transactionMessage_config()['edit']);
      for($i=0 ; $i<count($msgedit); $i++)
      {
    ?>
        setNotification("<?= lang($msgedit[$i]); ?>", 3, "bottom", "right");
    <?php 
      }
    }
    
    unset(
          $_SESSION[transactionMessage_config()['success']],
          $_SESSION[transactionMessage_config()['edit']],
          $_SESSION[transactionMessage_config()['add']]
    );
    ?>
  // }
  </script>
</body>

</html>
