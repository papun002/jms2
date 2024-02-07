<?php
session_start();
include('../db.php');
// checking session is valid or not 
if (strlen($_SESSION['admin_logid'] == 0)) {
    header('location:logout.php');
} else {
    $admin_id = $_SESSION['admin_logid'];

?>
<!DOCTYPE html>
<html lang="en">

<!--   //Jewellary Management system powered by JMS -->

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Admin Dashboard &mdash; <?php echo $_SESSION['admin_name']; ?></title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="assets/modules/datatables/datatables.min.css" />
    <link rel="stylesheet" href="assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.min.css">
    <link rel="stylesheet" href="assets/css/components.min.css">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="layout-4">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <span class="loader"><span class="loader-inner"></span></span>
    </div>

    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>

            <!-- Call to top navbar -->
            <?php include 'partials/top-navbar.php'; ?>

            <!-- Call to main left sidebar menu -->
            <?php include 'partials/left-sidebar.php'; ?>

            <!-- Start app main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>Dashboard</h1>
                    </div>

                    <div class="row">
                        <!-- Call to order statistics-->
                        <div class="col-lg-4 col-md-4 col-sm-12">
                          <div class="card card-statistic-2">
                            <div class="card-stats">
                              <div class="card-stats-title">
                               Client Statistics
                              </div>
                              <!-- <div class="card-stats-items">
                                <div class="card-stats-item">
                                  <div class="card-stats-item-count">24</div>
                                  <div class="card-stats-item-label">Pending</div>
                                </div>
                                <div class="card-stats-item">
                                  <div class="card-stats-item-count">12</div>
                                  <div class="card-stats-item-label">Shipping</div>
                                </div>
                                <div class="card-stats-item">
                                  <div class="card-stats-item-count">23</div>
                                  <div class="card-stats-item-label">Completed</div>
                                </div>
                              </div> -->
                            </div>
                            <div class="card-icon shadow-primary bg-secondary">
                              <i class="fa fa-archive"></i>
                            </div>
                            <div class="card-wrap">
                              <div class="card-header">
                                <h4>Total Clients</h4>
                              </div>
                              <?php
$sql = "SELECT * FROM `client_jms` WHERE admin_id='$admin_id';";
$result = mysqli_query($con,$sql);
if($result){
    $row = mysqli_num_rows($result);
    ?>
    <div class="card-body"><?php echo $row; ?></div>
    <?php
}
                              ?>
                              
                            </div>
                          </div>
                        </div>                                             
                      </div>
                      

                    


<!-- //Table section -->
<div class="row">
                            <div class="col-12 col-md-12 col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>All Clients</h4>
                                    </div>

                                    <div class="card-body">

                                        <div class="table-responsive">
                                            <table class="table table-striped v_center" id="example">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">SL No.</th>
                                                        <th>Client Name</th>
                                                        <th>Contact Person</th>
                                                        <th>Contact No.</th>
                                                        <th>Address</th>
                                                        <th>Email</th>
                                                        <th>GST No.</th>
                                                        <th>Username</th>
                                                        <th>Password</th>
                                                        <th>Plan Name</th>
                                                        <th>Start date</th>
                                                        <th>End date</th>
                                                        <th>Sub Price</th>
                                                        <th>Sub Status</th>
                                                        <th class="no-print">Edit</th>
                                                        <!-- <th class="no-print">Delete</th> -->
                                                    </tr>
                                                </thead>
                                                
                                                <tbody>
                                                    <!-- table data starts here -->
                                                    <?php
                                                    $sql2 = "SELECT * FROM `view_all_clients` WHERE admin_id='$admin_id'";
                                                    $result2 = mysqli_query($con,$sql2);
                                                    $count = 1;
                                                    if(mysqli_num_rows($result2)){
                                                        while($row1 = mysqli_fetch_array($result2)){
                                                            ?>
<tr>
    <td class="text-center"><?php echo $count; ?></td>
    <td><?php echo $row1['client_name']; ?></td>
    <td><?php echo $row1['contact_person']; ?></td>
    <td><?php echo $row1['client_contact']; ?></td>
    <td><?php echo $row1['client_add']; ?></td>
    <td><?php echo $row1['client_email']; ?></td>
    <td><?php echo $row1['client_gst']; ?></td>
    <td><?php echo $row1['client_user']; ?></td>
    <td><?php echo $row1['client_password']; ?></td>
    <td><?php echo $row1['plan_name']; ?></td>
    <td><?php echo $row1['start_date']; ?></td>
    <td><?php echo $row1['end_date']; ?></td>
    <td><?php echo $row1['sub_price']; ?></td>
    <td><?php echo $row1['sub_status']; ?></td>
    <td class="no-print"><a href="#" class="btn btn-secondary">Edit</a></td>
    <!-- <td class="no-print"><a href="all_client.php?cid=<?php /*echo $row1['client_id']; */ ?>" class="btn btn-dark" onClick="return confirm('Do you really want to delete');">Delete</a></td> -->
</tr>

                                                            <?php
                                                            $count++;
                                                        }
                                                    }
                                                    ?>

                                                    


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                
                    </div>
                </section>
            </div>

            
            <!-- Call to footer part -->
            <?php include 'partials/footer.php'; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

  <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

  <script>
    $(document).ready(function () {
      $('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [
          'copyHtml5',
          'excelHtml5',
          'csvHtml5',
          'pdfHtml5',
          'print'
        ]
      });
    });
  </script>

    <!-- General JS Scripts -->
    <script src="assets/bundles/lib.vendor.bundle.js"></script>
    <script src="js/jms.js"></script>

    <!-- JS Libraies -->
    <script src="assets/modules/datatables/datatables.min.js"></script>
    <script src="assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
    <script src="assets/modules/jquery-ui/jquery-ui.min.js"></script>
 
 <!-- Page Specific JS File -->
 <script src="js/page/modules-datatables.js"></script>
    <script src="js/page/index.js"></script>

    <!-- Template JS File -->
    <script src="js/scripts.js"></script>
    <script src="js/custom.js"></script>
</body>

<!-- Copyright © 2022 Jewellary Management Sysytem. All Right Reserved -->

</html>
<?php  
}
?>