<?php
$title="แบบฟอร์มแก้ไขข้อมูลครู";
require_once "layout/header.php";
require_once "db/connect.php";
require_once "layout/check_admin.php";
if(!isset($_GET['id'])){
    header("Location:index.php");
}else{
    $id=$_GET["id"];
    $emp=$controller->getmemberDetail($id);

}
$result=$controller->getdepartment();
?>
    <h1 class = "text-center"><?php echo "แบบฟอร์มแก้ไขข้อมูล";?></h1>
    <form method="POST" action="updateMember.php">
        <input type="hidden" name ="emp_id" value="<?php echo $emp["emp_id"]?>"/>
        <div class ="form-group">
            <label for ="name">ชื่อ</label>
            <input type="text" name="name" class="form-control" value="<?php echo $emp["name"] ?>">
        </div>
        <div class ="form-group">
            <label for ="sname">นามสกุล</label>
            <input type="text" name="sname" class="form-control" value="<?php echo $emp["sname"] ?>">
        </div>
        <div class ="form-group">
            <label for ="email">อีเมล์</label>
            <input type="text" name="email" class="form-control" value="<?php echo $emp["email"] ?>">
        </div>
        <div class ="form-group">
            <label for ="department">เเผนก</label>
            <select name="department_id" class="form-control">
                <?php while($row=$result->fetch(PDO::FETCH_ASSOC)){?>
                   <option
                   <?php if($row["department_id"] == $emp["department_id"]) echo "selected"?>
                   value="<?php echo $row["department_id"];?>">
                   <?php echo $row["department_name"];?></option>
                <?php } ?>
                
            </select>
        </div>
        <input type="submit" name="submit" value ="อัปเดตข้อมูล" class="btn btn-primary my-3">

    </form>
</div>
</body>
</html>
