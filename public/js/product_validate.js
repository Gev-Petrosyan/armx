$(function() {

    const products = $("#products");

    let category = "all";
    let city = "all";
    const _token = $("meta[name='csrf_token']").attr("content");

    function deleteActivity(element) {
        element.removeClass("active");
        element.addClass("denied");
    }

    function deleteOnlyActivity(element) {
        element.removeClass("active");
    }


    const buttons = $("#best-goods-buttons button");

    buttons.click(function() {
        deleteActivity(buttons);
        $(this).removeClass("denied");
        $(this).addClass("active");
    });

    
    const categorys = $(".section-part-two .category .category-name");

    categorys.click(function() {
        if ($(this).hasClass("active")) {
            deleteOnlyActivity(categorys);
            category = "all";
        } else {
            deleteOnlyActivity(categorys);
            category = $(this).html();
            $(this).addClass("active");
        }
        request(category, city);
    });


    const citys = $(".section-part-two .citys .category-name");

    citys.click(function() {
        if ($(this).hasClass("active")) {
            deleteOnlyActivity(citys);
            city = "all";
        } else {
            deleteOnlyActivity(citys);
            city = $(this).html();
            $(this).addClass("active");
        }
        request(category, city);
    });

    const select_category = $("#select-category");
    const select_city = $("#select-city");

    select_category.change(function () {
        category = $(this).val();
        request(category, city)
    })

    select_city.change(function () {
        city = $(this).val();
        request(category, city)
    })


    function request(category, city) {
        products.html("");

        for (let i = 0; i < 9; i++) {
            products.append(`
                <div class="card product">
                <svg class="bd-placeholder-img card-img-top" width="100%" height="180" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#868e96"></rect></svg>
                    <div class="card-body">
                        <h5 class="card-title placeholder-glow">
                        <span class="placeholder col-6"></span>
                        </h5>
                        <p class="card-text placeholder-glow">
                        <span class="placeholder col-9 mb-1"></span>
                        <span class="placeholder col-6 mb-2"></span>
                        <span class="placeholder col-7"></span>
                        </p>
                    </div>
                </div>
            `);
        }

        if (city == "Все города") {
            city = "all";
        }

        $.ajax({
            url: "/company/products/getDataValidate",
            type: "POST",
            data: {
                _token: _token,
                category: category,
                city: city
            },
            success: function(data) {

                let dataProducts = data.products;
                products.html("");

                dataProducts.forEach(product => {
                    let city;
                    product.city ? city = product.city : city = "Не указан";
                    let image = product.image;

                    products.append(`
                        <a href="product/${product.id}" class="product">
                            <div class="image">
                                <img src="storage/product/${image}" alt="image">
                            </div>
                            <div class="text">
                                <h4>${product.name}</h4>
                                <p>${product.category}</p>
                                <i>${city}</i>
                                <h5>${product.price} ₽/м³</h5>
                            </div>
                        </a>
                    `);
                });

                if (dataProducts.length == 0) {
                    products.html(`<p style="margin: auto;padding: 90px 0 300px 0;font-size: 26px;font-weight: 800;">Пусто...</p>`);
                }

            }
        });
    }
    

})