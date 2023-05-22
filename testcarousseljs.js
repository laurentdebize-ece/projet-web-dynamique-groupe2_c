$(document).ready(function () {

    var $caroussel = $('#caroussel');
    var $img = $('#caroussel img');
    indexImg = $img.length -1;
    i = 0;
    var $currentImg = $img.eq(i);
    $img.css('display', 'none');
    $currentImg.css('display', 'block');
    var $next = $('#buttonNext');
    var $prev = $('#buttonPrev');


    $($prev, $next).click(function () { 
        if ($(this).is($prev)) { 
            i--; 
            if (i<0) { 
                i = $img.length - 1; 
            }

            $img.css('display', 'none'); 
            $currentImg = $img.eq(i); 
            $currentImg.css('display', 'block'); 

          
        }   
        else if ($(this).is($next)){
            i++; 
            if (i<= indexImg) { 
            $img.css('display', 'none'); 
            $currentImg= $img.eq(i); 
            $currentImg.css('display', 'block'); 
            }
            else { 
                i = 0; 
                $img.css('display', 'none'); 
                $currentImg = $img.eq(i); 
                $currentImg.css('display', 'block'); 
            }
        }

    })
});

  // if (i>=0) { 
            //     $img.css('display', 'none'); 
            //     $currentImg = $img.eq(i); 
            //     $currentImg.css('display', 'block');
            // } 
            // else {
            //     i = $img.length - 1; 
            //     $img.css('display', 'none'); 
            //     $currentImg = $img.eq(i); 
            //     $currentImg.css('display', 'block');
            // }