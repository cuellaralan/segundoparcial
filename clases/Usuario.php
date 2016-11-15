<?php

class Usuario {

//--------------------------------------------------------------------------------//
//--ATRIBUTOS
    public $id;
    public $nombre;
    public $email;
    //public $perfil;
   // public $foto;
    public $password;

//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
    public function __construct($id = NULL) {
        if ($id !== NULL) {
            $obj = Usuario::TraerUnUsuarioPorId($id);
            $this->id = $obj->id;
            $this->nombre = $obj->nombre;
            $this->email = $obj->email;
           // $this->foto = $obj->foto;
            $this->perfil = $obj->perfil;
        }
    }

//--------------------------------------------------------------------------------//
    
    public static function TraerUsuarioLogueado($obj) {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

        $sql = "SELECT U.id, U.nombre, U.email, U.perfil, U.foto
                FROM usuarios U
                WHERE U.email = :email AND U.password = :pass";

        $consulta = $objetoAccesoDato->RetornarConsulta($sql);
        $consulta->bindValue(':email', $obj->email, PDO::PARAM_STR);
        $consulta->bindValue(':pass', $obj->pass, PDO::PARAM_STR);

        $consulta->execute();

        $usuarioLogueado = $consulta->fetchObject('Usuario');

        return $usuarioLogueado;
    }

    public static function TraerUnUsuarioPorId($id) {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $sql = "SELECT U.id, U.nombre, U.email, U.password
                FROM usuarios U 
                WHERE U.id = :id ";
        
        $consulta = $objetoAccesoDato->RetornarConsulta($sql);
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();

        $usuarioBuscado = $consulta->fetchObject('Usuario');

        return $usuarioBuscado;
    }

   public static function Agregar($obj) {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $sql = "INSERT INTO usuarios (nombre, email, password, perfil,foto) 
                VALUES (:nombre, :email, :pass, :perfil,:foto)";
        
        $consulta = $objetoAccesoDato->RetornarConsulta($sql);
        $consulta->bindValue(':nombre', $obj->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':email', $obj->email, PDO::PARAM_STR);
        $consulta->bindValue(':pass', $obj->password, PDO::PARAM_STR);
        $consulta->bindValue(':perfil', $obj->perfil, PDO::PARAM_STR);
        $consulta->bindValue(':foto', "sinfoto", PDO::PARAM_STR);
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }
    

    public function GuardarUsuario()
     {

        if($this->id>0)
            {
                $this->ModificarUsuarioParametros();
            }
            else 
            {
                Usuario::Agregar($this);
            }
           

     }
       public function ModificarUsuarioParametros()
     {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("
                update usuarios 
                set nombre=:nombre,
                email=:email,
                password=:pass,
                perfil=:perfil,
                foto=:foto
                WHERE id=:id");
        $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':email', $this->email, PDO::PARAM_STR);
        $consulta->bindValue(':pass', $this->password, PDO::PARAM_STR);
        $consulta->bindValue(':perfil', $this->perfil, PDO::PARAM_STR);
        $consulta->bindValue(':foto', "sinfoto", PDO::PARAM_STR);
        $consulta->bindValue(':id', $this->id, PDO::PARAM_STR);
            return $consulta->execute();
     }
     public static function TraerTodosLosUsuarios() {
      
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("select id,nombre as nombre, email as Email from usuarios");
            $consulta->execute();           
            return $consulta->fetchAll(PDO::FETCH_CLASS, "usuario");     
    }

        public static function TraerUnUsuarioUserYCorreo($correo,$clave) 
    {
            /*$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("select count(id) from usuarios where usuario = '$user' OR correo = '$correo'");
            $consulta->execute();
            $usuarioBuscado= $consulta->fetch(PDO::FETCH_NUM);  
            if($usuarioBuscado[0] > 0)
            {
                return true;
            }
            else
            {
                return false;
            }    */

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $sql = "SELECT U.id, U.nombre, U.email, U.password
                FROM usuarios U 
                WHERE U.email = :email AND U.password =:clave ";
        
        $consulta = $objetoAccesoDato->RetornarConsulta($sql);
        $consulta->bindValue(':email', $correo, PDO::PARAM_STR);
        $consulta->bindValue(':clave', $clave, PDO::PARAM_STR);
        $consulta->execute();

        $usuarioBuscado = $consulta->fetchObject('Usuario');

        return $usuarioBuscado;
    }

     public function InsertarUsuarioParametros()
     { 
                $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 


        $sql = "INSERT INTO usuarios (nombre, email, password, perfil) 
                VALUES (':nombre',':email',':password',':perfil')";
        
        $consulta = $objetoAccesoDato->RetornarConsulta($sql);

                $consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_STR);
                $consulta->bindValue(':email', $this->email, PDO::PARAM_STR);
                $consulta->bindValue(':password',$this->password, PDO::PARAM_STR);
                $consulta->bindValue(':perfil', $this->perfil, PDO::PARAM_STR);
                //$consulta;       
                return $objetoAccesoDato->RetornarUltimoIdInsertado();
            
     }
        public function BorrarUsuario()
     {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            //var_dump( $objetoAccesoDato);
            $consulta =$objetoAccesoDato->RetornarConsulta("DELETE FROM usuarios WHERE id = :id"); 
            $consulta->bindValue(':id',$this->id, PDO::PARAM_INT);      
            $consulta->execute();
            return $consulta->rowCount();
     }

   /*  public function InsertarElCd()
     {
                $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
                $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into usuarios(titel,interpret,jahr)values('$this->titulo','$this->cantante','$this->año')");
                $consulta->execute();
                return $objetoAccesoDato->RetornarUltimoIdInsertado();
                

     }*/

    public function ActualizarFoto() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE usuarios SET foto = :foto WHERE id = :id");
        $consulta->bindValue(':id', $this->id, PDO::PARAM_INT);
        $consulta->bindValue(':foto', $this->foto, PDO::PARAM_STR);

        $consulta->execute();

        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    public static function Modificar($obj) {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $sql = "UPDATE usuarios 
                SET nombre = :nombre, email = :email, password = :pass, 
                perfil = :perfil;
                WHERE id=:id";
        
        $consulta = $objetoAccesoDato->RetornarConsulta($sql);
        $consulta->bindValue(':id', $obj->id, PDO::PARAM_INT);
        $consulta->bindValue(':nombre', $obj->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':email', $obj->email, PDO::PARAM_STR);
        $consulta->bindValue(':pass', $obj->pass, PDO::PARAM_STR);
        $consulta->bindValue(':perfil', $obj->perfil, PDO::PARAM_STR);
     //   $consulta->bindValue(':foto', $obj->foto, PDO::PARAM_STR);
        $consulta->execute();
        
        return $consulta->rowCount();
    }

    

    public static function TraerTodosLosPerfiles() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

        $sql = "SELECT DISTINCT(U.perfil) AS perfil
                FROM usuarios U";

        $consulta = $objetoAccesoDato->RetornarConsulta($sql);
        $consulta->execute();

        return $consulta->fetchall(PDO::FETCH_ASSOC);
    }

    public static function Borrar($id) {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("DELETE FROM usuarios WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->rowCount();
    }
//--------------------------------------------------------------------------------//
}