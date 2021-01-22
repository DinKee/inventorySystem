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
    <h2 class="u-align-center u-clearfix u-valign-middle u-text u-text-1">進貨訂單管理</h2>
    <form  class="searchTable" action="purchaseOrder.php" method="POST" name="query">
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
              <col width="11.7%">
              <col width="12.4%">
              <col width="10.4%">
              <col width="10.9%">
              <col width="9.7%">
              <col width="14.9%">
              <col width="15.000000000000002%">
              <col width="15.200000000000003%">
              <col width="5%">
              <col width="5%">
            </colgroup>
            <thead class="u-custom-font u-font-courier-new u-palette-4-base u-table-header u-table-header-1">
              <tr style="height: 59px;">
                <th class="u-table-cell">採購編號<br>
                </th>
                <th class="u-table-cell">茶種名稱</th>
                <th class="u-table-cell">數量<br>
                </th>
                <th class="u-table-cell">單價<br>
                </th>
                <th class="u-table-cell">總價</th>
                <th class="u-table-cell">購買時間</th>
                <th class="u-table-cell">採購人員編號</th>
                <th class="u-table-cell">產地</th>
                <th class="u-table-cell">編輯</th>
                <th class="u-table-cell">刪除</th>
              </tr>
            </thead>
            <tbody class="u-table-body">
            <?php
                session_start();
                $t_name_ch = "";
                $d_begin = "";
                $d_end = "";
                $t_num = 0;
                if (isset($_POST["search"])) {
                  $t_name_ch = $_POST["t_name"];
                  $d_begin = $_POST["date_begin"];
                  $d_end = $_POST["date_end"];
                }
                
                require_once("dbconnect.inc");

                if (!($t_name_ch == "" && $d_begin == "" && $d_end == "")){
                  if($t_name_ch == ""){
                    $sql = " SELECT * FROM purchase WHERE tea_date BETWEEN '$d_begin' AND '$d_end' ";
                  }else{
                    $sql = " SELECT * FROM purchase WHERE tea_type LIKE '%$t_name_ch%' OR (tea_date BETWEEN '$d_begin' AND '$d_end') ";
                  }
                  $_SESSION["purchase_search"] = $sql;
                  $_SESSION["d_start"] = $d_begin;
                  $_SESSION["d_end"] = $d_end;
                  header("Location: purchase_result.php");
                }
               
                $sql = "SELECT * FROM purchase";
                $result = mysqli_query($link, $sql);

                $total_price = 0;

                while ($rows = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

                  echo "<tr style='height: 55px;'>";
                  echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$rows["purchase_id"]."</td>";
                  echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$rows["tea_type"]."</td>";
                  echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$rows["tea_num"]."</td>";
                  echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$rows["unit_price"]."</td>";
                  echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$rows["tea_num"] * $rows["unit_price"]."</td>";
                  echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$rows["tea_date"]."</td>";
                  echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>34251</td>";
                  echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$rows["location"]."</td>";
                  echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>";
                  echo "<a href='purchase_edit.php?id=\"".$rows['purchase_id']."\"' onclick=''><img src='https://cdn0.iconfinder.com/data/icons/glyphpack/45/edit-alt-512.png' height='40px'></img></a></td>";
                  echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>";
                  echo "<a href='purchase_delete.php?id=\"".$rows['purchase_id']."\"' onclick='return confirm(\"真的要刪除嗎?\");'><img src='https://upload.wikimedia.org/wikipedia/commons/thumb/0/0f/Icons8_flat_delete_generic.svg/846px-Icons8_flat_delete_generic.svg.png' height='60px'></img></a></td>";
                  echo "</tr>";
                  $total_price = $total_price + $rows["tea_num"] * $rows["unit_price"];
                }
                $m_num = mysqli_num_rows($result);
                echo "<tr style='height: 47px;' class='u-table-footer u-table-footer-1'>";
                echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'></td>";
                echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'></td>";
                echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'></td>";
                echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'></td>";
                echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'></td>";
                echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'></td>";
                echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>All Order:</td>";
                echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$m_num."</td>";
                echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>Your Total:</td>";
                echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$total_price."</td>";

                mysqli_free_result($result);
                // require_once("dbclose.inc");

              ?>
              <!-- <tr style="height: 55px;">
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">001</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">紅茶</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">10</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">$ 10.00</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">$ 100.00</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">2020-01-01</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">34251</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">台灣</td>
              </tr>
              <tr style="height: 55px;">
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">002</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">綠茶</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">10</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">$ 10.00</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">$ 100.00</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">2020-01-01</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">34251</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">台灣</td>
              </tr>
              <tr style="height: 55px;">
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">003</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">青茶</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">10</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">$ 10.00</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">$ 100.00</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">2020-02-01</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">34242</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">台灣</td>
              </tr>
              <tr style="height: 54px;">
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">004</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">古早味紅茶</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">10</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">$ 10.00</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">$ 100.00</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">2020-02-01</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">34242</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">台灣</td>
              </tr>
            </tbody>
            <tfoot class="u-table-footer u-table-footer-1">
              <tr style="height: 47px;">
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-border-no-top u-table-cell"></td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-border-no-top u-table-cell"></td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-border-no-top u-table-cell"></td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-border-no-top u-table-cell"></td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-border-no-top u-table-cell">All Items</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-border-no-top u-table-cell">4<br>
                </td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-border-no-top u-table-cell">Your Total:</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-border-no-top u-table-cell">$400.00</td>
              </tr>
            </tfoot> -->
          </table>
        </div>
      </div>
    </section>
    <section class="u-align-center u-clearfix u-section-2" id="sec-e399">
      <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <h2 class="u-text u-text-1">新增訂單</h2>
        <div class="u-form u-form-1">
          <form action="purchaseOrder.php" method="POST" class="u-clearfix u-form-spacing-10 u-form-vertical u-inner-form" style="padding: 10px" source="email" name="form">
            <input type="hidden" id="siteId" name="siteId" value="165608">
            <input type="hidden" id="pageId" name="pageId" value="165609">
            <!-- <div class="u-form-group u-form-group-5">
                <label for="text-a175" class="u-form-control-hidden u-label"></label>
                <input type="text" placeholder="訂單編號" id="text-a175" name="order_id" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white u-input-5">
            </div> -->
            <div class="u-form-group u-form-group-4">
                <label for="text-6448" class="u-form-control-hidden u-label"></label>
                <span>茶種</span>
                <select name="teaName" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white u-input-5" value="茶種">
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
            </div>
            <div class="u-form-group u-form-group-5">
                <label for="text-a175" class="u-form-control-hidden u-label"></label>
                <span>數量</span>
                <input type="number" placeholder="數量" id="text-a175" name="teaNum" min="1" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white u-input-5">
            </div>
            <!-- <div class="u-form-group u-form-group-5">
              <label for="text-a175" class="u-form-control-hidden u-label"></label>
              <input type="number" placeholder="總價格" id="text-a175" name="teaPrice" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white u-input-5">
            </div> -->
            <div class="u-form-group u-form-group-4">
              <label for="text-6448" class="u-form-control-hidden u-label"></label>
              <span>產地</span>
              <input type="text" placeholder="產地" id="text-6448" name="location" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white u-input-4">
            </div>
            <div class="u-form-group u-form-message">
              <label for="message-3b9a" class="u-form-control-hidden u-label">Message</label>
              <span>備註</span>
              <textarea placeholder="其他備註" rows="4" cols="50" id="message-3b9a" name="message" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white u-input-6"></textarea>
            </div>
            <div class="u-align-center u-form-group u-form-submit">
              <!-- <a href="#" class="u-btn u-btn-submit u-button-style">訂單送出<br>
              </a> -->
              <input type="submit" value="訂單送出" class="u-btn u-btn-submit u-button-style" name="send">
            </div>
            <div class="u-form-send-message u-form-send-success"> Thank you! Your message has been sent. </div>
            <div class="u-form-send-error u-form-send-message"> Unable to send your message. Please fix errors then try again. </div>
            <input type="hidden" value="" name="recaptchaResponse">
          </form>
          <?php
            $p_id = "";      
            $t_num = "";
            $t_name_ch = "";
            $location = "";
            
            if (isset($_POST["send"])) {
              $t_num = $_POST["teaNum"];
              $t_name_ch = $_POST["teaName"];
              $location = $_POST["location"];
              $p_id = $_POST["order_id"];

              require_once("dbconnect.inc");

              $sql = " SELECT * FROM purchase WHERE purchase_id = '$p_id' ";
              $result = mysqli_query($link, $sql);
              $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
              if(!empty($row["purchase_id"])){            
                echo ("Same order id !");
                // echo ("Error: ".mysqli_error($link));
                // exit();
              }else{
                $date = date('Y-m-d');
                $id_trigger_sql="
                CREATE TRIGGER tg_purchase_insert\n"
                . "BEFORE INSERT ON purchase\n"            
                . "FOR EACH ROW\n"            
                . "BEGIN\n"            
                . "INSERT INTO purchase_seq VALUES (NULL)SET NEW.purchase_id = CONCAT('P', LPAD(LAST_INSERT_ID(), 2, \'0\'))END;";

                $link->multi_query($id_trigger_sql);
                $insert_sql = "INSERT INTO purchase (tea_type, tea_num, unit_price, tea_date, location) 
                              VALUES ('$t_name_ch', '$t_num', '220', '$date', '$location');";
                // $_SESSION["member_add.php"] = $insert_sql;
                // mysqli_query($link, $insert_sql);
                if ($link->query($insert_sql) === TRUE) {
                  echo "New record created successfully";
                  echo "<meta http-equiv='refresh' content='0'>";
                } else {
                  echo "Error: " . $insert_sql . "<br>" . $link->error;
                }
                $tea_sql = "SELECT * FROM tea_inventory WHERE tea_type = '$t_name_ch' ";
                $tea_row = mysqli_fetch_array(mysqli_query($link, $tea_sql), MYSQLI_ASSOC);
                $tea_num = $tea_row["inventory_qty"];
                $tea_total = $tea_num + $t_num;
                $update_sql ="UPDATE tea_inventory SET inventory_qty = '$tea_total' WHERE tea_type = '$t_name_ch' ";
                mysqli_query($link, $update_sql);
              }
            }
            require_once("dbclose.inc");
          ?>
        </div>
      </div>
    </section>
</body>
<script>
    $('.date').datepicker({dateFormat: 'yy-mm-dd'});
</script>