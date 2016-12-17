

var lisaVorm = document.getElementById('lisa-vorm');

lisaVorm.addEventListener('submit',
    function(event) {

        var kirjeldusKast = document.getElementById('kirjeldus'); // otsib elemendi
        var aegKast = document.getElementById('tahtaeg');
        var taseKast = document.getElementById('tase');

        var kirjeldus = kirjeldusKast.value; //võtab elemendi väärtuse
        var aeg = aegKast.value;
        var tase = taseKast.value;

        if (kirjeldus === '' || aeg === '' || tase === '') {
            alert('Täida palun kõik väljad: Kirjeldus, Tähtaega, Probleemi kriitilisus');
            event.preventDefault();
            return;
        }

    });
