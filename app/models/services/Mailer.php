<?php
/**
*
*/

namespace SECC\Models\Services;

use \PHPMailer as PHPMailer;

class Mailer
{
	public static $mailer;

	public static function initialize()
	{
		self::$mailer = new PHPMailer;

		if(Config::get('mail.smtp'))
			self::$mailer->isSMTP();

		self::$mailer->Host 		= Config::get('mail.host');
		self::$mailer->SMTPAuth 	= Config::get('mail.smtp');
		self::$mailer->Username 	= Config::get('mail.username');
		self::$mailer->Password 	= Config::get('mail.password');
		self::$mailer->SMTPSecure 	= Config::get('mail.secure');
		self::$mailer->Port 		= Config::get('mail.port');

		self::$mailer->isHTML(Config::get('mail.html'));
	}

	public static function send($data = [])
	{
		self::initialize();
		$data = (object)($data);

		if(isset($data->from))
			self::$mailer->setFrom($data->from['email'], $data->from['name']);

		if(isset($data->addresses))
		{
			for($i = 0; $i < count($data->addresses); $i++) 
			{ 
				self::$mailer->addAddress($data->addresses[$i]['email'], $data->addresses[$i]['name']);
			}
		}

		if(isset($data->replyTo))
		{
			for($i = 0; $i < count($data->replyTo); $i++) 
			{ 
				self::$mailer->addReplyTo($data->replyTo[$i]['email'], $data->replyTo[$i]['name']);
			}
		}

		if(isset($data->cc))
		{
			for($i = 0; $i < count($data->cc); $i++) 
			{ 
				self::$mailer->addCC($data->cc[$i]);
			}
		}

		if(isset($data->bcc))
		{
			for($i = 0; $i < count($data->bcc); $i++) 
			{ 
				self::$mailer->addBCC($data->bcc[$i]);
			}
		}

		if(isset($data->attachments))
		{
			for($i = 0; $i < count($data->attachments); $i++) 
			{ 
				self::$mailer->addAttachment($data->attachments[$i]);
			}
		}

		if(isset($data->subject))
		{
			self::$mailer->Subject = $data->subject;
		}

		if(isset($data->body))
		{
			self::$mailer->Body = $data->body;
		}

		if(isset($data->altBody))
		{
			self::$mailer->AltBody = $data->altBody;
		}

		if(self::$mailer->send())
			return true;
		else
			return false;
	}
}