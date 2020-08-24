$(function() {
    $(".js-modal-open").on("click", function() {
        $(".js-modal").fadeIn();
        return false;
    });

    $(".js-check").on("click", function() {
        $("#select_box_list").val("0");
    });

    $(".js-modal-close").on("click", function() {
        $(".js-modal").fadeOut();
        return false;
    });
});
