<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo $page_title; ?></title>
        <meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-5">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-responsive.min.css" />
        <?php if(isset($page) && $page == 'login'):?>
            <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/matrix-login.css" />
        <?php endif;?>
        <?php if(isset($page) && $page == 'dashboard'):?>
            <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/fullcalendar.css" />
            <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/matrix-style.css" />
            <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/matrix-media.css" />
            <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.gritter.css" />
        <?php endif;?>
        <?php if(isset($page) && $page == 'send_notifications' || $page == 'send_notifications_cb'  || $page == 'result' ||$page='resultNotAttned' ||$page='resultSMS' || $page == 'result_quiz_answer' || $page == 'quiz_all' || $page == 'inquiry_all' || $page == 'feedback_all' || $page == 'exam_time_view' || $page == 'apps_installation' || $page == 'upload_materials_all' || $page == 'material_hitcount' ||  $page == 'pbi_report'):?>
            <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/uniform.css" />
            <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/select2.css" />
            <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/matrix-style.css" />
            <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/matrix-media.css" />
        <?php endif;?>
        <?php if(isset($page) && $page == 'quiz_add' || $page == 'exam_time_add'|| $page == 'upload_materials_add'|| $page == 'material_title_hit_count'):?>
            <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/colorpicker.css" />
            <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/datepicker.css" />
            <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/uniform.css" />
            <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/select2.css" />
            <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/matrix-style.css" />
            <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/matrix-media.css" />
            <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-wysihtml5.css" />
        <?php endif;?>
        <?php if(isset($page) && $page == 'exam_time_add'):?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/datetimepicker/jquery.datetimepicker.css"/>
        <?php endif;?>
        <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
       <!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>-->
        
        <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>  
        <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/rscripts.js"></script>
        <script src="<?php echo base_url();?>assets/autocomplete/jquery.autocomplete.js" type="text/javascript"></script>
        <link href="<?php echo base_url();?>assets/autocomplete/jquery.autocomplete.css" type="text/css" rel="stylesheet"/>
        
        <?php if(isset($page) && $page == 'kpi_details_all'):?>
       
            <script>
                $(document).ready(function()
                {
                    var records_per_page = $("#records_per_page_customer").val();    
                    var search = $('#search_customer').val();
                    console.log(search);
                    vpb_pagination_system('1',search,records_per_page);
                });
                //This is the Pagination Function
                function vpb_pagination_system(page_id,search,records_per_page)
                {	
                    var dataString = "page=" + page_id +"&search=" + search +"&records_per_page=" + records_per_page;
                    console.log(dataString);
                   
                    $.ajax({  
                            type: "POST",  
                            url: "<?php echo base_url();?>kpi/content_displayer",  
                            data: dataString,
                            beforeSend: function() 
                            {
                                $('#vpb_pagination_system_displayer').html('<br clear="all"><div style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:black;">Please wait <img src="<?php echo base_url();?>assets/img/loadings.gif" align="absmiddle" /></div><br clear="all">');
                            },  
                            success: function(response)
                            {
                                $("#vpb_pagination_system_displayer").fadeIn(2000).html(response);
                            }
                    });
                }
                $(function(){           
                    $("#search_customer").keyup(function(){
                        var records_per_page = $("#records_per_page_customer").val();
                        if(records_per_page == ''){
                            return false;
                        }
                        var search = $(this).val();
                        if(search == ''){
                            return false;
                        }            
                       console.log(search);
                       vpb_pagination_system('1',search,records_per_page);
                    });
                    $("#records_per_page_customer").change(function(){
                        var records_per_page = $(this).val();
                        if(records_per_page == ''){
                            return false;
                        }
                        var search =  $('#search_customer').val();
        //                if(search == ''){
        //                    return false;
        //                }
                       console.log(records_per_page);
                       vpb_pagination_system('1',search,records_per_page);
                    });
                });
            </script>
<?php endif;?>

    </head>
    <body>