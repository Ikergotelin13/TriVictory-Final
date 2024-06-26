<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos</title>
    <link rel="stylesheet" href="../../assets/css/estilo.css">
</head>

<body>
    <header id="header"></header>
    <main id="contenedor-completo">
        <div class="loader" id="loader"></div>
        <div>
            <div id="container-titulo">
                <h1 id="titulo-eventos">Competiciones</h1>
            </div>
            <div id="subtitulo-eventos">
                <p>Aquí podrás ver las próximas pruebas que se van a organizar, a través de los enlaces podrás ver más
                    detalles de cada prueba junto a sus circuitos, normativa y enlace de inscripción. También puedes
                    filtrar tanto por tipo de distancia, modalidad o edad para participar.</p>
            </div>
            <div id="busqueda">
                <h2>Búsqueda avanzada</h2>
            </div>
            <div id="container-filtros">
                <ul>
                    <li class="lista-eventos">
                        <label for="filtro-modalidad"></label>
                        <select name="modalidad" id="filtro-modalidad" class="listas-filtros">
                            <option value="Todas las modalidades">Todas las modalidades</option>
                            <option value="Triatlon">Triatlón</option>
                            <option value="Duatlon">Duatlón</option>
                            <option value="Triatlon Cros">Triatlón Cros</option>
                            <option value="Duatlon Cros">Duatlón Cros</option>
                            <option value="Acuatlon">Acuatlón</option>
                            <option value="Aquabike">Aquabike</option>
                        </select>
                    </li>
                </ul>
                <ul>
                    <li  class="lista-eventos">
                        <label for="filtro-distancia"></label>
                        <select name="distancia" id="filtro-distancia" class="listas-filtros">
                            <option value="Todas las distancias">Todas las distancias</option>
                            <option value="Corta">Corta</option>
                            <option value="Sprint">Sprint</option>
                            <option value="Supersprint">Supersprint</option>
                            <option value="Media distancia">Media distancia</option>
                            <option value="Olimpica">Olímpica</option>
                            <option value="Larga distancia">Larga distancia</option>
                        </select>
                    </li>
                </ul>
                <ul>
                    <li  class="lista-eventos">
                        <label for="filtro-categoria"></label>
                        <select name="categoria" id="filtro-categoria" class="listas-filtros">
                            <option value="Todas las edades">Todas las edades</option>
                            <option value="Menores">Menores</option>
                            <option value="Adultos">Adultos</option>
                        </select>
                    </li>
                </ul>
                <button class="botones-filtros" id="boton-buscar">Buscar</button>
                <button class="botones-filtros" id="boton-reiniciar">Reiniciar filtros</button>





            </div>

        </div>

        <div id="Todo-completos">
            <div id="container-listado-competiciones">
                <?php include '../../assets/php/mostrar-competiciones-usuario.php'; ?>
            </div>
        </div>

        <footer>
            <div id="footer"></div>
        </footer>

    </main>


    <script>
        
    /*CARGAR HEADER Y FOOTER*/
    window.addEventListener('DOMContentLoaded', (event) => {
        const headerContainer = document.getElementById('header');
        const footerContainer = document.getElementById('footer');

        // Obtener la ruta relativa al directorio actual
        const currentPagePath = window.location.pathname;
        const currentPageDirectory = currentPagePath.substring(0, currentPagePath.lastIndexOf('/'));

        // Cargar el encabezado
        fetch(currentPageDirectory + '/header-usuario.html')
            .then(response => response.text())
            .then(data => {
                headerContainer.innerHTML = data;
            });

        // Cargar el pie de página
        fetch(currentPageDirectory + '/../footer.html')
            .then(response => response.text())
            .then(data => {
                footerContainer.innerHTML = data;
            });
        // Mostrar loader al cargar la página
        const loader = document.getElementById("loader");
        loader.classList.add("hidden");
    });


    /*MENU DESPLEGABLE */
    document.addEventListener('DOMContentLoaded', function() {
        const hamburgerMenu = document.getElementById('hamburger-menu');
        const listaMenu = document.getElementById('lista-menu');

        hamburgerMenu.addEventListener('click', function() {
            listaMenu.classList.toggle('active');
        });
    });

    function toggleMenu() {
        const navMenu = document.getElementById('lista-menu');
        navMenu.classList.toggle('active');
    }


    /*FILTRO COMPETI*/
    document.getElementById('boton-buscar').addEventListener('click', function() {
        buscarCompeticiones();
    });

    // Función para realizar la búsqueda de competiciones
    function buscarCompeticiones() {
        var modalidad = document.getElementById('filtro-modalidad').value;
        var distancia = document.getElementById('filtro-distancia').value;
        var categoria = document.getElementById('filtro-categoria').value;

        // Enviar los valores de los filtros incluso si la categoría no está seleccionada
        var formData = new FormData();
        formData.append('modalidad', modalidad);
        formData.append('distancia', distancia);
        formData.append('categoria', categoria);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../../assets/php/filtro-competicion.php', true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById('container-listado-competiciones').innerHTML = xhr.responseText;
            }
        };
        xhr.send(formData);
    }

    // Event listener para el botón de reiniciar filtros
    document.getElementById('boton-reiniciar').addEventListener('click', function() {
        // Restablecer los valores de los selectores de filtro a sus valores por defecto
        document.getElementById('filtro-modalidad').value = 'Todas las modalidades';
        document.getElementById('filtro-distancia').value = 'Todas las distancias';
        document.getElementById('filtro-categoria').value = 'Todas las edades';

        // Realizar la búsqueda nuevamente con los filtros reiniciados
        buscarCompeticiones();
    });
    </script>
</body>

</html>