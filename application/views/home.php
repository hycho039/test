
  <!-- Page Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h1 class="mt-5">Welcome!  
        <?php 
          if(isset($_SESSION['user_id'])){
            echo $_SESSION['user_name']; 
          }
        ?>
        <p class="lead">Rough application for CRUD</p>
        <ul class="list-unstyled">
          <img src="https://dogsaholic.com/wp-content/uploads/2015/08/Runing-Maltese.jpg" alt="want to go home..."/>

        </ul>
      </div>
    </div>
  </div>
</body>

</html>
