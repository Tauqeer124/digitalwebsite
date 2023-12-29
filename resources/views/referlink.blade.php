<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Refer a Friend</title>
</head>
<body>
    @php 
    $referl_link = 'https://www.aas.com/register/'.auth()->user()->phone;
    @endphp
    <h1>Refer a Friend</h1>

    <div>
        <input type="text" id="referralLinkInput" value="{{ $referl_link }}" readonly>
        <button onclick="copyToClipboard()">Copy Link</button>
    </div>

    <p>Your reference number is:</p>
    <h2>{{ auth()->user()->phone}}</h2>

    <p>Enjoy the Aas Website and App! <a href="{{ $referl_link }}">{{ $referl_link }}</a></p>

    <script>
        function copyToClipboard() {
            /* Get the text field */
            var copyText = document.getElementById("referralLinkInput");

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */

            /* Copy the text inside the text field */
            document.execCommand("copy");

            /* Alert the copied text */
            alert("Copied the referral link: " + copyText.value);
        }
    </script>

</body>
</html>
