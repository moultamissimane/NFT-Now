<?php

session_start();
if (!isset($_SESSION['user'])) {
    header("location: /ShopNow/login.php");
}

//connect to the db
require('db.php');


if (isset($_POST['create'])) {

    $productName = $_POST['productName'];
    $imgSrc = $_POST['imgSrc'];
    $price = $_POST['price'];
    $cat_id = $_POST['cat_id'];


    $sql_query = "INSERT INTO product (productName, imgSrc, price, cat_id) VALUES ( '$productName' , '$imgSrc' , '$price' , '$cat_id' )";
    $res = mysqli_query($conn, $sql_query);
}

//prepare query string
$sql_query  = "SELECT * FROM product_cat";
$result = mysqli_query($conn, $sql_query);

//transfoorm mysqli_results to array associative
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

//like printf
// var_dump($rows);

$sql_query  = "SELECT * FROM category";
$res = mysqli_query($conn, $sql_query);

$cats =  mysqli_fetch_all($res, MYSQLI_ASSOC);

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/ShopNow2/public/css/index.css">
    <link rel="stylesheet" href="/ShopNow2/public/css/inventorypage.css">
    <link rel="stylesheet" href="/ShopNow2/public/css/dashboard.css">
    <link rel="stylesheet" href="/ShopNow2/public/css/header.css">
    <link rel="stylesheet" href="/ShopNow2/public/css/sidebar.css">
    <script src="https://kit.fontawesome.com/c4254e24a8.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;500;600;700;800;900&family=Roboto&display=swap" rel="stylesheet">
    <title>Inventory Page</title>
</head>

<body class="flex">
    <!-- side bar -->
    <div style="overflow: hidden; position:fixed; left:0; right:0; width: 6.5%; height:100%; background-color: #1F2344; " class="sidebar">
    </div>
    <!-- end side bar -->
    <!-- body content -->
    <!-- popup -->
    <div style=" display:none; width: 100vw; height:100vh; background-color: #000000d4; z-index:999; position:absolute; top:0;left:0;" class="flex justify-center items-center popup">
        <form method="POST" style=" background-color: #1F2344;" class=" w-l-wrapper p-3 gap-3 flex rounded flex-col bg-wrapper shadow-wrapper">
            <div style="justify-content: flex-end;" class="w-full flex">
                <h3 onclick="closePopup()" class="cursor-pointer text-white">Cancel</h3>
            </div>
            <h1 class="p-1 text-white flex justify-center items-center ">Add NFT</h1>
            <label for="name" class="text-white pl-3">NFT Name</label>
            <input type="text" style="min-width: 320px;" name="productName" id="name" class="p-1  rounded-sm form-email outline-none" placeholder="Enter NFT Name" required>

            <label for="src" class="text-white pl-3">NFT image</label>
            <input type="text" style="min-width: 320px;" name="imgSrc" id="src" class="p-1  rounded-sm form-email outline-none" placeholder="Enter NFT source URL" required>

            <label for="price" class="text-white pl-3">NFT price</label>
            <input type="number" style="min-width: 320px;" name="price" id="price" class="p-1  rounded-sm form-email outline-none" placeholder="Enter NFT price" required>

            <label for="price" class="text-white pl-3">NFT category</label>
            <select name="cat_id" class="p-1 rounded-sm form-email outline-none">
                <option>select category</option>
                <?php foreach ($cats as $c) { ?>
                    <option value="<?php echo $c['id'] ?>"><?php echo $c['catName'] ?></option>
                <?php } ?>
            </select>

            <div class="flex justify-center w-full">
                <button name="create" style="min-width:300px;" class="p-3 w-btn font-xl cursor-pointer outline-none rounded flex justify-center items-center bg-primary"><span>Add</span></button>
            </div>
        </form>
    </div>
<!-- end popup -->
    <div class="body w-full overflow-y-scroll">
        <div class="header w-full">
            <?php require_once('header.php') ?>
        </div>
        <div style="justify-content: flex-end; margin-top:5rem; " class="flex w-full p-3">
            <button onclick="showPopup()" style="background-color: deeppink;" class="p-1 cursor-pointer text-white rounded-sm">Add new NFT</button>
        </div>
        <div class="dashboard-wrapper rounded-sm w-full flex bg-violet ">
        </div>
        <script>
          
            const showPopup = () => {
                document.querySelector('.popup').style.display = 'flex'
            }

            const closePopup = () => {
                document.querySelector('.popup').style.display = 'none'
            }
            
        </script>
        <script src="./public/js/helpers/helpers.js"></script>
        <script src="./public/js/sidebar.js"></script>
</body>

</html>