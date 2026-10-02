<?php include('connection.php') ?>
<?php include('auth.php') ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">
</head>

<body>
    <header class="sticky top-0">
        <div class="bg-orange-400 items-center flex justify-between py-2 shadow-[2px_1px_4px_0] lg:py-2 lg:pr-3 lg:px-4">
            <div class=" h-[10px] w-[80px] flex items-center md:w-[160px] lg:w-[160px]">
                <img class="text-black" src="../images/logo2-removebg-preview.png" alt="">
            </div>
            <ul class="flex justify-between gap-x-2 md:gap-x-10 items-center lg:gap-x-20">
                <li class="text-[10px]  hover:bg-white hover:px-1 py-1 hover:rounded-md duration-300 lg:px-3 hover:lg:px-3"> <a
                        href="index.php" class="md:text-[20px] lg:text-[15px]">Home</a></li>
                <li class="text-[10px]  "><a href="best_seller.php"
                        class="bg-white rounded-md px-1 py-1 md:text-[20px]  lg:text-[15px] lg:px-3">Best Seller</a></li>
                <li class="text-[10px]  hover:bg-white hover:px-1  py-1 hover:rounded-md duration-300 lg:px-3 hover:lg:px-3"><a
                        href="shop.php" class="md:text-[20px]   lg:text-[15px]">Shop</a></li>

            </ul>

            <div class="flex gap-x-2 md:gap-x-4 items-center">
                <div class="relative flex items-center">
                    <i
                        class="fa-solid fa-magnifying-glass absolute left-2 text-gray-500 text-[12px] md:text-[18px] lg:text-[15px]"></i>
                    <input type="search" placeholder="search..."
                        class="focus:outline-none focus:border-orange-400 text-[10px] bg-white h-[20px] w-[90px] rounded-full px-3 pl-6 md:pl-9 md:text-[20px] md:h-[30px] md:w-[200px] lg:text-[14px] lg:h-[25px] lg:w-[200px] lg:pl-8">
                </div>
                
                <a href="order_check.php"><i
                        class="fa-solid fa-cart-shopping text-white text-[14px] md:text-[25px] lg:text-[18px]"></i></a>
            </div>
        </div>
    </header>

    <main>
        <h2 class="text-center tracking-tight mt-4 text-blue-700 font-semibold text-[10px] md:text-[18px] lg:text-[22px] lg:mt-15">
            CUSTOMER FAVORITES</h2>
        <h1
            class="text-center tracking-tighter mt-2 text-orange-500 font-semibold text-[22px] md:text-[35px] lg:text-[40px] lg:mt-1">
            Most Popular Frames</h1>
        <p class="text-center tracking-tighter mt-1 text-[13px] md:text-[20px]">Shop the most popular and best-selling
            eyewear designs all in one place..</p>

        <?php

        if(isset($_GET['category'])) {
            $category = $_GET['category'];
        }else{
            $category = 'all';
        }

        if($category=='all') {
            $result = $conn->query("SELECT * FROM products WHERE bestseller=1 ORDER BY id DESC");
        }else{
            $result = $conn->query("SELECT * FROM products WHERE bestseller=1 AND category='$category' ORDER BY id DESC");
        }
        ?>

        <div class="flex justify-center mt-5 gap-4 px-4 md:px-10 md:gap-10 lg:px-10">
            <a href="best_seller.php?category=all" class="text-[10px] border border-gray-400 px-2 py-1 md:px-4 md:text-[16px] md:py-2 lg:px-4 lg:py-1 lg:mt-4 rounded-full hover:bg-orange-400 hover:border-orange-400 hover:text-white duration-200 <?php echo ($category=='all')? 'border-orange-400 bg-orange-400 text-white':'text-black'; ?>">All Bestseller</a>

            <a href="best_seller.php?category=clearglass" class="text-[10px] border border-gray-400 px-2 py-1 md:px-4 md:text-[16px] md:py-2 lg:px-4 lg:py-1 lg:mt-4 rounded-full hover:bg-orange-400 hover:border-orange-400 hover:text-white duration-200 <?php echo ($category=='clearglass')? 'border-orange-400 bg-orange-400 text-white':'text-black'; ?>">Prescription</a>

            <a href="best_seller.php?category=sunglass" class="text-[10px] border border-gray-400 px-2 py-1 md:px-4 md:text-[16px] md:py-2 lg:px-4 lg:py-1 lg:mt-4 rounded-full hover:bg-orange-400 hover:border-orange-400 hover:text-white duration-200 <?php echo ($category=='sunglass')? 'border-orange-400 bg-orange-400 text-white':'text-black'; ?>">Sunglass</a>

            <a href="best_seller.php?category=bluelight" class="text-[10px] border border-gray-400 px-2 py-1 md:px-4 md:text-[16px] md:py-2 lg:px-4 lg:py-1 lg:mt-4 rounded-full hover:bg-orange-400 hover:border-orange-400 hover:text-white duration-200 <?php echo ($category=='bluelight')? 'border-orange-400 bg-orange-400 text-white':'text-black'; ?>">Blue Light</a>

        </div>

        <!-- <div class="flex justify-end mr-2 lg:mr-40 md:mr-20 mt-10">
            <button class="text-white bg-blue-500 text-[13px] md:text-[18px] lg:text-[15px] px-2 py-1 rounded-md"><a href="#">+ Add New Product</a></button>
        </div> -->

        <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3 md:px-20 md:gap-10 lg:px-40 lg:gap-40 gap-4 mt-10 px-3 mb-20 gap-y-10 md:gap-y-20">

            <?php while ($item = $result->fetch_assoc()): ?>

            <div
                class="border border-gray-400 rounded-md h-[300px] md:h-[460px] lg:h-[400px] bg-gray-100 overflow-hidden">
                <img class="w-full h-[200px] md:h-[350px] lg:h-[300px] rounded-[20px] p-3 transition-transform hover:scale-102"
                    src="../images/<?php echo $item['image'] ?>" alt="">
                <div class="flex px-3 place-content-between mt-2 lg:mt-4">
                    <p class="font-semibold md:text-[20px]"><?php echo number_format($item['price'],0); ?>MMK</p>
                    <ul class="flex gap-3">
                        <li>
                          <a href="product_delete.php?id=<?php echo $item['id']; ?>">
                            <i class="fa-solid fa-trash-can text-red-600"></i>
                          </a>
                        </li>
                    </ul>
                </div>
                <button class="text-[15px] bg-orange-400 px-4 py-1 ml-3 mt-4 rounded-md"><a href="market.php">Shop Now</a></button>
            </div>
            <?php endwhile; ?>

        </div>
    </main>

    <footer>
        <div class="flex justify-between mb-15 md:mt-40 md:px-6 lg:mt-50 lg:px-20 px-5">
            <div class="text-center w-[100px] md:w-[250px] lg:w-[300px] lg:mt-40 md:mt-40">
                <i
                    class="fa-solid fa-truck-fast text-[35px] text-blue-700 mb-3 md:text-[50px] lg:mb-6 lg:text-[50px]"></i>
                <p class="font-semibold md:text-[22px]">Free Express Shipping</p>
                <small class="md:text-[15px]">Free shipping on orders over 200,000MMK</small>
            </div>

            <div class="text-center w-[100px] md:w-[250px] lg:w-[300px]">
                <i
                    class="fa-solid fa-rotate-left text-[35px] text-blue-700 mb-3 md:text-[50px] lg:mb-6 lg:text-[45px]"></i>
                <p class="font-semibold md:text-[22px]">10-Day Money Back</p>
                <small class="md:text-[15px]">Returnable within 10 days if not satisfield</small>
            </div>

            <div class="text-center w-[100px] md:w-[250px] lg:w-[300px] lg:mt-40 md:mt-40">
                <i
                    class="fa-solid fa-shield-halved text-[35px] text-blue-700 mb-3 md:text-[50px] lg:mb-6 lg:text-[50px]"></i>
                <p class="font-semibold md:text-[22px]">Free Lens Fitting</p>
                <small class="md:text-[15px]">Free eye testing and lens fitting</small>
            </div>
        </div>

    </footer>
</body>





</html>