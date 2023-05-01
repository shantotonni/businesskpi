<div id="content">
    <div id="content-header">
        <div id="breadcrumb"><a href="<?php echo base_url();?>" title="Go to Home" class="tip-bottom">
		<i class="icon-home"></i> Home</a> <a href="<?php echo base_url('kpi/add');?>" class="current"><?php echo $page_title;?></a> </div>
        <h1><?php echo $page_title;?></h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5><?php echo $page_title;?></h5>
                    </div>
                    <div class="widget-content nopadding">
                        <?php
                            $message = $this->session->userdata('message');
                            if (isset($message)) {
                                echo $message;
                                $this->session->unset_userdata('message');
                            }
							//echo '<pre/>';print_r($rows);exit();
                        ?>                    
                        <form action="<?php echo base_url('kpi/valueDriverEdit');?>" method="post" class="form-horizontal">                           
                            <input type="hidden" name="ValueDriverCode" value="<?php echo isset($row['ValueDriverCode']) ? $row['ValueDriverCode'] : '' ?>">
                            <div class="control-group">
                                <label class="control-label">Value Driver :</label>
                                <div class="controls">
                                    <input id="ValueDriver" type="text" name="ValueDriver" value="<?php echo isset($row['ValueDriver']) ? $row['ValueDriver'] : '' ?>" class="span6" placeholder="Value Driver" />
                                </div>
                            </div>
                           
                            
                           <div class="control-group">
                                <label class="control-label"></label>
                                <div class="controls text-left">
                                    <button type="submit" class="btn btn-success span3">Save</button>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"></label>
                                <div class="controls text-left">
                                   
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

