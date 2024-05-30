<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Request</title>
</head>
<body>
    <p>Hi Admin,</p>
    <p>A New Request has been Submitted from contact us page with the following information:</p>
    <p><b>Name:</b> <span><?php echo $Name; ?></span></p>
    <p><b>Email:</b> <span><?php echo $Email; ?></span></p>
    <p><b>Company Name:</b> <span><?php echo $CompanyName; ?></span></p>
    <p><b>Contact Number:</b> <span><?php echo $PhoneNumber; ?></span></p>
    <p><b>Message:</b> <span><?php echo $Message; ?></span></p>
</body>
</html>