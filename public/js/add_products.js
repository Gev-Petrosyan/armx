
const product_image = document.querySelector("#product_image");
const product_img = document.querySelector("#product_img");

product_image.addEventListener("change", function (e) {

  const inputTarget = e.target;
  const file = inputTarget.files[0];

  if (file) {
    const reader = new FileReader();

    reader.addEventListener("load", function (e) {
      const readerTarget = e.target;

      product_img.src = readerTarget.result;
      product_img.style.width = "100%";
      product_img.style.height = "100%";
    });

    reader.readAsDataURL(file);
  }

});


const deleteButtons = $("button[class='delete']");
const _token = $("meta[name='csrf_token']").attr("content");

deleteButtons.click(function() {
  let id = $(this).parent().attr("id");
  let product = $(this).parent().parent().parent();
  product.html(`
      <div class="card product" style="margin-bottom: 0">
      <svg class="bd-placeholder-img card-img-top" width="100%" height="180" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#868e96"></rect></svg>
          <div class="card-body" style="margin-bottom: 0; height: 165px;">
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
  
    $.ajax({
      url: "/company/products/delete",
      type: "POST",
      data: {
          _token: _token,
          id: id
      },
      success: function(data) {
        product.remove()
      }
    })

})


const add_new_product = document.getElementById("add-new-product");
const add_new_product_alert = document.getElementById("add-new-product-alert");

add_new_product.style.display = "none";

add_new_product_alert.addEventListener("click", () => {
  add_new_product.style.display = "flex";
});



