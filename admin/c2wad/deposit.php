<?php
session_start();

include "../../conn.php";
include "../../config.php";

$msg = "";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if(isset($_GET['referred'])){
	$referreds = $_GET['referred'];
}else{
	$referreds = '';
}


if(isset($_SESSION['uid'])){
	



}
else{


	header("location:../c2wadmin/signin.php");
}
if(isset($_POST['approve'])){
	
	$tnx = $_POST['tnx'];
	$usd = $_POST['usd'];
	$email = $_POST['email'];
	$investplan = $_POST['ivtplan'];
  $cointype = $_POST['cointype'];
  $referred = $_POST['referred'];
	
	$cdate = date('Y-m-d H:i:s');
	
		 $sql2= "SELECT * FROM users WHERE email= '$email'";
  $result2 = mysqli_query($link,$sql2);
  if(mysqli_num_rows($result2) > 0){
   $row = mysqli_fetch_assoc($result2);
   $userwallebalance = $row['walletbalance'];
   $usernamewtc = $row['username'];
  }
  
  $sql13= "SELECT * FROM package1 WHERE pname='$investplan'";
			  $result13 = mysqli_query($link,$sql13);
			  if(mysqli_num_rows($result13) > 0){
			      
				 $row13 = mysqli_fetch_assoc($result13);  
                $increase = $row13['increase'];
                $bonus = $row13['bonus'];
                $duration = $row13['duration'];
                $froms = $row13['froms'];
			  }
			  
		
	

	//	$sql1 = "UPDATE users SET walletbalance = walletbalance + $usd  WHERE email='$email'";
		
		$sql2= "SELECT * FROM btc WHERE tnxid = '$tnx'";
  $result2 = mysqli_query($link,$sql2);
  if(mysqli_num_rows($result2) > 0){
   $row = mysqli_fetch_assoc($result2);
   $row['status'];
 
  }
 
if(isset($row['status']) &&  $row['status']== "approved"){
	
	$msg = "Transaction already approved!";

}else{
		
	$sql22 = "INSERT INTO investment (email,pname,increase,bonus,duration,pdate,froms,activate,usd,profit,payday,lprofit,status)
VALUES ('$email','$investplan','$increase','$bonus','$duration','$cdate','$froms','1','$usd','0.00','Daily','0.00','approved')";
          mysqli_query($link, $sql22);
          
          if($referred !=""){ 
              $refb = ($usd / 100)*4;
              $exp_ref = explode("_", $referred);
                      $exp_refe = $exp_ref['0'];
                      mysqli_query($link, "UPDATE users SET refbonus = refbonus + $refb, walletbalance = walletbalance + $refb where refcode = '$exp_refe'");
                      if(array_key_exists("1",$exp_ref)){
                          $refb = ($usd / 100)*2;
                        $exp_refe1 = $exp_ref['1'];
                       mysqli_query($link, "UPDATE users SET refbonus = refbonus + $refb, walletbalance = walletbalance + $refb where refcode = '$exp_refe1'");
                      }
                      if(array_key_exists("2",$exp_ref)){
                          $refb = ($usd / 100)*1;
                        $exp_refe2 = $exp_ref['2'];
                        mysqli_query($link, "UPDATE users SET refbonus = refbonus + $refb, walletbalance = walletbalance + $refb where refcode = '$exp_refe2'");
                      }


          }
          
        
    $dbbalance = $userwallebalance + $usd; 
          
    $sql1 = "UPDATE btc SET status = 'approved'  WHERE tnxid = '$tnx'";

    $sql12 = "UPDATE users SET walletbalance = '$dbbalance'  WHERE email = '$email'";
    mysqli_query($link, $sql1);
    mysqli_query($link, $sql12);



    $msg = "Transaction approved successfully and investor investment is now active!";

    if($msg = "Transaction approved successfully and investor investment is now active!"){
    
    
		    
		    
		include_once "PHPMailer/PHPMailer.php";
    require_once 'PHPMailer/Exception.php';


 $mail= new PHPMailer();
     $mail->setFrom($emaila);
   $mail->FromName = $name;
    $mail->addAddress($email, $usernamewtc);
    $mail->Subject = "Deposit Approval";
    $mail->isHTML(true);
    $mail->Body = '
    
    
    <div style=";width: 100%;height: 100%; font-family: sans-serif; font-weight: 100;" class="be_container"> 
 
 <div style="background:#fff;max-width: 600px;margin: 0px auto;padding: 30px;"class="be_inner_containr"> <div class="be_header">
 
 
 
 <div class="be_user" style="float: left"> <p>Dear: '.$usernamewtc.'</p> </div> 
 
 <div style="clear: both;"></div> 
 
 <div class="be_bluebar" style=" padding: 20px; margin-top: 10px;">
 
 <h1>Deposit Approval</h1>
 
 </div> </div> 
 
 <div class="be_body" style="padding: 20px;"> <p style="line-height: 25px; color:#FF6600;"> 
Your deposit of '.$usd.' USD worth of '.$cointype.' has been approved. Thank for investing in us.
 
 </p>
 
 <div class="be_footer">
 <div style="border-bottom: 1px solid #ccc;"></div>
 
 
 <div class="be_bluebar" style=" padding: 20px; color: #FF6600;;margin-top: 10px;">
 
 <p>
 Copyright ©'.$cy.' '.$name.'. </p> <div class="be_logo" style=" width:60px;height:40px;float: right;"> </div> </div> </div> </div></div>';
     
  $mail->send();
     
	
}
		 else {
    $msg = "transaction was not approved! ";
}


		
				    
	

		
}

}


