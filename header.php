<?php
?>
<div class="header-wrapper flex p-1 justify-between items-center">
    <h1 id="title-header" class="dashboard-text text-white cursor-pointer ">Dashboard</h1>
    <div style="width:50px; height:50px;" >
        <img class="logo" style="width: 100%; height:100%; object-fit: cover;" src="./public/assets/images/NFTlogo.png" alt="NFT logo">
    </div>
    <div class="flex gap-3">
        <span id="hello"  class="text-white">Hello <?php echo explode('@' ,$_SESSION['user'])[0]; ?></span>
        
        <form class="search-wrapper flex gap-3 bg-dark-blue rounded-sm ">
            <input id="search" name="search" class="bg-dark-blue p-1 outline-none rounded-sm text-white font-sm" type="text" placeholder="  Search..">
                <button style="margin-right:0.5rem;" class="bg-dark-blue outline-none rounded-sm text-white font-sm">
                    <i class="fas fa-search text-white"></i>
                </button>
        </form>
        <form method="POST" action="/ShopNow2/logout.php" id="checkLogout" class="user bg-violet p-1 cursor-pointer rounded-full">
            <button style="background: #00000000;" class="outline-none border-none" type="submit"  >
                <i class="fas fa-user text-white  cursor-pointer"></i>
            </button>
        </form>
    </div>
    <div class="header-responsive">
    <i id="times_menu" class="fas fa-times"></i>
    </div>
</div>

<script>
    setTimeout(()=>{
        $('#hello').remove()
    }, 2000);
</script>
<script>
    (location.pathname.toLowerCase().includes('statistic')) ? document.querySelector('#title-header').innerHTML='Statistics' : (location.pathname.toLowerCase().includes('inventory')) ? document.querySelector('#title-header').innerHTML='Inventory' :  null
</script>



