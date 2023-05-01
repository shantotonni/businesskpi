<style>
.select2-container{
    width: 40% !important;
}
input[type="text"]{
    font-size: 12px;
    width: 39%;
}
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
                        <form action="<?php echo base_url('UserPermission/saveUpdatedPermission'); ?>" method="post" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">UserID :</label>
                                <div class="controls">
                                    <input type="text" name="userid" value="<?php if(isset($UserID)){echo $UserID;}else{echo '';} ?>" class="form-control" autocomplete="off" placeholder="Type User ID" required readonly>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Business :</label>
                                <div class="controls">
                                    <select id="business" class="business" name="business[]" multiple="multiple" required>
                                        <?php if(isset($allbusiness) && !empty($allbusiness)){
                                            foreach($allbusiness as $business){     
                                        ?>
                                                <option value="<?=$business['Business']?>"><?=$business['Business']?></option>
                                        <?php }
                                            }
                                        ?>
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
                                        <?php if(isset($allkpi) && !empty($allkpi)){ 
                                            foreach($allkpi as $kpi){ 
                                        ?>
                                            <option value="<?=$kpi['KPICode']?>"><?=$kpi['KPIName']?></option>
                                        <?php }
                                            }
                                        ?>
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
                                        <?php if(isset($allmenu) && !empty($allmenu)){
                                            foreach($allmenu as $menu){ 
                                        ?>
                                            <option value="<?=$menu['MenuID']?>"><?=$menu['MenuName']?></option>
                                        <?php }
                                            }
                                        ?>
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
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<?php
if(isset($permissionDetails['business']) && !empty($permissionDetails['business'])){
$businessArr = array();
foreach($permissionDetails['business'] as $businessKey => $business){
    $businessArr[$businessKey] = $business['Business'];
}
$selectedBusiness = implode("','", $businessArr);
?>
<script>
$(document).ready(function() {
    $('.business').select2().val(['<?=$selectedBusiness?>']);
    $(".business").trigger("change");
});
</script>
<?php
}
if(isset($permissionDetails['kpi']) && !empty($permissionDetails['kpi'])){
$kpiArr = array();
foreach($permissionDetails['kpi'] as $kpiKey => $kpiCode){
    $kpiArr[$kpiKey] = $kpiCode['KPICode'];
}
$selectedKpi = implode("','", $kpiArr);
?>
<script>
$(document).ready(function() {
    $('.kpi').select2().val(['<?=$selectedKpi?>']);
    $(".kpi").trigger("change");
});
</script>
<?php
}
if(isset($permissionDetails['menu']) && !empty($permissionDetails['menu'])){
$menuArr = array();
foreach($permissionDetails['menu'] as $menuKey => $menuPermission){
    $menuArr[$menuKey] = $menuPermission['MenuID'];
}
$selectedMenu = implode(',', $menuArr);
?>
<script>
$(document).ready(function() {
    $('.menu').select2().val([<?=$selectedMenu;?>]);
    $(".menu").trigger("change");
});
</script>
<?php
}
?>
<script>
$(document).ready(function() {
    $('.business').select2({
        tags: "true",
        placeholder: "Select Business",
        allowClear: true,
    });

    $('.kpi').select2({
        tags: "true",
        placeholder: "Select KPI",
        allowClear: true,
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
</script>