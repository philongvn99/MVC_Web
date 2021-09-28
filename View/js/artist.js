document.getElementById("categories-artist").innerHTML = $.get('../controller/getArtist.php', function (data, status) {
    data = JSON.parse(data);
    if(data.success) {
        document.getElementById("categories-artist").innerHTML = ""
        data.artists.forEach((artist) => {
            document.getElementById("categories-artist").innerHTML += `<a class="nav-link" href="#">${artist.Name}</a>`
        })
    }
    else alert('Can not get Artist');
})