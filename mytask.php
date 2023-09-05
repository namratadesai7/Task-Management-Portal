<?php
include('dbcon.php');
include('header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My tasks</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h3>My Tasks</h3>
            </div>
            <div class="col-auto">
            <a href="addtask.php" class="btn btn-danger rounded-pill me-5">Add</a>
                <!-- <button type="button" class="btn btn-primary ms-3" id="Add">Add</button> -->
            </div>
        </div>
        <div class="divcss mt-2">
            <table class="table table-bordered text-center mb-0 table-striped table-hover" id="tasktable">
                <thead>
                    <th>Sr</th>
                    <th>User_Id</th>
                    <th>User Name</th>
                    <th>Task</th>
                    <th>Date Created</th>
                    <th>D Day</th>
                    
                    <th>Assigned By</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php
                        $Sr=1;
                        if($_SESSION['rights'] == 'Admin'){
                            $sql="SELECT * FROM Task WHERE Isdelete=0 " ;
                        }else{
                            $sql="SELECT * FROM Task WHERE CreatedBy='".$_SESSION['uname']."' AND Isdelete=0 " ;
                        }                        
                        $run=sqlsrv_query($conn,$sql);
                        while($row=sqlsrv_fetch_array($run,SQLSRV_FETCH_ASSOC)){
                    ?>
                    <tr>
                        <td><?php echo $Sr ?></td>
                        <td><?php echo $row['user_id']  ?></td>
                        <td><?php echo $row['user_name']  ?></td>
                        <td><?php echo $row['Task']  ?></td>
                        <td><?php echo $row['CreatedAt']->format('d-m-Y')  ?></td>
                        <td><?php echo $row['Ddate']->format('d-m-Y')   ?></td>
                        <td><?php echo $row['CreatedBy']  ?></td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm rounded-pill px-3 my-1 edit" id="<?php echo $row['Sr']?>" >Edit</button>
                       
                            <button type="button" class=" btn btn-danger btn-sm rounded-pill delete" id="<?php echo $row['Sr'] ?>" >Delete</button>
                        </td>        
                    </tr>
                    <?php
                    $Sr++ ; }
                    ?>
                </tbody>
            </table>   
        </div>
        <!-- remark modal -->

        <div class="modal fade" id="remarkModal" tabindex="-1" aria-labelledby="remarkModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="addtask_db_db.php" method="post" id="remarkForm">

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="remark" form="remarkForm">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- //edit modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="addtask_db.php" method="post" id="editForm">

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="edit" form="editForm">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</body>
</html>
<script>
    $('#mytask').addClass('activeTab');

    $(document).on('click','.edit',function(){
        var id= $(this).attr('id');
        $.ajax({
            url:'edittask.php',
            type: 'post',
            data: {id:id},  
            // dataType: 'json',
            success:function(data){
              $('#editForm').html(data);  
              $('#editModal').modal('show');
            }
          });
        });


    $(document).on('click','.delete',function(){
        var del=  $(this).attr('id');
        if(confirm('Are You Sure!')){   
            window.open('addtask_db.php?del='+del,'_self');
        }else{
            return false;
        }
    });
      
</script>

<?php
include('footer.php');
?>