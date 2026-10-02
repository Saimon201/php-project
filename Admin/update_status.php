<?php
include('connection.php');

if (isset($_GET['id'])) { //id ပါလာရင် အောက်က code တွေကို အလုပ်လုပ်မယ်
    $order_id = $_GET['id'];   //ပါလာတဲံ id ကို order_id ထဲကိုထည့်ထားမယ်

    $sql = "UPDATE orders SET status = ? WHERE id = ?"; //သက်ဆိုင်ရာ id ရဲ့ status ဆို့တဲ့ column ထဲက ဟာကိုပြောင်းမယ်
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        $new_status = 'Done';  //status ထဲကို အသစ်ထည့်မယ် data ကို done ဆိုပြီးသတ်မှတ်ပြီး variable ပေးထားမယ်

        mysqli_stmt_bind_param($stmt, "si", $new_status, $order_id);

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);  //ပြီးပြီဆိုရင် prepare statement ကိုပ်တ်မယ်
            header('location: order_check.php');
            exit(); //အလုပ်ဆက်မလုပ်တော့ဘဲ ရပ်တန့်မယ်
        }
    }
}
?>