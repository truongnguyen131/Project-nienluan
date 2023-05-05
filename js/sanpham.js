// range slider
let rangeInput = document.querySelectorAll('.range-input input');
let rangeText = document.querySelectorAll('.range-text div');
let progress = document.querySelector('.pro');
let priceMax = rangeInput[0].max;
let priceGap = 1000;

rangeInput.forEach(input => {
    input.addEventListener('input', (event) => {
        let minVal = parseInt(rangeInput[0].value);
        let maxVal = parseInt(rangeInput[1].value);

        if (maxVal - minVal < priceGap) {
            if (event.target.className === 'range-min') {
                minVal = rangeInput[0].value = maxVal - priceGap;
            } else {
                maxVal = rangeInput[1].value = minVal + priceGap;
            }
        }

        let positionMin = (minVal / priceMax) * 100;
        let positionMax = 100 - ((maxVal / priceMax) * 100);
        progress.style.left = positionMin + '%';
        progress.style.right = positionMax + '%';
        rangeText[0].style.left = positionMin + '%';
        rangeText[1].style.right = positionMax + '%';
        rangeText[0].innerText = minVal.toLocaleString();
        rangeText[1].innerText = maxVal.toLocaleString();
    })
})

// dialog filter

// Get the modal
var modal = document.getElementById("control");
var theloai = document.getElementById("category");
var nsx = document.getElementById("nsxx");


// When the user clicks the button, open the modal 
function opentheloai() {
    theloai.style.display = "block";
    modal.style.display = "none";
}

function opennsx() {
    nsx.style.display = "block";
    modal.style.display = "none";
}

function returnmodal() {
    modal.style.display = "block";
    nsx.style.display = "none";
    theloai.style.display = "none";
}

function openmodal() {
    modal.style.display = "block";
}
// When the user clicks on <span> (x), close the modal
function closemodal() {
    modal.style.display = "none";
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// pagination
$(function() {
    var pg_links = $(".pg-link"),
        h_elm = $("#m-pg-link"),
        curr = 5,
        _this,
        _class,
        _id,
        __this,
        _num,
        i = 0;

    function changeNumbers(flag) {
        if ((curr > 2 && flag == 0) || flag) {
            if (curr == 1) {
                curr = 2;
                h_elm.removeClass("left");
                return;
            }

            $(pg_links).each(function() {
                __this = $(this).find("span");
                _num = parseInt(__this.text());

                if (flag) _num += 1;
                else _num -= 1;

                ++i;

                pg_links.addClass("s-hide");

                __this.text(_num);

                setTimeout(function() {
                    pg_links.removeClass("s-hide");
                }, 150);

                if (i == 2) curr = _num;
            });

            i = 0;
        } else {
            if (curr == 2 && flag == 0) {
                curr = 1;
                h_elm.addClass("left");
            }
        }
    }

    function changeLinks() {
        _this = $(this);
        _class = _this.attr("class").trim().toLowerCase();

        if (_class == "arrow") {
            _id = _this.attr("id").trim().toLowerCase();

            if (_id == "l-arrow") changeNumbers(0);
            else changeNumbers(1);
        } else {
            if (parseInt(_this.text().trim()) < curr) changeNumbers(0);
            else changeNumbers(1);
        }
    }

    $(".pg-link,.arrow").on("click", changeLinks);
});




// Xử lí filter