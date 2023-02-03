<?php
namespace App\Libraries;

class Rest
{

    public function getRest($username, $password)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
        CURLOPT_URL => "https://restsimak.stimiksepnop.ac.id/api/users/login",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\n\t\"Username\":\"$username\",\n\t\"Password\":\"$password\"\n}",
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/json"
        ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return false;
        } else {
            return json_decode($response);
        }
    }
    
}