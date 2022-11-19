let logo;
let images = [];
let inputImages = document.getElementById("images");

const logoInput = document.querySelector("#logoInput");
const logoImage = document.querySelector("#logoImage");

logoInput.addEventListener("change", function (e) {

  const inputTarget = e.target;
  const file = inputTarget.files[0];

  if (file) {
    logo = file;
    const reader = new FileReader();

    reader.addEventListener("load", function (e) {
      const readerTarget = e.target;

      logoImage.src = readerTarget.result;
      logoImage.style.width = "100%";
      logoImage.style.height = "100%";
    });

    reader.readAsDataURL(file);
  }

});

// images

const image1 = document.querySelector("#image1");
const image1img = document.querySelector("#image1img");

const image2 = document.querySelector("#image2");
const image2img = document.querySelector("#image2img");

const image3 = document.querySelector("#image3");
const image3img = document.querySelector("#image3img");

const image4 = document.querySelector("#image4");
const image4img = document.querySelector("#image4img");

image1.addEventListener("change", function (e) {

  const inputTarget = e.target;
  const file = inputTarget.files[0];

  if (file) {
    images[0] = file;
    const reader = new FileReader();

    reader.addEventListener("load", function (e) {
      const readerTarget = e.target;

      image1img.src = readerTarget.result;
      image1img.style.width = "100%";
      image1img.style.height = "100%";
    });

    reader.readAsDataURL(file);
  }

});

image2.addEventListener("change", function (e) {

  const inputTarget = e.target;
  const file = inputTarget.files[0];

  if (file) {
    images[1] = file;
    const reader = new FileReader();

    reader.addEventListener("load", function (e) {
      const readerTarget = e.target;

      image2img.src = readerTarget.result;
      image2img.style.width = "100%";
      image2img.style.height = "100%";
    });

    reader.readAsDataURL(file);
  }

});

image3.addEventListener("change", function (e) {

  const inputTarget = e.target;
  const file = inputTarget.files[0];

  if (file) {
    images[2] = file;
    const reader = new FileReader();

    reader.addEventListener("load", function (e) {
      const readerTarget = e.target;

      image3img.src = readerTarget.result;
      image3img.style.width = "100%";
      image3img.style.height = "100%";
    });

    reader.readAsDataURL(file);
  }

});

image4.addEventListener("change", function (e) {

  const inputTarget = e.target;
  const file = inputTarget.files[0];

  if (file) {
    images[3] = file;
    const reader = new FileReader();

    reader.addEventListener("load", function (e) {
      const readerTarget = e.target;

      image4img.src = readerTarget.result;
      image4img.style.width = "100%";
      image4img.style.height = "100%";
    });

    reader.readAsDataURL(file);
  }

});


const textarea = document.querySelector("#about_us");
textAreaAdjust(textarea);

function textAreaAdjust(element) {
  element.style.height = "1px";
  element.style.height = (25+element.scrollHeight)+"px";
}
