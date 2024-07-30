<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">



<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width,initial-scale=1">

    <meta name="x-apple-disable-message-reformatting">

    <title></title>

    <style>

        table,

        td,

        div,

        h1,

        p {

            font-weight: 500;

            font-family: Arial, sans-serif;

        }

        .btn {margin: 10px 0px;

            border-radius: 4px;

            text-decoration: none;

            color: #fff !important;

            height: 46px;

            padding: 10px 20px;

            font-size: 16px;

            font-weight: 600;

            background-image: linear-gradient(to right top, #021d68, #052579, #072d8b, #09369d, #093fb0) !important;

        }

        .btn:hover {

            text-decoration: none;

            opacity: .8;

        }

    </style>

</head>

<body style="margin:0;padding:0;">

    <table role="presentation"

        style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">

        <tr>

            <td align="center" style="padding:0;">

                <table role="presentation"

                    style="width:600px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">

                    <tr style="border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;">

                        <td style="text-align: center;padding:10px 25px;background:#fff; display: flex; align-items: center;">

                        

                            <img src="{{url('/')}}/storage/logos/ust3.png" class="img-fluid" alt="Responsive image" style="max-width:250px; margin:auto;" >

                        </td>

                    </tr>

                    <tr>

                        <td style="padding:36px 30px 42px 30px;">

                            <table role="presentation"

                                style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">

                                <tr>

                                    <td style="padding:0 0 36px 0;color:#153643;">

                                        <h1 style="font-weight:bold;margin:0 0 20px 0;font-family:Arial,sans-serif;">

                                        {{ __('multi-leng.formerror46') }} {{ $user ? $user['name'] : '' }},</h1>

                                        <p

                                            style="margin:0 0 12px 0;font-size:14px;line-height:24px;font-family:Arial,sans-serif;">

                                            {{ __('multi-leng.formerror251') }}

                                        </p>

                                        <p

                                            style="margin:10px 0 12px 0;font-size:14px;line-height:24px;font-family:Arial,sans-serif;">

                                            {{ __('multi-leng.formerror249') }}

                                        </p>

                                        <p

                                            style="margin:10px 0 12px 0;font-size:14px;line-height:24px;font-family:Arial,sans-serif;">

                                            E-mail:&nbsp;{{ $user ? $user['email'] : '' }}

                                        </p>

                                        <p

                                            style="margin:10px 0 12px 0;font-size:14px;line-height:24px;font-family:Arial,sans-serif;">

                                            Password:&nbsp;{{ $user ? $user['pass'] : '' }}

                                        </p>

                                        <p style="text-align: center; color:#000;padding-top:30px;">

                                            <a target="_blank" style="background-color: #009FD4;color: white;" href="{{url('/')}}" class="btn">{{ __('multi-leng.formerror252') }}</a>

                                        </p>

                                        <p style="text-align: center; color:#000;padding-top:30px;">

                                            &nbsp;

                                        </p>

                                        <p style="margin:0 0 12px 0;font-size:14px;font-family:Arial,sans-serif;">

                                        {{ __('multi-leng.formerror250') }} </p>

                                    </td>

                                </tr>

                            </table>

                        </td>

                    </tr>

                </table>

            </td>

        </tr>

    </table>

</body>

</html>

