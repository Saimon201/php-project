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
    <?php include("header.php") ?>

    <?php
    session_start();

    // Cart မရှိသေးရင် Session Array အလွတ်တစ်ခု ပြုလုပ်မယ်
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // shop.php ထဲက ခလုတ်ကို နှိပ်လိုက်ရင် if ထဲကဟာတွေအလုပ်လုပ်မယ်
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'] ?? '';
        $id = $_POST['id'] ?? null;

        
        // Add to Cart Action (shop.php မှ ရောက်လာလျှင်)
        if ($action === 'add' && $id) {
            if (isset($_SESSION['cart'][$id])) {
                $_SESSION['cart'][$id]['quantity'] += 1;
            } else {
                $_SESSION['cart'][$id] = [
                    'id' => $id,
                    'category' => $_POST['category'],
                    'price' => $_POST['price'],
                    'image' => $_POST['image'],
                    'quantity' => 1
                ];
            }
        }

        // Quantity တိုးတာ (+)
        if ($action === 'increase' && $id) {
            if (isset($_SESSION['cart'][$id])) {
                $_SESSION['cart'][$id]['quantity'] += 1;
            }
        }

        // Quantity လျှော့တာ (-)
        if ($action === 'decrease' && $id) {
            if (isset($_SESSION['cart'][$id])) {
                $_SESSION['cart'][$id]['quantity'] -= 1;
                if ($_SESSION['cart'][$id]['quantity'] <= 0) {
                    unset($_SESSION['cart'][$id]);
                }
            }
        }

        // Item ကို ဖျက်ရင်
        if ($action === 'delete' && $id) {
            if (isset($_SESSION['cart'][$id])) {
                unset($_SESSION['cart'][$id]);
            }
        }
    }

    // စုစုပေါင်း အရေအတွက်နှင့် ဈေးနှုန်းတွက်ချက်ဖို့တွက် variable အလွတ်
    $total_quantity = 0;
    $total_price = 0;
    ?>


    <div class="pr-2 mt-5">
        <div class="flex justify-end px-3">
            <i class="fa-solid fa-receipt text-[22px] md:text-[25px] lg:text-[25px] text-green-600"></i>
        </div>
        <div class="flex justify-end px-2">
            <p class="text-[12px] md:text-[15px] lg:text-[13px]">History</p>
        </div>
    </div>
    <div class="flex justify-center">
        <div class="mt-8 overflow-hidden rounded-lg border border-gray-200 shadow-sm md:w-[750px] lg:w-[1200px]">
            <table class="w-full text-left text-sm text-gray-600">
                <!-- Table Header -->
                <thead class="bg-gray-300 text-xs uppercase text-gray-700 border-b border-gray-200">
                    <tr>
                        <th class="px-4 py-3 font-semibold md:text-[20px] lg:text-[15px]">Product</th>
                        <th class="px-4 py-3 font-semibold md:text-[20px] lg:text-[15px]">Quantity</th>
                        <th class="pl-8 pr-4 py-3 font-semibold md:text-[20px] lg:text-[15px]">Price</th>
                        <th class="px-4 py-3 font-semibold text-right md:text-[20px] lg:text-[15px]">Action</th>
                    </tr>
                </thead>
                <!-- Table Body -->
                <tbody class="divide-y divide-gray-200 bg-white">

                    <?php if (!empty($_SESSION['cart'])): ?>
                    <?php foreach ($_SESSION['cart'] as $item):

                        $item_total = $item['price'] * $item['quantity'];
                    $total_quantity += $item['quantity'];
                    $total_price += $item_total;
                    ?>
                    
                    <tr class="hover:bg-gray-50">

                        <!-- Image -->
                        <td class="px-4 py-2 font-medium text-gray-900"><img src="images/<?php echo $item['image']; ?>" class="w-[40px] h-[50px] md:w-[70px] md:h-[80px] rounded-md"></td>

                        <!-- Quantity and Price ကိုပေါင်းတာ -->
                        <td class="pl-4 py-2 md:pl-6 md:text-[20px] lg:pl-4 lg:text-[18px]">
                            <!-- (-) -->
                            <form action="market.php" method="POST" class="inline">
                                <input type="hidden" name="action" value="decrease">
                                <input type="hidden" name="id" value="<?php echo $item['id'] ?>">
                                <button type="submit" class="px-2 md:text-[20px] ">&ndash;</button>
                            </form>

                            <span><?php echo $item['quantity'] ?></span>

                            <!-- (+) -->
                            <form action="market.php" method="POST" class="inline">
                                <input type="hidden" name="action" value="increase">
                                <input type="hidden" name="id" value="<?php echo $item['id'] ?>">
                                <button type="submit" class="px-2 md:text-[23px]">+</button>
                            </form>
                        </td>

                        <!-- price -->
                        <td class="px-4 py-2">
                            <span class="inline-flex items-center text-xs font-medium text-green-700 md:text-[20px] lg:text-[18px]"><?php echo number_format($item_total) ?>MMK</span>
                        </td>

                        <td class="px-6 py-4 text-right">
                            <form action="market.php" method="POST">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?php echo $item['id'] ?>">
                                <button type="submit" ><i class="fa-solid fa-trash-can md:text-[20px] lg:text-[18px] font-medium text-red-600"></i></button>
                            </form>
                        </td>
                    </tr>
                 <?php endforeach; ?>

                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center py-4 text-[12px] lg:text-[15px]">There are no items in the cart...</td>
                    </tr>
                <?php endif; ?>

                </tbody>
            </table>
        </div>
    </div>


    <div class="flex justify-center mt-3">
        <div class="mt-8 overflow-hidden rounded-lg md:w-[750px] lg:w-[1200px] w-[350px]">
            <table class="w-full text-left text-sm text-gray-600">
                <thead class="bg-green-400 text-xs uppercase text-gray-700 border-b border-gray-200">
                    <tr>
                        <th class="px-4 py-3 font-semibold md:px-6 md:text-[20px] lg:px-12 lg:text-[15px]">Total</th>
                        <th class="px-4 py-3 font-semibold md:px-8 md:text-[20px] lg:px-10 lg:text-[18px]"><?php echo $total_quantity ?></th>
                        <th class="px-4 py-3 font-semibold md:text-[20px] md:px-12 lg:px-30 lg:text-[18px]"><?php echo number_format($total_price) ?>MMK</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div class="flex justify-center ">
        <div class="flex justify-end mt-3 w-[350px] md:w-[750px] lg:w-[1200px]">
            <button class="px-3 py-0.5 bg-blue-500 hover:bg-blue-600 duration-200 rounded-md text-white font-semibold md:px-5 md:text-[20px] lg:text-[18px]">
                <a href="order.php">Order</a></button>
        </div>
    </div>
</body>

</html>