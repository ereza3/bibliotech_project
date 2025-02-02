<?php
require_once('../Repository/ContactRepository.php');
require_once('../Model/Contact.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class ContactController {

    private $contactRepo;

    public function __construct() {
        $this->contactRepo = new ContactRepository();
    }

    public function handleContactForm() {
        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $message = trim($_POST['message']);

            // Basic validation
            if (empty($name) || empty($email) || empty($message)) {
                $_SESSION['error'] = "All fields are required.";
                header('Location: ../View/contact.php');
                exit();
            }

            // Create Contact object
            $contact = new Contact($name, $email, $message);

            // Store in the database
            $isSaved = $this->contactRepo->save($contact);  // FIXED: Call save()

            if ($isSaved) {
                $_SESSION['success'] = "Your message has been sent successfully!";
            } else {
                $_SESSION['error'] = "Failed to send your message. Please try again later.";
            }

            // Redirect back to the contact page
            header('Location: ../View/contact.php');
            exit();
        }
    }
}

// Instantiate and call the function
$contactController = new ContactController();
$contactController->handleContactForm();
