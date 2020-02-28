<?php

class mailer {
    public static function sendEmailTo($from, $to, $replyTo, $subject, $message, $attach = []) {
		global $cfg;

		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->CharSet = "UTF-8";
		$mail->Host = $cfg->email->smtp;
		$mail->SMTPDebug = $cfg->email->debug;
		$mail->SMTPAuth = TRUE;
		$mail->Port = $cfg->email->port;
		$mail->SMTPSecure = $cfg->email->secure;
		$mail->Username = $cfg->email->username;
		$mail->Password = $cfg->email->password;
		$mail->SetFrom($from, $cfg->system->sitename);
		$mail->Subject = $subject;
		$mail->AddAddress($to, "User");
		$mail->AddReplyTo($replyTo);
		$mail->MsgHTML($message);


		if (count($attach) > 0) {
			foreach ($attach as $file) {
				$mail->addAttachment($file[0], $file[1]);
			}
		}

		if (!$mail->Send()) {
			return FALSE;
		} else {
			return TRUE;
		}
	}
}