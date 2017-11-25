<?php include ("includes/header.php");?>

<?php 
require 'secure/db_connect.php';
//$job = '2017/Jul/PFIZER LTD /16/1439/sangita/260';
$job = $_GET['job'];
$query = "SELECT q.customer_name,q.billing_address_line_1,q.billing_address_line_2,q.billing_city,q.job_order,q.s_no,q.contact_name,q.po_no, c.challan_id,c.type, l.gst_no FROM table_quotation as q, table_challan AS c, customer_local as l WHERE MONTH(q.timestamp)=MONTH(CURDATE()) AND q.job_order = c.job_order AND l.customer_id = q.customer_id";

$qr  = $mysqli->prepare( $query );
          $qr->bind_param('s', $job);
         $qr->execute();
         $qr->store_result();
         $qr->bind_result($sNo, $quot_timestamp, $customer_name, $work_order_image, $security_letter_image, $rental_payment_image,
                          $security_neg_image);  
         $qr->fetch();
        // echo $qr->error;
         $qr->close();
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Details
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Timeline</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <ul class="timeline">

    <!-- timeline time label -->
    <li class="time-label">
        <span class="bg-red">
            <?php echo $quot_timestamp; ?>
        </span>
    </li>
    <!-- /.timeline-label -->

    <!-- timeline item -->
    <li>
        <!-- timeline icon -->
        <i class="fa fa-pencil-square-o bg-blue"></i>
        <div class="timeline-item">
          
            <h3 class="timeline-header"><a href="#">Attachments </a></h3>

            <div class="timeline-body">
            <ol>
               <li><a href="<?php echo $work_order_image; ?>">Work Order Image</a></li>
               <li><a href="<?php echo $security_letter_image; ?>">Security Letter</a></li>
               <li><a href="<?php echo $rental_payment_image; ?>">Rental Payment</a></li>
               <li><a href="<?php echo $security_neg_image; ?>">Security Neg</a></li>
            </ol>
            </div>

            <div class="timeline-footer">
                <a class="btn btn-primary btn-xs" href="viewquotation.php?id=<?php echo $sNo; ?>" target="_blank">View Quotation</a>
            </div>
        </div>
    </li>
    <!-- END timeline item -->

<?php 
$query = "SELECT challan_id, pickup_loc_id, delivery_loc_id, type, recieving, recieving_date, transporter, `timestamp` FROM table_challan WHERE job_order = ?";

$qr  = $mysqli->prepare( $query );
          $qr->bind_param('s', $job);
         $qr->execute();
         $qr->store_result();
         $qr->bind_result($challan_id, $pickup_loc_id, $delivery_loc_id, $type, $recieving, $recieving_date, $transporter, $timestamp);  
        
      while( $qr->fetch()){
?>

  <!-- timeline time label -->
    <li class="time-label">
        <span class="bg-green">
            <?php echo $timestamp; ?>
        </span>
    </li>
    <!-- /.timeline-label -->

 <li>
        <!-- timeline icon -->
        <i class="fa fa-exchange bg-yellow"></i>
        <div class="timeline-item">
          
            <h3 class="timeline-header"><a>Challan ID: <?php echo $challan_id; ?></a></h3>

            <div class="timeline-body">
            <h3><?php echo $pickup_loc_id; ?> To <?php echo $delivery_loc_id; ?></h3><br>
            <b>Transporter    : </b><?php echo $transporter; ?><br>
            <b>Recieving Date : </b><?php echo $recieving_date; ?>
            </div>

            <div class="timeline-footer">
                <a class="btn btn-primary btn-xs" href="<?php echo $recieving; ?>" target="_blank">View Recieving</a>
            </div>
        </div>
    </li>
    <!-- END timeline item -->

    <?php } $qr->close(); ?>

    <li>
              <i class="fa fa-clock-o bg-gray"></i>
            </li>

</ul>

        <ul class="timeline">

            <?php

            $query = "SELECT invoice_no, timestamp FROM bill_logs WHERE job_order = ? ORDER BY timestamp";

            $qr = $mysqli->prepare($query);
            $qr->bind_param('s', $job);
            $qr->execute();
            $qr->store_result();
            $qr->bind_result($invoice_no, $bill_timestamp);

            while ($qr->fetch()) {
                ?>

                <!-- timeline time label -->
                <li class="time-label">
        <span class="bg-green">
            <?php echo $bill_timestamp; ?>
        </span>
                </li>
                <!-- /.timeline-label -->

                <li>
                    <!-- timeline icon -->
                    <i class="fa fa-exchange bg-yellow"></i>
                    <div class="timeline-item">

                        <h3 class="timeline-header"><a>INVOICE ID: <?php echo $invoice_no; ?></a></h3>


                        <div class="timeline-footer">
                            <a class="btn btn-primary btn-xs" href="viewInvoice.php?id=<?php echo $invoice_no; ?>"
                               target="_blank">View Invoice</a>
                        </div>
                    </div>
                </li>
                <!-- END timeline item -->

            <?php }
            $qr->close(); ?>

            <li>
                <i class="fa fa-clock-o bg-gray"></i>
            </li>

        </ul>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include ("includes/footer.php"); ?>