/* Author:
	Matthew Wilber: mattw@click3x.com
*/

// Return a helper with preserved width of cells
var fixHelper = function(e, ui) {
    ui.children().each(function() {
        $(this).width($(this).width());
    });
    return ui;
};

$(document).ready(function() {

	$('#brands_list tbody').sortable({
		helper: fixHelper,
		update: function() {
		$.ajax({
			type: "POST",
			url: "brands/editorder",
			data: $('#brands_list tbody').sortable('serialize'),
			success: function() {
				//alert('data saved');
			}
		});
		}
		}).disableSelection();
		
	$('.dialog').dialog({ autoOpen: false });
});