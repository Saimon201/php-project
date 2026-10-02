 <?php include("connection.php"); ?>
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

   <?php include("header.php") ?>

   <?php
    $media = '../images/';
    if (!is_dir($media)) mkdir($media);

    if (isset($_POST['submit'])) {
      $price = $_POST['price'];
      $category = $_POST['category'];
      $stock = $_POST['stock'];

      if (isset($_POST['bestseller'])) {
        $bestseller = 1;
      } else {
        $bestseller = 0;
      }

      // Image သို့မဟုတ် Price လိုအပ်ချက် ရှိမရှိ စစ်တဲ့ဟာ
      if (empty($price) || empty($_FILES['image']['name'])) {
        echo "<script>alert('ကျေးဇူးပြု၍ Data များကို ပြည့်စုံစွာ ဖြည့်စွက်ပါ');</script>";
      } else {
        $image = time() . "_" . basename($_FILES['image']['name']);

        // Image ကို Folder ထဲ ပို့မယ်
        if (move_uploaded_file($_FILES['image']['tmp_name'], $media . $image)) {

          // Database ထဲ ထည့်မယ်
          $query = "INSERT INTO products (price, category, stock, bestseller, image) 
                      VALUES ('$price', '$category', '$stock', '$bestseller', '$image')";

          if ($conn->query($query)) {
            // Database ထဲ အောင်မြင်စွာ ရောက်မှ index.php ကို ပို့မယ်
            header("location:index.php");
            exit();
          } else {
            echo "<script>alert('Failed to insert data into the database');</script>"; //database ထဲကိုမရောကိရင် အောက်ပါ alert ကိုထုတ်ပြမယ်
          }
        } else {
          echo "<script>alert('Image Upload not successful');</script>";
        }
      }
    }
    ?>

   <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
     <div class="sm:mx-auto sm:w-full sm:max-w-sm">
       <h2 class="mt-5 text-center text-2xl/9 font-bold tracking-tight text-blue-500">Create Product</h2>
     </div>

     <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">

       <form action="product_create.php" method="POST" enctype="multipart/form-data" class="space-y-4">

         <div class="mb-3 bg-orange-200 pl-5 py-1 mr-40 rounded-md">
           <label class="form-label">Category =</label>
           <select name="category" class="form-control" required>
             <option value="sunglass">Sunglass</option>
             <option value="clearglass">Clearglass</option>
             <option value="bluelight">Bluelight</option>
           </select>
         </div>

         <div>
           <label for="text" class="block text-sm/6 font-medium text-gray-600">Price</label>
           <div class="mt-2">
             <input id="text" type="number" name="price" required class="bg block w-full rounded-md bg-blue-100 px-3 py-1.5 text-base text-black outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
           </div>
         </div>

         <div>
           <label for="text" class="block text-sm/6 font-medium text-gray-600">Stock Quantity</label>
           <div class="mt-2">
             <input id="text" type="number" name="stock" required class="bg block w-full rounded-md bg-blue-100 px-3 py-1.5 text-base text-black outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
           </div>
         </div>

         <label class="flex items-center">
           Bestseller?<input type="checkbox" name="bestseller" value="1" class="ml-3 mt-1">
         </label>

         <div>
           <div class="flex items-center justify-between">
             <label for="file" class="block text-sm/6 font-medium text-gray-600">Image</label>
           </div>
           <div class="mt-2">
             <input id="file" type="file" name="image" required class="block w-full rounded-md bg-blue-100 px-3 py-1.5 text-base text-black outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
           </div>
         </div>

         <div>
           <button type="submit" name="submit" class="flex w-full justify-center rounded-md bg-indigo-500 px-3 py-1.5 text-sm/6 font-semibold text-white hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Submit</button>
         </div>
       </form>


     </div>
   </div>

 </body>

 </html>