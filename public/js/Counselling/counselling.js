$(document).ready(function () {
    $("#agey_register").change(function () {
        dob_input = "";
    });
    $("#vDate").val(todayIn);

    $("#q1_q2_amount").change(function () {
        q1q2();
    });
    $("#q3_q4_amount").change(function () {
        q3q4();
    });

    $("#mentalScreen").click(function () {
        console.log("hello mental");
        mental_show_hide();
    });
    $("#back_counselling").click(function () {
        console.log("hello back");
        backCounselling();
    });
});
