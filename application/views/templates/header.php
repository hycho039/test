<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>HYCHO CRUD</title>

  <!-- Bootstrap core CSS -->
  <link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- Bootstrap core JavaScript -->
  <script src="<?php echo base_url() ?>assets/js/jquery.js"></script>
  <script src="<?php echo base_url() ?>assets/js/bootstrap.bundle.js"></script>

</head>

<body>
  <!-- session check the user data -->

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
      <a class="navbar-brand" href="<?php echo base_url() ?>">Hyein Cho</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="<?php echo base_url() ?>">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>board/about">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>board/posts">Board</a>
          </li>
          <li class="nav-item">
            <!-- <button type="button" class="btn btn-link" data-toggle="modal" data-target="#myModalLogin" name="login" id="login">Login
            </button> -->
            <?php 
            if(isset($_SESSION['user_id']))
            {
            ?>
            <button type="button" class="btn btn-link" data-toggle="modal" name="logout" id="logout">Logout
            </button>
            <?php 
            }
            else 
            {
            ?>
            <button type="button" class="btn btn-link" data-toggle="modal" data-target="#myModalLogin" name="login" id="login">Login
            </button>
            <?php 
            }
            ?>
            
          </li>
        </ul>
      </div>
    </div>
  </nav>

<!-- Login Modal -->
  <div class="modal fade" id="myModalLogin" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Login</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <form class="form-horizontal" id="form-login">
              <div class="form-group">
                <label class="control-label col-sm-2" for="email">Email</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="content">Password</label>
                <div class="col-sm-12">
                  <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password"></input>
                </div>
              </div>
            </form>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-success" id="btn-login">Login</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>

        </div>
      </div>
    </div>

<script>
$(document).ready(function(){
  $("#btn-login").click(function(){
    var email = $('#email').val(); 
    var password = $("#password").val(); 
    if(email != '' && password != '')
    {
        $.ajax({
          url: "<?php echo base_url() ?>users/login", 
          method: "POST", 
          data:{email:email, password:password}, 
          success: function(data){

            if(data){
            $('#myModalLogin').hide();
            location.reload();  
          } else {
            alert('Wrong data'); 
          }

          }, 
          error: function(request, xhr, error){
            alert("Error"); 
            //console.warn(error); 
          }

        });
    } 
    else 
    {
        alert("Both information are required"); 
    }
  });

  $('#logout').click(function(){
    var action = "logout"; 
    $.ajax({
      url: "<?php echo base_url() ?>users/logout", 
      method: "POST", 
      data:{action:action}, 
      success: function(data)
      {
        location.reload(); 
      }
    })
  });  
}); 
</script>



