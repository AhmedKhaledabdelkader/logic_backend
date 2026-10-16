
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>New Contact Request</title>
</head>

<body style="
    margin: 0;
    padding: 0;
    background-color: #f4f6f8;
    font-family: Arial, Helvetica, sans-serif;
">

<table width="100%" cellpadding="0" cellspacing="0" border="0">
    <tr>
        <td align="center" style="padding: 40px 15px;">

            <table
                width="600"
                cellpadding="0"
                cellspacing="0"
                border="0"
                style="
                    max-width: 600px;
                    width: 100%;
                    background: #ffffff;
                    border-radius: 12px;
                    overflow: hidden;
                "
            >

                <!-- Header -->
                <tr>
                    <td style="
                        background: #0d2b3e;
                        padding: 30px;
                        text-align: center;
                    ">
                        <h1 style="
                            margin: 0;
                            color: #ffffff;
                            font-size: 24px;
                        ">
                            Houida Consulting
                        </h1>

                        <p style="
                            margin: 8px 0 0;
                            color: #d4a24c;
                            font-size: 14px;
                        ">
                            New Contact Request
                        </p>
                    </td>
                </tr>

                <!-- Content -->
                <tr>
                    <td style="padding: 35px 30px;">

                        <h2 style="
                            margin: 0 0 25px;
                            color: #0d2b3e;
                            font-size: 20px;
                        ">
                            You received a new message
                        </h2>

                        <!-- Name -->
                        <div style="margin-bottom: 20px;">
                            <p style="
                                margin: 0 0 5px;
                                color: #888888;
                                font-size: 12px;
                                text-transform: uppercase;
                            ">
                                Name
                            </p>

                            <p style="
                                margin: 0;
                                color: #222222;
                                font-size: 16px;
                            ">
                                {{ $contact->name }}
                            </p>
                        </div>

                        <!-- Email -->
                        <div style="margin-bottom: 20px;">
                            <p style="
                                margin: 0 0 5px;
                                color: #888888;
                                font-size: 12px;
                                text-transform: uppercase;
                            ">
                                Email
                            </p>

                            <p style="
                                margin: 0;
                                color: #222222;
                                font-size: 16px;
                            ">
                                {{ $contact->email }}
                            </p>
                        </div>

                        <!-- Phone -->
                        <div style="margin-bottom: 20px;">
                            <p style="
                                margin: 0 0 5px;
                                color: #888888;
                                font-size: 12px;
                                text-transform: uppercase;
                            ">
                                Phone
                            </p>

                            <p style="
                                margin: 0;
                                color: #222222;
                                font-size: 16px;
                            ">
                                {{ $contact->phone }}
                            </p>
                        </div>

                        <!-- Message -->
                        <div style="margin-top: 30px;">
                            <p style="
                                margin: 0 0 10px;
                                color: #888888;
                                font-size: 12px;
                                text-transform: uppercase;
                            ">
                                Message
                            </p>

                            <div style="
                                background: #f7f5f1;
                                border-left: 4px solid #d4a24c;
                                padding: 18px;
                                border-radius: 6px;
                                color: #333333;
                                font-size: 15px;
                                line-height: 1.6;
                            ">
                                {!! nl2br(e($contact->message)) !!}
                            </div>
                        </div>

                    </td>
                </tr>

                <!-- Footer -->
                <tr>
                    <td style="
                        background: #f7f5f1;
                        padding: 20px 30px;
                        text-align: center;
                    ">
                        <p style="
                            margin: 0;
                            color: #777777;
                            font-size: 12px;
                        ">
                            This message was submitted through the
                            Logic Consulting website.
                        </p>
                    </td>
                </tr>

            </table>

        </td>
    </tr>
</table>

</body>
</html>