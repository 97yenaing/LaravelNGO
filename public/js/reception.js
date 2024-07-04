$(document).ready(function () {
    var year = today.split("-")[0];

    $("#clinic_code").val(mam_clinicID);
    $(".reception_id").prop("disabled", true);
    $("#resDiaSecton div ul li select").prop("disabled", true);

    // serach name
    function check(text) {
        only_serach_name = [];
        $.each(serch_name_result, function (index, value) {
            only_serach_name[index] = value["Name"];
        });
        rec_listName = [];
        rec_list = [];
        var list = 0;
        only_serach_name.filter(function (item) {
            rec_list[list] = item.toLowerCase().includes(text.toLowerCase());
            if (rec_list[list] == true) {
                rec_listName[list] = item;
            }
            list++;
        });
    }

    $("#search_input_name").change(function () {
        $("#show_name_result table tbody tr").remove();
        if ($("#search_input_name").val().length > 1) {
            check($("#search_input_name").val());
            keys = Object.keys(rec_listName);
            console.log(keys);
            if (keys.length > 0) {
                $.each(keys, function (index, value) {
                    var show_name = $("<tr>")
                        .append($("<td>").text(serch_name_result[value]["Pid"]))
                        .append(
                            $("<td>").text(serch_name_result[value]["FuchiaID"])
                        )
                        .append(
                            $("<td>").text(serch_name_result[value]["Name"])
                        )
                        .append(
                            $("<td>").text(serch_name_result[value]["Father"])
                        )
                        .append(
                            $("<td>").text(serch_name_result[value]["Agey"])
                        )
                        .append(
                            $("<td>").text(serch_name_result[value]["Reg Date"])
                        );
                    $("#show_name_result table tbody").append(show_name);
                });
            }
        }
    });

    $("#patientExport").click(function () {
        $("#export-container").table2excel({
            exclude: ".noExl",
            name: "Excel Document Name",
            filename: "excel-file-name",
            fileext: ".xls",
            exclude_img: true,
            exclude_links: true,
            exclude_inputs: true,
            preserveColors: true,
            excelHeader: "excel-header",
            excelText: "excel-text",
        });
    });

    if ($("#he_code").find("option").length < 2) {
        for (var i = 1; i < 31; i++) {
            $("#he_code").append(
                $("<option>", {
                    value: i,
                    text: i,
                })
            );
        }
    } // add option to peer code

    $("#gneralcheck").change(function () {
        console.log("hello general");
        if ($("#gneralcheck").is(":checked")) {
            updateCheck = "click";
        } else {
            updateCheck = "noclick";
            $("#general_new_old").val("-");
        }
        generalCheck();
    });
    $("#ncdcheck").change(function () {
        if ($("#ncdcheck").is(":checked")) {
            updateCheck = "click";
        } else {
            updateCheck = "noclick";
            $("#ncd_new_old").val("-");
        }
        ncdCheck();
    });

    $("#gneralcheckupdate").change(function () {
        if ($("#gneralcheckupdate").is(":checked")) {
            updateCheck = "fromUpdate";
        } else {
            updateCheck = "noupdate";
            $("#general_new_oldupdate").val("-");
        }

        generalCheck();
    });
    $("#ncdcheckupdate").change(function () {
        if ($("#ncdcheckupdate").is(":checked")) {
            updateCheck = "fromUpdate";
        } else {
            updateCheck = "noupdate";
            $("#ncd_new_oldupdate").val("-");
        }
        ncdCheck();
    });
    $(".resDiaBlock ul li input[type='checkbox']").click(function () {
        var diease_checkId = event.target.id;
        var checkParentId = $("#" + diease_checkId)
            .parent()
            .parent()
            .attr("id");
        if ($("#" + diease_checkId).not(":checked").length > 0) {
            $("#" + checkParentId + " li select").val("");
            $("#" + checkParentId + " li select").prop("disabled", true);
        } else {
            $("#" + checkParentId + " li select").prop("disabled", false);
        }
    }); // if not check in disease category cancelling all data

    // validation section for muac and diagnosis

    $("#weight").change(function () {
        var weight = $("#weight").val();
        if (weight < 445 && parseFloat(weight) > 0.21) {
            console.log("weight OK");
        } else {
            alert("Your weight input is impossible.");
            $("#weight").val("");
            $("#weight").focus();
        }
    });
    $("#heigth").change(function () {
        var height = $("#heigth").val();
        if (height < 275 && height > 24) {
            console.log("Height is OK");
        } else {
            alert("Your height input is impossible");
            $("#heigth").val("");
            $("#heigth").focus();
        }
    });
    $("#phacheck,#artcheck,#prepcheck").click(function () {
        if ($("#phacheck").is(":checked")) {
            $("#artcheck,#prepcheck").prop("disabled", true);
        } else if ($("#artcheck").is(":checked")) {
            $("#phacheck,#prepcheck").prop("disabled", true);
        } else if ($("#prepcheck").is(":checked")) {
            $("#phacheck,#artcheck").prop("disabled", true);
        } else {
            $("#phacheck,#prepcheck,#artcheck").prop("disabled", false);
        }
    }); // input check validation

    $("#phacheckupdate,#artcheckupdate,#prepcheckupdate").click(function () {
        pha_art_prepUPdateCheck(); // functio in blade
    }); //update check validation some are in blade updateFiller

    $("#preCode_define").click(function () {
        var topval = "50px";
        if ($(this).hasClass("pres-open")) {
            topval = "-100%";
            $(this).removeClass("pres-open");
            $(this).css("background-color", "#198754");
            console.log("Pres_open here ! has class");
        } else {
            console.log("Pres_open here !");
            $(this).addClass("pres-open");

            $(this).css("background-color", "#dd2727");
        }

        $(".predefine-section").stop().animate(
            {
                top: topval,
            },
            500
        );
    });
});
