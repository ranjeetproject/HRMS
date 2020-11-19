<!DOCTYPE html>
<html>
<head>
    <title>Invoice </title>

</head>
<body>
<table width="100%" border="0" cellspacing="2" cellpadding="0" bgcolor="#ffffff" style="max-width:800px; border:1px solid #dddddd; padding:50px;">
    <tbody>
    <tr>
        <td style="text-align: right;"><img src="{{asset('images/logo.png')}}" alt="" style="width:80px;"/></td>
    </tr>
    <tr>
        <td style="font-family: Arial, Helvetica, sans-serif; font-size: 17px; line-height: 22px; color: #000000; font-weight: bold; padding-bottom: 20px;">INVOICE</td>
    </tr>
    <tr>
        <td style="padding-bottom: 50px;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; line-height: 22px; color: #333;">
                <tr>
                    <td style="width: 130px;">Invoice ID:</td>
                    <td>{{$payee_id}}</td>
                </tr>
                <tr>
                    <td style="width: 130px;">Email:</td>
                    <td>{{$email}}</td>
                </tr>
            </table>

        </td>
    </tr>
    <tr>
        <td style="padding-bottom: 50px;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; line-height: 22px; color: #333;">
                <tr>
                    <td style="width: 80px; vertical-align: top;">To:</td>
                    <td></td>
                </tr>
            </table>

        </td>
    </tr>
    <tr>
        <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; line-height: 22px; color: #333;">
                <tr>
                    <td style="vertical-align: top; font-weight: bold; border-bottom: 2px solid #333;">Description</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="vertical-align: top; font-weight: bold; border-bottom: 2px solid #333;">Amount<br>(USD)</td>
                </tr>
                <tr>
                    <td style="vertical-align: top; padding-top: 5px; padding-bottom: 5px;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="vertical-align: top; padding-top: 5px; padding-bottom: 5px;">{{@$net_pay}}</td>
                </tr>
                <tr>
                    <td colspan="2" style="vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 2px solid #333; border-bottom: 2px solid #333;">&nbsp;</td>
                    <td colspan="2" style="vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 2px solid #333; border-bottom: 2px solid #333;">TOTAL:</td>
                    <td style="vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 2px solid #333; border-bottom: 2px solid #333;">{{@$invoice->packageDetails->price}}</td>
                </tr>
            </table>
        </td>
    </tr>
    
    </tbody>
</table>

</body>
</html>


