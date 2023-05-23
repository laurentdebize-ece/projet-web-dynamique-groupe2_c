window.addEventListener('DOMContentLoaded', () => {
    const canevas = document.getElementById('bubbleCanvas');
    const contexte = canevas.getContext('2d');
    let bulles = [];

    canevas.width = window.innerWidth;
    canevas.height = window.innerHeight;

    class Bulle {
        constructor() {
            this.x = Math.random() * canevas.width;
            this.y = Math.random() * canevas.height;
            this.rayon = Math.random() * 20 + 10;
            this.couleur = 'rgba(255, 255, 255, 0.7)';
            this.vitesseX = Math.random() * 2 - 1;
            this.vitesseY = Math.random() * 2 - 1;
        }

        miseAJour() {
            this.x += this.vitesseX;
            this.y += this.vitesseY;

            if (this.x + this.rayon > canevas.width || this.x - this.rayon < 0) {
                this.vitesseX *= -1;
            }

            if (this.y + this.rayon > canevas.height || this.y - this.rayon < 0) {
                this.vitesseY *= -1;
            }
        }

        dessiner() {
            contexte.beginPath();
            contexte.arc(this.x, this.y, this.rayon, 0, Math.PI * 2);
            contexte.fillStyle = this.couleur;
            contexte.fill();
            contexte.closePath();
        }
    }

    function creerBulles() {
        for (let i = 0; i < 50; i++) {
            bulles.push(new Bulle());
        }
    }

    function animerBulles() {
        contexte.clearRect(0, 0, canevas.width, canevas.height);

        for (let bulle of bulles) {
            bulle.miseAJour();
            bulle.dessiner();
        }

        requestAnimationFrame(animerBulles);
    }

    creerBulles();
    animerBulles();
});


$(document).ready(function() {
    displayNotification();
    $(window).on('storage', function(e) {
        if (e.originalEvent.key === 'notification') {
            displayNotification();
        }
    });

    function displayNotification() {
        var notification = localStorage.getItem("notification");
        if (notification) {
            $("#notificationContainer").html(
                '<p>' + notification + '</p><button id="removeNotification">Supprimer la notification</button><button id="goToPageButton">Aller à la page correspondante</button>'
            );
            $("#notificationContainer").fadeIn("slow");
        } else {
            $("#notificationContainer").fadeOut("slow", function() {
                $(this).empty();
            });
        }
    }

    $(document).on('click', '#removeNotification', function() {
        localStorage.removeItem("notification");
        $("#notificationContainer").fadeOut("slow", function() {
            $(this).empty();
        });
    });

    // Go to page button click event
    $(document).on('click', '#goToPageButton', function() {
        localStorage.removeItem("notification");
        $("#notificationContainer").fadeOut("slow", function() {
            $(this).empty();
            window.location.href = "page_Etud_MesComp.php";
        });
    });
});