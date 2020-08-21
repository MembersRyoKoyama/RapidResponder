$(document).ready(function() {
    $(".tagSelector").click(function() {
        if ($(this).hasClass("button-dark")) {
            $(this)
                .removeClass("button-dark")
                .addClass("button-outline-big");
        } else {
            $(this)
                .addClass("button-dark")
                .removeClass("button-outline-big");
            $(".questionListTable").append("<x-button text='aaa' />");
        }
    });
});
