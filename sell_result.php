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
    <h2 class="u-align-center u-clearfix u-valign-middle u-text u-text-1">銷貨訂單管理</h2>
    <form  class="searchTable" action="sellOrder.php" method="POST" name="query">
        <table>
            <tr>
                <td>
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
            <col width="12%">
              <col width="12.4%">
              <col width="5.4%">   
              <col width="5%">            
              <col width="9.7%">
              <col width="12%">
              <col width="12%">
              <col width="14%">
              <col width="12%">
              <col width="5%">
            </colgroup>
            <thead class="u-custom-font u-font-courier-new u-palette-4-base u-table-header u-table-header-1">
              <tr style="height: 59px;">
                <th class="u-table-cell">訂單編號<br>
                </th>
                <th class="u-table-cell">茶種名稱</th>
                <th class="u-table-cell">數量<br>
                </th>
                <th class="u-table-cell">單價<br></th>
                <th class="u-table-cell">總價</th>
                <th class="u-table-cell">會員編號</th>
                <th class="u-table-cell">會員名稱</th>
                <th class="u-table-cell">會員電話</th>
                <th class="u-table-cell">送貨地點</th>
                <th class="u-table-cell">訂單日期</th>
              </tr>
            </thead>
            <tbody class="u-table-body">
            <?php
                session_start();
                require_once("dbconnect.inc");
                
                if (isset($_SESSION["sell_search"]))
                    $sql = $_SESSION["sell_search"];
                    $d_begin = $_SESSION["d_start"];
                    $d_end = $_SESSION["d_end"];
                $result = mysqli_query($link,$sql);               
                
                if(!$result){
                    echo ("Error: ".mysqli_error($link));
                    exit();
                }else{
                    $total_price = 0;
                    while ($rows = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $m_id = $rows["m_ID"];
                        $m_name_sql = "SELECT* FROM member WHERE m_ID = '$m_id' ";
                        $name_result = mysqli_query($link, $m_name_sql);
                        $member_row = mysqli_fetch_array($name_result, MYSQLI_ASSOC);

                        echo "<tr style='height: 55px;'>";
                        echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$rows["order_ID"]."</td>";
                        echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$rows["tea_type"]."</td>";
                        echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$rows["tea_num"]."</td>";
                        echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$rows["unit_price"]."</td>";
                        echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$rows["tea_num"] * $rows["unit_price"]."</td>";
                        echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$rows["m_ID"]."</td>";
                        echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$member_row["m_name"]."</td>";
                        echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$member_row["m_tel"]."</td>";
                        echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$member_row["m_address"]."</td>";
                        echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$rows["tea_date"]."</td>";
                        echo "</tr>";
                        $total_price = $total_price + $rows["tea_num"] * $rows["unit_price"];
                    }
                    $t_num = mysqli_num_rows($result);
                    echo "<tr style='height: 47px;' class='u-table-footer u-table-footer-1'>";
                    echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'></td>";
                    echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'></td>";
                    echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'></td>";
                    echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'></td>";
                    echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'></td>";
                    echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'></td>";
                    echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>All tea</td>";
                    echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$t_num."</td>";
                    echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>Your Total</td>";
                    echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$total_price."</td>";
                    echo "</tr>";
                }

                mysqli_free_result($result);
                // require_once("dbclose.inc");

              ?>
          </table>
        </div>
      </div>
    </section>

    <section class="u-align-center u-clearfix u-section-1" id="report">
      <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <div class="u-expanded-width u-table u-table-responsive u-table-1">
        <table>
            <colgroup>
              <col width="45.7%">
              <col width="45.4%">              
            </colgroup>
            <tbody>
              <tr>
                  <td><h2 class="u-align-left">昌洲商行</h2></td>
                  <td class="u-align-right"><button id="print">列印報表</button></td>
              </tr>
              <tr>                  
                  <td class="u-align-left"><h2>銷貨日報表</h2></td>
                  <td class="u-align-right"></td>                
              </tr>
              <tr>
                  <td class="u-align-left"><?php echo "<p>開始日期:".$d_begin."  結束日期:".$d_end."</p>"?></td>
                  <td class="u-align-right" id="date"></td>  
                  <script>
                    var d = new Date();
                    var month = d.getMonth()+1;
                    var day = d.getDate();

                    var output = d.getFullYear() + '/' +
                        (month<10 ? '0' : '') + month + '/' +
                        (day<10 ? '0' : '') + day;
                    var dateHTML = "列印日期 : "+ output;
                    $('#date').html(dateHTML);
                  </script> 
              </tr>
            </tbody>            
          </table>          
          <table class="u-table-entity u-table-entity-1">
            <colgroup>
              <col width="12%">
              <col width="10.4%">
              <col width="8.4%">   
              <col width="9.5%">            
              <col width="9.7%">
              <col width="12%">
              <col width="10%">
              <col width="10%">
              <col width="10%">
            </colgroup>
            <thead class="u-custom-font u-font-courier-new u-palette-4-base u-table-header u-table-header-1">
              <tr style="height: 59px;">
                <th class="u-table-cell">銷貨日期<br></th>
                <th class="u-table-cell">訂單編號</th>
                <th class="u-table-cell">單別</th>
                <th class="u-table-cell">會員編號<br></th>
                <th class="u-table-cell">會員名稱<br></th>
                <th class="u-table-cell">茶種名稱</th>
                <th class="u-table-cell">數量</th>
                <th class="u-table-cell">單價</th>
                <th class="u-table-cell">銷售額</th>
              </tr>
            </thead>
            <tbody class="u-table-body">
            <?php
                
                if (isset($_SESSION["sell_search"]))
                    $sql = $_SESSION["sell_search"];
                $result = mysqli_query($link,$sql);               
                
                if(!$result){
                    echo ("Error: ".mysqli_error($link));
                    exit();
                }else{
                    $total_price = 0;
                    while ($rows = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $m_id = $rows["m_ID"];
                        $m_name_sql = "SELECT* FROM member WHERE m_ID = '$m_id' ";
                        $name_result = mysqli_query($link, $m_name_sql);
                        $member_row = mysqli_fetch_array($name_result, MYSQLI_ASSOC);

                        echo "<tr style='height: 55px;'>";
                        echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$rows["tea_date"]."</td>";
                        echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$rows["order_ID"]."</td>";
                        echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>銷貨</td>";
                        echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$member_row["m_ID"]."</td>";
                        echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$member_row["m_name"]."</td>";
                        echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$rows["tea_type"]."</td>";
                        echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$rows["tea_num"]."</td>";
                        echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$rows["unit_price"]."</td>";
                        echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$rows["tea_num"] * $rows["unit_price"]."</td>";
                        echo "</tr>";
                        $total_price = $total_price + $rows["tea_num"] * $rows["unit_price"];
                    }
                    $t_num = mysqli_num_rows($result);
                    echo "<tr style='height: 47px;' class='u-table-footer u-table-footer-1'>";
                    echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'></td>";
                    echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'></td>";
                    echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'></td>";
                    echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'></td>";
                    echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'></td>";
                    echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>All tea</td>";
                    echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$t_num."</td>";
                    echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>Your Total</td>";
                    echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$total_price."</td>";
                    echo "</tr>";
                }

                mysqli_free_result($result);
                require_once("dbclose.inc");

              ?>
          </table>
        </div>
      </div>
    </section>

    <section class="u-align-center u-clearfix u-section-2" id="sec-e399">
      <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <h2 class="u-text u-text-1">新增訂單</h2>
        <div class="u-form u-form-1">
          <form action="sellOrder.php" method="POST" class="u-clearfix u-form-spacing-10 u-form-vertical u-inner-form" style="padding: 10px" source="email" name="form">
            <input type="hidden" id="siteId" name="siteId" value="165608">
            <input type="hidden" id="pageId" name="pageId" value="165609">
            <!-- <div class="u-form-group u-form-group-5">
                <label for="text-a175" class="u-form-control-hidden u-label"></label>
                <input type="text" placeholder="訂單編號" id="text-a175" name="order_id" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white u-input-5">
            </div> -->
            <div class="u-form-group u-form-name">
              <label for="name-3b9a" class="u-form-control-hidden u-label"></label>
              <span>會員名稱</span>
              <!-- <input type="text" placeholder="輸入會員名稱" id="name-3b9a" name="m_name" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white u-input-1" required=""> -->
              <select id="name-3b9a" name="m_name" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white u-input-1" required="">
                <option>會員名稱</option>
                <?php
                  $member_sql = " SELECT * FROM member ";
                  $m_result = mysqli_query($link, $member_sql);
                  while ($m_rows = mysqli_fetch_array($m_result, MYSQLI_ASSOC)) {
                    echo "<option>".$m_rows["m_name"]."</option>";
                  }
                  
                ?>
              </select>
            </div>
            <!-- <div class="u-form-email u-form-group">
              <label for="email-3b9a" class="u-form-control-hidden u-label">Email</label>
              <input type="text" placeholder="輸入會員編號" id="email-3b9a" name="m_Num" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white u-input-2" required="">
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
              <input type="number" placeholder="數量" min="1" id="text-a175" name="teaNum" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white u-input-5">
            </div>
            <!-- <div class="u-form-group u-form-name">
              <label for="name-3b9a" class="u-form-control-hidden u-label"></label>
              <input type="text" placeholder="價格" id="name-3b9a" name="teaPrice" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white u-input-1" required="">
            </div> -->
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
        </div>
      </div>
    </section>
