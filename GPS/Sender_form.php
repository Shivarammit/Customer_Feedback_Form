<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sender.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <title>Sender Form</title>
</head>
<body>
    <div class="form-container">
        <form onsubmit="return validateEmail()">
            <label>GPS Project No:</label>
            <input type="text" id="pno" name="pno">
            <label for="jno">Job No:(If Applicable)</label>
            <input type="text" id="jno" name="jno">
            <label>Client Email:</label>
            <input type="email" id="email" name="email">
            <label>Client Name:(Person Name)</label>
            <input type="text" id="cname" name="cname">
            <label>Client Designation:</label>
            <input type="text" id="desg" name="desg">
            <label for="sname">Sender's Name</label>
            <input type="text" id="sname" name="sname">
            <label for="smail">Sender's Email ID</label>
            <input type="text" id="smail" name="smail">
            <span class="error" id="errormsg" style="display: none;">The Client should not be from GPS</span>
            <button type="submit">Send</button>
        </form>
    </div>
    <script>
        function validateEmail() {
            let email = document.getElementById('email').value;
            let errorMessage = document.getElementById('errormsg');

            // Regular expression to check if email ends with 'gpsoman.com'
            let regex = /@gpsoman\.com$/;

            if (regex.test(email)) {
                errorMessage.style.display = 'block';
                return false;
            } else {
                errorMessage.style.display = 'none';
            }
            return true;
        }
    </script>
</body>
</html>
