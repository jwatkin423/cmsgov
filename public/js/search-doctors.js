$(document).ready(function () {
    var $url = $('form.th').attr('data-url');
    $('input.typeahead-doctor').typeahead({
        minLength: 2,
        highlight: true,
        order: "asc",
        offset: true,
        source: function (query, process) {
            $.ajax({
                url: $url,
                type: 'POST',
                data: {'query': query},
                dataType: 'JSON',
                // async: true,
                success: function (data) {
                    console.log(data);
                    process(data);
                }
            });
        },
        displayText: function(item) {
            console.log("The item: " + item);
            $('#doctor-id').val(item.id);
            return item.id + ' – ' + item.doctor
        },
        select: function() {
            
        }
    });
});
