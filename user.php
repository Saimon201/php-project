<?php include('connection.php') ?>
<?php session_start() ?>

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
    <?php include('header.php') ?>

    <?php

    if (isset($_POST['login'])) { // Login Button နှိပ်ရင် အလုပ်လုပ်မယ်
        $email    = trim($_POST['email']); 
        $password = $_POST['password']; 

        // Database ထဲတွင် register လုပ်ထားသော Email ရှိမရှိ ရှာတဲ့ဟာ
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) { // Email မှန်တယ်ရင်
            $user = $result->fetch_assoc();

            // Hash လုပ်ထားသော Password နှင့် ရိုက်ထည့်လိုက်သော Password တူမတူ စစ်တဲံဟာ
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id']; // User ID ကို Session ထဲ မှတ်ထားမယ်
                $_SESSION['role']    = $user['role']; // User ရဲ့ Role ကို Session ထဲ မှတ်ထားမယ်

                // Role ပေါ်မူတည်၍ Page လမ်းကြောင်း ခွဲပေးမယ်
                if ($user['role'] === 'admin') {
                    header("Location: Admin/index.php"); // Admin ဖြစ်ပါက Admin ဘက်ကို ပို့မယ်
                    exit();
                } else {
                    header("Location: shop.php"); // User ဖြစ်ပါက User Home Page ကို ပို့
                    exit();
                }
            } else {
                echo "<script>alert('Invalid your password');</script>";
            }
        } else {
            echo "<script>alert('Not found your Email');</script>";
        }
    }
    ?>

    <main>
        <div class="flex justify-center mt-20 mb-20 md:mt-40 lg:mt-20">
            <div class="bg-gray-600 w-[300px] h-[370px] rounded-2xl md:w-[500px] md:h-[520px] lg:w-[400px] lg:h-[430px]">
                <div class="flex justify-between  py-1 mt-7 mb-2 mx-9 border border-gray-500 rounded-xl  md:py-2 md:mx-10 lg:px-0 lg:py-1.5">
                    <p class="text-[13px] md:text-[20px] lg:text-[18px]  text-gray-200 bg-orange-500 px-8.5 py-1 mx-1 md:mx-2 md:px-16.5  md:mx-1 lg:px-11.5 lg:mx-1.5 rounded-md duration-300">Login</p>
                    <p class="text-[13px] md:text-[20px] lg:text-[18px] text-gray-200 hover:bg-orange-500 px-8.5 py-1 mx-1 md:mx-2 md:px-16.5 md:mx-1 lg:px-11.5 lg:mx-1.5 rounded-md duration-300"><a href="register.php">Register</a></p>
                </div>
                <form action="user.php" method="POST" class="mt-3 md:mt-8">
                    <div class="w-[275px] mx-3">
                        <p class="text-[13px] md:text-[20px] lg:text-[15px] text-gray-200 mb-1 md:mb-2">EMAIL ADRESS</p>
                        <input type="email" name="email" autocomplete="off" class="bg-blue-100 w-[270px] h-[30px] md:w-[465px] md:h-[50px] lg:w-[365px] lg:h-[40px] lg:mb-2 border border-gray-400 focus:outline-none focus:border-blue-400 pl-2 pb-1 md:pt-1 md:mb-6 ml-1 rounded-md placeholder-gray-400 placeholder:text-[13px] md:placeholder:text-[20px] lg:placeholder:text-[15px] text-sm"
                            placeholder="Enter your email ">
                        <P class="text-[13px] md:text-[20px] lg:text-[15px] text-gray-200 mt-5 mb-1  md:mb-2">PASSWORD</P>

                        <div class="relative flex items-center md:w-[467px] lg:w-[368px]">
                            <input type="password" name="password" autocomplete="new-password" id="passwordInput" class="bg-blue-100 w-[270px] h-[30px] md:w-[465px] md:h-[50px] lg:h-[40px] border border-gray-400 focus:outline-none focus:border-blue-400 pl-2 pb-1 md:pt-1 ml-1 rounded-md placeholder-gray-400 placeholder:text-[13px] md:placeholder:text-[20px] lg:placeholder:text-[15px] text-sm"
                                placeholder="Enter your password">
                            <i class="fa-solid fa-eye-slash absolute right-3 text-gray-600 lg:right-5" id="togglePassword"></i>
                        </div>

                    </div>
                    <button type="submit" name="login" class="lg:text-[15px] md:text-[20px] text-[13px] block mx-auto text-white bg-orange-500 mt-15 mb-2 px-26 py-1.5 rounded-md">Login</button>
                    <small class="lg:text-[15px] md:text-[15px] text-[12px] block mx-auto text-center text-gray-200">Forgot Password?</small>
                </form>
            </div>

        </div>
    </main>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#passwordInput');

        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            this.classList.toggle('fa-eye-slash');
            this.classList.toggle('fa-eye');
        });
    </script>
</body>

</html>