$(document).ready(function() {
    $('#toggleBtn').on('click', function() {
        $('#myPara').toggle();
    });

    $('#myPara').css('color', 'blue');
});