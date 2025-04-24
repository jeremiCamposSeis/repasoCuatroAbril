<?php

namespace App\Models;

use CodeIgniter\Model;

class usuarioModel extends Model
{
    protected $db = null;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

//

public function login($username,$password)
{

        $sql="SELECT
ru.ROL_ID
FROM tbl_rol_usuario as ru
JOIN tbl_usuarios as u on u.USU_ID=ru.USU_ID
WHERE u.USU_CORREO=? AND u.USU_IDENTIFICACION=?;";

    $query = $this->db->query($sql,array($username,$password));

    return $query->getResult(); 
}


//
public function rolesAutorizadosModel($idRut)
{

        $sql="SELECT 
rr.ROL_ID
FROM tbl_rol_ruta as rr
WHERE rr.RUT_ID=?;";

    $query = $this->db->query($sql,[$idRut]);

    return $query->getResult(); 
}



//



//

public function menuModel($rol)
{

        $sql="SELECT 
    r.RUT_ID,r.RUT_NOMBRE,r.RUT_RUTA,r.RUT_PADRE
    FROM tbl_rutas as r 
    RIGHT JOIN tbl_rol_ruta as rr on rr.RUT_ID=r.RUT_ID
    RIGHT JOIN tbl_rol as rol on rol.ROL_ID=rr.ROL_ID
    WHERE r.RUT_ESTADO=1 AND rol.ROL_ID=?;";

    $query = $this->db->query($sql,[$rol]);

    return $query->getResult(); 
}
//
    public function selectUsuarios()
    {

        $sql="SELECT 
                rol.ROL_ID,u.USU_ID,u.USU_NOMBRE, u.USU_APELLIDO,u.USU_IDENTIFICACION,u.USU_CORREO,rol.ROL_NOMBRE
                FROM tbl_usuarios as u 
                LEFT JOIN tbl_rol_usuario as ru on ru.USU_ID=u.USU_ID
                LEFT JOIN tbl_rol as rol on rol.ROL_ID=ru.ROL_ID
                WHERE u.USU_ESTADO=1;";

        $query = $this->db->query($sql);

        return $query->getResult(); 
    }
    public function selectRoles(){
        $sql="SELECT 
              r.ROL_ID,r.ROL_NOMBRE,r.ROL_ESTADO
              FROM tbl_rol as r
              WHERE r.ROL_ESTADO=1;";
        
        $query=$this->db->query($sql);
        return $query->getResult();
  
      }


    public function seleid($nombre){
        $sql="SELECT 
        u.USU_ID,
        r.ROL_ID
        FROM tbl_usuarios as u
        LEFT JOIN tbl_rol_usuario as ru on ru.USU_ID=u.USU_ID
        LEFT JOIN tbl_rol as r on r.ROL_ID=ru.ROL_ID
        WHERE u.USU_NOMBRE=?;";
        $query=$this->db->query($sql,[$nombre]);
        return $query->getResult();
        }


        public function insertarRol($ide,$rol){


            $sql="INSERT INTO tbl_rol_usuario(ROL_ID, USU_ID) VALUES (?,?);";
      
             $this->db->query($sql,array($rol,$ide));
              
             return $this->db->affectedRows()> 0;
             
      
            }


