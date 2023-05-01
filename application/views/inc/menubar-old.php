<!--Header-part-->
<div id="header">
  <h1><a href="<?php echo base_url();?>">Admin</a></h1>
</div>
<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <li  class="dropdown" id="profile-messages" >
        <a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle">
            <i class="icon icon-user"></i>  <span class="text">Welcome <?php echo $emp_name;?></span><b class="caret"></b>
        </a>
      <ul class="dropdown-menu">
<!--        <li><a href="#"><i class="icon-user"></i> My Profile</a></li>
        <li class="divider"></li>
        <li><a href="#"><i class="icon-check"></i> My Tasks</a></li>
        <li class="divider"></li>-->
        <li><a href="<?php echo base_url(); ?>authenticate/logout"><i class="icon-key"></i> Log Out</a></li>
      </ul>
    </li>
    <li class=""><a title="" href="<?php echo base_url('authenticate/logout');?>"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
  </ul>
</div>
<!--close-top-Header-menu-->
<!--start-top-serch-->
<!--<div id="search">
  <input type="text" placeholder="Search here..."/>
  <button type="submit" class="tip-bottom" title="Search"><i class="icon-search icon-white"></i></button>
</div>-->
<!--close-top-serch-->
<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
    <ul>
        <li class="<?php if(isset($page) && $page == 'processkpi'){echo 'active';}?>">
            <a href="<?php echo base_url('processkpi');?>"><i class="icon icon-home"></i><span>Process KPI</span></a> 
        </li>

        <li class="<?php if(isset($page) && $page == 'processkpientry'){echo 'active';}?>"> 
            <a href="<?php echo base_url('processkpi/processkpientry');?>"><i class="icon icon-plus"></i>Process KPI Entry</a>
        </li>
		
		<li class="<?php if(isset($page) && $page == 'kpi_notification_all'){echo 'active';}?>"> 
            <a href="<?php echo base_url('notification');?>"><i class="icon icon-plus"></i>Notification KPI By Email</a>
        </li>
        <li class="<?php if(isset($page) && $page == 'user_permission'){echo 'active';}?>"> 
            <a href="<?php echo base_url('UserPermission');?>"><i class="icon icon-plus"></i>User Permission</a>
        </li>
        
        <li style="display: none;" class="<?php if(isset($page) && $page == 'kpi_report'){echo 'active';}?>">
            <a href="<?php echo base_url('site/kpi_report');?>"><i class="icon icon-home"></i><span>KPI Dashboard</span></a> 
        </li>
        <li style="display: none;" class="submenu <?php if(isset($page) && $page == 'kpi_add' || $page == 'kpi_all' || $page == 'kpi_details_all' || $page == 'process_kpi_entry'){echo 'active'.' '.'open';}?>"> 
            <a href="javascript:;"><i class="icon icon-th-list"></i> <span>KPI Management</span> <span class="label label-important">3</span></a>
            <ul>
                <li><a href="<?php echo base_url('kpi/add');?>">KPI Entry</a></li>
                <li><a href="<?php echo base_url('kpi');?>">All KPI</a></li>
                <li><a href="<?php echo base_url('kpi/details_add');?>">Group KPI Details Output</a></li>
                <li><a href="<?php echo base_url('kpi/details_all_p');?>">Group KPI Details Output ALL</a></li>
            </ul>
        </li>
    </ul>
</div>
<!--sidebar-menu-->