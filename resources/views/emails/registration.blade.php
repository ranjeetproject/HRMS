<!DOCTYPE html>
<html>
<head>
    <title>EMAIL FOR REGISTRATION</title>

</head>
<body>
<table height="100%" cellspacing="0" cellpadding="0" width="100%" border="0" bgcolor="#ffffff">
    <tbody>
    <tr>
        <td valign="top" align="center" height="100%" width="100%">
            <table width="100%" border="0" cellspacing="0" cellpadding="0"
                   style="max-width:620px; border-left: 1px solid #dddddd; border-right: 1px solid #dddddd; border-top: 1px solid #dddddd;">
                <tbody>
                <tr>
                    <td><a href="#" target="_blank"
                           style="display:inline-block; width:100%; text-align: center;float:left;"><img
                                src="{{asset('images/emailTemplateLogo.png')}}" width="500px" alt="" style="float: left"/></a></td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td valign="top" align="center" height="100%" width="100%">
            <table cellpadding="0" cellspacing="0" bgcolor="#f5f5f5" border="0" width="100%"
                   style="max-width:620px; border-left: 1px solid #dddddd; border-right: 1px solid #dddddd; border-bottom: 1px solid #dddddd;">
                <tbody>
                <tr>
                    <td align="left" style="padding:20px 20px 40px 20px;font-size:16px;line-height:22px"> <span
                            style="font-family:'Open Sans',sans-serif;font-size:16px;line-height:22px;color:#063a7b;font-weight:400">
                            <span
                                style="font-family:Arial,sans-serif;font-size:17px;line-height:24px; font-weight: bold;">
                                Welcome <br><hr><br>
                            </span>
                            <span
                                style="font-family:Arial,sans-serif;font-size:17px;line-height:24px; font-weight: bold;">
                                Dear {{$row->name}}<br><br>
                            </span>
                            <span
                                style="color:#000000;font-style:normal;font-variant-caps:normal;font-weight:normal;letter-spacing:normal;
                                text-align:-webkit-left;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px;font-family:Arial,
                                sans-serif;font-size:14px;line-height:18px">Your new On brainium infotech account created successfully, welcome to  Brainium Infotech.
                                 </span>
                                 <br><br><span
                                style="color:#000000;font-style:normal;font-variant-caps:normal;font-weight:normal;letter-spacing:normal;
                                text-align:-webkit-left;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px;font-family:Arial,
                                sans-serif;font-size:14px;line-height:18px"></span>
                                 <br><br>

                                <p><u>Your Account details </u></p>

                                <p>username: {{$row->email}}</p>
                                <p>password : {{$password}}</p>
                                <br><br>
                                <p>You can access your account with the above credentials.  Once you login, please change your password for security reasons.<p>
                                <br><br>
                                <p>If you have any queries, please contact us at brainiminfotech@gmail.com.com<p>

                                <br>
                                <span
                                    style="color:#333333;font-style:normal;font-variant-caps:normal;font-weight:normal;letter-spacing:normal;text-align:-webkit-left;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px;font-family:Arial,sans-serif;font-size:15px;line-height:18px; font-weight:bold;">
                                    Brainium Infotech
                                </span>
                                <br><br>
                                 <span
                                     style="color:#9a9a9a;font-style:normal;font-variant-caps:normal;font-weight:normal;letter-spacing:normal;text-align:-webkit-left;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px;font-family:Arial,sans-serif;font-size:12px;line-height:18px; border-top:1px solid #ccc; display: inline-block; padding-top: 10px;">
                                     Automated message. Please do not Reply!<br>
                                     You have received this email because you have been added to the On brainium family.
                                     In order to stop these e-mails please email brainiminfotech@gmail.com.com
                                     </span>
                                  <br>
                            </span>
                    </td>
                </tr>
                <tr>
                    <td align="center" bgcolor="#1e1e2d" style="padding-top: 30px; padding-bottom: 0px;">
                        <a href="#" style="display: inline-block; margin: 0 5px;" target="_blank"><img
                                src="{{asset('images/s1.png')}}" width="" alt=""/></a>
                        <a href="#" style="display: inline-block; margin: 0 5px;" target="_blank"><img
                                src="{{asset('images/s2.png')}}" width="" alt=""/></a>
                        <a href="#" style="display: inline-block; margin: 0 5px;" target="_blank"><img
                                src="{{asset('images/s3.png')}}" width="" alt=""/></a>
                        <a href="#" style="display: inline-block; margin: 0 5px;" target="_blank"><img
                                src="{{asset('images/s4.png')}}" width="" alt=""/></a>
                        <a href="#" style="display: inline-block; margin: 0 5px;" target="_blank"><img
                                src="{{asset('images/s5.png')}}" width="" alt=""/></a>
                    </td>
                </tr>
                <tr>
                    <td align="center" bgcolor="#1e1e2d" style="padding-top: 20px; padding-bottom: 20px;">
                        <span
                            style="color:#717070;font-style:normal;font-variant-caps:normal;font-weight:normal;letter-spacing:normal;text-align:-webkit-left;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px;font-family:Arial,sans-serif;font-size:12px;line-height:18px">&copy; {{date('Y')-1}} - {{date('Y')}} Brainium Infotech
                            All Rights Reserved</span><br>
                        <span
                            style="color:#717070;font-style:normal;font-variant-caps:normal;font-weight:normal;letter-spacing:normal;text-align:-webkit-left;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px;font-family:Arial,sans-serif;font-size:12px;line-height:18px">URL: <a
                                href="https://demos.mydevfactory.com//mywork/hrms/public" style="color:#cccccc;">www.brainiuminfotech.com</a>; Email: <a
                                href="mailto:brainiminfotech@gmail.com.com"
                                style="color:#cccccc;">brainiminfotech@gmail.com.com</a></span>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>
