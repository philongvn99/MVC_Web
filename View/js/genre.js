document.getElementById("categories-genre").innerHTML = $.get('../controller/getGenre.php', function (data, status) {
    data = JSON.parse(data);
    if(data.success) {
        document.getElementById("categories-genre").innerHTML = ""
        data.genres.forEach((genre) => {
            document.getElementById("categories-genre").innerHTML += `<a class="nav-link" href="#">${genre.GenreName}</a>`
        })
    }
    else alert('Can not get Gerne');
})