(function($) {
'use strict';
    $('.btn-approve').on('click', function() {
        var id = $(this).closest('tr').data('id');
        $('#approve-id').val(id);
    });
    
    $('.btn-reject').on('click', function() {
        var id = $(this).closest('tr').data('id');
        $('#reject-id').val(id);
    });

})(jQuery);