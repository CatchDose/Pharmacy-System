import './bootstrap';
import 'laravel-datatables-vite';
import select2 from 'select2';

select2();

$(document).ready(function() {
    $(".select2").select2({
    tags: true,
    theme: 'bootstrap-5',
    });

    $("select").on("select2:select", function (evt) {
        var element = evt.params.data.element;
        var $element = $(element);
        
        $element.detach();
        $(this).append($element);
        $(this).trigger("change");
      });
});
