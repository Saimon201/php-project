<?php include ('connection.php'); ?>
<?php include ('auth.php'); ?>

 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Detail</title>
 </head>

 <body>
     <?php include 'header.php'; ?>

     <?php

        if (isset($_GET['id'])) {
            $order_id = $_GET['id'];

            // အရင်ဆုံး နှိပ်လိုက်တဲ့ ID ရဲ့ Phone number ကို အရင်ရှာမယ်
            $get_phone_sql = "SELECT phone,status FROM orders WHERE id = ?";
            $stmt_phone = mysqli_prepare($conn, $get_phone_sql);
            mysqli_stmt_bind_param($stmt_phone, "i", $order_id);
            mysqli_stmt_execute($stmt_phone);
            $res_phone = mysqli_stmt_get_result($stmt_phone);
            $phone_data = mysqli_fetch_assoc($res_phone);

            if ($phone_data) {
                $customer_phone = $phone_data['phone'];
                $status = $phone_data['status'];

                // အဲ့ဒီ Phone Number နဲ့ မှာထားသမျှ Order အားလုံးကို ဆွဲထုတ်မယ်
                $sql = "SELECT * FROM orders WHERE phone = ?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "s", $customer_phone);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
            }
        }
        ?>

     <div class="flex justify-center">
         <div class="w-full lg:w-[2000px] lg:mx-20 mt-20">
             <table class="w-full text-left text-sm text-gray-600">
                 <thead class="bg-gray-100 text-xs text-gray-700 border border-gray-300">
                     <tr>
                         <th class="py-2 border border-gray-300 font-semibold md:text-[20px] lg:text-[17px] text-center">Customer Name</th>
                         <th class="px-8 py-2 border border-gray-300 font-semibold md:text-[20px] lg:text-[17px] text-center">Address</th>
                         <th class="px-2 py-2 border border-gray-300 font-semibold md:text-[20px] lg:text-[17px] text-center">Phone number</th>
                         <th class="px-2 py-2 border border-gray-300 font-semibold md:text-[20px] lg:text-[17px] text-center">Quantity</th>
                         <th class="px-5 py-2 border border-gray-300 font-semibold md:text-[20px] lg:text-[17px] text-center">Price</th>
                         <th class="px-5 py-2 border border-gray-300 font-semibold md:text-[20px] lg:text-[17px] text-center">Image</th>
                         <th class="px-5 py-2 border border-gray-300 font-semibold md:text-[20px] lg:text-[17px] text-center">Payment Slip</th>
                     </tr>
                 </thead>
                 <tbody class="text-xs text-gray-700 border border-gray-300">
                     <?php
                        if (isset($result) && mysqli_num_rows($result) > 0):
                            while ($row = mysqli_fetch_assoc($result)):
                        ?>
                             <tr>
                                 <td class="py-2 border border-gray-300 font-semibold md:text-[20px] lg:text-[17px] text-center"><?php echo $row['customer_name']; ?></td>
                                 <td class="px-8 py-2 border border-gray-300 font-semibold md:text-[20px] lg:text-[17px] text-center"><?php echo $row['address']; ?></td>
                                 <td class="px-2 py-2 border border-gray-300 font-semibold md:text-[20px] lg:text-[17px] text-center"><?php echo $row['phone']; ?></td>
                                 <td class="px-2 py-2 border border-gray-300 font-semibold md:text-[20px] lg:text-[17px] text-center"><?php echo $row['quantity']; ?></td>
                                 <!-- Database Column Name မှာ price ဖြစ်သောကြောင့် price ဟု ပြောင်းထားပါသည် -->
                                 <td class="px-5 py-2 border border-gray-300 font-semibold md:text-[20px] lg:text-[17px] text-center"><?php echo $row['price']; ?> MMK</td>
                                 <td class="px-5 py-2 border border-gray-300 font-semibold md:text-[20px] lg:text-[17px] text-center">
                                     <img src="../images/<?php echo $row['image']; ?>" class="mx-auto block w-[60px] h-[70px]">
                                 </td>
                                 <td class="px-[7px] py-2 border border-gray-300 font-semibold md:text-[20px] lg:text-[17px] text-center">
                                     <img src="../images/<?php echo $row['payment_slip']; ?>" class="mx-auto block w-[60px] h-[70px]">
                                 </td>
                             </tr>
                     <?php
                            endwhile;
                        endif;
                        ?>
                 </tbody>
             </table>

             <div class="flex justify-end mt-4">
                 <?php if ($status === 'Done'): ?>
                     <a href="update_status.php?id=<?php echo $order_id; ?>" class="bg-green-400 hover:bg-green-500 text-white px-4 py-2 rounded-md duration-200">Approved</a>
                 <?php else: ?>
                     <a href="update_status.php?id=<?php echo $order_id; ?>" class="bg-blue-400 hover:bg-blue-500 text-white px-4 py-2 rounded-md duration-200">Approve</a>
                 <?php endif; ?>
             </div>
         </div>
     </div>
 </body>

 </html>