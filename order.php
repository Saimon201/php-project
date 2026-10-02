<?php session_start() ?>

<?php include('connection.php') ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
    <title>Shop</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">
</head>

<body>
    <div class="flex justify-center mt-5">
        <div class="w-full max-w-md">
            <a href="market.php" class="inline-flex items-center gap-1 text-md font-medium text-green-600 hover:text-slate-900 mb-4 inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Go Back
            </a>
        </div>
    </div>

    <?php
    if (isset($_POST['confirm_order'])) {
    $customer_name = $_POST['customer_name'];
    $address       = $_POST['address'];
    $phone         = $_POST['phone'];
    
    // Payment Slip Upload ပြုလုပ်တာ
    $payment_slip  = $_FILES['payment_ss']['name'];
    $temp_name     = $_FILES['payment_ss']['tmp_name'];
    $folder        = "images/" . $payment_slip;
    move_uploaded_file($temp_name, $folder);

    // Cart ထဲရှိ ပစ္စည်းတစ်ခုချင်းစီကို Loop ပတ်ပြီး Database ထဲ ထည့်မယ်
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        
        $sql = "INSERT INTO orders (customer_name, address, phone, quantity, price, image, payment_slip, status) VALUES (?, ?, ?, ?, ?, ?, ?, 'Pending')";
        $stmt = mysqli_prepare($conn, $sql);

        foreach ($_SESSION['cart'] as $item) {
            $item_quantity = $item['quantity'];
            $item_price    = $item['price']; // ပစ္စည်းတစ်ခု၏ မူလတန်ဖိုး
            $item_image    = $item['image'];

            mysqli_stmt_bind_param($stmt, "sssidss", $customer_name, $address, $phone, $item_quantity, $item_price, $item_image, $payment_slip);
            mysqli_stmt_execute($stmt);
        }

        // Order အားလုံး ဝင်သွားပါက Cart Session ကို ရှင်းမယါ
        unset($_SESSION['cart']);

        // market.php သို ပြန်သွားမယ်
        header("Location: market.php");
        exit();
    }
}
    ?>


    <div class="flex items-center justify-center pb-5">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-lg overflow-hidden border border-slate-100">

            <!-- Header -->
            <div class="bg-blue-600 p-6 text-white">
                <h2 class="text-xl font-bold">Payment Details</h2>
                <p class="text-blue-100 text-xs mt-1">Please fill in your details to proceed.</p>
            </div>
            
            <form class="p-6 space-y-4 text-xs" action="order.php" method="POST" enctype="multipart/form-data">

                <!-- Full Name -->
                <div>
                    <label for="fullname" class="block font-medium text-slate-700 mb-1">
                        Full Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text"  name="customer_name" placeholder="Enter your name" required
                        class="w-full p-2.5 rounded-lg border border-slate-200 focus:outline-none focus:border-blue-500">
                </div>

                <!-- Address -->
                <div>
                    <label for="address" class="block font-medium text-slate-700 mb-1">
                        Address <span class="text-red-500">*</span>
                    </label>
                    <textarea  name="address" rows="2" placeholder="Street address, city" required
                        class="w-full p-2.5 rounded-lg border border-slate-200 focus:outline-none focus:border-blue-500 resize-none"></textarea>
                </div>


                <!-- Phone Numbers (Grid) -->
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label for="phone" class="block font-medium text-slate-700 mb-1">
                            Phone Number <span class="text-red-500">*</span>
                        </label>
                        <input type="tel"  name="phone" placeholder="09xxxxxxxxx" required
                            class="w-full p-2.5 rounded-lg border border-slate-200 focus:outline-none focus:border-blue-500">
                    </div>

                    <div>
                        <label for="transfer_phone" class="block font-medium text-slate-700 mb-1">
                            Transfer Phone (K pay) <span class="text-red-500">*</span>
                        </label>
                        <input type="tel" id="transfer_phone" name="payment_ss" value="09-795979784" readonly required
                            class="w-full p-2.5 rounded-lg border border-slate-200 focus:outline-none focus:border-blue-500">
                    </div>
                </div>

                <!-- QR Codes -->
                <div class="pt-1">
                    <label class="block font-medium text-slate-700 mb-2 text-center">Scan QR Code to Pay</label>
                    <div class="flex items-center justify-center gap-6">
                        <!-- KPay QR -->
                        <div class="rounded-xl text-center ">
                            <span class="block font-bold text-blue-600 mb-1 text-[11px]">KPay</span>
                            <img src="images/kpay.jpg" alt="KPay QR" class="w-full h-28 object-contain mx-auto rounded">
                        </div>
                        <div class="flex justify-center items-center">
                            <p>OR</p>
                        </div>
                        <!-- WavePay QR -->
                        <div class="rounded-xl text-center">
                            <span class="block font-bold text-yellow-500 mb-1 text-[11px]">WavePay</span>
                            <img src="images/wave.jpg" alt="WavePay QR" class="w-full h-28 object-contain mx-auto rounded">
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block font-medium text-slate-700 mb-1">
                        Payment Screenshot<span class="text-red-500">*</span>
                    </label>

                    <!-- File Upload Input -->
                    <input type="file" id="payment_slip" name="payment_ss" accept="image/*" onchange="previewImage(event)" required
                        class="w-full p-2.5 rounded-lg border border-slate-200 focus:outline-none focus:border-blue-500 text-xs">

                    <!-- တင်လိုက်တဲ့ ပုံကို အောက်မှာ ပြပေးမယ့် Box -->
                    <div id="preview-container" class="mt-3 hidden">
                        <p class="text-xs text-slate-500 mb-1">Uploaded Screenshot Preview:</p>
                        <img id="image-preview" src="#" alt="Screenshot Preview" class="w-full max-h-48 object-contain rounded-lg border border-slate-200 p-1 bg-slate-50">
                    </div>
                </div>

                <div class="flex items-center gap-2 p-2.5 bg-blue-50/60 rounded-lg text-blue-700 text-[11px] font-medium">
                    <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Please double-check the transfer phone number.</span>
                </div>

                <button type="submit" name="confirm_order"
                    class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors cursor-pointer">
                    Confirm Order
                </button>

            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const input = event.target;
            const previewContainer = document.getElementById('preview-container');
            const imagePreview = document.getElementById('image-preview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                }

                reader.readAsDataURL(input.files[0]);
            } else {
                imagePreview.src = '#';
                previewContainer.classList.add('hidden'); 
            }
        }
    </script>
</body>

</html>