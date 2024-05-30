<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <p>Dear <?php echo $name; ?>,</p>
    <p>Thank you for registering Storm Storage! We are excited to have you on our portal.</p>
    <p>Please click on below button to confirm the registration.</p>
    <a href="<?php echo $access_token_url;?>" class="btn dark">Active Account</a>
     
    <p>Here are the details of your registration:</p>
     
    <p>Name: <?php echo $name; ?></p>
    <p>Username/Email Address: <?php echo $email; ?></p>
    <p>Please keep this email for your records. If you have any questions or need to make any changes, feel free to contact us at <?php echo SMTP_FROM_EMAIL?> .</p>
     
    <p>Welcome aboard!</p>
     
    <p>Best,</p>
    <img src="https://storm-storage.com/assets/images/logo-lane-header_75px.png" alt="logo" class="logo-default">
    <img src="https://storm-storage.com/assets/images/lane-corporate-logo_55px.png" alt="logo" class="logo-default">
    <p>Storm storage</p>
    <p><?php echo SMTP_FROM_EMAIL?></p>
     
    <p>Statement Of Confidentiality: This electronic message transmission, and all attachments, contains information from Lane Enterprises Holdings, Inc which is confidential and privileged. The information is for the exclusive viewing or use of the intended recipient. If you are not the intended recipient, be aware that any disclosure, copying, distribution or use of the contents of this information is prohibited. If you have received this electronic transmission in error, please notify the sender immediately by a "reply to sender only" message and destroy all electronic and hard copies of the communication, including attachments.</p>
     
    <p>Lane Enterprises Holdings, Inc is an Equal Opportunity/Affirmative Action employer.</p>
</body>
</html>