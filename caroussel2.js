$(document).ready(function () {

    var $carrousel = $('#carrousel'), // on cible le bloc du carrousel
        $img = $('#carrousel img'), // on cible les images contenues dans le carrousel
        indexImg = $img.length - 1, // on définit l'index du dernier élément
        i = 0, // on initialise un compteur
        $currentImg = $img.eq(i); // enfin, on cible l'image courante, qui possède l'index i (0 pour l'instant)
    $img.css('display', 'none'); // on cache les images $currentImg.css('display', 'block'); // on affiche seulement l'image courante
    $currentImg.css('display', 'block');

    /*
    function maBoucle() {
        setTimeout(function () {
            if (i < indexImg) {
                i++;
            } else {
                i = 0;
            }
            $img.css('display', 'none');
            $currentImg = $img.eq(rand(i));
            $currentImg.fadeIn(2000);
            $img.not($currentImg).fadeOut(2000);
            maBoucle();

        }, 4000);
    }
    maBoucle();
*/
    function afficherImageAleatoire() {
        var indexAleatoire = Math.floor(Math.random() * indexImg);
        $img.css('display', 'none');
        $currentImg = $img.eq(indexAleatoire);
        $currentImg.fadeIn(2000);
        $img.not($currentImg).fadeOut(2000);
    }

    setInterval(afficherImageAleatoire, 4000);
    @
    $('#menuBtn').click(function () {
        $('#resultat').slideToggle();
    });

    $("#buttonPrev, #buttonNext").hover(function () {

        $(this).css("background-color", "#a2a290");
    }, function () {
        $(this).css("background-color", "");
    });



    $("#buttonPrev, #buttonNext").click(function () {
        if ($(this).is("#buttonPrev")) {
            i--;
            if (i >= 0) {
                $img.css('display', 'none');
                $currentImg = $img.eq(i);
                $currentImg.css('display', 'block');
            } else {
                i = 0;
            }
        } else if ($(this).is("#buttonNext")) {
            i++;
            if (i <= indexImg) {
                $img.css('display', 'none');
                $currentImg = $img.eq(i);
                $currentImg.css('display', 'block');
            } else {
                i = indexImg;
            }
        }
    });
});
