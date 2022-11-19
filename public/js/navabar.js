$(function() {

    let navabarOpen = false;
    let navabarButton = $("#navabarButton");
    let navabarModel = $("#navabarModel");

    navabarButton.on("click", function() {
        if (navabarOpen) {
            navabarModel.hide();
            navabarOpen = false;
        } else {
            navabarModel.css({
                'display': 'flex'
            });
            navabarOpen = true;
        }
    });

})