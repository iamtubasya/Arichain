<?php


function post($url, $header, $data){
      $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

function get($url, $header){
    $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
}


function ua(){


return $ua=array(

"user-agent: Dart/3.8 (dart:io)",
"content-type: application/x-www-form-urlencoded; charset=utf-8",
"accept: application/json",
"content-length: ",
"host: mobile.arichain.io",
);


}


function balance(){

$ua=ua();
$email="mohammadtubagus321@gmail.com";
$session="514a13bf";

$url="https://mobile.arichain.io/api/wallet/get_list_mobile";
  $data="blockchain=testnet&email=$email&lang=id&device=app&is_mobile=Y&session_code=".$session;

$post=json_decode(post($url,$ua,$data));
$blc1=$post->result[0]->balance;
$blc2=$post->result[1][0]->balance;

$balance="# Balance : $blc1\n # Balance : $blc2\n";

echo "\n $balance";
}



function checkin(){



$url="https://mobile.arichain.io/api/event/get_checkin";
$data="blockchain=testnet&address=ARW542Yjs6p26CJv1GzqE86qJyQimw74RBQJpinUjzCG6KNN9nxck&lang=id&device=app&is_mobile=Y&session_code=514a13bf";


$post=json_decode(post($url,ua(),$data));



$url="https://mobile.arichain.io/api/event/checkin";
 $data="blockchain=testnet&address=ARW542Yjs6p26CJv1GzqE86qJyQimw74RBQJpinUjzCG6KNN9nxck&lang=id&device=app&is_mobile=Y&session_code=514a13bf";

$post=json_decode(post($url,ua(),$data));




$sts=$post->status;


if ($sts=="success"){

echo "\n # Daily Checkin Successfully!\n";

}else{

echo "\n # Failed chechkin!!!\n";

  }

}

function mission(){


$url="https://mobile.arichain.io/api/event/get_app_event_all";
  $data="blockchain=testnet&lang=id&device=app&is_mobile=Y&session_code=514a13bf";

$post=json_decode(post($url,ua(),$data));

$eid=$post->result->daily->result[1]->id;


$url="https://mobile.arichain.io/api/event/set_app_event";
$data="blockchain=testnet&email=mohammadtubagus321%40gmail.com&address=ARW542Yjs6p26CJv1GzqE86qJyQimw74RBQJpinUjzCG6KNN9nxck&event_id=$eid&lang=id&device=app&is_mobile=Y&session_code=514a13bf";

$post=json_decode(post($url,ua(),$data));


$sts=$post->status;


if ($sts=="success"){

echo "\n # Daily missions Claimed!\n";

}else{

echo "\n # Failed claimed missions!!!\n";

  }
}


echo "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
balance().checkin().mission().balance();
echo "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
