<?php
function endsWith($haystack, $needle) {
  // search forward starting from end minus needle length characters
  return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
}

// 零歲男生
$index = 7;

echo '請您輸入您要計算的年紀起使值：';
$user_input_start = readline();
echo '請您輸入您要計算的年紀結束值：';
$user_input_end = readline();

while (!is_numeric($user_input_start)) {
  echo '麻煩請輸入數字.' . "\n";
  echo '請您輸入您要計算的年紀起使值：';
  $user_input_start = readline();
}

while (!is_numeric($user_input_end)) {
  echo '麻煩請輸入數字.' . "\n";
  echo '請您輸入您要計算的年紀結束值：';
  $user_input_end = readline();
}



$sum = 0;
$dir = '.';

if ($dh = opendir($dir)) {
  while (($file = readdir($dh)) !== false) {
    if (endsWith($file, 'csv') === true) {
      $csvFile = fopen($file, "r");;
      fgetcsv($csvFile);
      while(! feof($csvFile)) {
        $data_array = fgetcsv($csvFile);
        for($i = $user_input_start; $i <= $user_input_end; $i ++ ) {
          $sum += $data_array[$index + $i * 2] + $data_array[$index + $i * 2 + 1];
        }
      }

      fclose($csvFile);
    }
  }
  closedir($dh);
}

echo $user_input_start . ' 歲到 ' . $user_input_end . ' 歲的人數共有: ' . $sum . ' 人';