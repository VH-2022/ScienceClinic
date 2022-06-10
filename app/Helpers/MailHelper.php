<?php

namespace App\Helpers;

use Mail;
use PHPMailer\PHPMailer\Exception;

class MailHelper
{
	public static function mail_send($email_message, $semail, $subject)
	{
		$data = array('email' => $semail, 'subject' => $subject, 'msg' => $email_message);
		try {
			Mail::send([], [], function ($message) use ($data) {
				$message->to($data['email']);
				$message->subject($data['subject']);
				$message->html($data['msg'], 'text/html'); // for HTML rich messages
			});
			return  '1';
		} catch (Exception $e) {
			return $e;
		}
	}
}
