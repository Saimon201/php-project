<?php include('connection.php') ?>

<!-- login မဝင်ရသေးရင် session ကိုစတင်မယ် -->
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

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
        <div class="bg-orange-400 items-center flex justify-between py-2 shadow-[2px_1px_4px_0] lg:py-2 lg:px-4">
            <div class=" h-[10px] w-[80px] flex items-center md:w-[160px] lg:w-[160px]">
                <img class="text-black" src="images/logo2-removebg-preview.png" alt="">
            </div>

            <ul class="flex justify-between gap-x-2 md:gap-x-10 items-center lg:gap-x-20">
                <li class="text-[10px]  hover:bg-white hover:px-1 py-1 hover:rounded-md duration-300 lg:px-3 hover:lg:px-3"> <a
                        href="index.php" class="md:text-[20px] lg:text-[15px]">Home</a></li>
                <li class="text-[10px]  hover:bg-white hover:px-1 py-1 hover:rounded-md duration-300 lg:px-3 hover:lg:px-3"><a
                        href="best_seller.php" class=" md:text-[20px]  lg:text-[15px]">Best Seller</a></li>
                <li class="text-[10px]  "><a href="shop.php"
                        class="bg-white rounded-md px-1 py-1 md:text-[20px]   lg:text-[15px] lg:px-3">Shop</a></li>

            </ul>

            <div class="flex gap-x-2 md:gap-x-4 items-center">
                <div class="relative flex items-center">
                    <i
                        class="fa-solid fa-magnifying-glass absolute left-2 text-gray-500 text-[12px] md:text-[18px] lg:text-[15px]"></i>
                    <input type="search" placeholder="search..."
                        class="focus:outline-none focus:border-orange-400 text-[10px] bg-white h-[20px] w-[90px] rounded-full px-3 pl-6 md:pl-9 md:text-[20px] md:h-[30px] md:w-[200px] lg:text-[14px] lg:h-[25px] lg:w-[200px] lg:pl-8">
                </div>
                <a href="user.php"><i
                        class="fa-regular fa-user text-white text-[14px] md:text-[25px] lg:text-[18px] "></i></a>
                <a href="market.php"><i
                        class="fa-solid fa-cart-shopping text-white text-[14px] md:text-[25px] lg:text-[18px]"></i></a>

            </div>
        </div>
    </header>

    <main>
        <h2 class="text-center text-[20px] text-blue-700 tracking-tight font-semibold mt-5 lg:text-[30x] lg:mt-10 md:text-[30px]">
            Find Your Perfect Frames</h2>
        <p class="text-center text-[15px] mt-2 lg:text-[20px] md:text-[25px]">Discover stylish, lightweight, and durable
            eyewear
            crafted for your daily look.</p>

        <!-- <div class="flex justify-end mt-10 mr-6 lg:mr-50">
            <button class="bg-blue-500 px-2 py-1 rounded-md text-[15px] text-white font-semibold md:text-[20px] lg:text-[18px] md:px-4"><a
                    href="#">+ Add New</a></button>
        </div> -->
        <?php
        $result = $conn->query("SELECT * FROM products ORDER BY id DESC");
        ?>

        <div class="mt-4 md:mt-5 mb-10 md:mb-20 ">

            <?php while ($item = $result->fetch_assoc()): ?>
                <div class="flex justify-between border border-gray-400 mx-5 md:mx-10 rounded-xl mb-4 lg:mx-60 lg:mb-9 ">
                    <div class="flex">
                        <img src="images/<?php echo $item['image']; ?>" class="w-[90px] h-[100px] md:w-[150px] md:h-[180px] rounded-xl m-2">
                        <div class="mt-1 lg:mt-3">
                            <p class="lg:text-[20px] md:text-[20px] text-[13px]"><?php echo $item['category'] ?></p>
                            <p class="lg:text-[18px] md:text-[18px] text-[13px] font-semibold"><?php echo number_format($item['price'], 0) ?>MMK</p>
                        </div>
                    </div>
                    <div>
                        <?php if ($item['stock'] > 10): ?>
                            <button class="px-3 py-1 text-[12px] text-green-500 bg-green-100 rounded-md mt-2 mr-2 md:text-[15px] md:mt-3 md:mr-4">In Stock:<?php echo $item['stock'] ?></button><br>

                        <?php elseif ($item['stock'] > 0): ?>
                            <button class="px-3 py-1 text-[12px] text-yellow-500 bg-yellow-100 rounded-md mt-2 mr-2 md:text-[15px] md:mt-3 md:mr-4">Low Stock:<?php echo $item['stock'] ?></button><br>

                        <?php else: ?>
                            <button class="px-3 py-1 text-[12px] text-red-500 bg-red-100 rounded-md mt-2 mr-2 md:text-[15px] md:mt-3 md:mr-4">Sold Out:<?php echo $item['stock'] ?></button><br>
                        <?php endif; ?>



                        <div class="flex justify-end">

                            <!-- login ဝင်ထားလားစစ်အပေးတယ် login ဝင်ထားရင် form ထဲကဟာ အလုပ်လုပ်မယ် -->
                            <?php if (isset($_SESSION['user_id'])): ?>
                                <!-- market.php ဘက်ကို dataပို့ပေးဖို့တွက်input -->
                                <form action="market.php" method="POSt">
                                    <input type="hidden" name="action" value="add">  <!--hiddenက  user တွေမမြင်ရဘဲ dataတွေက်ု market.php ကိုပို့‌ေပးတာ -->
                                    <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                    <input type="hidden" name="category" value="<?php echo $item['category']; ?>">
                                    <input type="hidden" name="price" value="<?php echo $item['price']; ?>">
                                    <input type="hidden" name="image" value="<?php echo $item['image']; ?>">


                                    <?php if ($item['stock'] > 0): ?>
                                        <button type="submit" name="submit" class=" px-3 py-1 bg-blue-200 text-blue-700 font-semibold rounded-md mt-12 mr-2 text-[12px] md:text-[18px] md:mt-26 md:mr-4 lg:text-[15px]">Add to Cart</button>
                                    <?php else: ?>
                                        <button type="button" disabled class=" px-3 py-1 bg-red-500 text-white font-semibold rounded-md mt-12 mr-2 text-[12px] md:text-[18px] md:mt-26 md:mr-4 lg:text-[15px]">Out of Stock</button>
                                    <?php endif; ?>
                                </form>

                            <?php else: ?>
                                <!-- login မဝင်ရသေးရင်  -->
                                <a href="user.php">
                                    <button type="submit" name="submit" class=" px-3 py-1 bg-blue-200 text-blue-700 font-semibold rounded-md mt-12 mr-2 text-[12px] md:text-[18px] md:mt-26 md:mr-4 lg:text-[15px]">please login</button>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </main>

    <div class="mt-15">
        <hr>
        <p class="flex justify-center mt-5 mb-4">&copy; 2026 K&Z luxury Glasses. All right reserve.</p>
    </div>
</body>

</html>