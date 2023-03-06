<?php
// データ取得
$monthNext = filter_input(INPUT_GET, 'monthNext'); // 次月
$yearNext = filter_input(INPUT_GET, 'yearNext'); // 翌年
$monthPrev = filter_input(INPUT_GET, 'monthPrev'); // 前月
$yearPrev = filter_input(INPUT_GET, 'yearPrev'); // 前年

// GETにデータがない場合は当日を取得
$_GET['year'] = $_GET['year'] ?? date('Y');
$_GET['month'] = $_GET['month'] ?? date('n');
$_GET['day'] = $_GET['day'] ?? date('j');

// 選択した日付を表示、未選択の場合は当月の日付を表示（HTMLの表示で使用）
if(isset($_GET['day'])) {
  //選択日の曜日を取得
  $timestamp = mktime(0, 0, 0, $_GET['month'], $_GET['day'], $_GET['year']);
  $youbi = date('w', $timestamp);
  $week = ['日', '月', '火', '水', '木', '金', '土'];

  // 選択した日付を取得
  $pickdays = $_GET['month']."月".$_GET['day']."日"."（".$week[$youbi]."）";
}

// 次のボタンを押した時、12月を超えた場合は月を1月にし、年に1を足す
if($monthNext > 12) {
  $monthNext = 1;
  $yearNext++; 
}

// 前のボタンを押した時、月が0になった場合は月を12月にし、年から1を引く
if($monthPrev === "0") {
  $monthPrev = 12;
  $yearPrev--;
}

// $Next→$Prev→$GET→現在
$year = $yearNext ?? $yearPrev ?? $_GET['year'] ?? date('Y'); // 西暦4桁
$month = $monthNext ?? $monthPrev ?? $_GET['month'] ?? date('n'); // 0なし月

// 月末日を取得、$calendarの配列作成
$last_day = date('j', mktime(0, 0, 0, $month + 1, 0, $year));
$calendar = array();
$j = 0;

// 月末日までループして、日付を$calendarの配列に挿入する
// mktime( 時, 分, 秒, 月, 日, 年 )
for ($i = 1; $i < $last_day + 1; $i++) {
  $week = date('w', mktime(0, 0, 0, $month, $i, $year)); // 曜日を取得
  if($i == 1) {
    for($s = 1; $s <= $week; $s++) { // 1日目の曜日までをループ
      $calendar[$j]['day'] = ''; // 前半に空文字をセット
      $j++;
    }
  }
  // 配列に日付をセット
  $calendar[$j]['day'] = $i;
  $j++;

  // 月末日の場合
  if($i == $last_day) {
    for($e = 1; $e <= 6 - $week; $e++) { // 月末日から残りをループ
      $calendar[$j]['day'] = ''; // 後半に空文字をセット
      $j++;
    }
  }
}

