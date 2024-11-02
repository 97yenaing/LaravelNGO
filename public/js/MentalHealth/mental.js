$(document).ready(function () {
    mainRiskCreate("mental-mrisk");
    $("#mental_mrisk").click(function () {
        subRiskCreate("mental-srisk", "#mental_mrisk");
    });
    $("#ifPWID").click(function () {
        pwidRisk();
    });
    $("#sucidalRisk").click(function () {
        sucidalRisk();
    });

    $("#drugUse").click(function () {
        drugUse();
    });

    $("#drugSexUse").click(function () {
        drugSexUse();
    });
    $("#injectDrugUse").click(function () {
        injectDrug();
    });
    $("#bi").click(function () {
        biref();
    });

    $("#phamacoMAM").click(function () {
        pharmacological();
    });
    $("#drugUseReassement").click(function () {
        drugassemnt();
    });

    $("#rebi").click(function () {
        birefRe();
    });
    $("#pharmaloTre input[type='checkbox']").click(function () {
        console.log("hello check");
        pharmaloTre();
    });

    $("#metal_toFollowBtn").click(function () {
        $("#mental_register,#metal_toFollowBtn").hide();
        $("#mental_follow,#metal_followBtn,#metal_toRegisterBtn").show();
        $("#mental_head").text(
            "Mental Health & Sexualized drug use- Follow Up Form"
        );
    });
    $("#metal_followBtn").click(function () {
        $("#patient_information,#mental_follow").hide();
        $("#mentalFollowHistory").show();
    });
    $("#toFollowForm").click(function () {
        $("#patient_information,#mental_follow").show();
        $("#mentalFollowHistory").hide();
    });
    $("#metal_toRegisterBtn").click(function () {
        $("#mental_register,#metal_toFollowBtn").show();
        $("#mental_follow,#metal_followBtn,#metal_toRegisterBtn").hide();
        $("#mental_head").text(
            "Update Mental Health & sexualized drug use– Registration Form"
        );
        $("#mental_follow input,#mental_follow select").val("");
        $("#mental_follow input[type='checkbox']").prop("checked", false);
        $("#mentaFollowBtn")
            .text("Save Mental Follow")
            .val("saveMentalFollow")
            .prop("disabled", true);
    });
});
