<style>
.select2-container{
    width: 40% !important;
}
input[type="text"]{
    font-size: 12px;
    width: 39%;
}
.ui-autocomplete-loading { 
    background: white url(http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/images/ui-anim_basic_16x16.gif) no-repeat right center;
}
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"><a href="<?php echo base_url(); ?>" title="Go to Home" class="tip-bottom">
                <i class="icon-home"></i> Home</a> <a href="<?php echo base_url('UserPermission'); ?>" class="current"><?php echo $page_title; ?></a> </div>
        <h1><?php echo $page_title; ?></h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5><?php echo $page_title; ?></h5>
                    </div>
                    <div class="widget-content nopadding">
                        <?php
                        $message = $this->session->userdata('message');
                        if (isset($message)) {
                            echo '<p style="color: darkgreen;text-align: center;padding: 10px;font-weight: 600;">' . $message . '</p>';
                            $this->session->unset_userdata('message');
                        }
                        ?>
                        <form action="<?php echo base_url('UserPermission/addPermission'); ?>" method="post" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">UserID :</label>
                                <div class="controls">
                                    <input type="text" name="empcode" class="form-control" id="empcode" autocomplete="off" placeholder="Type User ID" required>
                                    <input type="hidden" name="userid" value="" id="userid">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Business :</label>
                                <div class="controls">
                                    <select id="business" class="business" name="business[]" multiple="multiple" required>
                                        <?php foreach($allbusiness as $business){ ?>
                                            <option value="<?=$business['Business']?>"><?=$business['Business']?></option>
                                        <?php } ?>
                                    </select>
                                    <label class="checkbox inline" style="margin-left: 30px;">
                                        <input type="checkbox" class="form-check-input" id="selectAllBusiness"> Select All Business
                                    </label>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">KPI :</label>
                                <div class="controls">
                                    <select id="kpi" id="kpi" class="kpi" name="kpi[]" multiple="multiple" required>
                                    <?php foreach($allkpi as $kpi){ ?>
                                        <option value="<?=$kpi['KPICode']?>"><?=$kpi['KPIName']?></option>
                                    <?php } ?>
                                    </select>
                                    <label class="checkbox inline" style="margin-left: 30px;">
                                        <input type="checkbox" class="form-check-input" id="selectAllKPI"> Select All KPI
                                    </label>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Menu :</label>
                                <div class="controls">
                                    <select id="menu" id="menu" class="menu" name="menu[]" multiple="multiple" required>
                                    <?php foreach($allmenu as $menu){ ?>
                                        <option value="<?=$menu['MenuID']?>"><?=$menu['MenuName']?></option>
                                    <?php } ?>
                                    </select>
                                    <label class="checkbox inline" style="margin-left: 30px;">
                                        <input type="checkbox" class="form-check-input" id="selectAllMenu"> Select All Menu
                                    </label>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"></label>
                                <div class="controls text-center">
                                    <button type="submit" class="btn btn-success">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php if (isset($usersPermission) && !empty($usersPermission)){ ?>
                <div class="widget-box">
                <div class="widget-content nopadding">
                        <table class="table table-bordered data-table" id="report_data">
                            <thead>
                                <tr>
                                    <th style="text-align: center; width:90px;">User ID</th>
                                    <th style="text-align: center; width:90px;">User Name</th>
                                    <th>Business Permission</th>
                                    <th>KPI Permission</th>
                                    <th>Menu Permission</th>
                                    <th>Edit Permission</th>
                                </tr>
                            </thead>
                            <tbody>                                
                            <?php 
                                $i = 1;
                                foreach ($usersPermission as $row): 
                                ?>
                                <tr class="gradeX">
                                    <td style="text-align: center; width:90px;"><?php echo $row['UserID']; ?></td>   
                                    <td style="text-align: center; width:90px;"><?php echo $row['Name']; ?></td>   
                                    <td style="text-align: left; width:30%;">                                        
                                        <?php 
                                            $k = 1;
                                            foreach ($row['business'] as $row_Business){
                                                echo $k.'. '.$row_Business['Business'].'<br/>';
                                                $k++;
                                            }
                                        ?>
                                    </td>                         
                                    <td style="text-align: left;">                                        
                                        <?php 
                                            $j = 1;
                                            foreach ($row['kpi'] as $row_KPI){
                                                echo $j.'. '.$row_KPI['KPIName'].'<br/>';
                                                $j++;
                                            }
                                        ?>
                                    </td>  
                                    <td style="text-align: left;">                                        
                                        <?php 
                                            $k = 1;
                                            foreach ($row['menu'] as $row_Menu){
                                                echo $k.'. '.$row_Menu['MenuName'].'<br/>';
                                                $k++;
                                            }
                                        ?>
                                    </td>
                                    <td style="text-align: center;"><a class="btn btn-primary" href="<?php echo base_url(); ?>UserPermission/updatePermission/<?php echo $row['UserID']; ?>">Edit</a></td>
                                </tr>
                            <?php 
                                endforeach; 
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$(document).ready(function() {
    $('.business').select2({
        tags: "true",
        placeholder: "Select Business",
        allowClear: true
    });

    $('.kpi').select2({
        tags: "true",
        placeholder: "Select KPI",
        allowClear: true
    });

    $('.menu').select2({
        tags: "true",
        placeholder: "Select Menu",
        allowClear: true
    });
});
$("#selectAllBusiness").click(function(){
    if($("#selectAllBusiness").is(':checked') ){
        $(".business > option").prop("selected","selected");
        $(".business").trigger("change");
    }else{
        $(".business > option").removeAttr("selected");
        $(".business").val('');
        $(".business").trigger("change");
    }
});

$("#selectAllKPI").click(function(){
    if($("#selectAllKPI").is(':checked') ){
        $(".kpi > option").prop("selected","selected");
        $(".kpi").trigger("change");
    }else{
        $(".kpi > option").removeAttr("selected");
        $(".kpi").val('');
        $(".kpi").trigger("change");
    }
});

$("#selectAllMenu").click(function(){
    if($("#selectAllMenu").is(':checked') ){
        $(".menu > option").prop("selected","selected");
        $(".menu").trigger("change");
    }else{
        $(".menu > option").removeAttr("selected");
        $(".menu").val('');
        $(".menu").trigger("change");
    }
});

$( function() {
    $( "#empcode" ).autocomplete({
        source: function( request, response ) {
            console.log(request.term);
        // Fetch data
        $.ajax({
            url: "<?php echo base_url();?>UserPermission/autocompleteUserDetails",
            type: 'post',
            dataType: "json",
            data: {
                empcode: request.term
            },
            success: function( data ) {
            response( $.map(data, function(item) {
                    return {
                        label: item.EMPCODE + ' - ' + item.NAME + ' - ' + item.DESIGNATION + ' - ' + item.DeptName,
                        value: item.EMPCODE
                    }
                }));
            }
        });
        },
      select: function( event, ui ) {
        $('#empcode').val(ui.item.label);
        return false;
      },
      focus: function(event, ui){
        $("#userid").val(ui.item.value);
        return false;
    },
    });
  });
</script>