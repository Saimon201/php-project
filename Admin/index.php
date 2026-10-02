<?php include('connection.php') ?>
<?php include('auth.php') ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Montenegrin+Gothic+One&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Playwrite+DE+SAS+Guides&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Yuyu&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

</head>

<body class="overflow-x-hidden">
    <header class="sticky top-0">
        <div class="bg-orange-400 items-center flex justify-between py-2 shadow-[2px_1px_4px_0] lg:py-2 lg:px-4">
            <div class=" h-[10px] w-[80px] flex items-center md:w-[160px] lg:w-[160px]">
                <img class="text-black" src="../images/logo2-removebg-preview.png" alt="">
            </div>
            <ul class="flex justify-between gap-x-2 md:gap-x-10 items-center lg:gap-x-20">
                <li class="text-[10px]  "> <a href="index.php"
                        class="bg-white rounded-md px-1 py-1 md:text-[20px] lg:text-[15px] lg:px-3">Home</a></li>
                <li class="text-[10px] hover:bg-white hover:px-1 py-1 hover:rounded-md duration-300 lg:px-3 hover:lg:px-3"><a
                        href="best_seller.php" class="md:text-[20px]   lg:text-[15px]">Best Seller</a></li>
                <li class="text-[10px]  hover:bg-white hover:px-1 py-1 hover:rounded-md duration-300 lg:px-3 hover:lg:px-3"><a
                        href="shop.php" class="md:text-[20px]   lg:text-[15px]">Shop</a></li>

            </ul>

            <div class="flex gap-x-2 md:gap-x-4 items-center ">
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
        <div class="w-full grid grid-cols-2 mt-4 md:mt-10 ">
            <div class="flex flex-col items-center justify-center ">
                <p class="mb-2 text-[10px] md:text-[25px]">Fit and style guaranteen</p>
                <h3
                    class="mb-2 text-[13px] md:text-[30px] md:ml-10 font-[playfair-display] font-semibold italic text-orange-500">
                    Prescription glasses at remarkable</h3>
                <small class="text-[6px] md:text-[20px]">Find your perfect pair</small><br>
                <button
                    class="flex items-center bg-orange-400 text-white text-[9px] px-3 py-1 rounded-xl md:text-[15px] md:px-4 lg:px-8"><a
                        href="shop.php">SHOP
                        NOW</a></button>
            </div>
            <div class="mr-3">
                <img class="h-[160px] w-full rounded-[60px] md:h-[300px] md:rounded-[110px] lg:h-[380px] lg:rounded-[140px]"
                    src="../images/title photo.jpg" alt="">
            </div>
        </div>

        <div class="grid grid-cols-3 mt-5 gap-3 px-2 md:mt-7">
            <img class="bg-blue-400" src="../images/1.jpg" alt="">
            <img class="bg-blue-400" src="../images/2.jpg" alt="">
            <img class="bg-blue-400" src="../images/3.jpg" alt="">
        </div>

        <h2 class="text-[20px] font-semibold text-center mt-10 mb-3 md:mt-20 lg:mb-10 lg:mt-30 md:text-[25px]">Featured Category</h2>

        <div class="flex justify-between md:mb-2 lg:mb-3">
            <button class="ml-2 mb-4 bg-orange-400  px-4 italic text-[13px]  md:text-[20px] lg:px-6 lg:text-[18px] rounded-sm">Sun
                Glasses</button>
            <button class=" mr-2 mb-4 bg-blue-500  px-2 text-white text-[13px]  md:text-[20px] lg:px-6 lg:text-[18px] rounded-sm"><a href="product_create.php">+ Add New
                    Product</a></button>
        </div>

        <?php
        $result = $conn->query("SELECT * FROM products WHERE category='sunglass' OR category='bluelight' ORDER BY id DESC");
        ?>

        <div class="grid grid-cols-4  gap-2 gap-y-5 px-2 md:grid-cols-5 md:gap-4 lg:grid-cols-7">

            <?php while ($item = $result->fetch_assoc()): ?>
                <div class="border border-gray-400">
                    <img src="../images/<?php echo $item['image']; ?>" alt="">
                    <div class="flex justify-between items-center ">
                        <p class="text-[12px] md:ml-1 my-2 font-semibold md:text-[20px]"><?php echo number_format($item['price'], 0); ?>MMK</p>
                        <a href="product_update.php?id=<?php echo $item['id'];?>"><i class="fa-solid fa-pen-square text-[15px] md:text-[20px] text-blue-500 md:pr-1"></i></a>
                    </div>
                    <button
                        class="text-[10px] block mx-auto bg-orange-400 py-1 px-4 mx-1 mb-1 md:px-9 md:text-[15px] lg:px-13 lg:text-[13px]"><a href="shop.php">Shop
                            Now</a></button>
                </div>
            <?php endwhile; ?>

        </div><br><br><br><br>


        <div class="flex justify-between md:mb-2 lg:mb-3">
            <button
                class="ml-2 mb-4 bg-orange-400  px-4 italic text-[13px]  md:text-[20px] lg:px-6 lg:text-[18px] rounded-sm">Prescription
                & Clear Glasses</button>
        </div>

        <?php
        $result_clear = $conn->query("SELECT * FROM products WHERE category='clearglass' ORDER BY id DESC");
        ?>

        <div class="grid grid-cols-4  gap-2 gap-y-5 px-2 md:grid-cols-5 md:gap-4 lg:grid-cols-7">
            <?php while ($item_clear = $result_clear->fetch_assoc()): ?>
                <div class="border border-gray-400">
                    <img src="../images/<?php echo $item_clear['image']; ?>" alt="">
                    <div class="flex justify-between items-center ">
                        <p class="text-[12px] md:ml-1 my-2 font-semibold md:text-[20px]"><?php echo number_format($item_clear['price'], 0) ?>MMK</p>
                        <a href="product_update.php?id=<?php echo $item_clear['id']; ?>"><i class="fa-solid fa-pen-square text-[15px] md:text-[20px] text-blue-500 md:pr-1 lg:pr-1"></i></a>
                    </div>
                    <button
                        class="text-[10px] block mx-auto bg-orange-400 py-1 px-4 mx-1 mb-1 md:px-9 md:text-[15px] lg:px-13 lg:text-[13px]"><a href="shop.php">Shop
                            Now </a></button>
                </div>
            <?php endwhile; ?>


        </div>
    </main>

    <footer class="mt-20 lg:mt-30">
        <div class="mb-5">
            <h2 class="flex justify-center text-orange-500 font-bold text-[20px] md:text-[25px]">CONTACT US</h2>
            <h1 class="text-center text-[30px]">.....</h1>
            <p class="text-center text-[14px] md:text-[15px]">Need an expert? you are more than welcomed to leave your
                contact info and
                we will be in touch shortly.</p>
        </div>

        <div class="grid grid-cols-3 px-1 gap-1 mb-8 md:px-2 md:gap-3 md:mb-8 lg:px-10 lg:gap-10">

            <div class="h-[210px] w-full border border-gray-400 shadow-gray-500 shadow-[2px_2px_6px_0] rounded-xl">
                <div class="flex justify-center mt-6">
                    <i class="fa-solid fa-home fa-2xl text-center text-orange-500"></i>
                </div>
                <div class="mt-5">
                    <h1 class="font-bold text-center">Visit Us</h1>
                    <p class="text-[10px] text-center mb-1 md:text-[15px]">Visit our store to explore our premium
                        etewear collection and get a professional eye test from our specialists.</p>
                    <p class="text-[12px] text-center text-orange-500 font-bold md:text-[15px]">Myanandar St, Kamayut
                        Tsp,Yangon</p>
                </div>
            </div>

            <div class="h-[210px] w-full border border-gray-400 shadow-gray-500 shadow-[2px_2px_6px_0] rounded-xl">
                <div class="flex justify-center mt-6">
                    <i class="fa-solid fa-phone fa-2xl text-center text-orange-500"></i>
                </div>
                <div class="mt-5">
                    <h1 class="font-bold text-center">Call Us</h1>
                    <p class="text-[10px] text-center mb-1 md:text-[15px]">Call us directly for quick assistance and
                        details about our products and services. Mon-Sat(9:00AM 6:00PM)</p>
                    <p class="text-[12px] text-center text-orange-500 font-bold md:text-[15px]">+959 777 543 721</p>
                </div>
            </div>

            <div class="h-[210px] w-full border border-gray-400 shadow-gray-500 shadow-[2px_2px_6px_0] rounded-xl">
                <div class="flex justify-center mt-6">
                    <i class="fa-solid fa-envelope fa-2xl text-center text-orange-500"></i>
                </div>
                <div class="mt-5">
                    <h1 class="font-bold text-center">Contact Us</h1>
                    <p class="text-[10px] text-center mb-1 md:text-[15px]">Send up email for any inquiriees, custom
                        orders, or support. We wil get back to you as soon as possible.</p>
                    <p class="text-[12px] text-center text-orange-500 font-bold md:text-[15px]">Saimon.201@gamil.com</p>
                </div>
            </div>

        </div>
    </footer>
</body>

</html>