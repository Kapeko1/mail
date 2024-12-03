<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Webklex\IMAP\Facades\Client;

class EmailController extends Controller
{
    public function sendTestEmail() {
        $details = [
            'subject' => 'Testowy e-mail',
            'body' => 'To jest testowy e-mail wysłany z Laravel.'
        ];

        Mail::raw($details['body'], function ($message) use ($details) {
            $message->to('odbiorca@example.com')
                ->subject($details['subject']);
        });

        return "E-mail został wysłany!";
    }
    public function fetchEmails() {
        $client = Client::make([
            'host' => 'mail.kgadek.pl',
            'port' => 993,
            'encryption' => 'ssl',
            'validate_cert' => true,
            'username' => 'user1@kgadek.pl',
            'password' => 'password1',
        ]);

        $client->connect();
        $inbox = $client->getFolder('INBOX');
        $messages = $inbox->messages()->all()->get();

        foreach ($messages as $message) {
            echo $message->getSubject() . '<br>';
        }

        $client->disconnect();
    }
}
