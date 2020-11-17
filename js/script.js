const url = window.location.search;
const sUrl = url.split('=')[1];


$('#keyword').on('keyup', function() {
    $('#container').load(`ajax/${sUrl}.php?keyword=${$('#keyword').val()}`);
});