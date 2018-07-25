$(document).ready(function () {
    $('.alert').fadeOut(3000);
    $('.delete-user').click(function () {
        event.preventDefault();
        if (confirm("Do you want to delete this user?")) {
            $(this).parent('form').submit();
        }
    });
});