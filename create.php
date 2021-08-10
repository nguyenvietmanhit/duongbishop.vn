<?php
session_start();
//require_once 'database.php';
$error = '';
echo "<pre>";
print_r($_POST);
print_r($_FILES);
echo "</pre>";
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $avatar_arr = $_FILES['avatar'];
    $description = $_POST['description'];
// validate
    if (empty($name) || empty($age)) {
        $error = 'tên và tuổi không đươc bỏ trống';
    } elseif ($avatar_arr['error'] == 0) {
        $extension = pathinfo($avatar_arr['name'], PATHINFO_EXTENSION);
        $extension = strtolower($extension);
        $allowed = ['jpg, jpeg, png, gif'];

        if (!in_array($extension, $allowed)) {
            $error = 'file upload phải là ảnh';
        }
        // + lưu vào CSDL,upload file nếu có chỉ khi không có lỗi xảy ra
        if (empty($error)) {
            $avatar = '';
            if ($avatar_arr['error'] == 0) {
                $dir_upload = 'uploads';
                if (!file_exists($dir_upload)) {
                    mkdir($dir_upload);
                }
                $avatar = time() . "-" . $avatar_arr['name'];
                move_uploaded_file($avatar_arr['tmp_name'], "$dir_upload/$avatar");
            }
            $sql_insert = "INSERT INTO quanlysinhvien(name,age,avatar,description) 
      VALUES ('$name,$age,$avatar,$description')";
            $is_insert = mysqli_query($connection, $sql_insert);
            var_dump($is_insert);
            if ($is_insert) {
                $_SESSION['success'] = "thêm mới sản phẩm thành công";
                header('location:index.php');
                exit();
            } else {
                $error = " thêm thất bại";
            }
        }
    }
}
?>
<h3 style="color: red"><?php echo $error; ?></h3>
 <h2>Thêm sinh viên mới</h2>
<a href="index.php">Về trang danh sách</a>
<form action="" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>Họ tên:</td>
    <td><input type="text" name="name" value="" /></td>
        </tr>
        <tr>
            <td>Tuổi:</td>
            <td> <input type="number" name="age" value="" /></td>
        </tr>
<tr>
    <td> Ảnh đại diện:</td>
    <td> <input type="file" name="avatar" value="" /></td>
</tr>
 <tr>
     <td>Mô tả sinh viên:</td>
     <td><textarea ></textarea></td>
 </tr>
    <tr>
        <td></td>
        <td><input type="submit" name="submit" value="Save" />
            <input type="reset" name="reset" value="reset" />
        </td>
    </tr>

    </table>
</form>
