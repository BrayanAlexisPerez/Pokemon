<!DOCTYPE html>
<?php
class Pokemon {
    
    private $numero = 0;
    private $nombre = null;
    private $tipo = null;
    private $fuerza = null;
    private $velocidad = null;
    private $tipoEvolucion = null;
    private $imagen = null;
    
    function __construct($numero, $nombre, $tipo, $fuerza, $velocidad, $tipoEvolucion, $imagen){
        $this->numero = $numero;
        $this->nombre = $nombre;
        $this->tipo = $tipo;
        $this->fuerza = $fuerza;
        $this->velocidad = $velocidad;
        $this->tipoEvolucion = $tipoEvolucion;
        $this->imagen = $imagen;   
    }
    
    public function getNumero(){
        return $this->numero;
    }
    
    public function setNumero($numero){
        $this->numero = $numero;
        return $this;
    }
    
    public function getNombre(){
        return $this->nombre;
    }
    
    public function setNombre($nombre){
        $this->nombre = $nombre;
        return $this;
    }

    public function getTipo(){
        return $this->tipo;
    }
    
    public function setTipo($tipo){
        $this->tipo = $tipo;
        return $this;
    }

    public function getFuerza(){
        return $this->fuerza;
    }
    
    public function setFuerza($fuerza){
        $this->fuerza = $fuerza;
        return $this;
    }
    public function getVelocidad(){
        return $this->velocidad;
    }
    
    public function setVelocidad($velocidad){
        $this->velocidad = $velocidad;
        return $this;
    }
    public function getTipoEvolucion(){
        return $this->tipoEvolucion;
    }
    
    public function setTipoEvolucion($tipoEvolucion){
        $this->tipoEvolucion = $tipoEvolucion;
        return $this;
    }
    
    public function getImagen(){
        return $this->imagen;
    }
    
    public function setImagen($imagen){
        $this->imagen = $imagen;  
        return $this;
    }
}

$pokemones = array();
$pokemones[0] = new Pokemon(0, 'Bulbasaur',  array("Hierba","Veneno"), 93, 53, 1,'bulbasaur.png');
$pokemones[1] = new Pokemon(1, 'Charizard', array("Fuego","Volador"), 67, 80, 3,'charizard.png');
$pokemones[2] = new Pokemon(2, 'Squirtle', array("Agua"), 84, 35, 1,'squirtle.png');
$pokemones[3] = new Pokemon(3, 'Pikachu', array("Electrico"), 75, 99, 1,'pikachu.png');
$pokemones[4] = new Pokemon(4, 'Flareon', array("Fuego"), 110, 96, 2,'flareon.png');
$pokemones[5] = new Pokemon(5, 'Mewtwo', array("Psiquico"),160,156, 2,'mewtwo.png');
$pokemones[6] = new Pokemon(6, 'Magikarp', array("Agua"), 41, 56, 1,'magikarp.png');
$pokemones[7] = new Pokemon(7, 'Dragonite', array("Dragon","Volador"), 141, 50, 3,'dragonite.png');
$pokemones[8] = new Pokemon(8, 'Nidoqueen', array("Veneno","Tierra"), 98, 61, 2,'nidoqueen.png');
$pokemones[9] = new Pokemon(9, 'Articuno', array("Hielo","Volador"), 78, 55, 2,'articuno.png');

$todos = array();
$error="";


$tipoEscogido = $pokemones;
if(isset($_GET["tipoPokemon"])){
    $n = $_GET["tipoPokemon"];
    if($n=="todos")
    {
      $tipoEscogido=$pokemones;
    }
    else{
      $tipoEscogido=$todos;
      for($x=0;$x<count($pokemones);$x++)
      {
        for($y=0;$y<count($pokemones[$x]->getTipo());$y++)
        {
          if($pokemones[$x]->getTipo()[$y] == $n)
          {
            array_push($tipoEscogido, $pokemones[$x]);
          }
        }
      }
      if(count($tipoEscogido)<1) 
      {
        $error="Por el momento no hay almacenados pokemones de ese tipo ";
      }
    }
}

if(isset($_POST["btn"])){
  $f = (int)$_REQUEST["fuerza"];
  if($f>0)
  {
    $tipoEscogido=$todos;
      for($x=0;$x<count($pokemones);$x++)
      {
        if($pokemones[$x]->getFuerza() > $f)
        {
          array_push($tipoEscogido, $pokemones[$x]);
        }
      }
      if(count($tipoEscogido)<1) 
      {
        $error="Por el momento no hay almacenados pokemones con esa fuerza minima";
      }
  }
  else{
    $Error = "La fuerza debe ser mayor a cero";
  }
}
?>

<html lang="es" xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta charset="utf-8" />
  <title>Pokemon</title>
  <link rel="stylesheet" type="text/css" href="slide.css">
  <script src="imagen.js"></script>

</head>

<body onload="showSlides(1)">
  <h1 id="titulo">Pokemon</h1>
  <div class="container">
    <?php if($tipoEscogido != null):?>
    <div class="slideshow-container">
      <?php foreach($tipoEscogido as $tipoEscogid):
      ?>  
      <div class="mySlides fade">
        <img class="imagen" src=<?php echo $tipoEscogid->getImagen(); ?>>
        <div class="text">
          <p>Nombre: <?php echo $tipoEscogid->getNombre(); ?></p> 
          <p>Tipo : 
          <?php foreach($tipoEscogid->getTipo() as $tipo):?>            
          (
          <?php echo $tipo; ?>
          )
          <?php endforeach; ?>
          </p>
          <p>Fuerza: <?php echo $tipoEscogid->getFuerza(); ?></p>
          <p>Velocidad: <?php echo $tipoEscogid->getVelocidad(); ?></p>
          <p>Tipo de Evolucion: <?php echo $tipoEscogid->getTipoEvolucion(); ?></p>
        </div>
      </div>
      <?php if(count($tipoEscogido) > 1):?>
      <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
      <a class="next" onclick="plusSlides(1)">&#10095;</a>
      <?php endif;?>
      <?php endforeach;?>
    </div>
    <?php else:?>
    <h2 id="Error"><?php echo $error ?></h2>
    <?php endif;?>
    <form class="centrado caja" method="get">
      <p>Tipo :
        <select name="tipoPokemon" onchange="this.form.submit()">
          <option value"0">--SELECCIONE--</option>
          <option value="todos">Todos</option>
          <option value="Normal">Normal</option>
          <option value="Fuego">Fuego</option>
          <option value="Electrico">Electrico</option>
          <option value="Agua">Agua</option>
          <option value="Psiquico">Psiquico</option>
          <option value="Hierba">Hierba</option>
          <option value="Fantasma">Fantasma</option>
          <option value="Tierra">Tierra</option>
          <option value="Hielo">Hielo</option>
          <option value="Volador">Volador</option>
          <option value="Veneno">Veneno</option>
          <option value="Dragon">Dragon</option>
        </select>
      </p>
    </form>
    <form class="centrado caja" method="post">
      <p>
        Fuerza Minima : 
        <input name="fuerza" type="text"/>
        <button name="btn">Buscar</button>
      </p>
    </form>

  </div>
  
</body>

</html>