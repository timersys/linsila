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
             * Editable fields
             */
            $('.js-editable').click(function (e) {
                if ($('a.js-cancel-edit').is(e.target))
                    return false;
                $(this).removeClass('idle');
                var placeholder_val = $(this).find('.placeholder').text();
                $(this).find('.js-input').val(placeholder_val).focus().select();
            });
            $('.js-editable .cancel').click(function (e) {
                e.preventDefault();
                $(this).closest('.js-editable').addClass('idle').find('.js-input').val('');
            });
            /**
             * Add lists
             */
            $('.js-save-editable').click(function (e) {
                e.preventDefault();
                var button          = $(this),
                    editable_box    = button.closest('.js-editable'),
                    input           = editable_box.find('.js-input'),
                    input_val       = input.val(),
                    data            = { 'nonce' : linsila.nonce,'action' : input.data('action'), 'input_val' : input_val};

                button.prop('disabled', 'disabled').addClass('ajax-loading');

                var success_cb = function (data) {
                    button.prop('disabled', false).removeClass('ajax-loading');
                    input.val('');
                    if( data.success ) {
                        data.input_val = input_val;
                        editable_actions(input.data('action'), data);
                        editable_box.addClass('idle');
                    }
                    if( data.error ) {
                        show_alert( data.error, 'alert');
                    }
                }

                request(data,success_cb);
            });

            /**
             * ADD Jobs
             */

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


        function editable_actions( action, data ) {
            if( action == 'linsila_create_list') {
                $('<div class="list" data-id="'+data.success.term_id+'"><div class="list-header"><div class="handle">|||</div>'+data.input_val+'<div class="list-actions">x</div></div></div>').appendTo('#lists-container');
            } else if (action == 'linsila_save_job_title' ) {
                $('.job-title').text(data.input_val);
            }
        }

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
