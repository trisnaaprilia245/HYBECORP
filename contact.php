<?php
session_start();
require_once 'koneksi.php';

define('SITE_NAME', 'HYBE CORPORATION');
$pageTitle = "Contact Us";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $message = $_POST['message'] ?? '';
    
    // Basic validation
    $errors = [];
    if (empty($name)) $errors[] = 'Name is required';
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email is required';
    if (empty($subject)) $errors[] = 'Subject is required';
    if (empty($message)) $errors[] = 'Message is required';
    
    if (empty($errors)) {
        // In a real app, you would save to database and send email
        $success = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= SITE_NAME ?> | <?= $pageTitle ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Reuse styles from index.php */
        :root {
            --hybe-red: #ff2e2e;
            --hybe-dark: #121212;
            --hybe-light: #f8f9fa;
        }
        
        .contact-form {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            padding: 30px;
        }
        
        .contact-info-card {
            background-color: var(--hybe-dark);
            color: white;
            border-radius: 10px;
            padding: 30px;
            height: 100%;
        }
        
        .contact-icon {
            font-size: 1.5rem;
            color: var(--hybe-red);
            margin-right: 15px;
        }
        
        .form-control:focus {
            border-color: var(--hybe-red);
            box-shadow: 0 0 0 0.25rem rgba(255, 46, 46, 0.25);
        }
    </style>
</head>
<body>
    <!-- Navbar (same as index.php) -->
    <?php include 'navbar.php'; ?>

    <!-- Contact Header -->
    <section class="py-5 bg-dark text-white">
        <div class="container text-center">
            <h1 class="display-4 fw-bold">Contact HYBE</h1>
            <p class="lead">We'd love to hear from you</p>
        </div>
    </section>

    <!-- Contact Content -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 mb-4 mb-lg-0">
                    <div class="contact-form">
                        <h2 class="mb-4">Send us a message</h2>
                        
                        <?php if (!empty($errors)): ?>
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    <?php foreach ($errors as $error): ?>
                                        <li><?= htmlspecialchars($error) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (isset($success) && $success): ?>
                            <div class="alert alert-success">
                                Thank you for your message! We'll get back to you soon.
                            </div>
                        <?php endif; ?>
                        
                        <form method="POST">
                            <div class="mb-3">
                                <label for="name" class="form-label">Your Name</label>
                                <input type="text" class="form-control" id="name" name="name" required
                                    value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
                            </div>
                            
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" required
                                    value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                            </div>
                            
                            <div class="mb-3">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" class="form-control" id="subject" name="subject" required
                                    value="<?= htmlspecialchars($_POST['subject'] ?? '') ?>">
                            </div>
                            
                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" id="message" name="message" rows="5" required><?= 
                                    htmlspecialchars($_POST['message'] ?? '') 
                                ?></textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-hybe">Send Message</button>
                        </form>
                    </div>
                </div>
                
                <div class="col-lg-5">
                    <div class="contact-info-card">
                        <h2 class="mb-4">Contact Information</h2>
                        
                        <div class="d-flex align-items-start mb-4">
                            <i class="fas fa-map-marker-alt contact-icon"></i>
                            <div>
                                <h5>Address</h5>
                                <p>Yongsan, Seoul, South Korea</p>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-start mb-4">
                            <i class="fas fa-phone contact-icon"></i>
                            <div>
                                <h5>Phone</h5>
                                <p>+82 02-567-1277</p>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-start mb-4">
                            <i class="fas fa-envelope contact-icon"></i>
                            <div>
                                <h5>Email</h5>
                                <p>contact@hybeim.com</p>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-start">
                            <i class="fas fa-clock contact-icon"></i>
                            <div>
                                <h5>Business Hours</h5>
                                <p>Monday - Friday: 9:00 AM - 6:00 PM<br>
                                Saturday - Sunday: Closed</p>
                            </div>
                        </div>
                        
                        <hr class="bg-light my-4">
                        
                        <h5 class="mb-3">Follow Us</h5>
                        <div class="social-icons">
                            <a href="https://x.com/HYBEOFFICIALtwt?s=09" class="text-white me-3" target="_blank">
                                <i class="fab fa-twitter fa-lg"></i>
                            </a>
                            <a href="https://www.instagram.com/hybe.labels.audition?igsh=a3hpN3BqcHMxcDhu" class="text-white me-3" target="_blank">
                                <i class="fab fa-instagram fa-lg"></i>
                            </a>
                            <a href="https://www.youtube.com/@HYBELABELS" class="text-white me-3" target="_blank">
                                <i class="fab fa-youtube fa-lg"></i>
                            </a>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="pb-5">
        <div class="container">
            <div class="ratio ratio-16x9">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3162.666346199687!2d126.97282631564798!3d37.55197923263934!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzfCsDMzJzA3LjEiTiAxMjbCsDU4JzI3LjkiRQ!5e0!3m2!1sen!2sus!4v1620000000000!5m2!1sen!2sus" 
                        allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </section>

    <!-- Footer (same as index.php) -->
    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>