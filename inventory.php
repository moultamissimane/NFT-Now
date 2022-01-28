<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("location: /ShopNow2/login.php");
}
?>

<?php
require('db.php');

if (isset($_POST['update'])) {
    $id = $_POST['update-id'];
    $productName = $_POST['productName'];
    $imgSrc = $_POST['imgSrc'];
    $price = $_POST['price'];
    $cat_id = $_POST['cat_id'];


    $sql_query = "UPDATE `product` SET 
            productName = '$productName',
            imgSrc = '$imgSrc',
            price = '$price',
            cat_id = '$cat_id' WHERE id= '$id'";
    $res = mysqli_query($conn, $sql_query);
}

$sql = "SELECT * FROM product_cat";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    echo "0 results";
}

$sql = "SELECT * FROM category";
$res = mysqli_query($conn, $sql);

if (mysqli_num_rows($res) > 0) {
    $cats = mysqli_fetch_all($res, MYSQLI_ASSOC);
} else {
    echo "0 results";
}


if (isset($_POST['create'])) {

    $productName = $_POST['productName'];
    $imgSrc = $_POST['imgSrc'];
    $price = $_POST['price'];
    $cat_id = $_POST['cat_id'];


    $sql_query = "INSERT INTO product (productName, imgSrc, price, cat_id) VALUES ( '$productName' , '$imgSrc' , '$price' , '$cat_id' )";
    $res = mysqli_query($conn, $sql_query);
}




?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/ShopNow2/public/css/index.css">
    <link rel="stylesheet" href="/ShopNow2/public/css/inventorypage.css">
    <link rel="stylesheet" href="/ShopNow2/public/css/header.css">
    <link rel="stylesheet" href="/ShopNow2/public/css/sidebar.css">
    <script src="https://kit.fontawesome.com/c4254e24a8.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;500;600;700;800;900&family=Roboto&display=swap" rel="stylesheet">
    <title>Inventory Page</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #1F234430;
        }

        tr:hover {
            background-color: #1F234430;
        }

        @media only screen and (max-width: 430px) {
            .dashboard-wrapper {
                margin-left: 1rem;
            }
        }
    </style>
</head>

