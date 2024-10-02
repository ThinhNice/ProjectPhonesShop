<?php
require_once('./includes/admin-conect.php');

require_once('includes/conn.php');
if(isset($_GET['id'])){
    $category_id=$_GET['id'];
    $sql = 'SELECT * FROM categories WHERE id=?';
    $stmt=mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,'i', $category_id);
    mysqli_stmt_execute($stmt);
    $result=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    if($result && mysqli_num_rows($result)> 0){
        $row=mysqli_fetch_assoc($result);
    }
}
if(isset($_POST['btnsubmit'])){
    $name=$_POST['name'];
    $updateCatesql='UPDATE categories SET name= ? WHERE id= ? ';
    $updatestmt=mysqli_prepare($conn,$updateCatesql);
    mysqli_stmt_bind_param($updatestmt,'si', $name,$category_id);
    if(mysqli_stmt_execute($updatestmt)){
        echo "<script>
        alert('Category updated successfully.');
        window.location.href='category.php';
        </script>";
    };     
};
?>
<!DOCTYPE html>
<html lang="en">    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit category</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
   <div class="form-container">
    <h2>Edit category</h2>
    <form action="editcategory.php?id=<?php echo $category_id; ?>" method="POST">
        <div class="form-group">
            <label for="name">Category name:</label>
            <input type="text" id="name" name="name" value="<?php echo $row['name'];?>" required>
        </div>
        <div class="form-group">
            <button type="submit" name="btnsubmit">Update Category</button>
        </div>
    </form>
   </div>
</body>
</html>
<?php
mysqli_close($conn);
?>