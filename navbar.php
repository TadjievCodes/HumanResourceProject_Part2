<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Human Resource Project</a>
    </div>
    <ul class="nav navbar-nav">
      <li <?php if($active=="index") echo 'class="active"' ?>><a href="index.php">Home</a></li>
      <li <?php if($active=="generate") echo 'class="active"' ?>><a href="generatecsv.php">Generate random CSV file</a></li>
      <li <?php if($active=="import") echo 'class="active"' ?>><a href="importcsv.php">Import CSV file</a></li>
	  <li <?php if($active=="list") echo 'class="active"' ?>><a href="listemployees.php">List Employees from Database</a></li>
    </ul>
	<ul class="nav navbar-nav navbar-right">
	  <li><a><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['username']; ?></a></li>
	  <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
  </div>
</nav>