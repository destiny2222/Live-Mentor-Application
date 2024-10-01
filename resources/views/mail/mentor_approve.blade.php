<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        * {
            font-family: sans-serif;
        }

        body {
            font-family: sans-serif;
            font-style: normal;
            font-weight: normal;
            line-height: 15px;
            color: #828282;
            background-color: #F2F2F2;
        }

        .logo {
            border: 0.5px solid #BDBDBD;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: #F2F2F2;
            table-layout: fixed;
            padding: 20px;
        }

        .wrapper-inner {
            background-color: #fff;
            max-width: 670px;
            margin: 0 auto;
            padding: 15px;
            border-collapse: collapse;
            table-layout: fixed;
            word-break: break-word;
            width: 476px;
        }

        table {
            border-spacing: 0;
            font-family: sans-serif;
            color: #727f80;
        }

        .primary {
            color: #6450EF;
        }

        .success {
            color: #008000;
        }

        .danger {
            color: #ff0000;
        }

        .fw-bold {
            font-weight: bold;
        }

        .table-footer {
            text-align: center;
        }

        .table-footer p {
            line-height: 11px;
        }

        .main-table-first {
            width: 100%;
            max-width: 610px;
            margin: 0 auto;
        }

        .two-column {
            font-size: 0;
            padding: 5px 0 10px 0;
        }

        .two-column .section {
            width: 100%;
            max-width: 240px;
            display: inline-block;
            vertical-align: top;
        }

        .two-column .content-inner {
            font-size: 16px;
            line-height: 20px;
            text-align: justify;
        }

        .content-inner {
            width: 100%;
        }

        img {
            border: 0;
        }

        .layout div {
            padding-top: 0.1rem;
            text-align: left;
            vertical-align: top;
            color: #60666d;
            font-size: 15px;
            line-height: 21px;
            font-family: sans-serif;
            font-weight: 400;
            width: 476px;
        }

        a {
            padding-top: 150px;
        }

        @media screen and (max-width:768px) {
            .two-column .section-inner {
                width: 100% !important;
                max-width: 100% !important;
                display: inline-block;
                vertical-align: top;
            }
        }

        @media screen and (max-width: 400px) {
            .h1 {
                font-size: 22px;
            }

            .two-column .column {
                max-width: 100% !important;
            }
        }

        @media screen and (min-width: 401px) and (max-width: 400px) {
            .two-column .column {
                max-width: 50% !important;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="wrapper-inner">
            <table>
                <tr>
                    <td>
                        <table width="100%">
                            <tr>
                                <td style="text-align:left; padding-top: 10px; padding-bottom:25px;">
                                    <a href="#"><img src="https://livementor.gritinai.com/logo.png" width="180" alt="Logo"></a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="layout">
                        <div>
                            <h2>Congratulations! {{ $user->name }}</h2>
                            <p>Your LiveMentor profile has been approved</p>
                            <p>Now, let's grow together! Use LiveMentor to share your expertise, earn rewards, and inspire others to do the same.</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="layout">
                        <div>
                            <p>Thank you for applying to be a mentor on Livementor.</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table width="100%" style="border-spacing: 0; padding-top: 2rem;">
                            <tr>
                                <td class="table-footer">
                                    <div style="padding-bottom: 7px;">
                                        <p style="text-align: left;">© {{ date('Y') }} {{ config('app.name') }}. All Rights Reserved</p>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