if(isset($_POST['delete'])){
	
	$tnx = $_POST['tnx'];
	
$sql = "DELETE FROM btc WHERE tnxid='$tnx'";

if (mysqli_query($link, $sql)) {
    $msg = "Transaction deleted successfully!";
} else {
    $msg = "Transaction not deleted! ";
}
}



include 'header.php';





?>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  
  

  <link rel="stylesheet" href=" https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href=" https://cdn.datatables.net/1.10.19/css/dataTables.jqueryui.min.css">
  <link rel="stylesheet" href=" https://cdn.datatables.net/buttons/1.5.6/css/buttons.jqueryui.min.css">



  

  <link rel="stylesheet" href=" https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href=" https://cdn.datatables.net/buttons/1.5.6/css/buttons.bootstrap.min.css">
  <link rel="stylesheet" href="">
 
  
    
    



  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
 

  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/dataTables.jqueryui.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>

  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.jqueryui.min.js"></script>
   
  <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js"></script>
  

     
 <div class="content-wrapper">
  


  <!-- Main content -->
  <section class="content">



   <style>
 
	
   </style>


<div style="width:100%">
          <div class="box box-default">
            <div class="box-header with-border">

	<div class="row">


		 <h2 class="text-center">INVESTORS DEPOSIT MANAGEMENT</h2>
		  </br>

</br>
 <?php if($msg != "") echo "<div style='padding:20px;background-color:#dce8f7;color:black'> $msg</div class='btn btn-success'>" ."</br></br>";  ?>
          </br>
		    </br>

<div class="col-md-12 col-sm-12 col-sx-12">
               <div class="table-responsive">
                     <table class="display"  id="example">

					<thead>

						<tr class="info">
						<th>Email</th>
						<th style="display:none;"></th>
						<th style="display:none;"></th>
						<th style="display:none;"></th>
            <th style="display:none;"></th>
						<th style="display:none;"></th>
						<th>Investment Plan</th>
							<th>Amount(USD)</th>
              <th>Mode</th>
                               <th>Status</th>
							 
							 <th>Transaction ID</th>
							 <th style="display:none;"></th>
							  <th>Referrer  </th>
							<th>Date</th>
                                <th>Action</th>
                                 <th>Action</th>
                                
								
                                

						</tr>
					</thead>


					<tbody>
					<?php $sql= "SELECT * FROM btc WHERE type = 'Deposit' ORDER BY id DESC";
			  $result = mysqli_query($link,$sql);
			  if(mysqli_num_rows($result) > 0){
				  while($row = mysqli_fetch_assoc($result)){   



$row['status'];
$row['referred'];
   
   
if(isset($row['status']) &&  $row['status']== 'approved'){
	
	
	$sec = 'Approved &nbsp;&nbsp;<i style="background-color:green;color:#fff; font-size:20px;" class="fa  fa-check" ></i>';

}else{
$sec ='Pending &nbsp;&nbsp;<i class="fa  fa-refresh" style=" font-size:20px;color:red"></i>';

}


				  ?>

						<tr class="primary">
						<form action="deposit.php" method="post">
                            <td><?php echo $row['email'];?></td>
							
							<td style="display:none;"><input type="hidden" name="email" value="<?php echo $row['email'];?>"> </td>
							<td style="display:none;"><input type="hidden" name="usd" value="<?php echo $row['usd'];?>"> </td>
							
							<td style="display:none;"><input type="hidden" name="tnx" value="<?php echo $row['tnxid'];?>"> </td>
							<td style="display:none;"><input type="hidden" name="ivtplan" value="<?php echo $row['account'];?>"> </td>
              <td style="display:none;"><input type="hidden" name="cointype" value="<?php echo $row['cointype'];?>"> </td>
              
							<td><?php echo $row['account'];?> </td>
							<td>$<?php echo $row['usd'];?></td>
              <td><?php echo $row['cointype'];?></td>
							<td><?php echo $sec ;?></td>
							
							<td><?php echo $row['tnxid'];?></td>
              
           <td style="display:none;"><input type="hidden" name="referred" value="<?php echo $row['referred'];?>"> </td>
		    <td><?php echo $row['referred'];?></td>
			   <td><?php echo $row['date'];?></td>
			  
                            <td><button class="btn btn-success" type="submit" name="approve"><span class="glyphicon glyphicon-check"> Approve</span></button></td>
                            
						
							
							<td><button class="btn btn-danger" type="submit" name="delete"><span class="glyphicon glyphicon-check"> Delete</span></button></td>
							
   
</form>

						</tr>
					  <?php
 }
			  }
			  ?>
					</tbody>



				</table>
</div>
          </div>

		  </div>
          <!-- /top tiles -->

          </div>

                



    </body>
              </div>
            </div>


              </div>


          <br />







    </body>
              </div>
            </div>





          </section>

   </div>
  </div>
</div>


  </body>
</html>
    
<script>
$(document).ready(function() {
    var table = $('#example').DataTable( {
        lengthChange: false,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ],
       
    } );
    

    table.buttons().container()
        .insertBefore( '#example_filter' );

        table.buttons().container()
        .appendTo( '#example_wrapper .col-sm-12:eq(0)' );
} );
</script>






<script>
$(document).ready(function () {
        $('#table')
                .dataTable({
                    "responsive": true,
                    
                });

				
    });



				</script>


