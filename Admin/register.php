<?php include('connection.php') ?>
<?php include ('auth.php'); ?>



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

    <div class="flex justify-center mt-10">
        <div class="w-full max-w-md">
            <a href="index.php" class="inline-flex items-center gap-1 text-md font-medium text-green-600 hover:text-slate-900 mb-4 inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Go Back
            </a>
        </div>
    </div>

    <?php
    session_start(); 
    include('connection.php'); 

    if (isset($_POST['register'])) { // Register Button ကို နှိပ်လိုက်ပါက အောက်ပါ Code များ အလုပ်လုပ်မည်
        $username  = trim($_POST['username']); 
        $email     = trim($_POST['email']); 
        $password  = $_POST['password'];

        $ADMIN_USERNAME = "saimon";
        $ADMIN_EMAIL    = "saimon@glasses.com";
        $SECRET_PASSWORD     = "MYADMIN123";

        if ($username === $ADMIN_USERNAME && $email === $ADMIN_EMAIL && $password === $SECRET_PASSWORD) {
            $role = 'admin'; // အချက်အလက် (၃) ခုလုံး မှန်ပါက Admin Role သတ်မှတ်မယ်
        }
        
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $email, $hashed_password, $role);

        if ($stmt->execute()) {
            // Register အဆင်ပြေပါက Login Page သို ပိုပေးမည်
            echo "<script>
                alert('Account created successfully.Please Login.');
                window.location.href = 'user.php';
              </script>";
            exit();
        }
    }
    ?>

    <main>
        <div class="flex justify-center mt-20 mb-20 md:mt-40 lg:mt-10">
            <div class="bg-gray-600 w-[300px] h-[400px] rounded-2xl md:w-[500px] md:h-[550px] lg:w-[400px] lg:h-[490px] ">
                <div class="flex justify-between  py-1 mt-7 mx-9 border border-gray-500 rounded-xl  md:py-2 md:mx-10 lg:px-0 lg:py-1.5">
                    <p class="text-[13px] md:text-[20px] lg:text-[18px]  text-gray-200 hover:bg-orange-500 px-8.5 py-1 mx-1 md:mx-2 md:px-16.5  md:mx-1 lg:px-11.5 lg:mx-1.5 rounded-md duration-300"><a href="user.php">Login</a></p>
                    <p class="text-[13px] md:text-[20px] lg:text-[18px] text-gray-200 bg-orange-500 px-8.5 py-1 mx-1 md:mx-2 md:px-16.5 md:mx-1 lg:px-11.5 lg:mx-1.5 rounded-md duration-300">Register</p>
                </div>

                <form action="register.php" method="POST" class="mt-3 md:mt-8 lg:mt-5">
                    <div class="w-[275px] mx-3">

                        <p class="text-[13px] md:text-[20px] lg:text-[15px] text-gray-200 mb-1 md:mb-2 ">FULL NAME</p>
                        <input type="name" name="username" class="bg-blue-100 w-[270px] h-[30px] md:w-[465px] md:h-[50px] lg:w-[365px] lg:h-[40px] border border-gray-400 pl-2 pb-1 mb-4 md:pt-1 md:mb-6 ml-1 rounded-md placeholder-gray-400 placeholder:text-[13px] md:placeholder:text-[20px] lg:placeholder:text-[15px]"
                            placeholder="Enter your name ">


                        <p class="text-[13px] md:text-[20px] lg:text-[15px] text-gray-200 mb-1  md:mb-2">EMAIL ADRESS</p>
                        <input type="email" name="email" autocomplete="off" class="bg-blue-100 w-[270px] h-[30px] md:w-[465px] md:h-[50px] lg:w-[365px] lg:h-[40px] border border-gray-400 pl-2 pb-1 mb-4 md:pt-1 md:mb-6 ml-1 rounded-md placeholder-gray-400 placeholder:text-[13px] md:placeholder:text-[20px] lg:placeholder:text-[15px]"
                            placeholder="Enter your email ">


                        <P class="text-[13px] md:text-[20px] lg:text-[15px] text-gray-200  mb-1  md:mb-2 lg:mt-1">PASSWORD</P>
                        <div class="relative flex items-center md:w-[467px] lg:w-[368px]">
                            <input type="password" name="password" autocomplete="new-password" required id="passwordInput" class="bg-blue-100 w-[270px] h-[30px] md:w-[465px] md:h-[50px] lg:w-[365px] lg:h-[40px] border border-gray-400 pl-2 pb-1 md:pt-1 ml-1 rounded-md placeholder-gray-400 placeholder:text-[13px] md:placeholder:text-[20px] lg:placeholder:text-[15px]"
                                placeholder="Enter your password">
                            <i class="fa-solid fa-eye-slash absolute right-3 text-gray-600 lg:right-5" id="togglePassword"></i>
                        </div>

                    </div>
                    <button type="submit" name="register" class="lg:text-[15px] md:text-[20px] text-[13px] block mx-auto text-white bg-orange-500 mt-10 mb-2 px-26 py-1.5 rounded-md">Sing Up</button>
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