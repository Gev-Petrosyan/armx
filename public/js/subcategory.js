$(function() {

    const _token = $("meta[name='csrf_token']").attr("content");
    const subcategorySelect = $("form #subcategory");
    const categorySelect = $("form #category");

    subcategorySelect.on("change", function() {
        let value = $(this).val();
        (!value) ? categorySelect.html(`<option value="" selected>Выберите категорию для начало</option>`) :
        getRequest($(this).val());
    })
    
    function getRequest(category) {
        let requestURL = "/product/category/" + category;

        $.ajax({
            url: requestURL,
            type: "GET",
            data: {
                _token: _token
            },
            success: function(data) {
                categorySelect.html('');
                data.subcategory.forEach(index => {
                    let value = index.category;
                    categorySelect.append(`
                        <option value="${value}">${value}</option>
                    `);
                });
            }
        });
    }

})