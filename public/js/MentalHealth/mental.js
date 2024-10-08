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
});