<body class="flex">
    <!-- side bar -->
    <div class="sidebar w-full">
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
    <div style=" display:none; width: 100vw; height:100vh; background-color: #000000d4; z-index:999; position:absolute; top:0;left:0;" class="flex justify-center items-center update-popup">
        <form method="POST" style=" background-color: #1F2344;" class=" w-l-wrapper p-3 gap-3 flex rounded flex-col bg-wrapper shadow-wrapper">
            <div style="justify-content: flex-end;" class="w-full flex">
                <h3 onclick="closeUpdatePopup()" class="cursor-pointer text-white">Cancel</h3>
            </div>
            <h1 class="p-1 text-white flex justify-center items-center ">Edit NFT</h1>
            <label for="name" class="text-white pl-3">NFT Name</label>
            <input type="text" style="min-width: 320px;display:none;" id="update-id" name='update-id' class="p-1  rounded-sm form-email outline-none" placeholder="Enter NFT id">
            <input type="text" style="min-width: 320px;" name="productName" id="update-name" class="p-1  rounded-sm form-email outline-none" placeholder="Enter NFT Name" required>
            <label for="src" class="text-white pl-3">NFT image</label>
            <input type="text" style="min-width: 320px;" name="imgSrc" id="update-src" class="p-1  rounded-sm form-email outline-none" placeholder="Enter NFT source URL" required>

            <label for="price" class="text-white pl-3">NFT price</label>
            <input type="number" style="min-width: 320px;" name="price" id="update-price" class="p-1  rounded-sm form-email outline-none" placeholder="Enter NFT price" required>

            <label for="price" class="text-white pl-3">NFT category</label>
            <select name="cat_id" id="update-cat" class="p-1 rounded-sm form-email outline-none">
                <option disabled>select category</option>
                <?php foreach ($cats as $c) { ?>
                    <option value="<?php echo $c['id'] ?>"><?php echo $c['catName'] ?></option>
                <?php } ?>
            </select>

            <div class="flex justify-center w-full">
                <button name="update" style="min-width:300px;" class="p-3 w-btn font-xl cursor-pointer outline-none rounded flex justify-center items-center bg-primary"><span>Update</span></button>
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
            <!-- write your code here -->
            <table style="min-width: 1000px;" class=" w-full">
                <thead>
                    <tr>
                        <th style="color: white; text-align: center;">Id</th>
                        <th style="color: white; text-align: center;">Image</th>
                        <th style="color: white; text-align: center;">Name</th>
                        <th style="color: white; text-align: center;">Price</th>
                        <th style="color: white; text-align: center;">Category</th>
                        <th style="color: white; text-align: center;">Add Date</th>
                        <th style="color: white; text-align: center;">Actions</th>
                    </tr>
                </thead>
                <tbody class="p-3">
                    <?php foreach ($row as $nft) { ?>
                        <tr id="<?php echo $nft['id']; ?>">
                            <td><input type="checkbox" id="" name="" value=""></td>
                            <td style="width: 3rem; height: 3rem;">
                                <img style="object-fit: cover; width:100%; height: 100%;" src="<?php echo $nft['imgSrc'] ?>">
                            </td>
                            <td style="text-align: center; color: white;" class="product-<?php echo $nft['id'] ?>"><?php echo $nft['productName'] ?></td>
                            <td style="text-align: center; color: white;" class="price-<?php echo $nft['id'] ?>"><?php echo $nft['price'] ?></td>
                            <td style="text-align: center; color: white;" class="catName-<?php echo $nft['id'] ?>"><?php echo $nft['catName'] ?></td>
                            <td style="text-align: center; color: white;"><?php echo $nft['createdAt']; ?></td>
                            <td style="text-align: center; color: white;" class="product-<?php echo $nft['id'] ?>" class="flex justify-center">
                                <div class="actions gap-3 flex justify-center">
                                    <form class="form_delete_button" action="crud_DB.php" method="POST">
                                        <input type="text" name="id_product" hidden value="<?php echo $nft['id']; ?>">
                                        <button class="DELETE_BUTTON filter-red" name="delete" style="background : none; border : none">
                                            <img src="public/assets/images/delete.svg">
                                        </button>
                                    </form>
                                    <button onclick="getRowInfo(
                                                    {
                                                        id:`<?php echo $nft['id'] ?>`,
                                                        src:`<?php echo $nft['imgSrc'] ?>`,
                                                        name:`<?php echo $nft['productName'] ?>`,
                                                        price:`<?php echo $nft['price'] ?>`,
                                                        catName:`<?php echo $nft['catName'] ?>`
                                                    }
                                                )" class="UPDATE_BUTTON filter-green" name="update" style=" background : none; border : none">
                                        <img src="public/assets/images/update.svg">
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <!-- Send id of product to highlight the row if clicked -->
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <script>
            const showPopup = () => {
                $('.popup').style.display = 'flex'
            }

            const closePopup = () => {
                $('.popup').style.display = 'none'
            }

            const showUpdatePopup = () => {
                $('.update-popup').style.display = 'flex'
            }

            const closeUpdatePopup = () => {
                $('.update-popup').style.display = 'none'
            }

            const getRowInfo = (nft) => {
                console.log(nft);
                showUpdatePopup();
                $('#update-id').value = nft.id;
                $('#update-name').value = nft.name;
                $('#update-src').value = nft.src;
                $('#update-price').value = nft.price;
                let Option = 0;
                /*
                        get all Options first available

                    */
                [...$('#update-cat').options].forEach((option, idx) => {
                    option.label == nft.catName ? Option = idx : null
                })
                $('#update-cat').value = Option
            }
        </script>
        <script src="./public/js/helpers/helpers.js"></script>
        <script src="./public/js/sidebar.js"></script>
</body>

</html>