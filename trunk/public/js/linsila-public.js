(function( $ ) {
	'use strict';
    $(document).foundation();

    var Linsila = function() {
        $(document).ready(function () {
            /**
             * Lists
             */
            sort($('#lists-container'));

            /**
             * Add lists
             */
            $('.add-a-list').click(function (e) {
                if ($('a.js-cancel-edit').is(e.target))
                    return false;
                $(this).removeClass('idle');
                $(this).find('.list-name').focus();
            });
            $('.add-a-list .cancel').click(function (e) {
                e.preventDefault();
                $(this).closest('.add-a-list').addClass('idle');
            });

            $('.js-save-list').click(function (e) {
                e.preventDefault();
                var button      = $(this),
                    list_box    = button.closest('.add-a-list'),
                    input       = list_box.find('.list-name'),
                    input_val   = input.val(),
                    data        = { 'nonce' : linsila.nonce,'action' : 'linsila_create_list', 'list_name' : input_val};
                button.prop('disabled', 'disabled').addClass('ajax-loading');

                var success_cb = function (data) {
                    button.prop('disabled', false).removeClass('ajax-loading');
                    input.val('');
                    if( data.success ) {
                        list_box.addClass('idle');
                        $('<div class="list" data-id="'+data.success.term_id+'"><div class="list-header"><div class="handle">|||</div>'+input_val+'<div class="list-actions">x</div></div></div>').appendTo('#lists-container');
                    }
                    if( data.error ) {
                        show_alert( data.error, 'alert');
                    }
                }

                request(data,success_cb);
            });

        });

        $(document).mouseup(function (e) {
            var add_list = $('.add-a-list');
            if ($('a.js-cancel-edit').is(e.target) || ( !add_list.is(e.target) // if the target of the click isn't the add_list...
                && add_list.has(e.target).length === 0 )) // ... nor a descendant of the add_list
            {
                add_list.addClass('idle');
            } else {
                add_list.removeClass('idle');
            }
        });

        /***
         * ADD JOBS
         */
        $(document).on('opened.fndtn.reveal', '#js-new-job', function () {
            var modal = $(this);
            $('.js-client-dropdown').chosen({
                no_results_text: 'Oops, nothing found! <a href="#" class="js-add-client add-client">Add new</a>'
            });
        });


        /**
         * Create sortable element
         * @param element
         */
        function sort(element){

            element.sortable({
                animation : 150,
                handle: ".handle",
                onEnd: function(evt){
                    var order = this.toArray();
                    console.log(order);
                    var data        = { 'nonce' : linsila.nonce,'action' : 'linsila_sort_lists', 'lists_order' : order };
                    request(data);
                }
            });
        }
        /**
         * Display simple alerts
         * @param message
         * @param alert_mode
         */
        function show_alert( message, alert_mode){
            var alert_box = $('.alert-box');
            alert_box.find('span').text(message);
            alert_box.addClass(alert_mode).fadeIn().delay(5000).fadeOut();
        }
        /**
         * Ajax requests
         * @param data
         * @param success_cb
         * @param error_cb
         * @param dataType
         */
        function request(data, success_cb, error_cb, dataType) {
            // Prepare variables.
            var ajax = {
                    url: linsila.ajax_url,
                    data: data,
                    cache: false,
                    type: 'POST',
                    dataType: 'json',
                    timeout: 30000
                },
                error_cb_default = function(data) {
                    if( data.error ){
                        show_alert( data.error, 'alert');
                    }
                },
                dataType = dataType || false,
                success_cb = success_cb || false,
                error_cb = error_cb || error_cb_default;

            // Set success callback if supplied.
            if (success_cb) {
                ajax.success = success_cb;
            }

            // Set error callback if supplied.
            if (error_cb) {
                ajax.error = error_cb;
            }

            // Change dataType if supplied.
            if (dataType) {
                ajax.dataType = dataType;
            }
            // Make the ajax request.
            $.ajax(ajax);

        }
    }
    Linsila();
})( jQuery );
