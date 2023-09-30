<?php
session_start();
if (!isset($_SESSION['username'])) {
?>
    <script>
        alert("Anda harus login!");
        document.location = "../index.php";
    </script>

<?php exit;
} ?>