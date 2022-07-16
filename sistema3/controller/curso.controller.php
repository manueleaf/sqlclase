<?php
require_once 'model/curso.model.php';
require_once 'entity/curso.entity.php';
require_once 'includes.controller.php';

class CursoController extends IncludesController{    
  
    private $model;
    
    public function __CONSTRUCT()
    {
        $this->model = new CursoModel();
    }
    /**==========================Vistas=======================================*/
    public function Index(){        
        require_once 'view/header.php';
        require_once 'view/administracion/curso/index.php';
        require_once 'view/footer.php';       
    }

    public function v_Actualizar(){        
        require_once 'view/header.php';
        require_once 'view/administracion/curso/actualizar.php';
        require_once 'view/footer.php';       
    }

    public function v_Registrar(){        
        require_once 'view/header.php';
        require_once 'view/administracion/curso/registrar.php';
        require_once 'view/footer.php';       
    }


    /**=======================================================================*/   
    public function Listar()
    {
        $cursos = $this->model->Listar();
        return $cursos;
    }


    public function ListarCursosTI()
    {
        $cursos = $this->model->ListarCursosTI();
        return $cursos;
    }


    public function Consultar($idCurso)
    {
        $curso = new Curso();
        $curso->__SET('idCurso',$idCurso);

        $consulta = $this->model->Consultar($curso);
        return $consulta;
    }

    public function Actualizar(){
        $curso = new Curso();
        $curso->__SET('idCurso',$_REQUEST['idCurso']);
        $curso->__SET('nombre',$_REQUEST['nombre']);
        $curso->__SET('profesor',$_REQUEST['profesor']);
        $curso->__SET('activo',$_REQUEST['activo']);                  
        $curso->__SET('modificado_por',$_SESSION['Usuario_Actual']);      
        $actualizar_persona = $this->model->Actualizar($curso);         
        if($actualizar_persona=='error'){
            header('Location: index.php?c=Curso&a=v_Actualizar&idCurso='. $curso->__GET('idCurso'));
            echo 'No se Ha Podido Actualizar';
        }else{
            echo 'Actualizado Correctamente';
            header('Location: index.php?c=Curso');
         }
    }
    


    public function Registrar(){
        
        $curso = new Curso();
        $nropersona = $this->model->Consultar_persona_dia($_REQUEST['fecha_ingreso']);
        $date=date_create($_REQUEST['fecha_ingreso']);
        $cod_fecha=date_format($date,'ymd');
        if(strlen($nropersona)==1){
            $cod_dia="0".$nropersona;
        }else{
            $cod_dia=$nropersona;
        }

        $curso->__SET('nombre',$_REQUEST['nombre']);
        $curso->__SET('profesor',$_REQUEST['profesor']);
        //$curso->__SET('foto',$_REQUEST['foto']);

        $curso->__SET('ingresado_por',$_SESSION['Usuario_Actual']);    
        /*Validar Documento / Si no existe Registrar / Mostrar un mensaje que indique que el dni ya fue registrado*/
        $registrar_persona = $this->model->Registrar($curso);  
         //echo $registrar_persona;
        if($registrar_persona=='error'){
            header('Location: index.php?c=Curso&a=v_Registrar');
            echo 'No se Ha Podido Registrar';
         }else{
            echo 'Registrado Correctamente';
            header('Location: index.php?c=Curso');
         }
    }

    public function Eliminar(){
        $curso = new Curso();
        $curso->__SET('idCurso',$_REQUEST['idCurso']);      
        $curso->__SET('modificado_por',$_SESSION['Usuario_Actual']);
        $curso->__SET('eliminado',1); 
        $eliminar_curso = $this->model->Eliminar($curso);  
         
        if($eliminar_curso=='error'){
            echo 'No se Ha Podido Eliminar la Curso';
            header('Location: index.php?c=Curso');            
        }else{
            echo 'Origen Eliminado Correctamente';
            header('Location: index.php?c=Curso');
        }
    }


    public function redirect($url)
    {
        header("Location: $url");
    }   

}