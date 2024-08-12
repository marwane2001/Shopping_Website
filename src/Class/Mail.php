<?php
namespace App\Class;

use Mailjet\Client;
use Mailjet\Resources;

class Mail
{
    public function send($to_email, $to_name, $subject, $content)
    {
        $mj = new Client($_ENV['MJ_APIKEY_PUBLIC'], $_ENV['MJ_APIKEY_PRIVATE'], true, ['version' => 'v3.1']);
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "marwane.skaro@e-polytechnique.ma",
                        'Name' => "Softup"
                    ],
                    'To' => [
                        [
                            'Email' => $to_email,
                            'Name' => $to_name
                        ]
                    ],
                    'Subject' => $subject,
                    'TextPart' => "Greetings!",
                    'HTMLPart' => $content
                ]
            ]
        ];
        $mj->post(Resources::$Email, ['body' => $body]);
    }
}