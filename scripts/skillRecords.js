//iterator
let index = 0;
let newindex = 0;
//call to the function
slideshow();
slideshow2();

function slideshow() {
    let i;
    let x = $('.slide');
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    index++;
    if (index > x.length) { index = 1 }
    x[index - 1].style.display = "block";
    setTimeout(slideshow, 2000); // Change image every 2 seconds
}

$(document).ready(function() {
    $('.text').hover(function() {
        $('.slide').css({ opacity: 0.6 });
        $('.text').css({ "background-color": "black", color: "white" })
    }, function() {
        $('.slide').css({ opacity: 1.0 });
    })
})


function slideshow2() {
    let i;
    let x = $('.slidew');
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    newindex++;
    if (newindex > x.length) { newindex = 1 }
    x[newindex - 1].style.display = "block";
    setTimeout(slideshow2, 2000); // Change image every 2 seconds
}