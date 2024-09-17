function logoutuser() {

    // Prevent the default event bubbling action if the confirmation is canceled
    event.stopPropagation();

    if (confirm('Are you sure you want to logout?')) {
        // window.location.href = '../../src/controllers/logout.php';
        window.location.href = '/Anubhavphpprac/src/controllers/logout.php';
    }
}