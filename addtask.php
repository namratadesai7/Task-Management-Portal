<?php
include('dbcon.php');
include('header.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Task</title>
</head>
<body>
     <div class="container-fluid mt-2 p-0">
        <div class="divcss">
            <form  action="addtask_db.php" method="post" autocomplete="off" enctype="multipart/form-data">
                <div>
                    <label  style="width:20%;" class="form-label" for="name">Name
                           
                            <select name="name" id="name" class="form-select">
                                <option></option>
                                <?php
                                    $sql="SELECT * FROM  [Workbook].[dbo].[user] WHERE id BETWEEN 1 AND 5 ";
                                    $run=sqlsrv_query($conn,$sql);
                                    while($row=sqlsrv_fetch_array($run,SQLSRV_FETCH_ASSOC)){
                                    ?>
                                       <option><?php echo $row['user_name']?></option>      
<?php
                                    }
                                ?>
                            </select>
                        </label>
                    <label style="width:20%;" class="form-label"  for="userid">User ID
                            <input  type="text" placeholder="Enter UserID"  name="userid" id="userid" class="form-control " required>
                    </label>
                    <label  style="width:20%;" class="form-label"  for="task">Task
                            <input type="text" placeholder="Enter Task Description" name="task" id="task" class="form-control " required>
                        </label>
                    <label for="ddate" style="width:20%;" class="form-label">Deadline
                            <input type="date" placeholder="Enter Deadline" name="ddate" id="ddate" class="form-control " required>
                    </label>
                    <!-- <label for="remark" style="width:20%;" class="form-label">Remarks
                            <input type="text" placeholder="Enter remarks" name="remark" id="remark" class="form-control ">
                    </label> -->
                </div>
                <div class="mt-3">
                    <div class="row">
                        <div class="col"></div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-success rounded-pill" name="save">Submit</button>
                            <a href="mytask.php" class="btn btn-danger rounded-pill ms-1">Back</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
     </div>
</body>
</html>
<script>
      $('#mytask').addClass('activeTab');

      $(document).on('change','#name',function(){
        var name = $(this).val();
        console.log(name);
        $.ajax({
            url:'addtask_db.php',
            type:'post',
            data:{empname:name},
            success:function(data){
                $('#userid').val(data);
                console.log(data);
            },
            error:function(res){
                console.log(res);
            }
        });
      });

      //disable dates
      var today= new Date();
      var d = today.getDate();
      var m = today.getMonth() +1;
      var y = today.getFullYear();
      if(d<10){
        d='0'+d;
      }
      if(m<10){
        m='0'+m;
      }
      today= y+'-'+m+'-'+d ;
     
      document.getElementById('ddate').setAttribute("min",today);

      
</script>

<?php
include('footer.php');

?>