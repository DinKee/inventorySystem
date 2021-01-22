<head>
    <meta charset="utf-8">
    <title>進貨訂單管理系統</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/start/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <style>
        .searchTable {background-color: #FFAC7D;}
        #itemTable ,#itemTable td{border: solid 1px gray;padding: 0px;}
    </style>
    <link rel="stylesheet" href="nicepage.css" media="screen">
    <link rel="stylesheet" href="Page-2.css" media="screen">
</head>
<body>
    <a href="homepage.php"><img src="https://i.pinimg.com/originals/e2/5c/43/e25c43c6a65bdca84c72f0c58524fcd6.png" style="width: 30px;"></img> </a>
    <h2 class="u-align-center u-clearfix u-valign-middle u-text u-text-1">總訂單管理</h2>
    <form  class="searchTable" action="total.php" method="POST" name="query">
        <table>
            <tr>
                <td>
                    茶種類別=&nbsp
                    <select name="tea_name_select">
                        <option>茶種</option>
                        <option>紅茶</option>
                        <option>綠茶</option>
                        <option>青茶</option>
                        <option>烏龍茶</option>
                        <option>古早味紅茶</option>
                        <option>古早味綠茶</option>
                        <option>高山茶</option>
                        <option>台灣茶</option>
                    </select>
                    &nbsp&nbsp&nbsp&nbsp茶種名稱=&nbsp<input type="text" size="10" name="t_name">&nbsp&nbsp
                    訂單日期=&nbsp <input class="date" size="10" name="date_begin">&nbsp~&nbsp<input class="date" size="10" name="date_end">
                </td>
                <td>
                    <input type="submit" value="查詢" name="search">
                </td>
                <td>
                    <input type="submit" value="清除">
                </td>
            </tr>
        </table>
    </form>

    <section class="u-align-center u-clearfix u-section-1" id="sec-a1df">
      <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <div class="u-expanded-width u-table u-table-responsive u-table-1">
          <table class="u-table-entity u-table-entity-1">
            <colgroup>
              <col width="10.7%">
              <col width="12.4%">
              <col width="10.4%">
              <col width="10.9%">
              <col width="10.7%">
              <col width="14.9%">
              <col width="10%">
              <col width="7.6%">
              <col width="12.6%">
            </colgroup>
            <thead class="u-custom-font u-font-courier-new u-palette-4-base u-table-header u-table-header-1">
              <tr style="height: 59px;">
                <th class="u-table-cell">編號<br>
                </th>
                <th class="u-table-cell">茶種類別</th>
                <th class="u-table-cell">茶種名稱</th>
                <th class="u-table-cell">會員編號<br>
                </th>
                <th class="u-table-cell">訂單日期<br>
                </th>
                <th class="u-table-cell">送貨地點</th>
                <th class="u-table-cell">總費用</th>
                <th class="u-table-cell">姓名</th>
                <th class="u-table-cell">電話</th>
              </tr>
            </thead>
            <tbody class="u-table-body">
              <?php
                session_start();
                require_once("dbconnect.inc");
                
                if (isset($_SESSION["sell_search"]) && isset($_SESSION["purchase_search"]))
                    $sell_sql = $_SESSION["sell_search"];
                    $purchase_sql = $_SESSION["purchase_search"];
                $sell_result = mysqli_query($link,$sell_sql);
                $purchase_result = mysqli_query($link,$purchase_sql);                
                
                if(!$sell_result || !$purchase_result){
                    echo ("Error: ".mysqli_error($link));
                    exit();
                }else{
                    $total_price = 0;
                    while ($rows = mysqli_fetch_array($sell_result, MYSQLI_ASSOC)) {
                        $m_id = $rows["m_ID"];
                        $m_name_sql = "SELECT* FROM member WHERE m_ID = '$m_id' ";
                        $name_result = mysqli_query($link, $m_name_sql);
                        $member_row = mysqli_fetch_array($name_result, MYSQLI_ASSOC);

                        echo "<tr style='height: 55px;'>";
                        echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$rows["order_ID"]."</td>";
                        echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$rows["tea_type"]."</td>";
                        echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$rows["tea_type"]."</td>";
                        echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$rows["m_ID"]."</td>";
                        echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$rows["tea_date"]."</td>";
                        echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$member_row["m_address"]."</td>";
                        echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$rows["tea_num"] * $rows["unit_price"]."</td>";
                        echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$member_row["m_name"]."</td>";
                        echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$member_row["m_tel"]."</td>";
                        echo "</tr>";
                        $total_price = $total_price + $rows["tea_num"] * $rows["unit_price"];
                    }
                    while ($rows = mysqli_fetch_array($purchase_result, MYSQLI_ASSOC)) {
                        echo "<tr style='height: 55px;'>";
                        echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$rows["purchase_id"]."</td>";
                        echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$rows["tea_type"]."</td>";
                        echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$rows["tea_type"]."</td>";
                        echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'></td>";
                        echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$rows["tea_date"]."</td>";
                        echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'></td>";
                        echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$rows["tea_num"] * $rows["unit_price"]."</td>";
                        echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'></td>";
                        echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'></td>";
                        echo "</tr>";
                        $total_price = $total_price - $rows["tea_num"] * $rows["unit_price"];
                    }
                    $p_num = mysqli_num_rows($purchase_result);
                    $s_num = mysqli_num_rows($sell_result);
                    $total = $p_num + $s_num;
                    echo "<tr style='height: 47px;' class='u-table-footer u-table-footer-1'>";
                    echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'></td>";
                    echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'></td>";
                    echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'></td>";
                    echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'></td>";
                    echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'></td>";
                    echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>All Order:</td>";
                    echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$total."</td>";
                    echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>Your Total:</td>";
                    echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$total_price."</td>";
    
                    mysqli_free_result($purchase_result);
                    mysqli_free_result($sell_result);
                    require_once("dbclose.inc");
                }
              ?>
              <!-- <tr style="height: 55px;">
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">001</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">紅茶</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">紅茶</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">001</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">2020-01-01</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">704台南市北區北安路一段5689號</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">$ 500</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">王茶</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">0912345678</td>
              </tr>
              <tr style="height: 55px;">
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">002</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">綠茶</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">綠茶</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">001</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">2020-01-01</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">704台南市北區北安路一段5689號</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">$ 500</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">王茶</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">0912345678</td>
              </tr>
              <tr style="height: 55px;">
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">003</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">青茶</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">青茶</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">001</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">2020-01-01</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">704台南市北區北安路一段5689號</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">$ 500</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">王茶</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">0912345678</td>
              </tr>
              <tr style="height: 54px;">
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">004</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">古早味紅茶</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">古早味紅茶</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">001</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">2020-01-01</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">704台南市北區北安路一段5689號</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">$ 500</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">王茶</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">0912345678</td>
              </tr>
            </tbody>
            <tfoot class="u-table-footer u-table-footer-1">
              <tr style="height: 47px;">
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-border-no-top u-table-cell"></td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-border-no-top u-table-cell"></td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-border-no-top u-table-cell"></td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-border-no-top u-table-cell"></td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-border-no-top u-table-cell"></td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-border-no-top u-table-cell">All Items</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-border-no-top u-table-cell">4<br>
                </td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-border-no-top u-table-cell">Your Total:</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-border-no-top u-table-cell">$2000.00</td>
              </tr>
            </tfoot> -->
          </table>
        </div>
      </div>
    </section>
</body>
<script>
    $('.date').datepicker({dateFormat: 'yy-mm-dd'});
</script>