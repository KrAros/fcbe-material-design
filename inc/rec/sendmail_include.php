<?php

##################################################################################
#    Implementazione Utility Recovery User Password - Per Invio Mail per evitare
#    Errori in assenza del SendMail() - Codice Base preso in giro per la rete
#    Copyright (C) 2011 by KaYMaN - Contact: mattiaciro@tiscali.it	
#
#    This program is free software; you can redistribute it and/or modify
#    it under the terms of the GNU General Public License as published by
#    the Free Software Foundation; either version 2 of the License, or
#    (at your option) any later version.
#
#    This program is distributed in the hope that it will be useful,
#    but WITHOUT ANY WARRANTY; without even the implied warranty of
#    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#    GNU General Public License for more details.
#
#    You should have received a copy of the GNU General Public License
#    along with this program; if not, write to the Free Software
#    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
##################################################################################

function sendemail($toname, $toemail, $fromname, $fromemail, $subject, $message, $type = "plain", $cc = "", $bcc = "") {

	global $settings, $locale;
	
	require_once "class.phpmailer.php";
	
	$mail = new PHPMailer();
	if (file_exists("phpmailer.lang-it.php")) {
		$mail->SetLanguage("it", "/");
	} else {
		$mail->SetLanguage("en", INCLUDES."language/");
	}

	//if (!$settings['smtp_host']) {
		$mail->IsMAIL();
	//}
	
	$mail->CharSet = $locale['charset'];
	$mail->From = $fromemail;
	$mail->FromName = $fromname;
	$mail->AddAddress($toemail, $toname);
	$mail->AddReplyTo($fromemail, $fromname);
	if ($cc) { 
		$cc = explode(", ", $cc);
		foreach ($cc as $ccaddress) {
			$mail->AddCC($ccaddress);
		}
	}
	if ($bcc) {
		$bcc = explode(", ", $bcc);
		foreach ($bcc as $bccaddress) {
			$mail->AddBCC($bccaddress);
		}
	}
	if ($type == "plain") {
		$mail->IsHTML(false);
	} else {
		$mail->IsHTML(true);
	}
	
	$mail->Subject = $subject;
	$mail->Body = $message;
	
	if(!$mail->Send()) {
		$mail->ErrorInfo;
		$mail->ClearAllRecipients();
		$mail->ClearReplyTos();
		return false;
	} else {
		$mail->ClearAllRecipients(); 
		$mail->ClearReplyTos();
		return true;
	}

}
?>
