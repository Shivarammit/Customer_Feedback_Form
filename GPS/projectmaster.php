<?php
$conn=new mysqli('localhost','root','youpassword','gps'); 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 $action=$_POST['action'];
 if ($action == 'form1'){
    $pno=$_POST['pno1'];
    $pname=$_POST['pname'];
    $cname=$_POST['cname'];
    $cno=$_POST['cno'];
    $check="SELECT * FROM projects WHERE pno=?";
    $stcheck=$conn->prepare($check);
    $stcheck->bind_param('s',$pno);
    $stcheck->execute();
    $result=$stcheck->get_result();
    if($result->num_rows > 0){
        echo '<script>alert("Project Already Found in Database")</script>';
        header("Location: projectmaster.html?operation=notfound");
    }
    else{
        $ins="INSERT INTO projects (pno,pname,cname,cno) VALUES(?,?,?,?)";
        $insert=$conn->prepare($ins);
        $insert->bind_param("ssss",$pno,$pname,$cname,$cno);
        if ($insert->execute()) {
            echo '<script>alert("Project Already Found in Database")</script>';
            header("Location: projectmaster.html?operation=insert");
        } else {
            echo "Error: " . $insert->error;
        }
    }
 }
 if ($action == 'form2'){
    $pno=$_POST['pno2'];
    $check="SELECT * FROM projects WHERE pno=?";
    $stcheck=$conn->prepare($check);
    $stcheck->bind_param('s',$pno);
    $stcheck->execute();
    $result=$stcheck->get_result();
    if($result->num_rows == 0){
        echo '<script>alert("Project  not Found in Database")</script>';
        header("Location: projectmaster.html?operation=notfound");
    }
    $action1=$_POST['action1'];
    if ($action1 == 'form6'){
        $pname=$_POST['pname1'];
        $up="UPDATE projects SET pname=? WHERE pno=?";
        $update=$conn->prepare($up);
        $update->bind_param("ss",$pname,$pno);
        if ($update->execute()) {
            echo '<script>alert("Record updated successfully")</script>';
            header("Location: projectmaster.html?operation=update");
        } else {
            echo "Error: " . $update->error;
        }
    }
    if ($action1 == 'form7'){
        $cname=$_POST['cname1'];
        $up="UPDATE projects SET cname=? WHERE pno=?";
        $update=$conn->prepare($up);
        $update->bind_param("ss",$cname,$pno);
        if ($update->execute()) {
            echo '<script>alert("Record updated successfully")</script>';
            header("Location: projectmaster.html?operation=update");
        } else {
            echo "Error: " . $update->error;
        }
    }
    if ($action1 == 'form8'){
        $cno=$_POST['cno1'];
        $up="UPDATE projects SET cno=? WHERE pno=?";
        $update=$conn->prepare($up);
        $update->bind_param("ss",$cno,$pno);
        if ($update->execute()) {
            echo '<script>alert("Record updated successfully")</script>';
            header("Location: projectmaster.html?operation=update");
        } else {
            echo "Error: " . $update->error;
        }
    }
 }
 if ($action == 'form3'){
    $pno=$_POST['pno3'];
    $check="SELECT * FROM projects WHERE pno=?";
    $stcheck=$conn->prepare($check);
    $stcheck->bind_param('s',$pno);
    $stcheck->execute();
    $result=$stcheck->get_result();
    if($result->num_rows == 0){
        echo '<script>alert("Project  not Found in Database")</script>';
        header("Location: projectmaster.html?operation=notfound");
    }
    $del="DELETE FROM projects WHERE pno=?";
    $delete=$conn->prepare($del);
    $delete->bind_param("s",$pno);
    if ($delete->execute()) {
        echo '<script>alert("Record deleted successfully")</script>';
        header("Location: projectmaster.html?operation=delete");
    } else {
        echo "Error: " . $delete->error;
    }
 }
}
?>