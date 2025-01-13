<html>
    <head>
        <title>
            Registration Form - Martindale
        </title>
        <style>
            body { font-family: tahoma, arial; font-size: 12px }
            table { font-size: 12px; width: 50% }
            input { font-family: georgia; font-size: 12px; }
        </style>
    </head>
    <body>
        <h1>
            Martindale: Registration
        </h1>
        <form method="POST" autocomplete="off" action="submit.php" >
            <table>
                <tbody>
                    <tr>
                        <td width="15%">
                            First Name
                        </td>
                        <td>
                            : <input type="text" name="firstName" size="30" required/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Last Name
                        </td>
                        <td>
                            : <input type="text" name="lastName" size="30" required/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Date of Birth
                        </td>
                        <td>
                            : <input type="date" name="dateOfBirth" size="15" required max="<?php echo date('Y-m-d'); ?>" />
                            <noscript>
                            <input type="text" name="dateOfBirth" size="15" maxlength="10" placeholder="mm/dd/yyyy"/>
                        </noscript>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            E-mail
                        </td>
                        <td>
                            : <input type="email" name="eMailAddress" size="50" required/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Zip Code
                        </td>
                        <td>
                            : <input type="text" name="zipCode" size="10" pattern="\d{5}" title="Please enter correct ZIP Code" required/>
                        </td>
                    </tr>
                </tbody>
            </table>
            <input type="submit" name="Submit" value="Submit" />
            <input type="reset" value="Reset" />
        </form>
    </body>
</html>