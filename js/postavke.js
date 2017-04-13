function init_sliders_datum()
{
    if( typeof ($.fn.ionRangeSlider) === 'undefined'){ return; }
		console.log('init_IonRangeSlider');
        moment.locale("hr");
    $(".vrijeme_od_do").ionRangeSlider({
        hide_min_max: true,
        min: 0,
        max: 24*60,
        from: 60*8,
        to: 17*60,
        type: 'double',
        step: 5,
        grid: true,
		prettify: function(num) {
            var sati = Math.round(num/60);
            var string_sati = String(sati);

            var minuta = Math.round(num%60);
            var string_minuta = String(minuta);
            
            console.log(string_sati.length);

            if(string_sati.length == 1)
            {
                string_sati = "0" + string_sati;
            }
            if(string_minuta.length == 1)
            {
                string_minuta = "0" + string_minuta;
            }
         return string_sati + ":" + string_minuta;
    }
    });
    

};
function init_prikazivanje_slidera()
{
    $(".js-switch").click( function () {
        if( $(this).is(":checked")) 
        {
            $("#range"+$(this).attr("id")).parent().addClass("showRange");
        } 
         else 
        {
            $("#range"+$(this).attr("id")).parent().removeClass("showRange");
        }
    });
}

$(document).ready(function() {
   init_sliders_datum();
   init_prikazivanje_slidera();
});	