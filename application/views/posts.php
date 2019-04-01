  <!-- Page Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h2 class="mt-5 text-left">CRUD AJAX & PHP & Codeigniter</h2>
        <div class="card">
          <div class="card-header bg-light">
            Board_Test_Version
            <div class="btn-group float-right">
              <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModalAdd"><i class="fa fa-plus" data-toggle="tooltip" title="Add post"></i></button>
            </div>
          </div>
          <div class="card-body">
            <table class="table table-bordered" id="board-table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Title</th>
                  <th>Department</th>
                  <th>Writer</th>
                  <th>Created</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="board-row">

              </tbody>
            </table>
          </div> 
        </div>
      </div>
    </div>

    <!-- The Modal Add Post -->
    <div class="modal fade" id="myModalAdd" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Add Post</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <form class="form-horizontal" id="form-create">
              <div class="form-group">
                <!-- hidden user_id --> 
                <?php 
                if(isset($_SESSION['user_id'])){ 
                  echo "<input type='hidden' name='user_id' value=".$_SESSION['user_id'].">"; 
                } else {
                  echo "<input type='hidden' name='user_id' value='-1'>"; 
                }
                ?>
                <label class="control-label col-sm-2" for="title">Title:</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="content">Content:</label>
                <div class="col-sm-12">
                  <textarea class="form-control" id="content" name="content" placeholder="Write Content"></textarea>
                </div>
              </div>
            </form>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-success" id="btn-create">Create</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>

        </div>
      </div>
    </div>

    <!-- Modal Delete Post -->
    <div class="modal fade" role="dialog" id="myModalDelete">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Delete post</h4>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            Are you sure to delete? 
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-info" data-dismiss="modal" id="btn-delete">Yes</button>
            <button type="button" class="btn btn-warning" data-dismiss="modal">No</button>
          </div>

        </div>
      </div>
    </div>

    <!-- Modal Update Post -->
    <div class="modal fade" id="myModalUpdate" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Update Post</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <form id="form-update-post" class="form-horizontal">
            </form>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-success" id="btn-update">Update</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>

        </div>
      </div>
    </div>

     <!-- Modal Show Post -->
    <div class="modal fade" id="myModalShow" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Show Post</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <form id="form-show-post" class="form-horizontal">
            </form>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>

        </div>
      </div>
    </div>
  </div>
  <script>
      $(document).ready(function(){
        window.onload = function(){
          show_board(); 
        };
        $('[data-toggle="tooltip"]').tooltip(); 
        function show_board()
        {
          $.ajax({
              url: "<?php echo base_url()?>board/get_board", 
              type: "GET", 
              dataType: 'json', 
              success: function(data){
                $('#board-row').html(data); 
              }, 
              error: function(request, xhr, error){
                alert('Error ...'); 
                console.warn(error); 
              }
            }); 
        }
        // Create post 
        $('#btn-create').on('click', function(){
          $.ajax({
            url: "<?php echo base_url() ?>board/create_post", 
            type: "POST", 
            data: $('#form-create').serialize(), 
            dataType: 'json', 
            success: function(data){
              if(data.success)
              {
                show_board(); 
                $('#form-create')[0].reset();
                alert('Success'); 
                $('#myModalAdd').modal('hide');
              }
            }, 
            error: function(request, xhr, error){
              alert('Error...');
              console.log(error);
            }
          });
        });

        // Delete post 
        $('#board-row').on('click', '.btn-confirm-delete', function(){
            var id= $(this).attr('dataid'); 
            $('#myModalDelete').data('id', id).modal('show');
        });
        $('#btn-delete').on('click', function(){
          var id=$('#myModalDelete').data('id'); 

          $.ajax({
            url: "<?php echo base_url()?>board/delete_post", 
            type: "POST", 
            data: {board_id:id},
            dataType: 'json', 
            success: function(data){
              alert('Deleted'); 
              show_board();
              $('#myModalDelete').modal('hide');
            }, 
            error: function(request, xhr, error){
              alert('Error ...'); 
              console.warn(error); 
              $('#myModalDelete').modal('hide');

            }
          }); 
        });

        // Update post 
        $('#board-row').on('click', '.btn-confirm-update', function(){
          var id= $(this).attr('dataid'); 
          $.ajax({
            url: "<?php echo base_url()?>board/get_update_post", 
            type: "POST", 
            data: {board_id:id},
            dataType: 'json', 
            success: function(data){
              var user_id = <?php echo $_SESSION['user_id'] ?>; 

              if(user_id==data[1] || user_id=='1'){  
                $('#form-update-post').html(data[0]);
                $('#myModalUpdate').modal('show');
              } else{
                alert("You don't have access!"); 
              }
            }, 
            error: function(request, xhr, error){
              alert('Error ...'); 
              console.warn(error); 
            }
          }); 
          }); 
        $('#btn-update').on('click', function(){
           $.ajax({
              url: "<?php echo base_url()?>board/update_post", 
              type: "POST", 
              data: $('#form-update-post').serialize(),
              dataType: 'json', 
              success: function(data){
                   alert('Success'); 
                   $('#myModalUpdate').modal('hide');
                   show_board();

              }, 
              error: function(request, xhr, error){
                alert('Error ...'); 
                console.warn(error); 
              }
            }); 
         });

        // Show post 
        $('#board-row').on('click', '.btn-confirm-show', function(){
          var id= $(this).attr('dataid'); 
          $.ajax({
            url: "<?php echo base_url()?>board/get_update_post", 
            type: "POST", 
            data: {board_id:id},
            dataType: 'json', 
            success: function(data){
              $('#form-show-post').html(data[0]);
              $('#myModalShow').modal('show');
            }, 
            error: function(request, xhr, error){
              alert('Error ...'); 
              console.warn(error); 
            }
          }); 
        }); 
      }); 
  </script>