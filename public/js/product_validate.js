$(function() {

    const products = $("#products");
    const best_goods_title = $("#best-goods-title");
    const best_goods_title2 = $("#best-goods-title2");
    const best_goods_titleSub = $("#best-goods-titleSub");

    let subcategory = "all";
    let category = $("meta[name='category']").attr("content");
    let city = "all";
    const _token = $("meta[name='csrf_token']").attr("content");

    const pagination = $(".pagination");

    function deleteActivity(element) {
        element.removeClass("active");
        element.addClass("denied");
    }

    function deleteOnlyActivity(element) {
        element.removeClass("active");
    }


    const buttonNavabar = $("#best-goods-buttons");
    // buttonNavabar.html("");

    const subcategoryList = $(".section-part-two .category .category-block .category-name");
    subcategoryList.each(function () {
        let element = $(this);
        if (element.text() == category) {
            element.addClass('active');
        }
    });

    $("#best-goods-buttons button").click(function() {
        deleteActivity($("#best-goods-buttons button"));
        $(this).removeClass("denied");
        $(this).addClass("active");
        subcategory = $(this).html() == "Все" ? "all" : $(this).html();
        request(subcategory, category, city, false);
    });

    buttonsNavabar = (element) => {
        deleteActivity($("#best-goods-buttons button"));
        element.removeClass("denied");
        element.addClass("active");
        subcategory = element.html() == "Все" ? "all" : element.html();
        request(subcategory, category, city, false);
    };

    
    const categorys = $(".section-part-two .category .category-name");

    categorys.click(function() {
        if ($(this).hasClass("active")) {
            deleteOnlyActivity(categorys);
            category = "all";
            subcategory = "all";
        } else {
            deleteOnlyActivity(categorys);
            category = $(this).html();
            $(this).addClass("active");
        }
        request(subcategory, category, city, true);
    });


    const citys = $(".section-part-two .citys .category-name");

    citys.click(function() {
        console.log($("#best-goods-buttons button"));
        if ($(this).hasClass("active")) {
            deleteOnlyActivity(citys);
            city = "all";
        } else {
            deleteOnlyActivity(citys);
            city = $(this).html();
            $(this).addClass("active");
        }
        request(subcategory, category, city, false);
    });

    const select_category = $("#select-category");
    const select_city = $("#select-city");

    select_category.change(function () {
        category = $(this).val();
        request(subcategory, category, city, true)
    })

    select_city.change(function () {
        city = $(this).val();
        request(subcategory, category, city, false)
    })


    function request(subcategory, category, city, norefresh) {
        requestSetHTML();

        if (city == "Все города") {
            city = "all";
        }

        $.ajax({
            url: "/company/products/getDataValidate",
            type: "POST",
            data: {
                _token: _token,
                subcategory: category,
                category: subcategory,
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
                                <img src="/storage/product/${image}" alt="image">
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

                if (norefresh == false) return;
                if (category == "all") {
                    buttonNavabar.html("");
                    return
                }

                let subcategories = data.subcategory;

                buttonNavabar.html(`<button type="button" class="active" onclick="buttonsNavabar($(this))">Все</button>`);
                subcategories.forEach(index => {
                    buttonNavabar.append(`<button type="button" class="denied" onclick="buttonsNavabar($(this))">${index.category}</button>`)
                });

            }
        });
    }

    function requestSetHTML() {
        pagination.html("");
        products.html("");

        best_goods_title.html('Все товары');
        best_goods_title2.html('Все товары');
        best_goods_titleSub.html('');

        if (subcategory !== 'all') {
            best_goods_titleSub.html(subcategory);
        }

        if (category !== 'all') {
            best_goods_title2.html(category);
            best_goods_title.html(category);
        }

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
    }
    

})