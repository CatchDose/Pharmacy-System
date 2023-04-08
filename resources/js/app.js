import 'bootstrap';
import 'laravel-datatables-vite';
import select2 from 'select2';
import Chart from 'chart.js/auto';
window.Chart = Chart;
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

      $("select").on('select2:unselect', function (e) {

        if (e.params.originalEvent != null && e.params.originalEvent.handleObj.type == "mouseup") {
            $(this).append('<option value="' + e.params.data.id + '">' + e.params.data.text + '</option>');
            let vals = $(this).val();
            vals.push(e.params.data.id);
            $(this).val(vals).trigger('change');
            $(this).select2('close');
        } else if (e.params.data.element != null) {
            e.params.data.element.remove();
        }
    });
});

import 'admin-lte';
