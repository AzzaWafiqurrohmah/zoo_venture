function displayFormErrors(errors) {
    for(const [key, value] of Object.entries(errors)) {
        const input = $(`#${key}`);

        input.addClass('is-invalid');
        input.next().html(value[0]);
    }
}

function removeFormErrors() {
    $('.form-control').removeClass('is-invalid');
    $('.invalid-feedback').html('');
}

function fillFormdata(data) {
    for(const [key, value] of Object.entries(data))
        $(`#${key}`).val(value);
}
