
<?php

*// please add MySQL access datas (connection functions)
	
$map=$_GET['map'];

echo '


        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Maps</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-table fa-sm text-white-50"></i> Remove filters</a>
          </div>
	</div>

';

echo '<div class="row">';
//* Display map
$limitd="12";

   echo'            <div class="col-xl-3 col-md-12 mb-4">';
   echo'              <div class="card border-left-primary shadow h-100 py-2">';
   echo'                <div class="card-body">';

	$sql = "SELECT count(*) as count FROM geoip WHERE cat='".$map."';";
	$i=0;
	$query = $conn->query($sql);
	while($r1 = $query->fetch_assoc())
	{
	
		$i=$i+$r1['count'];
		echo "<h2 class='h1 mb-0 text-warning-800 center'><b>".$r1['count']."</b> Hosts </h2>";
	}
	echo '<hr class="sidebar-divider">';
	echo '<br>';

        echo '<h1 class="h3 mb-0 text-gray-800"><u>By Country :</u></h1>';
	$sql = "SELECT *, count(*) as count FROM geoip WHERE cat='".$map."' GROUP BY country ORDER BY count DESC LIMIT ".$limitd.";";
	$i=0;
	$query = $conn->query($sql);
	while($r1 = $query->fetch_assoc())
	{
	
		$i=$i+$r1['count'];
		echo "<h2 class='h5 mb-0 text-gray-600'>".$r1['country']." : <b>".$r1['count']."</b></h2>";
	}


	echo '<hr class="sidebar-divider">';
	echo '<br>';
        echo '<h1 class="h3 mb-0 text-gray-800"><u>By TimeZone :</u></h1>';
	$sql = "SELECT *, count(*) as count FROM geoip WHERE cat='".$map."' GROUP BY timezone ORDER BY count DESC LIMIT ".$limitd.";";
	$i=0;
	$query = $conn->query($sql);
	while($r1 = $query->fetch_assoc())
	{
	
		$i=$i+$r1['count'];
		echo "<h2 class='h5 mb-0 text-gray-600'>".$r1['timezone']." : <b>".$r1['count']."</b></h2>";
	}

	echo '<hr class="sidebar-divider">';
	echo '<br>';
        echo '<h1 class="h3 mb-0 text-gray-800"><u>By Organization :</u></h1>';
	$sql = "SELECT *, count(*) as count FROM geoip WHERE cat='".$map."' GROUP BY organization ORDER BY count DESC LIMIT ".$limitd.";";
	$i=0;
	$query = $conn->query($sql);
	while($r1 = $query->fetch_assoc())
	{
	
		$i=$i+$r1['count'];
		echo "<h2 class='h5 mb-0 text-gray-600'>".$r1['organization']." : <b>".$r1['count']."</b></h2>";
	}



         echo "</div>";         
      echo "</div>";     
     echo "</div>";

//* Display map

   echo'            <div class="col-xl-9 col-md-12 mb-4">';
   echo'              <div class="card border-left-primary shadow h-100 py-2">';
   echo'                <div class="card-body">';


          echo '<h1 class="h3 mb-0 text-gray-800">Maps '.$map.'</h1>';
          echo '<div id="map" style="height: 1200px; width: 99%; border: 1px solid #AAA; align: center">';

		echo "<script src='datas/".$map.".json'></script>";

		echo "<script src='js/maps.js'></script>";
          echo "</div>";
         echo "</div>";         
      echo "</div>";     
     echo "</div>";

echo "</div>";
?>

      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Nolisa @2020 - Vincent Freret vfreret@redhat.com</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>


