function init_sliders_datum() {
    if (typeof($.fn.ionRangeSlider) === 'undefined') { return; }
    moment.locale("hr");
    $(".vrijeme_od_do").ionRangeSlider({
        hide_min_max: true,
        min: 0,
        max: 24 * 60,
        from: 60 * 8,
        to: 17 * 60,
        type: 'double',
        step: 5,
        grid: true,
        prettify: function(num) {
            var sati = Math.round(num / 60);
            var string_sati = String(sati);

            var minuta = Math.round(num % 60);
            var string_minuta = String(minuta);

            if (string_sati.length == 1) {
                string_sati = "0" + string_sati;
            }
            if (string_minuta.length == 1) {
                string_minuta = "0" + string_minuta;
            }
            return string_sati + ":" + string_minuta;
        }
    });


};

function init_prikazivanje_slidera() {
    $(".js-switch").click(function() {
        if ($(this).is(":checked")) {
            $("#range" + $(this).attr("id")).parent().addClass("showRange");
        } else {
            $("#range" + $(this).attr("id")).parent().removeClass("showRange");
        }
    });
}

function init_submit_dostupni_termini() {
    $("#dostupnost_termina").submit("submit", function(event) {
        event.preventDefault();

        console.log($(this).serialize());

        $.post('../../api/dostupni_termini', $(this).serialize(), function(data) {
            console.log(data);
            if (data === "success") {
                if (!$("#submit-dostupni-termini").hasClass("btn-success")) {
                    $("#submit-dostupni-termini").addClass("btn-success");
                    $("#submit-dostupni-termini").removeClass("btn-danger");
                }
            } else {
                if (!$("#submit-dostupni-termini").hasClass("btn-danger")) {
                    $("#submit-dostupni-termini").addClass("btn-danger");
                    $("#submit-dostupni-termini").removeClass("btn-success");
                }
            }
        });

    });
}



$(document).ready(function() {

    init_sliders_datum();
    init_prikazivanje_slidera();
    init_submit_dostupni_termini();
});