</body>
<script>
    $('.date').datepicker({dateFormat: 'yy-mm-dd'});
</script>
<!-- print -->
<script type="text/javascript" src="./js/html2canvas.js"></script>
<script type="text/javascript" src="./js/jsPdf.debug.js"></script>
<script type="text/javascript">

  var downPdf = document.getElementById("print");
  var source = document.getElementById("report");

  downPdf.onclick = function() {
      html2canvas(source, {background:'#fff',
          onrendered:function(canvas) {

              var contentWidth = canvas.width;
              var contentHeight = canvas.height;

              //一頁pdf顯示html頁面生成的canvas高度;
              var pageHeight = contentWidth / 592.28 * 841.89;
              //未生成pdf的html頁面高度
              var leftHeight = contentHeight;
              //頁面偏移
              var position = 0;
              //a4紙的尺寸[595.28,841.89]，html頁面生成的canvas在pdf中圖片的寬高
              var imgWidth = 595.28;
              var imgHeight = 592.28/contentWidth * contentHeight;
              var pageData = canvas.toDataURL('image/jpeg', 1.0);
              var pdf = new jsPDF('', 'pt', 'a4');
              //有兩個高度需要區分，一個是html頁面的實際高度，和生成pdf的頁面高度(841.89)
              //當內容未超過pdf一頁顯示的範圍，無需分頁
              if (leftHeight < pageHeight) {
                pdf.addImage(pageData, 'JPEG', 0, 0, imgWidth, imgHeight );
              } else {
                  while(leftHeight > 0) {
                    pdf.addImage(pageData, 'JPEG', 0, position, imgWidth, imgHeight)
                    leftHeight -= pageHeight;
                    position -= 841.89;
                    //避免新增空白頁
                    if(leftHeight > 0) {
                        pdf.addPage();
                      }
                  }
              }

              pdf.save('sell_report.pdf');
          }
      })
  }
</script>