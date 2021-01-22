<head>
    <meta charset="utf-8">
    <title>存貨管理系統</title>

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
    <h2 class="u-align-center u-clearfix u-valign-middle u-text u-text-1">存貨管理</h2>
    <form  class="searchTable" action="inventory.php" method="POST" name="query">
        <table>
            <tr>
                <td>
                    <!-- 查種類別=&nbsp
                    <select>
                        <option>紅茶</option>
                        <option>綠茶</option>
                        <option>青茶</option>
                    </select> -->
                    &nbsp&nbsp&nbsp&nbsp茶種名稱=&nbsp<input type="text" size="10" name="t_name">&nbsp&nbsp
                    <!-- 訂單日期=&nbsp <input class="date" size="10" name="date_begin">&nbsp~&nbsp<input class="date" size="10" name="date_end"> -->
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
              <col width="20%">
              <col width="20%">
              <col width="20%">
              <col width="20%">
              <col width="20%">
            </colgroup>
            <thead class="u-custom-font u-font-courier-new u-palette-4-base u-table-header u-table-header-1">
              <tr style="height: 59px;">
                <th class="u-table-cell">茶種編號<br></th>
                <th class="u-table-cell">茶種名稱</th>
                <th class="u-table-cell">單價<br></th>
                <th class="u-table-cell">總價<br></th>
                <th class="u-table-cell">庫存數量<br></th>
              </tr>
            </thead>
            <tbody class="u-table-body">
              <?php
                session_start();
                $t_name_ch = "";
                $t_num = 0;
                if (isset($_POST["search"])) {
                  $t_name_ch = $_POST["t_name"];
                }
                
                require_once("dbconnect.inc");

                if (!($t_name_ch == "")){                  
                  $sql = " SELECT * FROM tea_inventory WHERE tea_type LIKE '%$t_name_ch%' ";
                  
                  $_SESSION["inventory_search"] = $sql;
                  header("Location: inventory_result.php");
                }

                $sql = "SELECT * FROM tea_inventory";
                $result = mysqli_query($link, $sql);

                while ($rows = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

                  echo "<tr style='height: 55px;'>";
                  echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$rows["tea_ID"]."</td>";
                  echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$rows["tea_type"]."</td>";
                  echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$rows["stock_price"]."</td>";
                  echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$rows["stock_price"] * $rows["inventory_qty"]."</td>";
                  echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$rows["inventory_qty"]."</td>";
                  echo "</tr>";
                }
                $t_num = mysqli_num_rows($result);
                echo "<tr style='height: 47px;' class='u-table-footer u-table-footer-1'>";
                echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'></td>";
                echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'></td>";
                echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'></td>";
                echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>All tea</td>";
                echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$t_num."</td>";

                mysqli_free_result($result);
                require_once("dbclose.inc");

              ?>
              <!-- <tr style="height: 55px;">
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">001</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">紅茶</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">$ 10.00</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">5000</td>
              </tr>
              <tr style="height: 55px;">
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">002</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">綠茶</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">$ 10.00</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">3000</td>
              </tr>
              <tr style="height: 55px;">
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">003</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">青茶</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">$ 10.00</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">2846</td>
              </tr>
              <tr style="height: 54px;">
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">004</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">古早味紅茶</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">$ 10.00</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">2444</td>
              </tr>
            </tbody>
            <tfoot class="u-table-footer u-table-footer-1">
              <tr style="height: 47px;">
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-border-no-top u-table-cell">All Items</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-border-no-top u-table-cell">4<br>
                </td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-border-no-top u-table-cell"></td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-border-no-top u-table-cell"></td>
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
