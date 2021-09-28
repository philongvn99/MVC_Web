const searchBtn = document.getElementById('search-btn');

let artistPage = 0;
let albumPage = 0;
let songPage = 0;
let searchSubmit = {};

const updateartistPage = (num) => {
    artistPage = num; 
    searchArtist();
    document.getElementById(`artist-btn-${num}`).style.color = "green";
}
const updatealbumPage = (num) => {
    albumPage = num; 
    searchAlbum();
}
const updatesongPage = (num) => {
    songPage = num; 
    searchSong();
}

searchBtn.addEventListener('click', function (e) {
    searchSubmit = {
        keyword: document.getElementById('keyword').value,
        artistType: document.getElementById('artist-type').checked,
        albumType: document.getElementById('album-type').checked,
        songType: document.getElementById('song-type').checked,
    }
    e.preventDefault();
    searchBtn.setAttribute('disabled','true');

    if (!searchSubmit.keyword) {
        alert('Keyword must not be empty');
    }
    else if (!(searchSubmit.artistType || searchSubmit.albumType || searchSubmit.songType)) {
        alert('At least 1 type must be selected');
    }
    else {
        if(searchSubmit.artistType) {
            searchArtist(searchSubmit)
        }
        else document.getElementById("result-artist").innerHTML = ``;

        if(searchSubmit.albumType) {
            searchAlbum(searchSubmit)
        }
        else document.getElementById("result-album").innerHTML = ``;

        if(searchSubmit.songType) {
            searchSong(searchSubmit)
        }
        else document.getElementById("result-song").innerHTML = ``;
    }    
    searchBtn.removeAttribute('disabled');

})


const searchArtist = () => {
    $.post('../controller/searchArtist.php', {keyword: searchSubmit.keyword} , function (data, status) {
        data = JSON.parse(data);
        document.getElementById("result-artist").innerHTML = `<div class="text-left"><h5> <a href="#" class="fas fa-angle-double-right"></a> Ca sĩ / Nhóm nhạc</h5></div>`
        if(data.success) {
            data.artists.forEach((value, index) => {
                document.getElementById("result-artist").innerHTML += 
                `<div class="artist-box">
                    ${index + 1}. ${value.Name}
                    <image  src="${value.ImagePath}" alt="${value.Name} avatar" class="avatar"> 
                </div>`
            })
            var numPages = Math.ceil(data.artists.length / 5)
            if (numPages > 1) {
                document.getElementById("result-artist").innerHTML += "<div>"
                for(let i = 0; i < numPages; i++) {
                    document.getElementById("result-artist").innerHTML += `<button type="button" id="artist-btn-${i}" class='btn' onclick='updateartistPage(${i})'>${i + 1}</button>`
                }
                document.getElementById("result-artist").innerHTML += "</div>"
                document.getElementById(`song-btn-${artistPage}`).style.color = "red";  
            }

        }
        else document.getElementById("result-artist").innerHTML += `No Artist Found`
    })
}

const searchAlbum = () => {
    $.post('../controller/searchAlbum.php', {keyword: searchSubmit.keyword} , function (data, status) {
        console.log(data)
        data = JSON.parse(data);
        document.getElementById("result-album").innerHTML = `<div class="text-left"><h5> <a href="#" class="fas fa-angle-double-right"></a> Album</h5></div>`
        if(data.success) {
            data.albums.forEach((value, index) => {
                document.getElementById("result-album").innerHTML += `
                <div class="album-box">
                    ${index + 1} ${value.Title} - ${value.Name} (${value.song_count})
                    <image  src="${value.CoverPath}" alt="${value.Title} cover" class="avatar"> <br>
                    <div class="album-attr">
                        ${value.ReleaseDate}
                    </div>                            
                </div>`
            })
            var numPages = Math.ceil(data.albums.length / 5)
            if (numPages > 1) {
                document.getElementById("result-album").innerHTML += "<div>"
                for(let i = 0; i < numPages; i++) {
                    document.getElementById("result-album").innerHTML += `<button type="button" id="album-btn-${i}" class='btn' onclick='updatealbumPage(${i})'>${i + 1}</button>`
                }
                document.getElementById("result-album").innerHTML += "</div>"
                document.getElementById(`album-btn-${albumPage}`).style.color = "green";
            }
        }
        else document.getElementById("result-album").innerHTML += `No Album Found`
    })
}

const searchSong = () => {
    $.post('../controller/searchSong.php', {keyword: searchSubmit.keyword} , function (data, status) {
        data = JSON.parse(data);
        document.getElementById("result-song").innerHTML = `<div class="text-left"><h5> <a href="#" class="fas fa-angle-double-right"></a> Bài hát</h5></div>`
        if(data.success) {
            data.songs.slice(songPage * 5, (songPage + 1) * 5).forEach((value, index) => {
                document.getElementById("result-song").innerHTML += `
                <div class="song-box">
                    <div class="song-title">
                        ${index + 1}. ${value.Title} - ${value.Name} (${value.Length})
                    </div>
                    <div class="song-attr">
                        ${value.GenreName} - ${parseInt(parseInt(value.Length) / 60)}:${parseInt(value.Length) % 60}
                    </div><br>
                    <div class="song-audio">
                        <audio controls src="${value.Path}"></audio>
                    </div>
                </div>`
            })
            var numPages = Math.ceil(data.songs.length / 5)
            if (numPages > 1) {
                document.getElementById("result-song").innerHTML += "<div>"
                for(let i = 0; i < numPages; i++) {
                    document.getElementById("result-song").innerHTML += `<button type="button" id="song-btn-${i}" class='btn' onclick='updatesongPage(${i})'>${i + 1}</button>`
                }
                document.getElementById("result-song").innerHTML += "</div>"
                document.getElementById(`song-btn-${songPage}`).style.color = "red";  
            }
        }
        else document.getElementById("result-song").innerHTML += `No Song Found`
    })
}