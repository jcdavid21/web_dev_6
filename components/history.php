<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History</title>
    <link rel="stylesheet" href="../styles/header.css">
    <link rel="stylesheet" href="../styles/footer.css">
    <link rel="stylesheet" href="../styles/general.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'DM Sans', sans-serif;
            background-color: #f5f4ed; /* Cream background */
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .history-container {
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
            max-height: 600px; /* Set a max height for the scrollable area */
        }
        h1 {
            color: #f6a425; /* Change heading text color to orange */
        }
        .history-container p {
            text-align: justify;
        }

        .grid-con{
    display: grid;
    grid-template-columns: 260px 1fr 0;
    align-items: start;
    justify-content: center;
    margin-top: 80px;
}

    </style>
</head>
<body>
<?php include 'header.php'; ?>


<div class="grid-con"
style="<?php echo empty($_SESSION['user_id']) ? 'grid-template-columns: 50px 1fr 0' : ''; ?>">
    <?php if (!empty($_SESSION['user_id'])): ?>
        <?php include 'spaces.php'; ?>
    <?php else: ?>
        <div class="space"></div>
    <?php endif; ?>

    <div class="history-container">
        <h1>History</h1>
        <p>
            CyberSix began as a collaborative effort among a small group of passionate writers, developers, and digital enthusiasts who saw the need for a more engaging and inclusive online community. The name “CyberSix” represents our core philosophy—six pillars that guide everything we do: Community, Curiosity, Creativity, Collaboration, Conversation, and Connection. As the digital landscape evolves, so does CyberSix. What started as a modest forum has grown into a vibrant platform where users from all walks of life can share their stories, dive deep into discussions, and explore new ideas. Our blogging tools empower creators to publish their thoughts, experiences, and expertise while connecting with a supportive and engaged audience.
        </p>
        <h1>What We Believe In</h1>
        <p>
            At CyberSix, we’re not just another website; we’re a community. We believe in creating a space where everyone’s voice matters and where different ideas can coexist, be challenged, and evolve. Our platform is built on these core values:
        </p>
        <p><strong>Open Expression</strong> - Whether you’re here to blog, post in forums, or simply engage with others, CyberSix is a place for open dialogue and the exchange of ideas.</p>
        <p><strong>Creativity</strong> - We embrace the power of creativity in all forms, from personal blogs to thought-provoking forum discussions, and encourage everyone to share their unique perspectives.</p>
        <p><strong>Inclusivity</strong> - We’re committed to making CyberSix a welcoming space for all, regardless of background, interests, or expertise. Everyone has something valuable to contribute.</p>
        <p><strong>Collaboration</strong> - CyberSix is about building together. Whether it’s collaborating on a forum discussion, offering advice, or working on joint projects, we believe in the strength of community.</p>
        
        <h1>Join Our Journey</h1>
        <p>
            In 2024, Cybersix launched as a fresh alternative to traditional forums and blogging platforms, but we are just getting started. Our mission is to continuously evolve, providing a space where users can grow alongside us, exchange ideas, and make lasting connections. We invite you to become part of the Cybersix community. Whether you’re looking to blog about your passions, participate in diverse discussions, or simply find a space where your voice matters, there’s a place for you here.
        </p>
    </div>
</div>

<?php include 'footer.php'; ?>
<script src="../js/sidebar.js"></script>
</body>
</html>
