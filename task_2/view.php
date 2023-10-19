<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Walidacja PESEL</title>
</head>
<body>
    <p>Walidacja numeru PESEL (11 znaków):</p>
    <form method="POST">
        <input 
            type="text" 
            id="pesel" 
            name="pesel" 
            placeholder="PESEL"
            required
        ><br>
        <input 
            type="submit" 
            id="submitButton" 
            value="Submit"
            disabled
        >
    </form> 
    <script src="assets/js/pesel.js"></script>
</body>
</html>