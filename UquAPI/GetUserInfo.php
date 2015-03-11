<?php

function GetUserInfo($UQUID) {
    $url = 'https://uquapi.uqu.edu.sa/SSO/getInfo/getUserInfo';

    $data = array(
        "UserID" => $UQUID
    );
    $result = curl_send($data, $url, 'POST');
    print_r($result);
}

?>
<?

function curl_send($data, $url, $requestType) {
    global $API_KEY;
    $API_KEY = 'WKTG7GmEhkH*T!PmQDPlyzN!EJp&oS@56(#7Mx$z';
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $requestType); //-GET -POST -PUT -DELETE
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-API-KEY:' . $API_KEY));

    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
}


echo GetUserInfo(4330113) ; 

?>