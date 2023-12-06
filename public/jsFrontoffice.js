
document.addEventListener("DOMContentLoaded", function () {
    const phoneInputField = document.querySelector("#phone");
    const countryDropdown = document.querySelector("#pays");

    if (phoneInputField && countryDropdown) {
        const phoneInput = window.intlTelInput(phoneInputField, {
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
            initialCountry: "tn", // Set the default country to Tunisia ("TN"),
            nationalMode: false, // Disable country-specific validation
        });

        countryDropdown.addEventListener("change", function () {
            // Get the selected country code from the dropdown
            const selectedCountry = this.value;

            // Update the phone input's initial country based on the selected country
            phoneInput.setCountry(selectedCountry);
        });
    }
});



$('#hover-dropdown1').hover(
    function () {
        $(this).addClass('show');
        $(this).find('.dropdown-menu').addClass('show');
    },
    function () {
        $(this).removeClass('show');
        $(this).find('.dropdown-menu').removeClass('show');
    }
);






$('#hover-dropdown2').hover(
    function () {
        $(this).addClass('show');
        $(this).find('.dropdown-menu').addClass('show');
    },
    function () {
        $(this).removeClass('show');
        $(this).find('.dropdown-menu').removeClass('show');
    }
);




$('#hover-dropdown3').hover(
    function () {
        $(this).addClass('show');
        $(this).find('.dropdown-menu').addClass('show');
    },
    function () {
        $(this).removeClass('show');
        $(this).find('.dropdown-menu').removeClass('show');
    }
);



$('#hover-dropdown4').hover(
    function () {
        $(this).addClass('show');
        $(this).find('.dropdown-menu').addClass('show');
    },
    function () {
        $(this).removeClass('show');
        $(this).find('.dropdown-menu').removeClass('show');
    }
);


$('#hover-dropdown5').hover(
    function () {
        $(this).addClass('show');
        $(this).find('.dropdown-menu').addClass('show');
    },
    function () {
        $(this).removeClass('show');
        $(this).find('.dropdown-menu').removeClass('show');
    }
);


$('#hover-dropdown6').hover(
    function () {
        $(this).addClass('show');
        $(this).find('.dropdown-menu').addClass('show');
    },
    function () {
        $(this).removeClass('show');
        $(this).find('.dropdown-menu').removeClass('show');
    }
);


$('#hover-dropdown7').hover(
    function () {
        $(this).addClass('show');
        $(this).find('.dropdown-menu').addClass('show');
    },
    function () {
        $(this).removeClass('show');
        $(this).find('.dropdown-menu').removeClass('show');
    }
);


$('#hover-dropdown8').hover(
    function () {
        $(this).addClass('show');
        $(this).find('.dropdown-menu').addClass('show');
    },
    function () {
        $(this).removeClass('show');
        $(this).find('.dropdown-menu').removeClass('show');
    }
);





$('#hover-dropdown9').hover(
    function () {
        $(this).addClass('show');
        $(this).find('.dropdown-menu').addClass('show');
    },
    function () {
        $(this).removeClass('show');
        $(this).find('.dropdown-menu').removeClass('show');
    }
);
$('#hover-dropdown10').hover(
    function () {
        $(this).addClass('show');
        $(this).find('.dropdown-menu').addClass('show');
    },
    function () {
        $(this).removeClass('show');
        $(this).find('.dropdown-menu').removeClass('show');
    }
);
