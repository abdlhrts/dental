import $ from "jquery";

$("#light-button").on("click", function () {
    $("html").removeClass("dark");
});

$("#dark-button").on("click", function () {
    $("html").addClass("dark");
});
