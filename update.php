<?php
session_start();
require_once 'database.php';
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['error'] = 'id không hợp lệ';
    header('location:index.php');
    exit();
}
//$sql_select_one = "SELECT * FROM student WHERE id = $id";
//$obj_result_one = mysqli_query($connection,$sql_select_one);
//$student1 = mysqli_fetch_assoc($obj_result_one);
$error = '';
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $avatar_arr = $_FILES['avatar'];
    $description = $_POST['description'];
    if (empty($name) || empty($age)) {
        $error = 'tên và tuổi không được để trống';
    } elseif ($avatar_arr['error'] == 0) {
        $extension = pathinfo($avatar_arr['name'],PATHINFO_EXTENSION);
        $extension = strtolower($extension);
        $allowed = ['jpg', 'png', 'jpeg', 'gif'];
        if (!in_array($extension,$allowed)) {
            $error = 'file upload phải là ảnh';
        }
    }


    if (empty($error)){
        $avatar = '';
        if ($avatar_arr['avatar'] == 0) {
            @unlink('uploads/'. $avatar);
            $avatar = time() . '-' . $avatar_arr['name'];
            move_uploaded_file($avatar_arr['tmp_name'],"uploads/$avatar");
        }
//         + tương tác với CSDL để upload dữ liệu
        $id = $_GET['id'];
        $sql_update = " UPDATE student1 SET name = :name,age = :age,avatar = :avatar,description =:description 
 WHERE id = :id";
        $obj_update = $connection->prepare($sql_update);
        $updates = [
            $name =>':name'  ,
            $age =>':age' ,
            $avatar => ':avatar',
            $description => ':description'
        ];
        $is_update = $obj_update->execute($updates);
        if ($is_update) {
            $_SESSION['success'] = 'sửa thành công';
            header('location:index.php');
            exit();
        } else {
            $error = 'sửa thất bại';
        }
    }
}
?>
<h3 style="color: red"><?php echo $error; ?></h3>
<h2>Sửa sinh viên</h2>
<a href="index.php">Về trang danh sách</a>
<form action="" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>Họ tên:</td>
            <td> <input type="text" name="name" value="<?php echo $student1['name']; ?>" /></td>
        </tr>
        <tr>
            <td>Tuổi:</td>
            <td> <input type="number" name="age" value="<?php echo $student1['age']; ?>" /></td>
        </tr>
        <tr>
            <td> </td>
            <td> <input type="file" name="avatar" /></td>
        </tr>
        <tr>
            <td> Ảnh đại diện:</td>
            <td><img src="uploads/<?php echo $student1['avatar']; ?>" height="80px" /> </td>
        </tr>
        <tr>
            <td>Mô tả sinh viên:</td>
            <td><textarea name="description" value="<?php echo $student1['description']; ?>"></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="Save" />
                <input type="reset" name="reset" value="reset" />
            </td>
        </tr>

    </table>
</form>
