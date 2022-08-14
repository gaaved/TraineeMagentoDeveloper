function getId(id) {
    document.getElementById('getId').value = id;
}

function getStar(id, star) {
    $.ajax({
        type: "POST",
        url: 'Controller.php',
        data: {star: star, id: id, action_type: 'addRating'},
        success: function (data) {
        }
    });
    document.getElementById(id+'star-rating').style = "pointer-events: none; cursor: default;";
}