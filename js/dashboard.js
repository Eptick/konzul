var sync = true;

function init_popuni_tablicu() {
    // Assign handlers immediately after making the request,
    // and remember the jqXHR object for this request
    var jqxhr = $.ajax("../api/dash_termini")
        .done(function(data) {
            var json = JSON.parse(data);
            console.log(json);
            var odd_even = 2;
            json.forEach(function(termin) {
                console.log(termin);
                var einput = $("<input></input>").attr("type", "checkbox").addClass("flat").attr("name", "table_records");
                var td1 = $("<td></td>").addClass("a-center").append(einput);
                var e1 = $("<td></td>").text(termin.id);
                var e2 = $("<td></td>").text(termin.hash);
                var e3 = $("<td></td>").text(termin.datum);
                var e4 = $("<td></td>").text(termin.start);
                var e5 = $("<td></td>").text(termin.end);
                var eButtonPrihvati = $("<button></button>").text("Prihvati").attr("hash", termin.hash).addClass("prihvati_termin btn btn-round btn-success");
                var eButtonOdbij = $("<button></button>").text("Odbij").attr("hash", termin.hash).addClass("odbij_termin btn btn-round btn-danger");
                var e6 = $("<td></td>").append(eButtonOdbij);
                var e7 = $("<td></td>").append(eButtonPrihvati);
                var e8 = $("<tr></tr>").append(td1).append(e1).append(e2).append(e3).append(e4).append(e5).append(e6).append(e7);
                $("#termini_dashboard_insert_tbody").append(e8);
            }, this);
            sync = false;
            //init_dash_datatables();
            $('input.flat').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });
            $('button.prihvati_termin').click(function() {

                $.post("../api/dash_prihvati", { hash: $(this).attr("hash") })
                    .done(function(data) {
                        console.log(data);
                        if (data == "success") {
                            new PNotify({
                                title: 'Termin prihvacen',
                                text: 'Termin je uspiješno prihvaćen i korisnik je obaviješten!',
                                type: 'success',
                                styling: 'bootstrap3'
                            });
                            $(this).parent().parent().remove();
                        } else {

                        }
                    }.bind(this));
            });
            $('button.odbij_termin').click(function() {

                $.post("../api/dash_odbij", { hash: $(this).attr("hash") })
                    .done(function(data) {
                        console.log(data);
                        if (data == "success") {
                            new PNotify({
                                title: 'Termin odbijen',
                                text: 'Termin je odbijen i korisnik je obavješten',
                                type: 'success',
                                styling: 'bootstrap3'
                            });
                            $(this).parent().parent().remove();
                        } else {

                        }
                    }.bind(this));
            });
        })
        .fail(function() {
            alert("error");
            sync = false;
        })

}

function init_dash_datatables() {
    if (typeof($.fn.DataTable) === 'undefined') { return; }
    console.log('init burek');
    //while (sync);


    var $datatable = $('#termini_dashboard');

    $datatable.dataTable({
        'order': [
            [1, 'asc']
        ],
        'columnDefs': [
            { orderable: false, targets: [0] }
        ]
    });
    $datatable.on('draw.dt', function() {
        $('checkbox input').iCheck({
            checkboxClass: 'icheckbox_flat-green'
        });
    });

}

$(document).ready(function() {
    init_popuni_tablicu();
});