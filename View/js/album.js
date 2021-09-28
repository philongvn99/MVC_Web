document.getElementById("categories-album").innerHTML = $.get('../controller/getAlbum.php', function (data, status) {
    data = JSON.parse(data);
    if(data.success) {
        document.getElementById("categories-album").innerHTML = ""
        data.albums.forEach((album) => {
            document.getElementById("categories-album").innerHTML += `<a class="nav-link" href="#">${album.title}</a>`
        })
    }
    else alert('Can not get Album');
})