$(document).ready(function () {
    $("#agey_register").change(function () {
        dob_input = "";
    });
    $("#vDate").val(todayIn);

    $("#phq4").click(function () {
        console.log("hello phq4");
        if ($(this).prop("checked") == true) {
            $(".phpq4_detail").removeClass("phq4-hide");
            $(".phpq4_detail").addClass("phq4-show");
        } else {
            $(".phpq4_detail").addClass("phq4-hide");
            $(".phpq4_detail").removeClass("phq4-show");
            $(".phpq4_detail select,.phpq4_detail input[type='number']").val(
                ""
            );

            $(".phpq4_detail input[type='checkbox']").prop("checked", false);
        }
    });
    $(".adjust-button").click(function () {
        $(".phpq4_detail").addClass("phq4-hide");
        $(".phpq4_detail").removeClass("phq4-show");
    });
});
