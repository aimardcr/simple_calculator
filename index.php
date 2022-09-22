<?php
$input = '';
$result = '';
if (isset($_POST['input'])) {
    $input = $_POST['input'];
    if (preg_match('/^[0-9\+\-\*\/\(\)\s]+$/', $input)) {
        $result = 'Hasil dari ' . $input . ' adalah ' . eval('return ' . $input . ';');
    } else {
        $result = 'Invalid input!';
    }
    die($result);
}
?>

<!DOCTYPE html>
<head>
    <title>PNB</title>
    <link rel="stylesheet" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="container">
        <center><h2>Simple Calculator</h2></center>
    </div>   
    <div class="container">
        <input type="text" name="input" placeholder="Masukkan rumus kamu disini!" autocomplete="off" required>
        <button type="submit" onclick="submit()" style="margin-top: 15px">Submit</button>
    </div>
    <div class="container" hidden=true>
        <h2 id="result"><?php echo $result; ?></h2>
    </div>
</body>
<script>
function submit() {
    var input = document.querySelector('input[name="input"]').value;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'index.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (this.status == 200) {
            if (document.querySelector('#result').parentElement.hidden) {
                document.querySelector('#result').parentElement.hidden = false;
            }
            document.querySelector('#result').innerHTML = this.responseText;
        }
    };
    xhr.send('input=' + encodeURIComponent(input));
}
</script>
</html>