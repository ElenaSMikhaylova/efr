<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

$mosConfig_live_site = JURI :: base();

//Email Parameters
$recipient = $params->get('email_recipient', '');
$fromName = @$params->get('from_name', 'Website');
$fromEmail = @$params->get('from_email', 'change@me.com');

// Text Parameters
$myEmailLabel = $params->get('email_label', 'Email:');
$mySubjectLabel = $params->get('subject_label', 'Subject:');
$myFirstNameLabel = $params->get('first_name_label', 'First Name:');
$myLastNameLabel = $params->get('last_name_label', 'Last Name:');
$myPhoneNumberLabel = $params->get('phone_number_label', 'Phone Number:');
$myMessageLabel = $params->get('message_label', 'Message:');
$buttonText = $params->get('button_text', 'Send Message');
$pageText = $params->get('page_text', 'Thank you for your contact.');
$errorText = $params->get('error_text', 'Your message could not be sent. Please try again.');
$noEmail = $params->get('no_email', 'Please write your email');
$invalidEmail = $params->get('invalid_email', 'Please write a valid email');
$wrongantispamanswer = $params->get('wrong_antispam', 'Wrong anti-spam answer');
$pre_text = $params->get('pre_text', '');

// Size and Color Parameters
$thanksTextColor = $params->get('thank_text_color', '#FF0000');
$error_text_color = $params->get('error_text_color', '#FF0000');
$emailWidth = $params->get('email_width', '15');
$subjectWidth = $params->get('subject_width', '15');
$firstNameWidth = $params->get('first_name_width', '15');
$lastNameWidth = $params->get('last_name_width', '15');
$phoneNumberWidth = $params->get('phone_number_width', '15');
$messageWidth = $params->get('message_width', '13');
$buttonWidth = $params->get('button_width', '100');
$label_pos = $params->get('label_pos', '0');
$addcss = $params->get('addcss', '');

// URL Parameters
$exact_url = $params->get('exact_url', true);
$disable_https = $params->get('disable_https', true);
$fixed_url = $params->get('fixed_url', true);
$myFixedURL = $params->get('fixed_url_address', '');

// Anti-spam Parameters
$enable_anti_spam = $params->get('enable_anti_spam', true);
$myAntiSpamQuestion = $params->get('anti_spam_q', 'How many eyes has a typical person?');
$myAntiSpamAnswer = $params->get('anti_spam_a', '2');
$anti_spam_position = $params->get('anti_spam_position', 0);

// Module Class Suffix Parameter
$mod_class_suffix = $params->get('moduleclass_sfx', '');


if ($fixed_url) {
  $url = $myFixedURL;
}
else {
  if (!$exact_url) {
    $url = JURI::current();
  }
  else {
    if (!$disable_https) {
      $url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
    }
    else {
      $url = "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
    }
  }
}

$url = htmlentities($url, ENT_COMPAT, "UTF-8");

$myError = '';
$CORRECT_ANTISPAM_ANSWER = '';
$CORRECT_EMAIL = '';
$CORRECT_SUBJECT = '';
$CORRECT_FIRST_NAME = '';
$CORRECT_LAST_NAME = '';
$CORRECT_PHONE_NUMBER = '';
$CORRECT_MESSAGE = '';

if (isset($_POST["hot_appointment_email"])) {
  $CORRECT_SUBJECT = htmlentities($_POST["rp_subject"], ENT_COMPAT, "UTF-8");
  $CORRECT_FIRST_NAME = htmlentities($_POST["rp_first_name"], ENT_COMPAT, "UTF-8");
  $CORRECT_LAST_NAME = htmlentities($_POST["rp_last_name"], ENT_COMPAT, "UTF-8");
  $CORRECT_PHONE_NUMBER = htmlentities($_POST["rp_phone_number"], ENT_COMPAT, "UTF-8");
  $CORRECT_MESSAGE = htmlentities($_POST["rp_message"], ENT_COMPAT, "UTF-8");
  // check anti-spam
  if ($enable_anti_spam) {
    if (strtolower($_POST["rp_anti_spam_answer"]) != strtolower($myAntiSpamAnswer)) {
      $myError = '<span style="color: ' . $error_text_color . ';">' . $wrongantispamanswer . '</span>';
    }
    else {
      $CORRECT_ANTISPAM_ANSWER = htmlentities($_POST["rp_anti_spam_answer"], ENT_COMPAT, "UTF-8");
    }
  }
  // check email
  if ($_POST["hot_appointment_email"] === "") {
    $myError = '<span style="color: ' . $error_text_color . ';">' . $noEmail . '</span>';
  }
  if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/", strtolower($_POST["hot_appointment_email"]))) {
    $myError = '<span style="color: ' . $error_text_color . ';">' . $invalidEmail . '</span>';
  }
  else {
    $CORRECT_EMAIL = htmlentities($_POST["hot_appointment_email"], ENT_COMPAT, "UTF-8");
  }

  if ($myError == '') {
    $mySubject = "Message from site";
    $myFirstName = $_POST["rp_first_name"];
    $myLastName = $_POST["rp_last_name"];
    $myPhoneNumber = $_POST["rp_phone_number"];
    $myMessage = 'You received a message from '. $_POST["rp_first_name"] . ' ' . $_POST["rp_last_name"] . "\n\n" . $_POST["rp_phone_number"] ."\n\n". $_POST["rp_message"] ."\n\nSelected date: ". $_POST["rp_date"];

    $mailSender = &JFactory::getMailer();
    $mailSender->addRecipient($recipient);

    $mailSender->setSender(array($fromEmail,$fromName));
    if(version_compare(JVERSION, '3.5', 'ge')) {
      $mailSender->addReplyTo($_POST["hot_appointment_email"], $fromName);
    }
    else {
      $mailSender->addReplyTo(array( $_POST["hot_appointment_email"], $fromName ));
    }

    $mailSender->setSubject($mySubject);
    $mailSender->setBody($myMessage);

    if ($mailSender->Send() !== true) {
      $myReplacement = '<span style="color: ' . $error_text_color . ';">' . $errorText . '</span>';
      print $myReplacement;
      return true;
    }
    else {
      $myReplacement = '<span style="color: '.$thanksTextColor.';">' . $pageText . '</span>';
      print $myReplacement;
      return true;
    }

  }
} // end if posted

