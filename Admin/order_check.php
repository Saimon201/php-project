<?php include 'connection.php'; ?>
<?php include ('auth.php'); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Check</title>
</head>
<body>
    <?php include 'header.php'; ?>

    <?php
    // Phone no အလိုက် 1 ကြောင်းစီပဲ ပြမယ်
    $sql = "SELECT id,created_at, customer_name, address, status FROM orders GROUP BY phone";
    $stmt = mysqli_prepare($conn, $sql);
    
    if ($stmt) {
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $order_id ,$created_at ,$customer_name, $address, $status);
    }
    ?>

    <div class="flex justify-center">
        <div class="w-full lg:w-[2000px] lg:mx-20 mt-20">
            <table class="w-full text-left text-sm text-gray-600">
                <thead class="bg-gray-100 text-xs text-gray-700 border border-gray-300">
                    <tr>
                        <th class="px-5 py-3 font-semibold md:text-[20px] lg:text-[17px]">Date</th>
                        <th class="px-5 py-3 font-semibold md:text-[20px] lg:text-[17px]">Customer Name</th>
                        <th class="px-13 py-3 font-semibold md:text-[20px] lg:text-[17px]">Address</th>
                        <th class="px-5 py-3 font-semibold md:text-[20px] lg:text-[17px] text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="text-xs text-gray-700 border border-gray-200">
                    <?php while (mysqli_stmt_fetch($stmt)): ?>
                        <tr class="border border-gray-400">
                            <td class="px-5 py-2 font-semibold md:text-[20px] lg:text-[15px]"><?php echo $created_at; ?></td>
                            <td class="px-5 py-2 font-semibold md:text-[20px] lg:text-[15px]"><?php echo $customer_name; ?></td>
                            <td class="px-13 py-2 font-semibold md:text-[20px] lg:text-[15px]"><?php echo $address; ?></td>
                            <td class="px-4 py-2 font-semibold md:text-[20px] lg:text-[15px] text-right">
                                <?php if ($status == 'Done'): ?>
                                    <a href="detail.php?id=<?php echo $order_id; ?>" class="bg-blue-400 hover:bg-blue-500 px-4 py-1 rounded-md text-white duration-200">Detail</a>
                                    <a href="#" class="bg-green-600 hover:bg-green-500 px-4 py-1 rounded-md text-white duration-200">Done</a>
                                <?php else: ?>
                                    <!-- detail.php သို့ ID ပို့ပေးမည် -->
                                    <a href="detail.php?id=<?php echo $order_id; ?>" class="bg-blue-400 hover:bg-blue-500 px-2 py-1 rounded-md text-white">Pending</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    <?php mysqli_stmt_close($stmt); ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>