<?php 
    require("config.php");
	require("local.php"); 
    $submitted_username = ''; 
    if(!empty($_POST)){ 
        $username=strip_tags(trim($_POST['username']));
        $password=strip_tags(trim($_POST['password']));
         
        if($username === $admin_user and $password === $admin_password)
            $login_ok = true;
          
        if($login_ok){ 
            $_SESSION['user'] = "admin";  
            header("Location: index.php");
            die("Redirecting to: index.php"); 
        } 
        else{ 
            print('<h3 style="color:red; text-align:center">Login Failed.</h3>'); 
            $submitted_username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8'); 
        } 
    } 
?> 

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- blueimp Gallery styles -->
    <link rel="stylesheet" href="https://blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <style type="text/css">
        body { background: url(assets/bglight.png); }
        .hero-unit { background-color: #fff; }
        .center { display: block; margin: 0 auto; }
    </style>
</head>

<body>

 <div class="modal-dialog">

            <!-- Download Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Authentication required</h4>
              </div>
              
                <div class="col" style="padding:20px; text-align:center">
                  <form action="login.php" method="post"> 
                        Username:<br /> 
                        <input type="text" name="username" value="<?php echo $submitted_username; ?>" /> 
                        <br /><br /> 
                        Password:<br /> 
                        <input type="password" name="password" value="" /> 
                        <br /><br /> 
                         <input type="submit" class="btn btn-info" value="Login" /> 
                    </form> 
                  
                </div>
                
              <div class="modal-footer">
                
              </div>
            </div>

          </div>

</body>
</html>