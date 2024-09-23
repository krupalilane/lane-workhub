<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <p>Hello,</p>
    <p><b>Complaint details:</b></p>
    <table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse; width: 100%;">
        <thead>
            <tr>
                <th style="border: 1px solid #000;">Complaint Id</th>
                <th style="border: 1px solid #000;">Date Of Submit</th>
                <th style="border: 1px solid #000;">Associated logging number</th>
                <th style="border: 1px solid #000;">Severity Level</th>
                <th style="border: 1px solid #000;">Complaint Category</th>
                <th style="border: 1px solid #000;">Date of issue/occurrence</th>
                <th style="border: 1px solid #000;">Submitted By</th>
                <th style="border: 1px solid #000;">Location Submitted For</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($complain_data as $key => $complain) { ?>
                <tr>
                    <td style="border: 1px solid #000;"><?php echo $complain['Complaint Id']; ?></td>
                    <td style="border: 1px solid #000;"><?php echo $complain['Date Of Submit']; ?></td>
                    <td style="border: 1px solid #000;"><?php echo $complain['Associated logging number']; ?></td>
                    <td style="border: 1px solid #000;"><?php echo $complain['Severity Level']; ?></td>
                    <td style="border: 1px solid #000;"><?php echo $complain['Complaint Category']; ?></td>
                    <td style="border: 1px solid #000;"><?php echo $complain['Date of issue/occurrence']; ?></td>
                    <td style="border: 1px solid #000;"><?php echo $complain['Submitted By']; ?></td>
                    <td style="border: 1px solid #000;"><?php echo $complain['Location Submitted For']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <p>Regards,</p>
    <p>Plastic Pipe Quality Issue Submittal Form</p>
    <img style="width: 70px; height: 70px;" src="https://uat-stormstorage.lane-enterprises.com/assets/images/quality-issue-form-site-logo.png" alt="logo" class="logo-default">
    <img src="https://uat-stormstorage.lane-enterprises.com/assets/images/lane-corporate-logo_55px.png" alt="logo" class="logo-default">
     
    <p style="font-size: 10px; color: #807f83; font-style: italic;">Statement Of Confidentiality: This electronic message transmission, and all attachments, contains information from Lane Enterprises Holdings, Inc which is confidential and privileged. The information is for the exclusive viewing or use of the intended recipient. If you are not the intended recipient, be aware that any disclosure, copying, distribution or use of the contents of this information is prohibited. If you have received this electronic transmission in error, please notify the sender immediately by a "reply to sender only" message and destroy all electronic and hard copies of the communication, including attachments.</p>
     
    <p style="font-size: 10px; color: #807f83; font-style: italic;">Lane Enterprises Holdings, Inc is an Equal Opportunity/Affirmative Action employer.</p>
</body>
</html>