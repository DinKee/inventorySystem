<head>
    <meta charset="utf-8">
    <title>會員管理系統</title>

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
    <h2 class="u-align-center u-clearfix u-valign-middle u-text u-text-1">會員管理</h2>
    <form  class="searchTable" action="member.php" method="POST" name="query">
        <table>
            <tr>
                <td>
                    <!-- 查種類別=&nbsp
                    <select>
                        <option>紅茶</option>
                        <option>綠茶</option>
                        <option>青茶</option>
                    </select> -->
                    &nbsp&nbsp&nbsp&nbsp會員編號=&nbsp<input type="text" size="10" name="member_num">&nbsp&nbsp
                    &nbsp&nbsp&nbsp&nbsp會員名稱=&nbsp<input type="text" size="10" name="member_type">&nbsp&nbsp
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
              <col width="15%">
              <col width="15%">
              <col width="20%">
              <col width="20%">
              <col width="20%">
              <col width="5%">
              <col width="5%">
            </colgroup>
            <thead class="u-custom-font u-font-courier-new u-palette-4-base u-table-header u-table-header-1">
              <tr style="height: 59px;">
                <th class="u-table-cell">會員編號<br>
                </th>
                <th class="u-table-cell">會員名稱</th>
                <th class="u-table-cell">會員電話<br>
                </th>
                <th class="u-table-cell">會員地址<br>
                </th>
                <th class="u-table-cell">加入時間<br>
                </th>
                <th class="u-table-cell">編輯<br>
                </th>
                <th class="u-table-cell">刪除<br>
                </th>
              </tr>
            </thead>
            <tbody class="u-table-body">
              <?php
                session_start();  
                $m_name_num = "";
                $m_name_ch = "";
                $m_num = 0;
                if (isset($_POST["search"])) {
                   $m_name_ch = $_POST["member_type"];
                   $m_name_num = $_POST["member_num"];
                }
                
                require_once("dbconnect.inc");

                if (!($m_name_ch == "" && $m_name_num == "")){
                  if($m_name_ch == ""){
                    $sql = " SELECT * FROM member WHERE m_ID = '$m_name_num' ";
                  }else{
                    $sql = " SELECT * FROM member WHERE m_name LIKE '%$m_name_ch%' OR m_ID = '$m_name_num' ";
                  }
                  $_SESSION["member_search"] = $sql;
                  header("Location: member_result.php");
                }
               
                $sql = "SELECT * FROM member";
                $result = mysqli_query($link, $sql);

                while ($rows = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

                  echo "<tr style='height: 55px;'>";
                  echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$rows["m_ID"]."</td>";
                  echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$rows["m_name"]."</td>";
                  echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$rows["m_tel"]."</td>";
                  echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$rows["m_address"]."</td>";
                  echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$rows["join_date"]."</td>";
                  echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>";
                  echo "<a href='member_edit.php?id=\"".$rows['m_ID']."\"'><img src='https://cdn0.iconfinder.com/data/icons/glyphpack/45/edit-alt-512.png' height='40px'></img></a></td>";
                  echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>";
                  echo "<a href='member_delete.php?id=\"".$rows['m_ID']."\"' onclick='return confirm(\"真的要刪除嗎?\");'><img src='https://upload.wikimedia.org/wikipedia/commons/thumb/0/0f/Icons8_flat_delete_generic.svg/846px-Icons8_flat_delete_generic.svg.png' height='60px'></img></a></td>";
                  echo "</tr>";
                }
                $m_num = mysqli_num_rows($result);
                echo "<tr style='height: 47px;' class='u-table-footer u-table-footer-1'>";
                echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'></td>";
                echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'></td>";
                echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'></td>";
                echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>All member</td>";
                echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$m_num."</td>";
                echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'></td>";
                echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'></td>";

                mysqli_free_result($result);
                // require_once("dbclose.inc");

              ?>
              
              <!-- <tr style="height: 55px;">
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">001</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">王茶</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">0912345678</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">704台南市北區北安路一段5689號</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">2020-01-01</td>
              </tr>
              <tr style="height: 55px;">
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">002</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">陳茶</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">0912345678</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">台北市</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">2020-01-01</td>
              </tr>
              <tr style="height: 55px;">
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">003</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">吳茶</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">0912345678</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">台北市</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">2020-01-01</td>
              </tr>
              <tr style="height: 54px;">
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">004</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">林茶</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">0912345678</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">台北市</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">2020-01-01</td>
              </tr> -->
            </tbody>
            <!-- <tfoot class="u-table-footer u-table-footer-1">
              <tr style="height: 47px;">
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-border-no-top u-table-cell"></td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-border-no-top u-table-cell"></td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-border-no-top u-table-cell"></td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-border-no-top u-table-cell">All Members</td>
                <td class="u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-border-no-top u-table-cell">4</td>
              </tr>
            </tfoot> -->
          </table>
        </div>
      </div>
    </section>
    <section class="u-align-center u-clearfix u-section-2" id="sec-e399">
      <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <h2 class="u-text u-text-1">新增資料</h2>
        <div class="u-form u-form-1">
          <form action="member.php" method="POST" class="u-clearfix u-form-spacing-10 u-form-vertical u-inner-form" style="padding: 10px" source="email" name="form">
            <input type="hidden" id="siteId" name="siteId" value="165608">
            <input type="hidden" id="pageId" name="pageId" value="165609">
            <!-- <div class="u-form-group u-form-group-5">
                <label for="text-a175" class="u-form-control-hidden u-label"></label>
                <input type="number" placeholder="會員編號" id="text-a175" name="m_num" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white u-input-5">
            </div> -->
            <div class="u-form-group u-form-group-5">
              <span>會員姓名</span>
              <label for="text-a175" class="u-form-control-hidden u-label"></label>
              <input type="text" placeholder="會員姓名" id="text-a175" name="m_name" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white u-input-5">
            </div>
            <div class="u-form-group u-form-group-4">
              <span>會員電話</span>
              <label for="text-6448" class="u-form-control-hidden u-label"></label>
              <input type="number" placeholder="會員電話" id="text-6448" name="m_tel" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white u-input-4">
            </div>
            <div class="u-form-group u-form-group-5">
              <span>會員地址</span>
              <label for="text-a175" class="u-form-control-hidden u-label"></label>
              <input type="text" placeholder="會員地址" id="text-a175" name="m_address" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white u-input-5">
            </div>
            <div class="u-align-center u-form-group u-form-submit">
              <!-- <a href="#" class="u-btn u-btn-submit u-button-style">資料送出<br>
              </a> -->
              <input type="submit" value="資料送出" class="u-btn u-btn-submit u-button-style" name="send">
            </div>
            <div class="u-form-send-message u-form-send-success"> Thank you! Your message has been sent. </div>
            <div class="u-form-send-error u-form-send-message"> Unable to send your message. Please fix errors then try again. </div>
            <input type="hidden" value="" name="recaptchaResponse">
          </form>
          <?php            
            $m_num = "";
            $m_name_ch = "";
            $m_tel = "";
            $m_address = "";
            if (isset($_POST["send"])) {
              $m_num = $_POST["m_num"];
              $m_name_ch = $_POST["m_name"];
              $m_tel = $_POST["m_tel"];
              $m_address = $_POST["m_address"];

              require_once("dbconnect.inc");

              $sql = " SELECT * FROM member WHERE m_ID = '$m_num' ";
              $result = mysqli_query($link, $sql);
              if(!$result){              
                echo ("Same member id !");
                echo ("Error: ".mysqli_error($link));
                // exit();
              }else{
                $date = date('Y-m-d');
                $id_trigger_sql="
                CREATE TRIGGER tg_member_insert\n"
                . "BEFORE INSERT ON member\n"            
                . "FOR EACH ROW\n"            
                . "BEGIN\n"            
                . "INSERT INTO member_seq VALUES (NULL)SET NEW.m_id = CONCAT(LPAD(LAST_INSERT_ID(), 3, \'0\'))END;";

                $link->multi_query($id_trigger_sql);
                $insert_sql = "INSERT INTO member (m_account, m_password, m_name, m_tel, m_address, join_date) 
                VALUES ('', '', '$m_name_ch', '$m_tel', '$m_address', '$date')";
                // $_SESSION["member_add.php"] = $insert_sql;
                // mysqli_query($link, $insert_sql);
                if ($link->query($insert_sql) === TRUE) {
                  echo "New record created successfully";
                  echo "<meta http-equiv='refresh' content='0'>";
                } else {
                  echo "Error: " . $insert_sql . "<br>" . $link->error;
                }
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