    public function insertUsuarios($data)
    {

        $sql="INSERT INTO tbl_usuarios (USU_NOMBRE, USU_APELLIDO, USU_IDENTIFICACION, USU_CORREO) 
        VALUES (?,?,?,?);";

         $this->db->query($sql,[$data['nombre'],$data['apellido'],$data['cedula'],$data['correo']]);

        return $this->db->affectedRows() >0; 
    }



public function getUsuarioModel($usuId){
        $sql="SELECT 
u.USU_NOMBRE,u.USU_APELLIDO,u.USU_IDENTIFICACION,u.USU_CORREO
FROM tbl_usuarios as u 
WHERE u.USU_ID=?;";
        $query=$this->db->query($sql,[$usuId]);
        return $query->getResult();
        }
    




public function actualizarUModel($nombre,$apellido, $correo, $cedula){

    $sql= "UPDATE tbl_usuarios SET USU_NOMBRE=?, USU_APELLIDO = ?, USU_CORREO=? WHERE USU_IDENTIFICACION = ?";
    $query = $this->db->query($sql, array($nombre, $apellido, $correo, $cedula)); 
    return "Dato actualizado";
}

public function eliminarUModel($id){


    $sql="UPDATE tbl_usuarios SET USU_ESTADO = '0' WHERE USU_ID = ?;";
    
    $query=$this->db->query($sql,[$id]);

    return "dato eliminado";

}



public function ventasUsuarioCategoriaModel(){

    $sql="SELECT 
u.USU_NOMBRE,c.CAT_NOMBRE,SUM(V.VEN_PRECIO)as totalVentas
FROM tbl_ventas as v 
JOIN tbl_usuarios as u on u.USU_ID=v.USU_ID
JOIN tbl_productos as p on p.PRO_ID=v.PRO_ID
JOIN tbl_categoria as c on c.CAT_ID=p.CAT_ID
GROUP BY u.USU_NOMBRE,c.CAT_NOMBRE
ORDER BY u.USU_NOMBRE,c.CAT_NOMBRE;";
            $query=$this->db->query($sql);
            return $query->getResult();


}


public function ventasDiariasCategoriaModel(){

    $sql="SELECT c.CAT_NOMBRE, v.VEN_FECHA, SUM(v.VEN_PRECIO) AS Total_vendido_diario 
    FROM tbl_ventas AS v JOIN tbl_usuarios AS u ON u.USU_ID=v.USU_ID 
    JOIN tbl_productos AS p ON p.PRO_ID=v.PRO_ID 
    JOIN tbl_categoria AS c ON c.CAT_ID= p.CAT_ID 
    GROUP BY c.CAT_NOMBRE, v.VEN_FECHA 
    ORDER BY v.VEN_FECHA, c.CAT_NOMBRE;";
            $query=$this->db->query($sql);
            return $query->getResult();


}


public function rankingVentasTotalesUsuarioModel(){

    $sql="WITH VentasPorUsuario As (

    SELECT u.USU_NOMBRE AS nombre,

           SUM(v.VEN_PRECIO) AS Total_ventas

    FROM tbl_ventas v

    JOIN tbl_usuarios u ON u.USU_ID=v.USU_ID

    GROUP BY u.USU_NOMBRE

        )

        SELECT 

	vu.Nombre,

    vu.Total_ventas,

    RANK() OVER(ORDER BY vu.Total_ventas DESC) AS Ranking

    FROM VentasPorUsuario vu;";
            $query=$this->db->query($sql);
            return $query->getResult();


}



public function mejoresProductosVendidosModel(){

    $sql="WITH productocategoria as (
        SELECT 
            p.PRO_NOMBRE as nombre,
                SUM(v.VEN_PRECIO) as totalVenta
        FROM tbl_ventas as v 
            JOIN tbl_productos as p on p.PRO_ID=v.PRO_ID
            GROUP BY p.PRO_NOMBRE

        )
        
            SELECT 
            pc.nombre,
            pc.totalVenta,
            DENSE_RANK()OVER(ORDER BY pc.totalVenta DESC )as ranking
            FROM productocategoria as pc
            LIMIT 4;";
            $query=$this->db->query($sql);
            return $query->getResult();


}


public function menoresProductosVendidosModel(){

    $sql="WITH productocategoria as (
        SELECT 
            p.PRO_NOMBRE as nombre,
                SUM(v.VEN_PRECIO) as totalVenta
        FROM tbl_ventas as v 
            JOIN tbl_productos as p on p.PRO_ID=v.PRO_ID
            GROUP BY p.PRO_NOMBRE

        )
        
            SELECT 
            pc.nombre,
            pc.totalVenta,
            DENSE_RANK()OVER(ORDER BY pc.totalVenta ASC )as ranking
            FROM productocategoria as pc
            LIMIT 4;";
            $query=$this->db->query($sql);
            return $query->getResult();


}

}