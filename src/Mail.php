<?php

namespace com\iceithq;

class Mail
{
    var $api_url;

    var $attachments;
    var $to;

    function __construct($api_url = '')
    {
        $this->api_url = $api_url;
    }

    function attach($filePath)
    {
        // $this->attachments[] = new CURLFile($filePath, mime_content_type($filePath), basename($filePath)); //$file;
        $filePaths = $filePath;
        if (!is_array($filePath)) {
            $filePaths[] = $filePath;
        }
        foreach ($filePaths as $filePath) {
            $this->attachments[] = new CURLFile($filePath, mime_content_type($filePath), basename($filePath));
        }
        return $this;
    }

    function to($to)
    {
        $this->to = $to;
        return $this;
    }

    function send($subject, $body)
    {
        $apiKey = '';

        $payload = [
            'to' => $this->to,
            'subject' => $subject,
            'body' => $body,
        ];

        // Add attachments if any
        if (!empty($this->attachments)) {
            foreach ($this->attachments as $index => $file) {
                $payload["attachments[$index]"] = $file;
            }
        }

        $ch = curl_init($this->api_url . "/send");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer $apiKey",
            // "Content-Type: application/json"
        ]);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // print_pre(array($response, $httpCode));

        // if ($httpCode >= 200 && $httpCode < 300) {
        //     return true; // success
        // } else {
        //     error_log("FrostMail error ($httpCode): $response");
        //     return false;
        // }
        return $response;
    }
}
