<?php 
include('dbcon.php');
session_start();

if(isset($_POST['save'])){
    $userid=$_POST['userid'];
    $name=$_POST['name'];
    $task=$_POST['task'];
    $ddate=$_POST['ddate'];
    
    

$sql="INSERT INTO Task (user_id,user_name,Task,Ddate,CreatedBy) VALUES('$userid',' $name','$task','$ddate','". $_SESSION['uname']."') " ;
$run=sqlsrv_query($conn,$sql);


if($run){
    ?>
    <script>
        window.open('mytask.php','_self');  
    </script>
<?php
}else{
  print_r(sqlsrv_errors());  
}
}

//for getting userid for each name selected
if(isset( $_POST['empname'])){
    
    $sql = "SELECT * FROM [Workbook].[dbo].[user] where user_name = '".$_POST['empname']."' ";
    $run = sqlsrv_query($conn,$sql);
    $row = sqlsrv_fetch_array($run, SQLSRV_FETCH_ASSOC);
    $id = $row['employee_id'];
    
    echo $id;
}

//edit
if(isset($_POST['edit'])){
    $Sr=$_POST['Sr'];
    $userid=$_POST['userid'];
    $name=$_POST['name'];
    $task=$_POST['task'];
    $ddate=$_POST['ddate'];
    $remark=$_POST['remark'];
    


    $sql="UPDATE Task SET user_id='$userid',user_name=' $name',Task=' $task',Ddate='$ddate',Remarks='$remark', UpdatedBy='".$_SESSION['uname']."', UpdatedAt='".date(Y-m-d)."'";
    $run=sqlsrv_query($conn,$sql);
    if($run){
        ?>
        <script>
            alert('updated successfully');
            window.open('mytask.php','_self');

        </script>
        <?php
    }else{
        print_r(sqlsrv_errors());
    }
}

//remark
if(isset($_POST['remark'])){
    $remarks=$_POST['remarks'];
    $date=$_POST['cdate'];
    $id=$_POST['id'];

    $sql="UPDATE Task SET Cdate='$date', Remarks='$remarks' WHERE Sr='$id' " ;
    $run=sqlsrv_query($conn,$sql);


    if($run){
        ?>
        <script>
            window.open('assignedtasks.php','_self');
        </script>
    <?php
    }else{
      print_r(sqlsrv_errors());  
    }

}

//delete
if(isset($_GET['del'])){
    $Sr=$_GET['del'];

    $sql="UPDATE Task SET Isdelete=1, UpdatedBy='".$_SESSION['uname']."', UpdatedAt='".date('Y-m-d')."' WHERE Sr='$Sr'";
    $run=sqlsrv_query($conn,$sql);

if($run){
    ?>
    <script>
        alert('Deleted Successfully');
        window.open('mytask.php','_self');
    </script>
    <?php
    }else{
        print_r(sqlsrv_errors());
    }
}

?>





