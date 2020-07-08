$(document).ready(function() {
    const formMinHeight = 200;
    const headerHeight = $("#header").height();
    $("#dummyForm").click(function() {
        $(this).hide();
        $("#form")
            .show()
            .height(formMinHeight);
        $("#message").focus();
        $("#questionViewTable").css({ "margin-bottom": formMinHeight });
    });
    let is_drag = false;
    let mY;
    $("#handle").on("mousedown", function(e) {
        is_drag = true;
        mY = e.pageY;
    });

    $("html").on("mouseup mouseleave", function() {
        is_drag = false;
    });

    $("html").on("mousemove", function(e) {
        if (is_drag === true) {
            let dY = mY - e.pageY;
            mY = e.pageY;
            let h = $("#form").height();
            if (
                h + dY > formMinHeight &&
                h + dY < $(window).height() - headerHeight - 17
            ) {
                $("#form").height(h + dY);
            }
            $("#questionViewTable").css({ "margin-bottom": h + dY });
        }
    });
});
