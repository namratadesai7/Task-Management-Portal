<?php
session_start();
include('dbcon.php');

if(isset($_POST['login'])){
    $empid=$_POST['empid'];
    $pwd=$_POST['pwd'];

    $sql="SELECT * FROM [Workbook].[dbo].[user] where employee_id= '$empid'";
    $run= sqlsrv_query($conn,$sql);
    $row=sqlsrv_fetch_array($run,SQLSRV_FETCH_ASSOC);

    if($pwd==$row['password']){
        $_SESSION['Sr']=$row['id'];
        $_SESSION['empid']=$row['employee_id'];
        $_SESSION['uname']=$row['user_name'];
        $_SESSION['password']=$row['password'];
        $_SESSION['rights']=$row['rights'];

        ?>
        <script>
            // alert('User logged in');
            window.open('dashboard.php','_self');

        </script>

<?php
    }
    else{
?>
      <script>
        alert('Password not march');
        window.open('index.php','_self');
      </script>
<?php
    }
}

?>