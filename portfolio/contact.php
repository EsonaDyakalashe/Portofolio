<?php
error_reporting(0);
$msg="";
if (isset($_POST['submit'])){
    $to="esonadyakalashe@gmail.com";
    $subject = "Form Submission";
    $name= $_POST['name'];
    $email=$_POST['email'];
    $message=$_POST['message'];

    $msgBody ='Name: ' .$name. ' has written you : ' .$message;
    $headers = 'From:'.$email;

    $secretKey="6LecT48bAAAAACHy2r_p7m1ktfbdzH_bmuz43n11";
    $responseKey=$_POST['g-recaptcha-response'];
    $url ="https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&responseKey"

    $response = file_get_contents($url);
    $response =json_decode($response);

    if ($response->success){
        if(mail($to,$subject,$msgBody,$headers)){
            $msg="Message Sent Successfully!";
        }
        else{
            $msg = "Failed to send the message!";
        }else{
            $msg = "Verification Failed!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Esona Dyakalashe">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initail-scale=1,shrink-to-fit=no">
        <title>Contact us form with recapture</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
         integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <head>
</head>
<body class="bg-info">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 bg-light rounded mt-3">
                <h4 class="text-center text-dark p-2">Contact Us</h4>
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" class="p-2">
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Enter E-mail" required>
                </div>
                <div class="form-group">
                   <textarea name="message" class="form-control"  rows="4" placeholder="Write your message"></textarea>
                </div>
                <div class="form-group">
                    <div class="g-recaptcha" data-sitekey="6LecT48bAAAAAPuQqit6TtBO2MUT1E9suD4j9G6d"></div>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Send" class="btn btn-danger btn-block" >
                </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>
</html>