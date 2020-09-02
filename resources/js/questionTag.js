$(function() {
    $(".js-modal-open").on("click", function() {
        $(".js-modal").fadeIn();
        return false;
    });
    let tagindex = $("#select_box_list").val();
    $(".js-check").on("click", function() {
        if ($(this).prop("checked") == true) {
            var index = $(".js-check").index(this);
            tagindex.push(index + 1);
        } else {
            var index = $(".js-check").index(this);
            let deleteindex = tagindex.indexOf(index + 1);
            tagindex.splice(deleteindex, 1);
        }
        $("#select_box_list").val(tagindex);
        console.log(index);
    });

    $(".js-modal-close").on("click", function() {
        $(".js-modal").fadeOut();
        return false;
    });

    $("select").each(function() {
        var select = $(this);
        var selected = $(this).data("selected");
        select
            .children('option[value="' + selected + '"]')
            .prop("selected", true);
    });
});
