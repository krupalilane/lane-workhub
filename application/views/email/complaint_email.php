<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <p>Hello,</p>
    <?php if (isset($RootCause)) { ?>
        <p>A response has been added against a complaint filed by <?php echo $SubmittedByUser; ?> with below details:</p>
    <?php } else{ ?>
        <p>You have received a complaint from <?php echo $SubmittedByUser; ?> with below details:</p>
    <?php } ?>
    <p><b>Associated Logging Number: </b><span><?php echo $AssociatedLoggingNumber; ?></span></p>
    <p><b>Date of Submit: </b><span><?php echo $DateOfSubmittal; ?></span></p>
    <p><b>Date Of Issue: </b><span><?php echo $DateOfIssue; ?></span></p>
    <p><b>Complaint Category: </b><span><?php echo $ComplaintCategory; ?></span></p>
    <p><b>Severity Level: </b><span><?php echo $SeverityLevel; ?></span></p>
    <p><b>Shipping Site Or Customer Location: </b><span><?php echo $ShippingSiteOrCustomerLocation; ?></span></p>
    <p>Complaint URL : <?php echo site_url('Plastic_pipe_quality_issue_submittal_form'). '?complaint_id=' . $complaint_id; ?></p>
    <p>Regards,</p>
    <p>Plastic Pipe Quality Issue Submittal Form</p>
    <img style="width: 70px; height: 70px;" src="https://uat-stormstorage.lane-enterprises.com/assets/images/quality-issue-form-site-logo.png" alt="logo" class="logo-default">
    <img src="https://uat-stormstorage.lane-enterprises.com/assets/images/lane-corporate-logo_55px.png" alt="logo" class="logo-default">
     
    <p style="font-size: 10px; color: #807f83; font-style: italic;">Statement Of Confidentiality: This electronic message transmission, and all attachments, contains information from Lane Enterprises Holdings, Inc which is confidential and privileged. The information is for the exclusive viewing or use of the intended recipient. If you are not the intended recipient, be aware that any disclosure, copying, distribution or use of the contents of this information is prohibited. If you have received this electronic transmission in error, please notify the sender immediately by a "reply to sender only" message and destroy all electronic and hard copies of the communication, including attachments.</p>
     
    <p style="font-size: 10px; color: #807f83; font-style: italic;">Lane Enterprises Holdings, Inc is an Equal Opportunity/Affirmative Action employer.</p>
</body>
</html>