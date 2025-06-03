<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 20px;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
        <tr>
            <td style="padding: 30px;">
                <h2 style="color: #333333; font-size: 24px; margin-top: 0;">Halo!</h2>
                <p style="color: #555555; font-size: 16px; line-height: 1.5;">
                    Kami menerima permintaan untuk mereset password akun Anda.
                </p>
                <p style="color: #555555; font-size: 16px; line-height: 1.5;">
                    Silakan klik tombol di bawah ini untuk mengatur ulang password Anda:
                </p>

                <div style="text-align: center; margin: 30px 0;">
                    <a href="{{ $resetLink }}" style="background-color: #4CAF50; color: white; padding: 14px 24px; text-decoration: none; display: inline-block; border-radius: 4px; font-size: 16px;">
                        Reset Password
                    </a>
                </div>

                <p style="color: #555555; font-size: 16px; line-height: 1.5;">
                    Jika Anda tidak meminta reset password, abaikan email ini.
                </p>

                <p style="color: #555555; font-size: 16px; line-height: 1.5;">
                    Salam,<br><strong>Kepala Desa Batupute</strong>
                </p>
            </td>
        </tr>
    </table>
</body>
</html>
