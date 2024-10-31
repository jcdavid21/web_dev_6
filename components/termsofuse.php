<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms of Use</title>
    <link rel="stylesheet" href="../styles/header.css">
    <link rel="stylesheet" href="../styles/footer.css">
    <link rel="stylesheet" href="../styles/general.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .center{
    display: grid;
    grid-template-columns: 260px 1fr;
    align-items: start;
    justify-content: space-between;
    width: 100%;
}

        body {
            font-family: 'DM Sans', sans-serif;
            background-color: #f5f4ed;
            margin: 0;
            margin-top: 80px;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Minimum height for the body */
        }

        .terms-container {
            background: white;
            padding: 19px; /* Increased padding for content */
            border-radius: 12px;
            border: 2px solid #f6a425; /* Change border color to orange */
            width: 90%; /* Make it responsive */
            max-width: 1200px; /* Optional: set a max width */
            margin: auto; /* Center the container */
            margin-top: 20px; /* Space above the container */
            margin-bottom: 20px; /* Space below the container */
            overflow-y: auto; /* Enable vertical scrolling */
            max-height: 700px;
        }
        h1 {
            color: #f6a425; /* Change heading text color to orange */
        }
        h3 {
            color: #f6a425; /* Change heading text color to orange */
        }
        li strong {
            color: #f6a425;
        }
        .history-container p {
            text-align: justify;
        }
    </style>
</head>
<body>
<?php include 'header.php'; ?>

<div class="center">
<?php include 'spaces.php'; ?>
    <div class="terms-container">
        <h1 style="text-align: center; color: #f6a425;">Terms of Use</h1>
        <p>
            Welcome to Deep Dive! By accessing or using Deep Dive, you agree to be bound by the following Terms of Use. Please read these terms carefully before using the Website.
        </p>

        <h3>1. Acceptance of Terms</h2>
        <p>
            By creating an account, posting content, commenting, or using any part of the Website, you agree to be bound by these Terms of Use and our Privacy Policy. If you do not agree with these terms, you should stop using the Website immediately.
        </p>

        <h3>2. Changes to Terms</h2>
        <p>
            We reserve the right to modify these Terms of Use at any time. Any changes will be effective immediately upon posting. It is your responsibility to review these terms periodically. Continued use of the Website following the posting of changes will mean you accept the revised terms.
        </p>

        <h3>3. User Responsibilities</h2>
        <p>You are responsible for your use of the Website and any content you post. You agree to:</p>
        <ul>
            <li><strong>Respectful Communication:</strong> Refrain from posting or sharing any offensive, discriminatory, defamatory, or harmful content.</li>
            <li><strong>No Illegal Activity:</strong> Do not use the Website to promote or engage in illegal activities.</li>
            <li><strong>Accurate Information:</strong> Provide accurate, current, and complete information when creating an account.</li>
            <li><strong>No Impersonation:</strong> Do not impersonate any individual or entity, or falsely state or otherwise misrepresent yourself.</li>
        </ul>

        <h3>4. Content Ownership and License</h2>
        <ul>
            <li><strong>Your Content:</strong> You retain ownership of any content you post (e.g., blog entries, forum posts, comments). However, by posting, you grant Deep Dive a non-exclusive, worldwide, royalty-free license to use, distribute, modify, and display your content in connection with the Website.</li>
            <li><strong>Website Content:</strong> All content on the Website, including text, graphics, logos, and software, is the property of Deep Dive or its licensors. You may not copy, distribute, or create derivative works of this content without express written permission.</li>
        </ul>
        
            <h3>5. Prohibited Conduct</h2>
        <p>You agree not to:</p>
        <ul>
            <li>Use the Website for any unlawful purposes.</li>
            <li>Post spam, unsolicited advertisements, or promotional content.</li>
            <li>Harass, abuse, or harm other users.</li>
            <li>Attempt to hack, exploit vulnerabilities, or disrupt the Website’s services.</li>
            <li>Engage in any activity that violates any applicable law or regulation.</li>
        </ul>

        <h3>6. Account Suspension or Termination</h2>
        <p>We reserve the right to suspend or terminate your account at our sole discretion if we believe you have violated these Terms of Use. This includes but is not limited to inappropriate conduct, illegal activities, or posting prohibited content.</p>

        <h3>7. Disclaimer of Warranties</h2>
        <p>The Website is provided "as is" and "as available." We make no warranties or representations, express or implied, regarding the operation of the Website, the accuracy of the content, or its availability.</p>

        <h3>8. Limitation of Liability</h2>
        <p>To the fullest extent permitted by law, Deep Dive and its affiliates shall not be liable for any damages arising out of or in connection with your use of the Website. This includes, but is not limited to, direct, indirect, incidental, punitive, and consequential damages.</p>

        <h3>9. Third-Party Links</h2>
        <p>The Website may contain links to third-party websites or services. We are not responsible for the content, terms, or privacy practices of any third-party websites.</p>

        <h3>10. Contact Information</h2>
        <p>If you have any questions about these Terms of Use, please contact us at <a href="mailto:cybersix24@gmail.com">cybersix24@gmail.com</a>.</p>
    </div>
</div>

<?php include 'footer.php'; ?>
<script src="../js/sidebar.js"></script>
</body>
</html>
