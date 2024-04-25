<?php
include('.\php\source.php');
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="author" content="SemiColonWeb">

    <!-- Stylesheets
        ============================================= -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Raleway:300,400,500,600,700|Crete+Round:400i" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="./HTML/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="./HTML/css/style.css" type="text/css">
    <link rel="stylesheet" href="./HTML/css/dark.css" type="text/css">
    <link rel="stylesheet" href="./HTML/css/font-icons.css" type="text/css">
    <link rel="stylesheet" href="./HTML/css/animate.css" type="text/css">
    <link rel="stylesheet" href="./HTML/css/magnific-popup.css" type="text/css">

    <!-- Select-Boxes CSS -->
    <link rel="stylesheet" href="./HTML/css/components/select-boxes.css" type="text/css">

    <link rel="stylesheet" href="./HTML/css/responsive.css" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- estas dos ligas son de Select2-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



    <script src="./HTML/js/jquery.js"></script>
    <script src="./HTML/js/plugins.js"></script>
    <script src="./HTML/js/components/select-boxes.js"></script>
    <script src="./HTML/js/components/selectsplitter.js"></script>
    <script src="./HTML/js/functions.js"></script>


    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    <script src='fullcalendar/locales/es.js'></script>
    <!-- dos ligas de bootstrap -->
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css'></script>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js'></script>

    <style>
        .fluid-width-video-wrapper {
            width: 100%;
            position: relative;
            padding: 0;
        }

        .fluid-width-video-wrapper iframe,
        .fluid-width-video-wrapper object,
        .fluid-width-video-wrapper embed {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .selectPrincipal {
            width: 50% !important;
            margin-top: 50px;
        }

        .divSelect {
            text-align: center;
        }
    </style>
</head>

<body>
    <script>
        jQuery(document).ready(function($) {

            // Multiple Select
            $(".select-1").select2({
                placeholder: ""
            });

            // Loading array data
            var data = [{
                id: 0,
                text: 'enhancement'
            }, {
                id: 1,
                text: 'bug'
            }, {
                id: 2,
                text: 'duplicate'
            }, {
                id: 3,
                text: 'invalid'
            }, {
                id: 4,
                text: 'wontfix'
            }];
            $(".select-data-array").select2({
                data: data
            })
            $(".select-data-array-selected").select2({
                data: data
            });

            // Enabled/Disabled
            $(".select-disabled").select2();
            $(".select-enable").on("click", function() {
                $(".select-disabled").prop("disabled", false);
                $(".select-disabled-multi").prop("disabled", false);
            });
            $(".select-disable").on("click", function() {
                $(".select-disabled").prop("disabled", true);
                $(".select-disabled-multi").prop("disabled", true);
            });

            // Without Search
            $(".select-hide").select2({
                minimumResultsForSearch: Infinity
            });

            // select Tags
            $(".select-tags").select2({
                tags: true
            });

            // Select Splitter
            $('.selectsplitter').selectsplitter();

        });
    </script>
    <script>
        var calendar;

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'es',
                headerToolbar:{
                    left: 'title', 
                    right: 'prev next',
                }
            });
            calendar.render();
        });

        function agregarEvento(titulo, inicio) {
            calendar.addEvent({
                title: titulo,
                start: inicio,

            })
        }

        function eliminarEventos() {
            eventos = calendar.getEvents()
            for (let i = 0; i < eventos.length; i++) {
                eventos[i].remove()

            }
        }

        function filtrarEventos() {
            //si hay eventos mostrandose, borra los eventos 
            if (calendar.getEvents().length > 0) {
                eliminarEventos()
            }
            select = document.getElementById('selectPrincipal')
            juzgadoSelect = select.value
            eventos = JSON.parse(<?php echo "'" . $eventosJSON . "'" ?>)

            for (let i = 0; i < eventos.length; i++) {
                tituloCita = eventos[i].titulo
                fechaCita = eventos[i].fecha
                juzgadoCita = eventos[i].juzgado
        
                //agregar evento si es de la sala que se busca
                if (juzgadoCita == juzgadoSelect) {
                    agregarEvento(tituloCita, fechaCita)
                }
            }
        }

        $(document).ready(function() {
            $('select-1 form-control select2-hidden-accessible').select2({
                theme: 'classic'
            });
        });
    </script>

    <div class="bottommargin-sm divSelect" data-select2-id="39">
        <label for="">Seleccione un juzgado:</label>
        <select id="selectPrincipal" class="select-1 form-control select2-hidden-accessible selectPrincipal" tabindex="-1" aria-hidden="true" onchange="filtrarEventos()">
            <optgroup label="Juzgados">
                <option value="" selected disabled hidden></option>
                <option value="JUZGADO ORAL DE LO PENAL DE AGUA PRIETA">JUZGADO ORAL DE LO PENAL DE AGUA PRIETA</option>
                <option value="JUZGADO ORAL DE LO PENAL DE GUAYMAS">JUZGADO ORAL DE LO PENAL DE GUAYMAS</option>
                <option value="JUZGADO ORAL DE LO PENAL DE HERMOSILLO">JUZGADO ORAL DE LO PENAL DE HERMOSILLO</option>
                <option value="JUZGADO SEGUNDO ORAL MERCANTIL DE HERMOSILLO">JUZGADO SEGUNDO ORAL MERCANTIL DE HERMOSILLO</option>
                <option value="JUZGADO PRIMERO ORAL DE ADOLESCENTES DE HERMOSILLO">JUZGADO PRIMERO ORAL DE ADOLESCENTES DE HERMOSILLO</option>
            </optgroup>
        </select>
      <!-- <a id="botonBuscar" class="button button-circle" onclick="filtrarEventos()">Buscar eventos</a>-->  
      <!-- <a id="botonAgregar" class="button button-circle" data-toggle="modal" data-target="#modalForm">Agregar evento</a> -->  
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action=".\php\source.php" method="POST">
                        Titulo: <input type="text" name="titulo"><br>
                        Sala: <input type="number" name="sala"><br>
                        Fecha: <input type="date" name="fecha"><br>
                        <input type="submit">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div id='calendar'></div>
</body>

</html>