// check recipient
if ($recipient === "") {
  $myReplacement = '<span style="color: ' . $error_text_color . ';">No recipient specified</span>';
  print $myReplacement;
  return true;
}

if($addcss) {
  print '<style type="text/css"><!--' . $addcss . '--></style>';
}
print '<div class="hot_appointment ' . $mod_class_suffix . '"><form action="' . $url . '" method="post">' . "\n";
if($pre_text) {
  print '<p class="hot_appointment intro_text ' . $mod_class_suffix . '">'.$pre_text.'</p>' . "\n";
}

if ($myError != '') {
  print $myError;
}

$separator = '';
$emptycell = '';
if ($label_pos == '1') {
  $separator = '<br/>';
  $emptycell = '';
}

// print anti-spam
if ($enable_anti_spam) {
  if ($anti_spam_position == 0) {
    print '<div style="text-align:center">' . $emptycell.'<input class="hot_appointment inputbox antispam ' . $mod_class_suffix . '" type="text" name="rp_anti_spam_answer" size="' . $emailWidth . '" value="'.$CORRECT_ANTISPAM_ANSWER.'" placeholder="'.$myAntiSpamQuestion.'"/></div>' . "\n";
  }
}
// print first name
print '<div class="span4">' . '<input class="hot_appointment inputbox ' . $mod_class_suffix . '" type="text" name="rp_first_name" size="' . $firstNameWidth . '" value="'.$CORRECT_FIRST_NAME.'" placeholder="'.$myFirstNameLabel.'"/>';
// print last name
print '<input class="hot_appointment inputbox ' . $mod_class_suffix . '" type="text" name="rp_last_name" size="' . $lastNameWidth . '" value="'.$CORRECT_LAST_NAME.'" placeholder="'.$myLastNameLabel.'"/></div>';
// print phone number
print '<div class="span4">' . '<input class="hot_appointment inputbox ' . $mod_class_suffix . '" type="text" name="rp_phone_number" size="' . $phoneNumberWidth . '" value="'.$CORRECT_PHONE_NUMBER.'" placeholder="'.$myPhoneNumberLabel.'"/>';
// print email input 
print '<input class="hot_appointment inputbox ' . $mod_class_suffix . '" type="text" name="hot_appointment_email" size="' . $emailWidth . '" value="'.$CORRECT_EMAIL.'" placeholder="'.$myEmailLabel.'"/></div>';
// print date input
print '<div class="span4">' . '<input class="hot_appointment inputbox datepicker ' . $mod_class_suffix . '" type="text" name="rp_date" placeholder="Select Date"/>';
// print message input 
print '<input class="hot_appointment button ' . $mod_class_suffix . '" type="submit" value="' . $buttonText . '" /></div><div class="clr"></div>';
//print anti-spam
if ($enable_anti_spam) {
  if ($anti_spam_position == 1) {
    print '<div style="text-align:center">' . $emptycell.'<input class="hot_appointment inputbox antispam ' . $mod_class_suffix . '" type="text" name="rp_anti_spam_answer" size="' . $emailWidth . '" value="'.$CORRECT_ANTISPAM_ANSWER.'" placeholder="'.$myAntiSpamQuestion.'" /></div>' . "\n";
  }
}
// print button
print '</form></div>' . "\n";
print '<script src="'.$mosConfig_live_site.'/modules/mod_hot_appointment/zebra_datepicker.js"></script>
<script type="text/javascript">
  jQuery(document).ready(function() {
      jQuery("input.datepicker").Zebra_DatePicker();
      jQuery(".Zebra_DatePicker").insertAfter(".hot_appointment.datepicker");
  });

</script>';
return true;
