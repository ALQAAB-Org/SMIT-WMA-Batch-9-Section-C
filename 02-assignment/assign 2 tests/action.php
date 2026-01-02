<?php
// Error reporting band karen
error_reporting(0);

// Agar form submit hua hai
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Saara POST data collect karen
    $form_data = $_POST;
    
    // Data save karne ka function
    function saveFormData($data) {
        $filename = 'form_data.txt';
        $timestamp = date('Y-m-d H:i:s');
        
        $log_entry = "=== Form Submission - $timestamp ===\n";
        foreach($data as $key => $value) {
            $safe_value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
            $log_entry .= "$key: $safe_value\n";
        }
        $log_entry .= "=== End Submission ===\n\n";
        
        return file_put_contents($filename, $log_entry, FILE_APPEND | LOCK_EX);
    }
    
    // Data save karen
    if(!empty($form_data)) {
        $saved = saveFormData($form_data);
        
        if($saved) {
            // Cache prevent karne ke liye random parameter add karen
            echo "<script>
                alert('Form submitted successfully! Data saved.');
                window.location.href = 'form.html?' + Math.random();
            </script>";
        } else {
            echo "<script>
                alert('Error saving data. Please try again.');
                window.history.back();
            </script>";
        }
    }
    
} else {
    // Agar directly access kiya hai
    echo "Form processor - Access via form submission only.";
}
?>