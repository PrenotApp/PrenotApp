<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifica Accesso</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333333; background-color: #f4f4f4; margin: 0; padding: 0;">

    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #f4f4f4; padding: 20px;">
        <tr>
            <td align="center">
                <table width="600" border="0" cellspacing="0" cellpadding="20" style="background-color: #ffffff; border-radius: 8px;">
                    <!-- Logo -->
                    <tr>
                        <td align="center">
                            <img src="https://bucket.mailersendapp.com/neqvygmrw5l0p7w2/pxkjn4185kqlz781/images/9d6aa0be-dce0-4e1e-8106-8815c3224d61.png" alt="Logo" style="width: 80px; height: auto;">
                        </td>
                    </tr>

                    <!-- Titolo -->
                    <tr>
                        <td align="center" style="font-size: 18px; color: #ff6f00; font-weight: bold;">
                            Ciao, {{ $name }}
                        </td>
                    </tr>

                    <!-- Messaggio principale -->
                    <tr>
                        <td align="center" style="font-size: 24px; color: #004aad; font-weight: bold; padding: 10px 0;">
                            Si prega di verificare il tuo accesso
                        </td>
                    </tr>

                    <!-- Corpo del messaggio -->
                    <tr>
                        <td align="center" style="font-size: 16px; color: #333333; padding: 10px 0;">
                            Abbiamo ricevuto la tua richiesta di login, per favore inserisci questo codice di verifica:
                        </td>
                    </tr>

                    <!-- Codice di verifica -->
                    <tr>
                        <td align="center" style="font-size: 30px; font-weight: bold; color: #333333; padding: 10px 0;">
                            {{ $codice }}
                        </td>
                    </tr>

                    <!-- Informazioni di contatto -->
                    <tr>
                        <td align="center" style="font-size: 14px; color: #666666; padding-top: 20px;">
                            Se hai qualche dubbio contattaci a <a href="mailto:prenotapp.pm@gmail.com" style="color: #004aad; text-decoration: none;">prenotapp.pm@gmail.com</a>.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</body>
</html>
