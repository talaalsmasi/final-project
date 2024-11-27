$(document).ready(function() {
    // Toggle the log-in class when the .info-item .btn is clicked
    $(".info-item .btn").click(function() {
        $(".container").toggleClass("log-in");
    });

    // Add the active class to the .container when the .container-form .btn is clicked
    $(".container-form .btn").click(function() {
        $(".container").addClass("active");
    });
});
