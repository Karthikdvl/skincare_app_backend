<?php
session_start();

// Database connection settings
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "skindatabase";

// Function to connect to database
function connectDB() {
    global $db_host, $db_user, $db_pass, $db_name;
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    return $conn;
}

// Function to generate OTP
function generateOTP() {
    return rand(100000, 999999); // 6-digit OTP
}

// Function to send email using PHP's built-in mail()
function sendEmail($to, $subject, $message) {
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: Ingreskin <ingreskin@gmail.com>" . "\r\n";

    return mail($to, $subject, $message, $headers);
}

// Handle OTP request
if (isset($_POST['send_otp'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response = array("status" => "error", "message" => "Invalid email address");
    } else {
        $conn = connectDB();
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 0) {
            $response = array("status" => "error", "message" => "Email not found in our records");
        } else {
            $otp = generateOTP();
            $_SESSION['delete_otp'] = $otp;
            $_SESSION['delete_email'] = $email;
            $_SESSION['otp_time'] = time();
            
            $subject = "Account Deletion OTP";
            $message = "<html><body>";
            $message .= "<h2>Account Deletion Request</h2>";
            $message .= "<p>Your OTP for account deletion is: <strong>{$otp}</strong></p>";
            $message .= "<p>This OTP will expire in 10 minutes.</p>";
            $message .= "<p>If you did not request account deletion, please ignore this email.</p>";
            $message .= "</body></html>";
            
            if (sendEmail($email, $subject, $message)) {
                $response = array("status" => "success", "message" => "OTP sent to your email");
            } else {
                $response = array("status" => "error", "message" => "Failed to send OTP email. Please try again.");
            }
        }
        
        $stmt->close();
        $conn->close();
    }
    
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
}

// Handle OTP verification and account deletion
if (isset($_POST['verify_otp'])) {
    $otp = filter_var($_POST['otp'], FILTER_SANITIZE_NUMBER_INT);
    
    if (!isset($_SESSION['delete_otp']) || !isset($_SESSION['delete_email'])) {
        $response = array("status" => "error", "message" => "OTP session expired. Please request a new OTP.");
    } else if ($_SESSION['delete_otp'] != $otp) {
        $response = array("status" => "error", "message" => "Invalid OTP. Please try again.");
    } else if (time() - $_SESSION['otp_time'] > 600) {
        $response = array("status" => "error", "message" => "OTP has expired. Please request a new one.");
    } else {
        $email = $_SESSION['delete_email'];
        $conn = connectDB();
        
        $stmt = $conn->prepare("DELETE FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $result = $stmt->execute();
        
        if ($result) {
            unset($_SESSION['delete_otp']);
            unset($_SESSION['delete_email']);
            unset($_SESSION['otp_time']);
            $response = array("status" => "success", "message" => "Your account has been successfully deleted.");
        } else {
            $response = array("status" => "error", "message" => "Failed to delete account. Please try again later.");
        }
        
        $stmt->close();
        $conn->close();
    }
    
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
        .success {
            color: green;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Delete Account</h1>

        <?php if (isset($response)): ?>
            <p class="message <?php echo $response['status']; ?>">
                <?php echo $response['message']; ?>
            </p>
        <?php endif; ?>

        <?php if (isset($_SESSION['delete_otp'])): ?>
            <p>Please enter the OTP sent to your email:</p>
            <form method="POST" id="verifyForm">
                <input type="text" name="otp" id="otp" placeholder="Enter OTP" required>
                <button type="submit" name="verify_otp">Verify & Delete Account</button>
            </form>
        <?php else: ?>
            <p>Enter your email to receive an OTP for account deletion:</p>
            <form method="POST" id="otpForm">
                <input type="email" name="email" id="email" placeholder="Enter your email" required>
                <button type="submit" name="send_otp">Send OTP</button>
            </form>
        <?php endif; ?>

        <div id="responseMessage" class="message"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const otpForm = document.getElementById('otpForm');
            const verifyForm = document.getElementById('verifyForm');
            const responseMessage = document.getElementById('responseMessage');
            
            if (otpForm) {
                otpForm.addEventListener('submit', async function(e) {
                    e.preventDefault();
                    const email = document.getElementById('email').value;
                    
                    try {
                        const formData = new FormData();
                        formData.append('email', email);
                        formData.append('send_otp', '1');
                        
                        const response = await fetch('', {
                            method: 'POST',
                            body: formData
                        });
                        
                        const result = await response.json();
                        
                        if (result.status === 'success') {
                            responseMessage.className = 'message success';
                            responseMessage.textContent = result.message;
                            location.reload(); // Refresh for OTP form
                        } else {
                            responseMessage.className = 'message error';
                            responseMessage.textContent = result.message;
                        }
                    } catch (error) {
                        responseMessage.className = 'message error';
                        responseMessage.textContent = 'Failed to send OTP. Please try again.';
                    }
                });
            }
            
            if (verifyForm) {
                verifyForm.addEventListener('submit', async function(e) {
                    e.preventDefault();
                    const otp = document.getElementById('otp').value;
                    
                    try {
                        const formData = new FormData();
                        formData.append('otp', otp);
                        formData.append('verify_otp', '1');
                        
                        const response = await fetch('', {
                            method: 'POST',
                            body: formData
                        });
                        
                        const result = await response.json();
                        
                        if (result.status === 'success') {
                            responseMessage.className = 'message success';
                            responseMessage.textContent = result.message;
                        } else {
                            responseMessage.className = 'message error';
                            responseMessage.textContent = result.message;
                        }
                    } catch (error) {
                        responseMessage.className = 'message error';
                        responseMessage.textContent = 'Failed to verify OTP. Please try again.';
                    }
                });
            }
        });
    </script>
</body>
</html>
