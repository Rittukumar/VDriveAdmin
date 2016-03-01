<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<table width="100%" cellpadding="0" cellspacing="0" border="0" style="font-size:17px;line-height:24px;color:#373737;background:#f9f9f9">
    <tbody><tr>
        <td valign="top">
            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tbody><tr>
                    <td valign="bottom" style="padding:20px 16px 12px">
                        <div>
                            <a href="https://www.evezown.com" target="_blank">
                                <img src="{{ asset('http://evezown.com/img/logo.png') }}">
                            </a>
                        </div>
                    </td>
                </tr>
                </tbody></table>
        </td>
    </tr>
    <tr>
        <td valign="top">
            <table width="100%" cellpadding="0" cellspacing="0" border="0" align="center">
                <tbody><tr>
                    <td valign="top">
                        <div style="max-width:100%;margin:0 auto;padding:0 6px">
                            <div style="background:white;border-radius:0.5rem;padding:2rem;margin-bottom:1rem">
                                <p>We received a request to reset the password associated with this e-mail address. If you made this request, please follow the instructions below.</p>
                                <p>Click the link below to reset your password:</p>
                                <a href="http://evezown.com/#/reset_password/{{$Code}}">http://evezown.com/#/reset_password/{{$Code}}</a>
                                <p>If you did not request to have your password reset you can safely ignore this email. Rest assured your customer account is safe.</p>
                                <p>If clicking the link doesn't seem to work, you can copy and paste the link into your browser's address window, or retype it there. 
                                    Once you have returned to <a href="http://evezown.com">Evezown</a> we will give instructions for resetting your password.</p>
                                <p>Thanks for visiting Evezown.com!</p>
                            </div>

                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody></table>
</body>
</html>