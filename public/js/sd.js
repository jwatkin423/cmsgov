$(document).ready(function () {
    var $url = $('form#form-user_v1').attr('data-url');

    $.typeahead({
        input: '.th-doctor',
        minLength: 1,
        order: "asc",
        dynamic: true,
        group: {
            template: "{{group}}"
        },
        backdrop: {
            "background-color": "#fff"
        },
        template: function (query, item) {
            var color = "#777";
            return '<span class="username">{{doctor}}</span> - <span class="city">{{city}}</span>, <span class="city">{{state}}</span>  - <span class="city">{{pub_date}}</span>';
        },
        emptyTemplate: "no result for {{query}}",
        source: {
            "doctor": {
                display: "doctor",
                ajax: function (query) {
                    return {
                        type: "post",
                        url: $url,
                        dataType: 'JSON',
                        data: {
                            query: "{{query}}"
                        }
                    }
                }
            },
            "city": {
                display: "city",
                ajax: function (query) {
                    return {
                        type: "post",
                        url: $url,
                        dataType: 'JSON',
                        data: {
                            query: "{{query}}"
                        }
                    }
                }
            },
            "Pub_date": {
                display: "pub_date",
                ajax: function (query) {
                    return {
                        type: "post",
                        url: $url,
                        dataType: 'JSON',
                        data: {
                            query: "{{query}}"
                        }
                    }
                }
            },
            "state": {
                display: "state",
                ajax: function (query) {
                    return {
                        type: "post",
                        url: $url,
                        dataType: 'JSON',
                        data: {
                            query: "{{query}}"
                        }
                    }
                }
            }
        },
        callback: {
            onClick: function (node, a, item, event) {
                $('#th-doctor').val(item.doctor);
                $('#th-id').val(item.id);
            }
        }
    })
});