<?php
// Set page title and last updated date
$pageTitle = "Privacy Policy - IngreSkin";
$lastUpdated = "28-01-2025";

// Define the privacy policy content sections
$intro = 'Welcome to IngreSkin! Your privacy is important to us. This Privacy Policy explains how we collect, use, and protect your personal information when you use our app.';

$information_collected_title = 'Information We Collect';
$information_collected_items = array(
    '<strong>Personal Information:</strong> When you sign up, we may collect your name, email address, and other profile details.',
    '<strong>Skin Assessment Data:</strong> Information about your skin type, concerns, and preferences provided by you.',
    '<strong>App Usage Data:</strong> Information about your interactions with the app, including product scans and recommendations.'
);

$information_use_title = 'How We Use Your Information';
$information_use_items = array(
    'To provide personalized skincare assessments and product recommendations.',
    'To improve app performance and user experience.',
    'To respond to your inquiries and provide customer support.'
);

$information_sharing_title = 'Sharing Your Information';
$information_sharing_content = 'We do not sell or share your personal information with third parties without your consent, except as required by law or for app functionality (e.g., barcode scanning services).';

$data_security_title = 'Data Security';
$data_security_content = 'We implement security measures to protect your information. However, no method of transmission over the Internet is completely secure.';

$your_rights_title = 'Your Rights';
$your_rights_items = array(
    'You have the right to access, update, or delete your personal information.',
    'You can withdraw your consent for data collection at any time.'
);

$policy_changes_title = 'Changes to This Policy';
$policy_changes_content = 'We may update this Privacy Policy from time to time. Any changes will be reflected on this page, and you will be notified of significant updates.';

$contact_title = 'Contact Us';
$contact_content = 'If you have any questions about this Privacy Policy, please contact us at: <strong>[ingreskin@gmail.com]</strong>';

// Function to display list items
function displayListItems($items) {
    echo '<ul>';
    foreach ($items as $item) {
        echo '<li>' . $item . '</li>';
    }
    echo '</ul>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7f6;
            color: #333;
        }
        header {
            background-color: #2c3e50;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        h1, h2, h3 {
            color: white;
        }
        h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
        }
        h2 {
            margin-top: 30px;
            font-size: 1.8em;
            color: #16a085;
        }
        p {
            font-size: 1.1em;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        ul {
            margin-left: 20px;
            font-size: 1.1em;
            line-height: 1.5;
        }
        li {
            margin-bottom: 10px;
        }
        strong {
            color: #16a085;
        }
        footer {
            background-color: #2c3e50;
            color: #fff;
            padding: 10px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
        }
    </style>
</head>
<body>

<header>
    <h1>Privacy Policy</h1>
    <p>Last updated: <?php echo $lastUpdated; ?></p>
</header>

<div class="container">
    <p><?php echo $intro; ?></p>

    <h2><?php echo $information_collected_title; ?></h2>
    <?php displayListItems($information_collected_items); ?>

    <h2><?php echo $information_use_title; ?></h2>
    <?php displayListItems($information_use_items); ?>

    <h2><?php echo $information_sharing_title; ?></h2>
    <p><?php echo $information_sharing_content; ?></p>

    <h2><?php echo $data_security_title; ?></h2>
    <p><?php echo $data_security_content; ?></p>

    <h2><?php echo $your_rights_title; ?></h2>
    <?php displayListItems($your_rights_items); ?>

    <h2><?php echo $policy_changes_title; ?></h2>
    <p><?php echo $policy_changes_content; ?></p>

    <h2><?php echo $contact_title; ?></h2>
    <p><?php echo $contact_content; ?></p>

    <p>Thank you for using IngreSkin!</p>
    
    <hr>
    <hr>
    <hr>
    <hr>
    <hr>
    <hr>
</div>

<footer>
    <p>&copy; <?php echo date('Y'); ?> IngreSkin. All rights reserved.</p>
</footer>

</body>
</html>