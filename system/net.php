<?php
function curl_request($url , $postData = array(), $return = true){/*??? ??? ???? ????? ??????? encode ??? ?? ???? ? ?? ?????? ??? ???? ?? ????*/
  $ch = curl_init();/*?? ????? curl ???? ????? ??????? ? ???? ?? ???? ? ?? ?????? ??? ???? ??????? ?? ??? ? ???? ?? ?? ??? ?? ???*/
  curl_setopt($ch, CURLOPT_URL, $url);/*???? url (???? ??????) ?? ?? ????? ch  ?? ???*/

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, $return);/*?? ??? ?? ?? ???? ????? ???? ??? ????? ?? ?? ?? ????? ???? ?????? ?? ??? ? ?? ??? ????? ?? ??? ? ??? ??? ???*/
  curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);/*??? ?? ???? post ???? ????????? ?? ?????? (wstester) ?? ??? ?? (webservice) ?? ????.*/
  $data = curl_exec($ch);/*????? ch ?? ???? url ??? ?? ???? ?? ??? ? ???? ?? ?? ???? ????? data  ?? ????*/
  curl_close($ch);/*?? ??? ?? ??? ????? curl ?? ?? ?????*/
  /*?? ???? ??? ??? ????? data ?? ???? ?? ?????????? ? ??? ?? ???*/
  if ($return){/*?? ???? true ???? ????? return ?? ???? ????? ??? ?? ????? ?? ?? ??? if  ??? ??? ?? ????? ?? ????*/
  return $data;
  }
}