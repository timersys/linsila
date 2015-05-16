(function( $ ) {
	'use strict';
    $(document).foundation();

    $(document).ready(function(){
        /**
         * Add lists
         */
        $('.add-a-list').click(function (e) {
            if( $('a.js-cancel-edit').is(e.target) )
                return false;
            $(this).removeClass('idle');
            $(this).find('.list-name').focus();
        });
        $('.add-a-list .cancel').click(function (e) {
            e.preventDefault();
            $(this).closest('.add-a-list').addClass('idle');
        });

        $('.js-save-list').click(function(e){
            e.preventDefault();

        });

    });

    $(document).mouseup(function (e) {
        var add_list = $('.add-a-list');
        if ( $('a.js-cancel-edit').is(e.target) || ( !add_list.is(e.target) // if the target of the click isn't the add_list...
            && add_list.has(e.target).length === 0 ) ) // ... nor a descendant of the add_list
        {
            add_list.addClass('idle');
        } else {
            add_list.removeClass('idle');
        }
    });

    /**
     * Ajax requests
     * @param data
     * @param success_cb
     * @param error_cb
     * @param dataType
     */
    function request(data, success_cb, error_cb, dataType){
        // Prepare variables.
        var ajax       = {
                url:      linsila.ajax_url,
                data:     data,
                cache:    false,
                type:     'POST',
                dataType: 'json',
                timeout:  30000
            },
            dataType   = dataType || false,
            success_cb = success_cb || false,
            error_cb   = error_cb   || false;

        // Set success callback if supplied.
        if ( success_cb ) {
            ajax.success = success_cb;
        }

        // Set error callback if supplied.
        if ( error_cb ) {
            ajax.error = error_cb;
        }

        // Change dataType if supplied.
        if ( dataType ) {
            ajax.dataType = dataType;
        }
        // Make the ajax request.
        $.ajax(ajax);

    }
})( jQuery );
