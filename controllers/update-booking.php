<?php
    include('db.php');
    $database = new Database();
    $conn = $database->getConnection();

    if(count($_POST)>0){
        if($_POST['type']==2){
            $id=$_POST['id'];
            $payment_status=$_POST['payment_status'];
            $email=$_POST['email'];
            
            $sql = "UPDATE `tblbooks` SET `payment_status`='$payment_status' WHERE id=$id";
            if (mysqli_query($conn, $sql)) {
                $to = $email;
    
                $subject = 'Booking Confirmed';
                $message = '<p>We are pleased to inform you that your booking request has been confirmed</p>';
                $message = '<p>Please check your account. Secure screenshots or print your booking receipt and present to the bus counter.
                                </p>';
              
                // $message .= '<a href="'.$url.'" target="_blank">Reset Password</a>';
            
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            
                mail($to, $subject, $message, $headers);
                echo json_encode(array("statusCode"=>200));
            } 
            else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            mysqli_close($conn);
        }
    }
?>