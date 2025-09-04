

let scrollBtn = document.getElementById("scrollBtn");
let isBtnVisible = false;
window.onscroll = function () { scrollFunction() };
function scrollFunction() {
    if ((document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) && !isBtnVisible) {
        scrollBtn.style.display = "block";
        fadeIn(scrollBtn);
        isBtnVisible = true;
    } else if (document.body.scrollTop <= 100 && document.documentElement.scrollTop <= 100 && isBtnVisible) {
        fadeOut(scrollBtn);
        isBtnVisible = false;
    }
}
function fadeIn(element) {
    let opacity = 0;
    let position = -20;
    element.style.opacity = opacity;
    element.style.transform = `translateY(${position}px)`;

    let fadeInInterval = setInterval(function () {
        opacity += 0.1;
        position += 2;
        element.style.opacity = opacity;
        element.style.transform = `translateY(${position}px)`;
        if (opacity >= 1) {
            clearInterval(fadeInInterval);
        }
    }, 30);
}
function fadeOut(element) {
    let opacity = 1;
    let position = 0;
    element.style.opacity = opacity;
    element.style.transform = `translateY(${position}px)`;

    let fadeOutInterval = setInterval(function () {
        opacity -= 0.1;
        position -= 2;
        element.style.opacity = opacity;
        element.style.transform = `translateY(${position}px)`;
        if (opacity <= 0) {
            clearInterval(fadeOutInterval);
            element.style.display = "none";
        }
    }, 30);
}
function topFunction() {
    let currentScroll = document.documentElement.scrollTop || document.body.scrollTop;
    if (currentScroll > 0) {
        window.requestAnimationFrame(topFunction);
        window.scrollTo(0, currentScroll - (currentScroll / 8));
    }
}

function filterReviews(starsId) {
    const reviewSections = document.querySelectorAll('.social-review-block');
    const buttons = document.querySelectorAll('.social-review-buttonfiltr');

    reviewSections.forEach(section => {
        if (section.id === starsId) {
            section.classList.remove('hidden');
        } else {
            section.classList.add('hidden');
        }
    });

    buttons.forEach(button => {
        if (button.getAttribute('onclick') === `filterReviews('${starsId}')`) {
            button.style.color = 'orange';
        } else {
            button.style.color = '';
        }
    });
}
window.onload = function () {
    filterReviews('stars5');
};

/*savecallback*/
const form = document.getElementById("callback-forms");


form.addEventListener("submit", function (event) {
    event.preventDefault();


    const name = document.getElementById("name").value;
    const phone = document.getElementById("phone").value;

    alert("Дякуємо за вашу заявку, " + name + "! Ми зв'яжемося з вами за номером " + phone + " зовсім згодом!");


    const data = new FormData();
    data.append("name", name);
    data.append("phone", phone);


    const xhr = new XMLHttpRequest();
    xhr.open("POST", "php/save_callback.php", true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            alert(xhr.responseText);
            document.getElementById("name").value = "";
            document.getElementById("phone").value = "";
        } else {
            alert("Сталася помилка під час відправки форми.");
        }
    };
    xhr.send(data);
});

$(document).ready(function() {

    function updateQueue() {
        $.ajax({
            url: 'php/get_queue.php',
            type: 'GET',
            dataType: 'json',
            success: function(data) {

                $('#queue-list').empty();


                data.forEach(function(item) {

                    var maskedNumber = item.NUMBERdzv.substring(0, 9) + '******';
                    $('#queue-list').append('<li>' + item.NAMEdzv + ' - ' + maskedNumber + '</li>');
                });
            },
            error: function(xhr, status, error) {
                console.error('Сталася помилка при отриманні черги: ' + status);
            }
        });
    }


    updateQueue();


    setInterval(updateQueue, 30000);

});

