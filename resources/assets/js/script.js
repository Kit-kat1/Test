const baseURL = window.location.origin;
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function reRenderTable(data) {
        let $table =  $('.table');
        const $tbody = $table.find('tbody');
        $tbody.remove();

        let $newTBody = '<tbody>' +
            '<tr>' +
            '<td>' +
            '<input type="search" data-type="users" class="form-control search" placeholder="Search">' +
            '</td>' +
            '<td>' +
            '<input type="search" data-type="products" class="form-control search" placeholder="Search">' +
            '</td>' +
            '</tr>';

        for (let i=0; i < data.length; i++) {
            let price = parseFloat(data[i].price) * data[i].quantity;

            $newTBody += ' <tbody>' +
                '<tr>' +
                '<td>' + data[i].user + '</td>' +
                '<td>' + data[i].product + '</td>' +
                '<td>' + data[i].date + '</td>' +
                '<td>' + price + '</td>' +
                '<td>' +
                '<a href="#"><i class="fa fa-pencil"></i></a>' +
                '<a href="#"><i class="fa fa-trash"></i></a>' +
                '</td>' +
                '</tr>';
        }

        $newTBody += '</tbody>';
        $table.append($newTBody);
    }

   $('input[type=radio]').on('change', function (event) {
       const $input = $(event.target);
       const option = $input.val();

       $.ajax({
           method: 'GET',
           url: baseURL + '/orders',
           data: {
               interval: option
           }
       }).done(function (data) {
           reRenderTable(data);
       }).fail(function () {
           alert('Something went wrong. Please, reload page and try again.')
       });
   });

    $(document).on('click', '.delete', function () {
        $.ajax({
            type: 'DELETE',
            url: $(this).data('url')
        }).done(function () {
            location.reload();
        });
    });

    $(document).on('click', '.edit', function () {
        const url = $(this).data('url');
        const user = $(this).data('user');
        const product = $(this).data('product');
        const token = $('meta[name="csrf-token"]').attr('content');

        $(document.body).append(
            '<div class="modal fade media-modal" tabindex="-1" role="dialog">' +
            '<div class="modal-dialog" role="document">' +
            '<div class="modal-content">' +
            '<div class="modal-header">' +
            '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
            '<h4 class="modal-title">Edit order</h4>' +
            '</div>' +
            '<div class="modal-body">' +
            '<form class="container-fluid edit-form" action="' + url + '" method="POST">' +
            '<input type="hidden" name="_token" value="' + token + '">' +
            '<input type="hidden" name="_method" value="PUT">' +
            '<div class="form-group col-md-3">' +
            '<label for="user">User </label>' +
            '<select class="form-control" disabled>' +
            '<option>' + user + '</option>' +
            '</select>' +
            '</div>' +
            '<div class="form-group col-md-3">' +
            '<label for="product">Product </label>' +
            '<select class="form-control" disabled>' +
            '<option>' + product + '</option>' +
            '</select>' +
            '</div>' +
            '<div class="form-group col-md-3">' +
            '<label for="quantity">Quantity </label>' +
            '<input class="form-control" type="number" name="quantity" value="1">' +
            '</div>' +
            '</form>' +
            '</div>' +
            '<div class="modal-footer">' +
            '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
            '<input type="button" class="btn btn-info update" value="Update">' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>');

        $('.modal').modal('show');
    });

    $(document).on('hidden.bs.modal', '.media-modal', function () {
        $('.modal').remove();
    });

    $(document).on('click', '.update', function () {
        $('.edit-form').submit();
    });

    $(document).on('keypress', '.search', function (event) {
        if (event.keyCode === 13) {
            $.ajax({
                url: baseURL + '/orders/filter',
                method: 'GET',
                data: {
                    'key': $(this).val(),
                    'type': $(this).data('type')
                }
            }).done(function (data) {
                reRenderTable(data);
            }).fail(function () {
                alert('Something went wrong. Please, reload page and try again.')
            });
        }
    });
});
