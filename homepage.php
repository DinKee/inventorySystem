<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>首頁</title>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/start/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <h1><font style= "text-shadow:0px 0px 15px #F2FF38" color = "#33333"; face = 微軟正黑體>昌洲商行</font></h1>
        <H1><strong><font style= "text-shadow:0px 0px 15px #F2FF38" color = "#AD5A5A"; face = 微軟正黑體>訂單與存貨管理系統</font></strong></H1>
        <!-- cards -->
        <section class="cards">
            <!-- card -->
            <div class="card" onclick=" location.href= 'total.php';">
                <img class="card-img" src="https://icons8.com/wp-content/uploads/2020/06/user-experience-illustration.png" alt="">
                <div class="card-body">
                    <DIV style = "text-align:center;">
                    <h3 class="card-title">總訂單管理</h3></DIV>
                    <p class="card-text">

                    </p>
                </div>
            </div>
            <!-- card end -->
            <!-- card -->
            <div class="card" onclick=" location.href= 'purchaseOrder.php';">
                <img class="card-img" src="https://uploads-ssl.webflow.com/5d547fd95c0c318175310f35/5d9cb4d7a7370f38ed1d76ad_abstract-customer-support.png" alt="">
                <div class="card-body">
                    <DIV style = "text-align:center;">
                    <h3 class="card-title">進貨訂單管理</h3></DIV>
                    <p class="card-text">

                    </p>
                </div>
            </div>
            <!-- card end -->
             <!-- card -->
             <div class="card" onclick=" location.href= 'sellOrder.php';">
                <img class="card-img" src="https://uploads-ssl.webflow.com/5d547fd95c0c318175310f35/5d9cb41ba9fcfbca9323b3dc_abstract-success.png" alt="">
                <div class="card-body">
                    <DIV style = "text-align:center;">
                    <h3 class="card-title">銷貨管理</h3></DIV>
                    <p class="card-text">
                    </p>
                </div>
            </div>
            <!-- card end -->
        </section>
        <!-- cards end -->
        <!-- cards -->
        <section class="cards">
            <!-- card -->
            <div class="card" onclick=" location.href= 'inventory.php';">
                <img class="card-img" src="https://ouch-cdn.icons8.com/preview/535/8c09e84b-11ab-4053-876b-ff5d999e1494.png" alt="">
                <div class="card-body">
                    <DIV style = "text-align:center;">
                    <h3 class="card-title">存貨管理</h3></DIV>
                    <p class="card-text">
                    </p>
                </div>
            </div>
            <!-- card end -->
            <!-- card -->
            <div class="card" onclick=" location.href= 'member.php';">
                <img class="card-img" src="https://ouch-cdn.icons8.com/preview/481/3cbbc127-1464-4d0a-a407-3ca4c321e107.png" alt="">
                <div class="card-body">
                    <DIV style = "text-align:center;">
                    <h3 class="card-title">會員管理</h3></DIV>
                    <p class="card-text">
                    </p>
                </div>
            </div>
            <!-- card end -->
        </section>
        <!-- cards end -->
    </body>
</html>