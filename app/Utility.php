<?php

/*

 * To change this license header, choose License Headers in Project Properties.

 * To change this template file, choose Tools | Templates

 * and open the template in the editor.

 */

namespace App;

use SendGrid;
use Razorpay\Api\Api;

//use App\SendGrid;
//use App\Email;

/**

 * Description of Utility



 * @author admin

 */
class Utility {

   
    //put your code here

    function SendEmail($toEmail, $sub, $body) {

        require __DIR__ . '/../vendor/autoload.php';

        $senderid = "team.sprigstack@gmail.com";

//        $senderid = "administrator@myboxscore.us";
//        $senderid = $sid;

        $receiverid = $toEmail;

        $subject = $sub;

        $message = $body;



        $sg_username = "SprigStack";

        $sg_password = "cartershah1";



//        $sg_username = "bill@boxscoreinc.com";
//        $sg_password = "B0x88888$";



        $sendgrid = new SendGrid($sg_username, $sg_password);



        $mail = new \SendGrid\Email();



        $emails = array(
            $receiverid
        );

        foreach ($emails as $recipient) {

            $mail->addTo($recipient);
        }

        $categories = array(
            "SendGrid Category"
        );

        foreach ($categories as $category) {

            $mail->addCategory($category);
        }

        $unique_args = array(
            "Name" => ""
        );

        foreach ($unique_args as $key => $value) {

            $mail->addUniqueArgument($key, $value);
        }

        try {

            $mail->
                    setFrom($senderid)->
                    setSubject($subject)->
                    setHtml($message);

            if ($sendgrid->send($mail)) {

                //echo "<script type='text/javascript'>alert('Sent mail successfully.')</script>";

                return 1;
            }
        } catch (Exception $e) {

            echo "Unable to send mail: ", $e->getMessage();

            return 0;
        }

        return 1;
    }

    static function sendEmail_New($toEmail, $sub, $body) {

        require_once 'lib/sendgrid-php/sendgrid-php.php';

        $Fromsenderid = "hello@gocoworq.com";
//        $Fromsenderid = "team.sprigstack@gmail.com";

        $receiverid = $toEmail;

        $subject = $sub;

        $message = $body;



        $email = new \SendGrid\Mail\Mail();

        $email->setFrom($Fromsenderid); // from email ID

        $email->setSubject($subject);

        $email->addTo($receiverid); // to email ID

        $email->addBcc('team.gocoworq@gmail.com');

        $email->addContent(
                "text/html", $message
        );

        
        // $sendgrid = new \SendGrid("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");
        $sendgrid = new \SendGrid(env('SENDGRID_KEY'));

        try {

            $response = $sendgrid->send($email);

            return 1;
        } catch (Exception $e) {

            echo 'Unable to send mail: ' . $e->getMessage() . "\n";

            return 0;
        }

        return 1;
    }

    static function sendEmail_to_leads($fromName,$toEmail, $sub, $body) {

        require_once 'lib/sendgrid-php/sendgrid-php.php';

         $Fromsenderid = 'team.gocoworq@gmail.com';
//        $Fromsenderid = "team.sprigstack@gmail.com";

        $receiverid = $toEmail;

        $subject = $sub;

        $message = $body;



        $email = new \SendGrid\Mail\Mail();

        $email->setFrom($Fromsenderid ,$fromName ); // from email ID

        $email->setSubject($subject);

        $email->addTo($receiverid); // to email ID

        $email->addBcc('team.gocoworq@gmail.com');

        $email->addContent(
                "text/html", $message
        );

        
        // $sendgrid = new \SendGrid("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");
        $sendgrid = new \SendGrid(env('SENDGRID_KEY'));

        try {

            $response = $sendgrid->send($email);

            return 1;
        } catch (Exception $e) {

            echo 'Unable to send mail: ' . $e->getMessage() . "\n";

            return 0;
        }

        return 1;
    }

    function GetCityIdByName($cityName) {

        //check server environment

        $checkServerEnv = env('SERVER_ENV');

        $isLocal = true;

        //if local then local city's id
        //if live then live city's id



        $cityId = 0;

        switch ($cityName) {

            case 'New York':

                if ($isLocal && $checkServerEnv == "local")
                    $cityId = 2;
                else
                    $cityId = 1;

                break;

            case 'Mumbai':

                if ($isLocal && $checkServerEnv == "local")
                    $cityId = 12;
                else
                    $cityId = 6;

                break;

            case 'Los Angeles':

                if ($isLocal && $checkServerEnv == "local")
                    $cityId = 9;
                else
                    $cityId = 2;

                break;

            case 'Bengaluru':

                if ($isLocal && $checkServerEnv == "local")
                    $cityId = 7;
                else
                    $cityId = 5;

                break;

            case 'Chicago':

                if ($isLocal && $checkServerEnv == "local")
                    $cityId = 10;
                else
                    $cityId = 3;

                break;

            case 'New Delhi':

                if ($isLocal && $checkServerEnv == "local")
                    $cityId = 13;
                else
                    $cityId = 9;

                break;

            case 'Kolkata':

                if ($isLocal && $checkServerEnv == "local")
                    $cityId = 3;
                else
                    $cityId = 8;

                break;

            case 'Chennai':

                if ($isLocal && $checkServerEnv == "local")
                    $cityId = 14;
                else
                    $cityId = 7;

                break;

            case 'Ahmedabad':

                if ($isLocal && $checkServerEnv == "local")
                    $cityId = 1;
                else
                    $cityId = 10;

                break;

            case 'Pune':

                if ($isLocal && $checkServerEnv == "local")
                    $cityId = 5;
                else
                    $cityId = 12;

                break;

            case 'Hyderabad':

                if ($isLocal && $checkServerEnv == "local")
                    $cityId = 17;
                else
                    $cityId = 11;

                break;

            case 'Noida':

                if ($isLocal && $checkServerEnv == "local")
                    $cityId = 16;
                else
                    $cityId = 17;

                break;

            case 'Gandhinagar':

                if ($isLocal && $checkServerEnv == "local")
                    $cityId = 4;
                else
                    $cityId = 15;

                break;
        }



        return $cityId;
    }

    static function encrypt_str($value) {
        // Store the cipher method
        $ciphering = "AES-128-CTR";

        // Use OpenSSl Encryption method
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;

        // Non-NULL Initialization Vector for encryption
        $encryption_iv = '9824881618654321';

        // Store the encryption key
        $encryption_key = "Spr!gSt@ck99";

        // Use openssl_encrypt() function to encrypt the data
        $encryption = openssl_encrypt($value, $ciphering, $encryption_key, $options, $encryption_iv);
        return $encryption;
    }

    static function decrypt_str($value) {
        // Store the cipher method
        $ciphering = "AES-128-CTR";
        // Use OpenSSl Encryption method
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;
        
        // Non-NULL Initialization Vector for decryption
        $decryption_iv = '9824881618654321';

        // Store the decryption key
        $decryption_key = "Spr!gSt@ck99";

        // Use openssl_decrypt() function to decrypt the data
        $decryption = openssl_decrypt($value, $ciphering, $decryption_key, $options, $decryption_iv);
        return $decryption;
    }

    

}
