<?php
    include('dbcon.php');
    $sr=$_POST['id'];
 
    
    $sql="SELECT * FROM Task WHERE Sr='$sr'";
    $run=sqlsrv_query($conn,$sql);
    $row=sqlsrv_fetch_array($run,SQLSRV_FETCH_ASSOC);
   
    ?>
    <div >
        <label  style="width:100%;" class="form-label" for="name">Name
                           
            <select name="name" id="name" class="form-select">
                <!-- <option> <?php echo $row['user_name']  ?></option> -->
              
    <?php
            $sqla="SELECT * FROM  [Workbook].[dbo].[user] WHERE id BETWEEN 1 AND 5";
            $runa=sqlsrv_query($conn,$sqla);
            while($rowa=sqlsrv_fetch_array($runa,SQLSRV_FETCH_ASSOC)){
           ?>
            <option <?php if($row['user_name'] ==  $rowa['user_name']){
                            ?> selected <?php } ?> > <?php echo $rowa['user_name']?></option>   
            
<?php
            }
?>
        </select>
        </label>
        <label style="width:100%;" class="form-label"  for="userid">User ID
            <input  type="text" placeholder="Enter UserID"  name="userid" id="userid" class="form-control " value="<?php echo $row['user_id']  ?>">
            <input type="hidden" placeholder="Enter remarks" name="id" id="id" class="form-control " value="<?php echo $row['Sr']  ?>">
        </label>
        <label  style="width:100%;" class="form-label"  for="task">Task
            <input type="text" placeholder="Enter Task Description" name="task" id="task" class="form-control" value="<?php echo $row['Task']  ?>">
        </label>
        <label for="ddate" style="width:100%;" class="form-label">Deadline
            <input type="date" placeholder="Enter Deadline" name="ddate" id="ddate" class="form-control " value="<?php echo $row['Ddate']->format('Y-m-d')  ?>">
        </label>
                <!-- <label for="remark" style="width:100%;" class="form-label">Remarks
                    <input type="text" placeholder="Enter remarks" name="remark" id="remark" class="form-control " value="<?php echo $row['Remarks']  ?>">
                </label> -->
      
           
   

    </div>
    <script>
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
      </script>  