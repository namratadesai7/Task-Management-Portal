<?php
include('dbcon.php');

$sr=$_POST['id'];
$sql="SELECT * FROM Task  WHERE Sr='$sr'";
$run=sqlsrv_query($conn,$sql);
$row=sqlsrv_fetch_array($run,SQLSRV_FETCH_ASSOC);
$date= $row['CreatedAt']->format('d-m-Y');

?>
<div>
    <label style="width:100%;" for="remark" style="width:20%;" class="form-label">Remarks
        <input type="text" placeholder="Enter remarks" name="remarks" id="remarks" class="form-control " required>
        <input type="hidden"  name="ddate" id="ddate" value="<?php echo $date ?>">
    </label>
    <label style="width:100%;" for="cdate" style="width:20%;" class="form-label">Completion Date
        <input type="date" placeholder="COmpletion Date" name="cdate" id="cdate" class="form-control " required>
    </label>
</div>
 
<script>
var date = document.getElementById('ddate').getAttribute("value");


var parts = date.split('-');
var day = parseInt(parts[0]);
var month = parseInt(parts[1]);
var year = parseInt(parts[2]);
var dat = new Date(year, month - 1, day);


var d = dat.getDate();
var m = dat.getMonth() + 1;
var y = dat.getFullYear();

if (d < 10) {
    d = '0' + d;
}
if (m < 10) {
    m = '0' + m;
}
 dat = y + '-' + m + '-' + d;

document.getElementById('cdate').setAttribute("min",dat);



</script>