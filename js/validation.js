function init_validacija_reg() {

    if (typeof(validator) === 'undefined') { return; }
    console.log('Validacija registracije', validator);

    // initialize the validator function
    validator.message.date = 'not a real date';


    validator.message.invalid = 'Neispravan unos',
        validator.message.short = 'Premalo znakova',
        validator.message.long = 'Previše znakova',
        validator.message.checked = 'Mora biti označeno',
        validator.message.empty = 'Potreban unos',
        validator.message.select = 'Odaberite jednu od',
        validator.message.number_min = 'Premala brijednost',
        validator.message.number_max = 'Prevelika vrijednost',
        validator.message.url = 'Pogrešan url',
        validator.message.number = 'Unesite broj',
        validator.message.email = 'Unesite valjanu mail adresu',
        validator.message.email_repeat = 'Vrijednosti se ne poklapaju',
        validator.message.date = 'Pogrešan datum',
        validator.message.time = 'Pogrešno vrijeme',
        validator.message.password_repeat = 'Lozinke se ne podudaraju',
        validator.message.no_match = 'Vrijednosti se ne podudaraju',
        validator.message.complete = 'Input nije izvršen'


    // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
    $('#form_registracija')
        .on('blur', 'input[required="required"], input.optional, select.required', validator.checkField)
        .on('change', 'select.required', validator.checkField)
        .on('keypress', 'input[required][pattern]', validator.keypress);


    $('#form_registracija').submit(function(e) {
        e.preventDefault();
        var submit = true;

        // evaluate the form using generic validaing
        if (!validator.checkAll($(this))) {
            submit = false;
        }
        console.log(this)

        if (submit)
            this.submit();

        return false;
    });

};

$(document).ready(function() {
    init_validacija_reg();
    $("#phone").intlTelInput({
        autoPlaceholder: "on",
        formatOnDisplay: true,
        initialCountry: "hr",
        placeholderNumberType: "MOBILE",
          utilsScript: "js/utils.js"
    });
});