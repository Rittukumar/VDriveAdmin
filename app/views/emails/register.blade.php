<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<table width="100%" cellpadding="0" cellspacing="0" border="0"
       style="font-size:17px;line-height:24px;color:#373737;background:#f9f9f9">
    <tbody>
    <tr>
        <td valign="top">
            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tbody>
                <tr>
                    <td valign="bottom" style="padding:20px 16px 12px">
                        <div>
                            <a href="https://www.evezown.com" target="_blank">
                                <img src="{{ asset('http://evezown.com/img/logo.png') }}">
                            </a>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td valign="top">
            <table width="100%" cellpadding="0" cellspacing="0" border="0" align="center">
                <tbody>
                <tr>
                    <td valign="top">
                        <div style="max-width:600px;margin:0 auto;padding:0 12px">
                            <div style="background:white;border-radius:0.5rem;padding:2rem;margin-bottom:1rem">
                                <h2 style="color:#2ab27b;margin:0 0 12px;line-height:30px">Hello {{ $name }}</h2>

                                <p>Thank you for your interest in EvezOwn.com. We welcome you to this platform!
                                    EvezOwn.com is a space for people like you to voice opinion and showcase your
                                    unique identity, personality, talent, business… anything and everything that
                                    defines you.</p>

                                <p>EvezOwn caters to each and every people. you can
                                    create independent circles, promote stores and Business services or just share the
                                    information or message you choose to among your friends.</p>

                                <p>Once you register, you can use the Mysite section to create your profile and use
                                    features like groups, events, ads & campaigns, discussion, blogs and circles for interacting
                                    with your group. You can open a store for your stores or business in MarketPlace
                                    or simply search and find the career of your choice in jobs section, if you are
                                    a working professional.</p>

                                <p>Click <a
                                            href="http://evezown.com/#/signup/{{ $inviteCode }}"
                                            target="_blank">here</a> to register with www.evezown.com and use your
                                    code…. <a
                                            href="http://evezown.com/#/signup/{{ $inviteCode }}"
                                            target="_blank">Sign
                                        Up Now</a></p>

                                <p>You invite code is {{ $inviteCode }}</p>

                                <p>Make EvezOwn.com your own place.</p>

                                <h4>Team EvezOwn</h4>

                            </div>

                        </div>
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