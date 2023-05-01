<script language="Javascript" type="text/javascript">
function confirm_submit()
{
    if (confirm('<?php echo 'Confirm Delete Data'; ?>')) {return true;}
    else {return false;}
}
</script>
<style>
/*Pagination Buttons*/
.vpb_pagination_system 
{
	padding: 3px;
	margin: 3px;
}

.vpb_pagination_system a 
{
	  background-color: #7fbf4d;
	  background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #7fbf4d), color-stop(100%, #63a62f));
	  background-image: -webkit-linear-gradient(top, #7fbf4d, #63a62f);
	  background-image: -moz-linear-gradient(top, #7fbf4d, #63a62f);
	  background-image: -ms-linear-gradient(top, #7fbf4d, #63a62f);
	  background-image: -o-linear-gradient(top, #7fbf4d, #63a62f);
	  background-image: linear-gradient(top, #7fbf4d, #63a62f);
	  border: 1px solid #63a62f;box-shadow: 0 2px 3px #666666;-moz-box-shadow: 0 2px 3px #666666;-webkit-box-shadow: 0 2px 3px #666666;
	  -webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;
	  font-family:"helvetica neue", helvetica, arial, sans-serif;font-size:13px;font-weight:bold;color: #fff;
	  text-align: center;
	  padding:6px 13px 6px 13px;
	  margin:5px;
	  text-decoration:none;
	  cursor:pointer;
}
.vpb_pagination_system a:hover, .vpb_pagination_system a:active 
{
	background-color: #76b347;
    background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #76b347), color-stop(100%, #5e9e2e));
    background-image: -webkit-linear-gradient(top, #76b347, #5e9e2e);
    background-image: -moz-linear-gradient(top, #76b347, #5e9e2e);
    background-image: -ms-linear-gradient(top, #76b347, #5e9e2e);
    background-image: -o-linear-gradient(top, #76b347, #5e9e2e);
    background-image: linear-gradient(top, #76b347, #5e9e2e);
    box-shadow: 0 2px 3px #666666;
	-moz-box-shadow: 0 2px 3px #666666;
	-webkit-box-shadow: 0 2px 3px #666666;
	-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;
}
.vpb_pagination_system span.current 
{
	  background-color: #ee432e;
	  background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #ee432e), color-stop(50%, #c63929), color-stop(50%, #b51700), color-stop(100%, #891100));
	  background-image: -webkit-linear-gradient(top, #ee432e 0%, #c63929 50%, #b51700 50%, #891100 100%);
	  background-image: -moz-linear-gradient(top, #ee432e 0%, #c63929 50%, #b51700 50%, #891100 100%);
	  background-image: -ms-linear-gradient(top, #ee432e 0%, #c63929 50%, #b51700 50%, #891100 100%);
	  background-image: -o-linear-gradient(top, #ee432e 0%, #c63929 50%, #b51700 50%, #891100 100%);
	  background-image: linear-gradient(top, #ee432e 0%, #c63929 50%, #b51700 50%, #891100 100%);
	  border: 1px solid #951100;box-shadow: 0 2px 3px #951100;-moz-box-shadow: 0 2px 3px #951100;-webkit-box-shadow: 0 2px 3px #951100;
	  -webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;
	  -webkit-box-shadow: inset 0px 0px 0px 1px rgba(255, 115, 100, 0.4), 0 1px 3px #333333;
	  box-shadow: inset 0px 0px 0px 1px rgba(255, 115, 100, 0.4), 0 1px 3px #333333;
	  font-family:"helvetica neue", helvetica, arial, sans-serif;font-size:13px;font-weight:bold;color: #fff;
	  text-align: center;
	  width: 10px;
	  padding:6px 13px 6px 13px;
	  margin:5px;
	  text-decoration:none;
	  cursor:pointer;
}
.vpb_pagination_system span.current:hover 
{
    background-color: #f37873;
    background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #f37873), color-stop(50%, #db504d), color-stop(50%, #cb0500), color-stop(100%, #a20601));
    background-image: -webkit-linear-gradient(top, #f37873 0%, #db504d 50%, #cb0500 50%, #a20601 100%);
    background-image: -moz-linear-gradient(top, #f37873 0%, #db504d 50%, #cb0500 50%, #a20601 100%);
    background-image: -ms-linear-gradient(top, #f37873 0%, #db504d 50%, #cb0500 50%, #a20601 100%);
    background-image: -o-linear-gradient(top, #f37873 0%, #db504d 50%, #cb0500 50%, #a20601 100%);
    background-image: linear-gradient(top, #f37873 0%, #db504d 50%, #cb0500 50%, #a20601 100%);
    cursor: pointer; 
}
.vpb_pagination_system span.disabled 
{
	  background-color:#ededed;
	  border:1px solid #bababa;
	  font-family:"helvetica neue", helvetica, arial, sans-serif;font-size:13px;font-weight:bold;color: #bababa;
	  -webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;
	  text-align: center;
	  width: 10px;
	  padding:6px 13px 6px 13px;
	  margin:5px;
	  text-decoration:none;
	  cursor: default;
}
</style>

<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> 
            <a href="<?php echo base_url();?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> 
            <a href="<?php echo base_url('kpi');?>" class="current"><?php echo $page_title;?></a> 
        </div>
        <h1><?php echo $page_title;?></h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">                             
                <?php
                    
                    $message = $this->session->userdata('message');
                    if (isset($message) && !empty($message)) {
                        echo '<div class="alert alert-success" align="center">';
                        echo '<h5>'.$message.'</h5>';
                        echo '</div>';
                        $this->session->unset_userdata('message');
                    }
                ?>
                <div class="widget-box">                    
                    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                        <h5><?php echo $page_title;?></h5>
                        <!--<button id="btncurrent" class="btn btn-success" style=" float: right;">Export to Excel</button>	-->
                    </div>          
                    <div class="widget-content nopadding">
                        <div style="float: left;">
                            <label>
                                <select size="1" id="records_per_page_customer" name="records_per_page" aria-controls="sample_1" class="m-wrap xsmall">
                                    <option value="10" selected="selected">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select> records per page
                            </label>
                        </div>
                        <div class="clearfix">
                            <input id="search_customer" style="width: 200px; margin: 0 5;" type="text" placeholder="Search" class="form-control pull-right" name="q" >
                        </div>
                        <center>
                            <div class="vpb_main_pagination_wrapper" align="left">
                                <div id="vpb_pagination_system_displayer"></div><!-- This will display the content along with the pagination  -->
                            </div>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
