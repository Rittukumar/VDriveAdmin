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
                        <div style="max-width:600px;margin:0 auto;padding:0 12px">
                            <div style="background:white;border-radius:0.5rem;padding:2rem;margin-bottom:1rem">
                                <h2 style="color:#2ab27b;margin:0 0 12px;line-height:30px">Hello Admin:</h2>
                                <p>You have received an invite request from:</p>
                                <p>Name: {{ $name }}, {{ $surname }}</p>
                                <p>Email: {{ $email }}</p>
                                <p>Address: {{ $city }}, {{ $state }}, {{ $country }}</p>
                                <br/>
                                <h5>Referrer Details: </h5>
                                <p>Referrer Name:  {{ $referrerName }}</p>
                                <p>Referrer Email:  {{ $referrerEmail }}</p>
                                <p>
                                    Go to <a href="http://evezown.com/#/admin" target="_blank">Invites Now</a>
                                </p>
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