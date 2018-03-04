  <?php
    $userDetails = $stratek->getFullDetailsId($_SESSION['stratekuser'],"login");
    $dp = $stratek->getFullDetailsPid($_SESSION['stratekuser'],"dp");
  ?>
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo $dp[2]; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $userDetails[3]; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview">
          <a href="?dashboard">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="?monitoring">
            <i class="fa fa-camera"></i> <span>Monitoring</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="?transactions">
            <i class="fa fa-credit-card"></i> <span>Transactions</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
