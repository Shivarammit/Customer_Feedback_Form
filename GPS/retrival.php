<html>
    <link rel="stylesheet"  href="retrival.css">
    <head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.2/html2pdf.bundle.min.js" integrity="sha512-MpDFIChbcXl2QgipQrt1VcPHMldRILetapBl5MPCA9Y8r7qvlwx1/Mc9hNTzY+kS5kX6PdoDq41ws1HiVNLdZA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </head>
    <img src="WhatsApp Image 2024-07-14 at 10.03.18_edde10e9.jpg" alt="Default Image" id="defaultImage">
    <div class="form_section">
    <form action="" method="post">
        <div class="middle">
        <label>Project Number</label>
        <input type="text" id="pno" name="pno" placeholder="Project Number">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label>Contract Number:</label>
        <input type="text" id="con_no" name="con_no" placeholder="Contract Number"><br><br><br>
        <label>From date:</label>
        <input type="date" id="fdate" name="fdate" placeholder="yyyy-mm-dd">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label>To date:</label>
        <input type="date" id="tdate" name="tdate" placeholder="yyyy-mm-dd">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label>Client Name</label>
        <input type="text" id="cname" name="cname" placeholder="Client Name"><br><br><br>
        <button name="submit">Search</button>
    </form>
    </div>
<div class="elem">
<table style="border: 1px solid black; width:100%; text-align:center; ">
    <th style="border: 1px solid white; background-color: black; color: white; height:50px">Company Name</th>
    <th style="border: 1px solid white; background-color: black; color: white; height:50px">Contract Number</th>
    <th style="border: 1px solid white; background-color: black; color: white; height:50px">Project Title</th>
    <th style="border: 1px solid white; background-color: black; color: white; height:50px">Client Name</th>
    <th style="border: 1px solid white; background-color: black; color: white; height:50px">Client Designation</th>
    <th style="border: 1px solid white; background-color: black; color: white; height:50px">Average Rating</th>
<?php
  if (isset($_POST['submit'])) {
    $conn=new mysqli('localhost','root','youpassword','gps');
    $pno = isset($_POST['pno']) ? $_POST['pno'] : null;
    $con_no = isset($_POST['con_no']) ? $_POST['con_no'] : null;
    $cname= isset($_POST['cname']) ? $_POST['cname'] : null;
    $from_date = isset($_POST['fdate']) ? $_POST['fdate'] : null;
    $to_date = isset($_POST['tdate']) ? $_POST['tdate'] : date('Y-m-d') ;
    $from_date = $from_date ? date('Y-m-d', strtotime($from_date)) : null;
    $to_date = $to_date ? date('Y-m-d', strtotime($to_date)) : date('Y-m-d');
    $stm2 = "SELECT * FROM feedback WHERE (pno LIKE ? OR ? IS NULL) AND (con_no LIKE ? OR ? IS NULL) AND (cname LIKE ? OR ? IS NULL) AND (fill_date >= ? OR ? IS NULL)  AND (fill_date <= ? OR ? IS NULL)";
    $stmt2 = $conn->prepare($stm2);
    $pno = $pno !== null ? "%$pno%" : null;
    $con_no = $con_no !== null ? "%$con_no%" : null;
    $cname = $cname !== null ? "%$cname%" : null;
    $stmt2->bind_param('ssssssssss',$pno,$pno,$con_no,$con_no,$cname,$cname,$from_date,$from_date,$to_date,$to_date);
    $stmt2->execute();
    $res=$stmt2->get_result();
    while($a = mysqli_fetch_array($res)){
?>
        <tr>
            <td style="border: 1px solid black;"><?php echo $a['cname'] ?></td>
            <td style="border: 1px solid black;"><?php echo $a['con_no'] ?></td>
            <td style="border: 1px solid black;"><?php echo $a['ptitle'] ?></td>
            <td style="border: 1px solid black;"><?php echo $a['clname'] ?></td>
            <td style="border: 1px solid black;"><?php echo $a['cldes'] ?></td>
            <td style="border: 1px solid black;"><?php echo $a['avg'] ?></td>
        </tr>
<?php
    }
}
?>  
</table>
</div><br><br>
<button style="left:50%" class="download" onclick="generatepdf()">Download PDF</button>
<script src="download.js"></script>
</html>