<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $to = "suriyagurumoorthi02@gmail.com"; // Your email
    $subject = strip_tags(trim($_POST["subject"]));
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = strip_tags(trim($_POST["message"]));

    // Validate input
    if (empty($name) || empty($email) || empty($subject) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Please fill out the form correctly.";
        exit;
    }

    // Email Headers
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Email Body
    $body = "You received a message from your portfolio contact form:\n\n";
    $body .= "Name: $name\n";
    $body .= "Email: $email\n";
    $body .= "Subject: $subject\n\n";
    $body .= "Message:\n$message\n";

    // Try sending the email
    if (mail($to, $subject, $body, $headers)) {
        echo "success";
    } else {
        // Optional: log the error or show friendly message
        error_log("Mail failed to send to $to.");
        echo "error";
    }
} else {
    http_response_code(405);
    echo "405 Method Not Allowed";
}
?>
