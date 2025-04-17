@php
    $settings = DB::table('site_settings')->where('smallname' , env('APP_NAME'))->first();
@endphp
<!DOCTYPE html>
<html>
<head>
    <title>{{ $subjectLine }}</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f4f4f4;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout:fixed;background-color:#f9f9f9" id="bodyTable">
        <tbody>
            <tr>
                <td style="padding-right:10px;padding-left:10px;" align="center" valign="top" id="bodyCell">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperBody" style="max-width:600px">
                        <tbody>
                            <tr>
                                <td align="center" valign="top">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableCard" style="background-color:#fff;border-color:#e5e5e5;border-style:solid;border-width:0 1px 1px 1px;">
                                        <tbody>
                                            <tr>
                                                <td style="background-color:#f36f21;font-size:1px;line-height:3px" class="topBorder" height="3">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td style="padding-top: 60px; padding-bottom: 20px;" align="center" valign="middle" class="emailLogo">
                                                    <a href="#" style="text-decoration:none" target="_blank">
                                                        <img alt="" border="0" src="https://mais.com.pk/creativezone/public/newfront/assets/img/logo/logo2.jpg" style="width:100%;max-width:150px;height:auto;display:block" width="150">
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding-bottom: 5px; padding-left: 20px; padding-right: 20px;" align="center" valign="top" class="mainTitle">
                                                    <h2 class="text" style="color:#000;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:28px;font-weight:500;font-style:normal;letter-spacing:normal;line-height:36px;text-transform:none;text-align:center;padding:0;margin:0">Your Application Submit Successfully</h2>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding-left:20px;padding-right:20px" align="center" valign="top" class="containtTable ui-sortable">
                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableDescription">
                                                        <tbody>
                                                            <tr>
                                                                <td style="padding-bottom: 20px;" align="center" valign="top" class="description">
                                                                    <p class="text" style="color:#666;font-family:'Open Sans',Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:22px;text-transform:none;text-align:left;padding:0;margin:0">
                                                                        Dear {{ $user->fname }},<br><br>
                                                                        Thank you for applying as an artist on CreativeZone! We are excited to have you on board.<br><br>
                                                                        Our team will review your application and get back to you shortly. In the meantime, feel free to explore our platform and connect with fellow artists.<br><br>
                                                                        If you have any questions, feel free to reach out to us at <a href="mailto:support@creativezone.com">support@creativezone.com</a>.<br><br>
                                                                        Best regards,<br>
                                                                        CreativeZone Team
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-size:1px;line-height:1px" height="20">&nbsp;</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperFooter" style="max-width:600px">
                                        <tbody>
                                            <tr>
                                                <td align="center" valign="top">
                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="footer">
                                                        <tbody>
                                                            <tr>
                                                                <td style="padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px" align="center" valign="top" class="socialLinks">
                                                                    <a href="#facebook-link" style="display:inline-block" target="_blank" class="facebook">
                                                                        <img alt="" border="0" src="http://email.aumfusion.com/vespro/img/social/light/facebook.png" style="height:auto;width:100%;max-width:40px;margin-left:2px;margin-right:2px" width="40">
                                                                    </a>
                                                                    <a href="#twitter-link" style="display: inline-block;" target="_blank" class="twitter">
                                                                        <img alt="" border="0" src="http://email.aumfusion.com/vespro/img/social/light/twitter.png" style="height:auto;width:100%;max-width:40px;margin-left:2px;margin-right:2px" width="40">
                                                                    </a>
                                                                    <a href="#pintrest-link" style="display: inline-block;" target="_blank" class="pintrest">
                                                                        <img alt="" border="0" src="http://email.aumfusion.com/vespro/img/social/light/pintrest.png" style="height:auto;width:100%;max-width:40px;margin-left:2px;margin-right:2px" width="40">
                                                                    </a>
                                                                    <a href="#instagram-link" style="display: inline-block;" target="_blank" class="instagram">
                                                                        <img alt="" border="0" src="http://email.aumfusion.com/vespro/img/social/light/instagram.png" style="height:auto;width:100%;max-width:40px;margin-left:2px;margin-right:2px" width="40">
                                                                    </a>
                                                                    <a href="#linkdin-link" style="display: inline-block;" target="_blank" class="linkdin">
                                                                        <img alt="" border="0" src="http://email.aumfusion.com/vespro/img/social/light/linkdin.png" style="height:auto;width:100%;max-width:40px;margin-left:2px;margin-right:2px" width="40">
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding: 10px 10px 5px;" align="center" valign="top" class="brandInfo">
                                                                    <p class="text" style="color:#bbb;font-family:'Open Sans',Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:20px;text-transform:none;text-align:center;padding:0;margin:0">©&nbsp;{{ $settings->site_name }}. | {{ $settings->site_address }}</p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding: 0px 10px 20px;" align="center" valign="top" class="footerLinks">
                                                                    <p class="text" style="color:#bbb;font-family:'Open Sans',Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:20px;text-transform:none;text-align:center;padding:0;margin:0"> <a href="{{ url('') }}" style="color:#bbb;text-decoration:underline" target="_blank">View Web Version </a>&nbsp;|&nbsp; <a href="{{ url('privacy-policies') }}" style="color:#bbb;text-decoration:underline" target="_blank">Privacy Policy</a>
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding: 0px 10px 10px;" align="center" valign="top" class="footerEmailInfo">
                                                                    <p class="text" style="color:#bbb;font-family:'Open Sans',Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:20px;text-transform:none;text-align:center;padding:0;margin:0">If you have any questions please contact us <a href="#" style="color:#bbb;text-decoration:underline" target="_blank">support@creativezone.com.</a>
                                                                        <br> <a href="#" style="color:#bbb;text-decoration:underline" target="_blank">Unsubscribe</a> from our mailing list</p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px" align="center" valign="top" class="appLinks">
                                                                    <a href="#Play-Store-Link" style="display: inline-block;" target="_blank" class="play-store">
                                                                        <img alt="" border="0" src="http://email.aumfusion.com/vespro/img/app/play-store.png" style="height:auto;margin:5px;width:100%;max-width:120px" width="120">
                                                                    </a>
                                                                    <a href="#App-Store-Link" style="display: inline-block;" target="_blank" class="app-store">
                                                                        <img alt="" border="0" src="http://email.aumfusion.com/vespro/img/app/app-store.png" style="height:auto;margin:5px;width:100%;max-width:120px" width="120">
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
                                            </tr>
                                        </tbody>
                                    </table>
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
