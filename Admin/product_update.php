<?php include('connection.php'); ?>
<?php include ('auth.php'); ?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Montenegrin+Gothic+One&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Playwrite+DE+SAS+Guides&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Yuyu&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

</head>

<body>
    <?php include('header.php') ?>

    <?php 
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $products = $conn->query("SELECT * FROM products WHERE id=$id");
        $product = $products->fetch_assoc();
    }
    
    // UPDATE 
    if(isset($_POST['update'])) {   //confirmနှိပ်လိုက်တဲ့ အခြေနေကို စစ်ပေးတာ
        $price = $_POST['price'];   
        $stock = $_POST['stock'];  
                 
        $conn->query("UPDATE products SET price='$price', stock='$stock' WHERE id='$id'");  //$id နဲ့ကိုက်ညီတဲ့ product ရဲ့စျေးနှုန်းကို စျေးနှုန်းအသစ်နဲ့ အစားထိုးတာ

        header("location: index.php");
    }
    ?>

    <!-- Delete -->
    <?php 
    if(isset($_POST['delete'])) {
        $imagepath = "images/".$product['image'];  //ဖျက်ချင်တဲ့ပုံရဲ့ folder လမ်းကြောင်းကိုယူမယ်

        if(file_exists($imagepath) && !empty($product['iamge'])) {  //ပတ်လည်းကြောင်း နဲ့ product ရဲ့ image column ထဲမှာphotoရှိနေသေးရင်
            unlink($imagepath);  //folder ထဲမှာရှိပုံကိုဖျက်
        }

        $delete = "DELETE FROM products WHERE id='$id'"; 
        $conn->query($delete);

        header("location: index.php");
    }
    ?>

    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-blue-500">Price Change</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form action="" method="POST" enctype="multipart/form-data" class="space-y-6">
                <div>
                    <label for="text" class="block text-sm/6 font-medium text-gray-600">Price</label>
                    <div class="mt-2">
                        <input type="number" name="price" value="<?php echo $product['price']; ?>" required class="bg block w-full rounded-md bg-blue-100 px-3 py-1.5 text-base text-black outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                    </div>
                </div>

                <div>
                    <label for="text" class="block text-sm/6 font-medium text-gray-600">Stock</label>
                    <div class="mt-2">
                        <input type="number" name="stock" value="<?php echo $product['stock']; ?>" required class="bg block w-full rounded-md bg-blue-100 px-3 py-1.5 text-base text-black outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                    </div>
                </div>


                <div>
                    <button type="submit" name="update" class="flex w-full justify-center rounded-md bg-indigo-500 px-3 py-1.5 text-sm/6 font-semibold text-white hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Confirm</button>
                    <button type="delete" name="delete" class="mt-5 flex w-full justify-center rounded-md bg-red-500 px-3 py-1.5 text-sm/6 font-semibold text-white hover:bg-red-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Product will be Delete</button>
                </div>
            </form>


        </div>
    </div>

</body>

</html>