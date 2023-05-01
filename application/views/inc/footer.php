
    <div class="row-fluid">
        <div id="footer" class="span12" style='color:white'> <?php echo date('Y');?> &copy; Powered By <a style='color:white' href="http://mis.digital">MIS@ACI</a> </div>
    </div>
    
    <?php if(isset($page) && $page == 'login'):?>
        <script src="<?php echo base_url();?>assets/js/matrix.login.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#loginform').submit(function(){
                    //alert('loginform');
                    var u = $('#empcode').val();
                    var p = $('#login-password').val();
                    if(u == '' && p == '') {
                        $('.login-alert').fadeIn();
                        return false;
                    }
                });
            });
        </script>
    <?php endif;?>

    <?php if(isset($page) && $page == 'dashboard' ):?>
        <script src="<?php echo base_url();?>assets/js/excanvas.min.js"></script> 
        <!--<script src="js/jquery.min.js"></script>--> 
        <script src="<?php echo base_url();?>assets/js/jquery.ui.custom.js"></script> 
         
        <script src="<?php echo base_url();?>assets/js/jquery.flot.min.js"></script> 
        <script src="<?php echo base_url();?>assets/js/jquery.flot.resize.min.js"></script> 
        <script src="<?php echo base_url();?>assets/js/jquery.peity.min.js"></script> 
        <script src="<?php echo base_url();?>assets/js/fullcalendar.min.js"></script> 
        <script src="<?php echo base_url();?>assets/js/matrix.js"></script>

        <!--<script src="<?php echo base_url();?>assets/js/matrix.dashboard.js"></script>--> 
        <script src="<?php echo base_url();?>assets/js/jquery.gritter.min.js"></script> 
        <script src="<?php echo base_url();?>assets/js/matrix.interface.js"></script> 
        <script src="<?php echo base_url();?>assets/js/matrix.chat.js"></script> 
        <script src="<?php echo base_url();?>assets/js/jquery.validate.js"></script> 
        <script src="<?php echo base_url();?>assets/js/matrix.form_validation.js"></script> 
        <script src="<?php echo base_url();?>assets/js/jquery.wizard.js"></script> 
        <script src="<?php echo base_url();?>assets/js/jquery.uniform.js"></script> 
        <script src="<?php echo base_url();?>assets/js/select2.min.js"></script> 
        <script src="<?php echo base_url();?>assets/js/matrix.popover.js"></script> 
        <script src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script> 
        <script src="<?php echo base_url();?>assets/js/matrix.tables.js"></script>

        <script type="text/javascript">
            // This function is called from the pop-up menus to transfer to
            // a different page. Ignore if the value returned is a null string:
//            function goPage (newURL) {
//
//                // if url is empty, skip the menu dividers and reset the menu selection to default
//                if (newURL != "") {      
//                    // if url is "-", it is this page -- reset the menu:
//                    if (newURL == "-" ) {
//                        resetMenu();            
//                    } 
//                    // else, send page to designated URL            
//                    else {  
//                      document.location.href = newURL;
//                    }
//                }
//            }
//            // resets the menu selection upon entry to this page:
//            function resetMenu() {
//               document.gomenu.selector.selectedIndex = 2;
//            }
        </script>

    <?php endif;?>
    <?php if(isset($page) && $page == 'send_notifications' || $page == 'result' || $page == 'result_quiz_answer' || $page == 'quiz_all' || $page == 'inquiry_all' || $page == 'feedback_all'  || $page == 'exam_time_view' || $page == 'apps_installation' || $page == 'upload_materials_all' || $page == 'pbi_report'):?>
        <script src="<?php echo base_url();?>assets/js/jquery.ui.custom.js"></script> 
        <script src="<?php echo base_url();?>assets/js/jquery.uniform.js"></script> 
        <script src="<?php echo base_url();?>assets/js/select2.min.js"></script> 
        <script src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script> 
        <script src="<?php echo base_url();?>assets/js/matrix.js"></script> 
        <script src="<?php echo base_url();?>assets/js/matrix.tables.js"></script>
    <?php endif;?>

    <?php if(isset($page) && $page == 'quiz_add'  || $page == 'exam_time_add'|| $page=='upload_materials_add' || $page=='material_hitcount' || $page=='material_title_hit_count'):?>
        <!--<script src="js/jquery.min.js"></script>--> 
        <script src="<?php echo base_url(); ?>assets/js/jquery.ui.custom.js"></script> 
        <!--<script src="js/bootstrap.min.js"></script>--> 
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-colorpicker.js"></script> 
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script> 
        <!--<script src="<?php echo base_url(); ?>assets/js/jquery.toggle.buttons.js"></script>--> 
        <script src="<?php echo base_url(); ?>assets/js/masked.js"></script> 
        <script src="<?php echo base_url(); ?>assets/js/jquery.uniform.js"></script> 
        <script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script> 
        <script src="<?php echo base_url(); ?>assets/js/matrix.js"></script> 
        <!--<script src="<?php echo base_url(); ?>assets/js/matrix.form_common.js"></script>--> 
        <script src="<?php echo base_url(); ?>assets/js/wysihtml5-0.3.0.js"></script> 
        <script src="<?php echo base_url(); ?>assets/js/jquery.peity.min.js"></script> 
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-wysihtml5.js"></script>

        <script>
            $('.textarea_editor').wysihtml5();
        </script>
    <?php endif;?>
	  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>

        <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.table2excel.js"></script>
<?php if(isset($page) && $page == 'exam_time_add'):?>        
    <!--<script src="<?php echo base_url(); ?>assets/datetimepicker/jquery.js"></script>-->
    <script src="<?php echo base_url(); ?>assets/datetimepicker/jquery.datetimepicker.js"></script>
    <script>
    $("#submittime").click(function(){
       var submittime = $("#datetimepicker").val();
         console.log(submittime);
             var dataString = 'submittime='+ submittime;
                    console.log(dataString);//return false;		
                    $.ajax({
                            type: "POST",
                            url: "<?php echo base_url();?>site/exam_time_action",
                            data: dataString,
                            success: function(response) {
                                    $('#message_form').html("<div id='message'></div>");
                                    $('#message').html(response)
                                    .append("<p>We will be in touch soon.</p>");
                            }
                    });
                    return false;
    }); 
    $('#datetimepicker').datetimepicker();
    $('#datetimepicker').datetimepicker({value:'2015-04-15 05:03',step:10});

    </script>
<?php endif;?>

<script>
  $(document).ready(function() {
        $('#multiple-checkboxes').multiselect({
          includeSelectAllOption: true,
        });
    });
</script>
</body>
</html>