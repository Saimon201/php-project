<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Montenegrin+Gothic+One&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Playwrite+DE+SAS+Guides&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Yuyu&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>
    <header class="sticky top-0">
        <div class="bg-orange-400 items-center flex justify-between py-2 shadow-[2px_1px_4px_0] lg:py-2 lg:px-4">
            <div class=" h-[10px] w-[80px] flex items-center md:w-[160px] lg:w-[160px]">
                <img class="text-black" src="../images/logo2-removebg-preview.png" alt="">
            </div>

            <ul class="flex justify-between gap-x-2 md:gap-x-10 items-center lg:gap-x-20">
                <li class="text-[10px]  hover:bg-white hover:px-1 py-1 hover:rounded-md duration-300 lg:px-3 hover:lg:px-3"> <a
                        href="index.php" class="md:text-[20px] lg:text-[15px]">Home</a></li>
                <li class="text-[10px]  hover:bg-white hover:px-1 py-1 hover:rounded-md duration-300 lg:px-3 hover:lg:px-3"><a
                        href="best_seller.php" class=" md:text-[20px]  lg:text-[15px]">Best Seller</a></li>
                <li class="text-[10px]  hover:bg-white hover:px-1 py-1 hover:rounded-md duration-300 lg:px-3 hover:lg:px-3"><a
                        href="shop.php" class=" md:text-[20px]  lg:text-[15px]">Shop</a></li>

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
</body>

</html>