<?php
class Estudiantes extends Controller{
    function __construct(){
        parent::__construct();
        parent::connectionSession();

        $this->view->datos = [];
        $this->view->mensaje = "Seccion Estudiantes";
        $this->view->mensajeResultado = "";        
    }
    function render(){
        $datos = $this->model->getEstudiantes();               
        $this->view->datos = $datos;
        $this->view->render('estudiantes/index');
    }

    function crear(){   //para ver la vista                   
        $this->view->datos = [];
        $this->view->mensaje = "Crear Estudiantes";
        $this->view->render('estudiantes/crear');
    }
    function insertarEstudiante(){
        //var_dump($_POST);
        if ($this->model->insertarEstudiante($_POST)){
            $mensajeResultado = '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    Nuevo Registro agregado 
                </div>';
        }else{
            $mensajeResultado = '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    No se Registro correctamente
                </div>';
        }
        $this->view->mensajeResultado = $mensajeResultado;        
        $this->render();
    }

    function detalle(){                      
        $this->view->datos = [];
        $this->view->mensaje = "Detalle del Estudiantes";
        $this->view->render('estudiantes/detalle');
    }

    function verEstudiantes( $param = null ){        
        $id = $param[0];

        $datos = $this->model->verEstudiantes($id);        
        $this->view->datos = $datos;
        $this->view->mensaje = "Detalle Estudiante";
        $this->view->render('estudiantes/detalle');
    }

    //actualizarGrupo
    function actualizarestudiante() {
        //var_dump($_POST);
        $datos = new classEstudiantes(); // Inicializar la variable $datos
        
        if ($this->model->actualizarestudiante($_POST)) {
            foreach ($_POST as $key => $value) {
                if (property_exists($datos, $key)) {
                    $datos->$key = $value;
                }
            }
    
            $mensajeResultado = '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    Actualización de datos del estudiante
                </div>';
        } else {
            $mensajeResultado = '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    No se actualizó el estudiante
                </div>';
        }
        
        $this->view->datos = $datos;
        $this->view->mensaje = "Detalle Estudiante";
        $this->view->mensajeResultado = $mensajeResultado;        
        $this->view->render('estudiantes/detalle');
    }   

    //eliminarGrupo
    function eliminarestudiante( $param = null ){   
        $id = $param[0];
        if ($this->model->eliminarestudiante($id)){
            $mensajeResultado = '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    Se elimino el estudiante correctamente
                </div>';
        }else{
            $mensajeResultado = '
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    No se elimino el el estudiante correctamente
                </div>';
        }
        $this->view->mensajeResultado = $mensajeResultado;        
        $this->render();
    }
}

?>