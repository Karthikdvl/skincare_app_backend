<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account with OTP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 350px;
            text-align: center;
        }
        h1 {
            color: #d9534f;
        }
        input, button {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #d9534f;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #c9302c;
        }
        .message {
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Delete Account</h1>
        <p>Enter your email to receive an OTP for account deletion:</p>
        <form id="otpForm">
            <input type="email" id="email" placeholder="Enter your email" required>
            <button type="button" id="sendOtpButton">Send OTP</button>
        </form>
        <form id="verifyForm" style="display: none;">
            <input type="text" id="otp" placeholder="Enter OTP" required>
            <button type="button" id="verifyOtpButton">Verify & Delete Account</button>
        </form>
        <p id="responseMessage" class="message"></p>
    </div>

    <script>
        const sendOtpButton = document.getElementById('sendOtpButton');
        const verifyOtpButton = document.getElementById('verifyOtpButton');
        const otpForm = document.getElementById('otpForm');
        const verifyForm = document.getElementById('verifyForm');
        const responseMessage = document.getElementById('responseMessage');

        sendOtpButton.addEventListener('click', async () => {
            const email = document.getElementById('email').value;

            try {
                const response = await fetch('http://127.0.0.1:5000/send-otp-delete', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ email })
                });

                const result = await response.json();

                if (response.ok) {
                    responseMessage.style.color = 'green';
                    responseMessage.textContent = result.message;
                    otpForm.style.display = 'none';
                    verifyForm.style.display = 'block';
                } else {
                    responseMessage.style.color = 'red';
                    responseMessage.textContent = result.error;
                }
            } catch (error) {
                responseMessage.style.color = 'red';
                responseMessage.textContent = 'Failed to send OTP. Please try again.';
            }
        });

        verifyOtpButton.addEventListener('click', async () => {
            const email = document.getElementById('email').value;
            const otp = document.getElementById('otp').value;

            try {
                const response = await fetch('http://127.0.0.1:5000/verify-otp-delete-account', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ email, otp })
                });

                const result = await response.json();

                if (response.ok) {
                    responseMessage.style.color = 'green';
                    responseMessage.textContent = result.message;
                } else {
                    responseMessage.style.color = 'red';
                    responseMessage.textContent = result.error;
                }
            } catch (error) {
                responseMessage.style.color = 'red';
                responseMessage.textContent = 'Failed to verify OTP. Please try again.';
            }
        });
    </script>
</body>
</html>
