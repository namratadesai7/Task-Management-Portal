<?php
include('dbcon.php');
include('header.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assigned Tasks</title>
</head>
<body>
    <div class="divcss">
    <table class="table table-bordered text-center mb-0 table-striped table-hover" id="tasktable">
                <thead>
                    <th>Sr</th>
                    <th>User_Id</th>
                    <th>User Name</th>
                    <th>Task</th>
                    <th>Date Created</th>
                    <th>D Day</th>
                    <th>Assigned By</th>
                    <th>Completion Date</th>
                    <th>Remark</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php
                        $Sr=1;
                        $sql="SELECT  Sr,user_id,user_name,Task,format(CreatedAt,'d-MM-yy') as CreatedAt,format(Cdate,'d-MM-yy') as Cdate,format(Ddate,'d-MM-yy') as Ddate,Remarks,CreatedBy FROM Task WHERE user_id='".$_SESSION['empid']."' AND isdelete= 0" ;
                        $run=sqlsrv_query($conn,$sql);
                        while($row=sqlsrv_fetch_array($run,SQLSRV_FETCH_ASSOC)){
                    ?>
                    <tr>
                        <td><?php echo $Sr ?></td>
                        <td><?php echo $row['user_id']  ?></td>
                        <td><?php echo $row['user_name']  ?></td>
                        <td><?php echo $row['Task']  ?></td>
                        <td><?php echo $row['CreatedAt'] ?></td>
                        <td><?php echo $row['Ddate']       ?></td>
                        <td><?php echo $row['CreatedBy']  ?></td>
                        <td><?php echo $row['Cdate']  ?></td>
                        <td><?php echo $row['Remarks']  ?></td>
                        <td>
                   
                        <button type="button" class="btn btn-primary btn-sm rounded-pill  btn-sm remarks" id="<?php echo $row['Sr']?>" >Remarks</button>
                    
                        </td>        
                    </tr>
                    <?php
                    $Sr++ ; }
                    ?>
                </tbody>
            </table>   
        <!-- remark modal -->
        <div class="modal fade" id="remarkModal" tabindex="-1" aria-labelledby="remarkModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="addtask_db.php" method="post" id="remarkForm">

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="remark" form="remarkForm">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<script>
     $('#assitasks').addClass('activeTab');

     $(document).on('click','.remarks',function(){
        var id= $(this).attr('id');
        $.ajax({
            url:'remarktask.php',
            type: 'post',
            data: {id:id},  
            
            success:function(data){
              $('#remarkForm').html(data);  
              $('#remarkModal').modal('show');
            }
          });
        });

    
</script>

<?php
include('footer.php');
?>