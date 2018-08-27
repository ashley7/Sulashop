<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Communication extends Model
{
    public function send_Email($to,$subject,$sms,$from)
    {     
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
          // Create email headers
        $headers .= 'From: '.$from."\r\n".

              'Reply-To: '.$from."\r\n" .

              'X-Mailer: PHP/' . phpversion();
        $message = '<html><body>';
        $message .= '<p style="color:#080;">'.$sms.'</p>';             
        $message .= '<p style="color:#000;">SulaShop</p>';             
        $message .= '</body></html>';           
        // Sending email
        try {
           mail($to, $subject, $message, $headers);         
         } catch (\Exception $e) {}
    }
}
