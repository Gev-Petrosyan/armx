$(function() {

    const nativeImage = $(".product-images .product-image-one img");
    const images = $(".product-images img");

    images.click(function() {
        nativeImage.attr("src", $(this).attr("src"));
    })

})