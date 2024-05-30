<!-- resources/views/includes/fixed_button.blade.php -->
<style>
    #scroll-to-top-btn {
        padding: 0;
        background: none;
        border: none;
    }

    #scroll-to-top-btn img {
        transition: transform 0.3s ease; /* Agregamos transición para un efecto suave al hacer hover */
    }

    /* Estilo para el contenedor de la imagen */
    #scroll-to-top-btn img-container {
        transition: box-shadow 0.3s ease; /* Aplicamos la transición de la sombra */
    }

    /* Al hacer hover sobre el botón, aplicamos la sombra al contenedor de la imagen */
    #scroll-to-top-btn:hover img-container {
        box-shadow: 0 0 10px rgba(255, 255, 255, 0.7); /* Sombra blanca */
    }

    /* Al hacer hover sobre el botón, hacemos que la imagen se eleve ligeramente */
    #scroll-to-top-btn:hover img {
        transform: translateY(-2px); /* Efecto de elevación */
    }
</style>

<div id="fixed-button-container" style="position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%); display: none;">
    <button id="scroll-to-top-btn" class="btn btn-primary">
        <!-- Contenedor de la imagen con sombra -->
        <div id="img-container">
            <img src="{{ asset('svg/arriba.png') }}" alt="Ir Arriba" style="width: 40px;">
        </div>
    </button>
</div>

<script>
    $(document).ready(function() {
        $(window).scroll(function() {
            if ($(this).scrollTop() > 100) {
                $('#fixed-button-container').fadeIn();
            } else {
                $('#fixed-button-container').fadeOut();
            }
        });

        $('#scroll-to-top-btn').click(function() {
            $('html, body').animate({scrollTop: 0}, 800);
            return false;
        });
    });
</script>