// 機能分け
if(session('nouser')) {
  echo "<script type='text/javascript'>alert('ログインしてご利用ください。');</script>";
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/main.css">
  <title>カレンダー</title>
</head>
<body class="main" id="main">

  <div class="background" id="background">
    <section class="main_calendar">
      <div class="left">
        <div class="pick_container">
          <div class="pick_days">
            <h2><?= $year; ?>年</h2>
            <h1><?= $month; ?><span class="h1_month">月</span></h1>
            <div class="month_btns">
              <form action="" method="GET">
                <th>
                  <button type="submit" id="prev" class="month_btn m_prev">
                    ←
                    <input type="hidden" name="monthPrev" value="<?= $month-1;?>">
                    <input type="hidden" name="yearPrev" value="<?= $year;?>">
                  </button>
                </th>
              </form>
              <form action="" method="GET">
                <th>
                  <button type="submit" id="next" class="month_btn m_next">
                    →
                    <input type="hidden" name="monthNext" value="<?= $month+1;?>">
                    <input type="hidden" name="yearNext" value="<?= $year;?>">
                  </button>
                </th>
              </form>
            </div>
          </div>
        </div>
        <div class="deadlines">
          <div class="pickdays">
            <p><?= $pickdays; ?></p>
          </div>
          <div class="deadline" id="deadline">
            <?php foreach($deadlines as $deadline): ?>
              <p>
                <?php if(isset($deadline['time'])) { echo $deadline['time']; } else { echo '•• : ••'; } ?>
                <?php echo htmlspecialchars($deadline['schedule'], ENT_QUOTES, 'UTF-8'); ?>
              </p>
            <?php endforeach; ?>
          </div>
        </div>
        <table class="calendar">
          <thead>
            <tr class="week">
              <th>SUN</th>
              <th>MoN</th>
              <th>TUE</th>
              <th>WeD</th>
              <th>THu</th>
              <th>FRi</th>
              <th>SAT</th>
            </tr>
          </thead>
          <tbody>
          <form action="" method="GET">
              <tr>
                <?php $cnt = 0; ?>
                <?php foreach ($calendar as $key => $value): ?>
                <td>
                  <p>
                  <?php $cnt++; ?>
                  <?php if ($year == date('Y') && $month == date('n') && $value['day'] == date('j')): ?>
                    <input type="submit" name="day" class="today" value="<?= $value['day']; ?>">
                  <?php elseif ($value['day'] == ''): ?>
                    <input type="hidden">
                  <?php else: ?>
                    <input type="submit" name="day" class="otherday" value="<?= $value['day']; ?>">
                  <?php endif; ?>
                  </p>
                </td>
                <?php if($cnt == 7): ?>
              </tr>
              <tr>
                <?php $cnt = 0; ?>
                <?php endif; ?>
                <?php endforeach; ?>
                <input type="hidden" name="month" value="<?= $month;?>">
                <input type="hidden" name="year" value="<?= $year;?>">
              </tr>
            </form>
          </tbody>
        </table>
        <div class="month_back_btn">
          <a href="calendar"><<</a>
        </div>
      </div>
      <div class="right">
        <div class="hamburger_menu"></div>
          <button class="hamburger" id="ham_btn">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
          </button>
          <div class="menu" id="menu">
            <ul class="all_list">
              <li class="list_title">予定登録</li>
              <li>
                <ul>
                  <li>
                    <img src="/img/main_img/sun.png" width="30" height="25" class="sun_icon"><a class="menu_link" href="/am_sche_regi">00:00〜11:59</a>
                  </li>
                  <li>
                    <img src="/img/main_img/moon.png" width="25" height="25" class="moon_icon"><a class="menu_link" href="/pm_sche_regi">12:00〜23:59</a>
                  </li>
                </ul>
              </li>
              <li class="list_title">予定変更</li>
              <li>
                <ul>
                  <li>
                    <img src="/img/main_img/sun.png" width="30" height="25" class="sun_icon"><a class="menu_link" href="/am_edit_choice">00:00〜11:59</a>
                  </li>
                  <li>
                    <img src="/img/main_img/moon.png" width="25" height="25" class="moon_icon"><a class="menu_link" href="/pm_edit_choice">12:00〜23:59</a>
                  </li>
                </ul>
              </li>
              <li class="list_title">予定削除</li>
              <li>
                <ul>
                  <li>
                    <img src="/img/main_img/sun.png" width="30" height="25" class="sun_icon"><a class="menu_link" href="/am_delete_choice">00:00〜11:59</a>
                  </li>
                  <li>
                    <img src="/img/main_img/moon.png" width="25" height="25" class="moon_icon"><a class="menu_link" href="/pm_delete_choice">12:00〜23:59</a>
                  </li>
                </ul>
              </li>
              </li>
              <li class="list_title">期限設定</li>
              <li>
                <ul>
                  <li>
                    <img src="/img/main_img/pen.png" width="20" height="20" class="dead_icon"><a class="menu_link" href="/dead_regi">期限登録</a>
                  </li>
                  <li>
                    <img src="/img/main_img/eraser.png" width="24" height="22" class="dead_icon eraser"><a class="menu_link" href="/dead_edit_choice">期限編集</a>
                  </li>
                  <li>
                    <img src="/img/main_img/dustbox.png" width="20" height="20" class="dead_icon"><a class="menu_link" href="/dead_delete_choice">期限削除</a>
                  </li>
                </ul>
              </li>
              </li>
              <li class="list_title"><a href="/logout">ログアウト</a></li>
            </ul>
          </div>

        <div class="schedules">
          <div class="am_title">
            <p class="p_am_time">
              <img src="/img/main_img/sun.png" width="60" height="45">
              <span class="am_span_times">00:00〜11:59</span>
            </p>
            <?php foreach($am_schedules as $am_schedule): ?>
              <p class="ams">
                <?php if(isset($am_schedule['time'])) { echo $am_schedule['time']; } else { echo '•• : ••'; } ?>
                <?php echo htmlspecialchars($am_schedule['schedule'], ENT_QUOTES, 'UTF-8'); ?>
              </p>
            <?php endforeach; ?>
          </div>
          <div class="pm_title">
            <p class="p_pm_times">
              <img src="/img/main_img/moon.png" width="45" height="45">
              <span class="pm_span_times">12:00〜23:59</span>
            </p>
            <?php foreach($pm_schedules as $pm_schedule): ?>
              <p class="ams">
                <?php if(isset($pm_schedule['time'])) { echo $pm_schedule['time']; } else { echo '•• : ••'; } ?>
                <?php echo htmlspecialchars($pm_schedule['schedule'], ENT_QUOTES, 'UTF-8'); ?>
              </p>
            <?php endforeach; ?>
            </p>
          </div>
        </div>
      </div>
    </section>
  </div>
  <script src=/js/main.js></script>

  <footer>@Personal Schedule</footer>
</body>
</html>
