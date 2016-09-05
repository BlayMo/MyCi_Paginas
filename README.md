# MyCi_Paginas
Simple ejercicio de paginación HMVC realizado con PHP7 + Codeigniter 3.2.0-dev + Bootstrap 3.1.1

El proyecto es un ejercicio de paginación aplicando el pattern HMVC. **No** he empleado "CodeIgniter’s Pagination class".

El controller 'Main':
```php
class Main extends MX_Controller {
    
        var $limite_sup;        
        var $filas;
        var $nro_reg;
        var $pagina;
        var $tot_paginas;
        var $anterior;
        var $siguiente;
        var $paginacion;
        
        function __construct()
        {
            parent::__construct(); 
            $this->load->library('faker','main_widget');
            $this->load->model('Faker_users_model');
            $this->faker = Faker\Factory::create();                       
            $this->limite_sup = 0;            
            $this->filas = 3;            
            $this->nro_reg = $this->Faker_users_model->total_rows();
            $this->pagina = 1;            
            $this->tot_paginas = intval(($this->nro_reg / $this->filas));
            if (($this->nro_reg % $this->filas) > 0){ ++$this->tot_paginas ;}
            $this->anterior = FALSE;
            $this->siguiente = TRUE;
            if ( $this->nro_reg != 0)
                {
                    $this->paginacion = TRUE;
                } else { $this->paginacion = FALSE;}
        }
	
	public function index()
	{     
            $faker_users = $this->Faker_users_model->get_all_rango($this->filas,$this->limite_sup);
            $data = array(
                'faker_users_data' => $faker_users
            );            
            
            
            $data['pagina']      = $this->pagina;
            $data['paginas']     = $this->tot_paginas;
            $data['anterior']    = $this->anterior;
            $data['siguiente']   = $this->siguiente;
            $data['paginacion']  = $this->paginacion;
            
            $this->load->view('main_view',$data);                       
	}
                                                                
        public function siguiente($pagina)
        {    
            $this->anterior = TRUE;
            $this->limite_sup = ($pagina * $this->filas) - $this->filas;
            if( $this->limite_sup > $this->nro_reg )
                {
                    $this->limite_sup = $this->nro_reg;
                    $this->siguiente = FALSE;
                }
            $this->pagina = $pagina;
            $this->index();            
        }
        
        public function ultimo()
        {
            $this->limite_sup = $this->nro_reg - $this->filas ;
            $this->pagina = $this->tot_paginas;
            $this->siguiente = FALSE;
            $this->anterior = TRUE;
            $this->index();           
        }
        
        public function anterior($pagina)
        {     
            $this->siguiente = TRUE;
            
            if ($pagina === 0)
                {
                    $this->pagina = 1;
                    $this->anterior = FALSE;
                }else 
                    {
                        $this->pagina = $pagina;
                        $this->anterior = TRUE;
                    }
                
            if ($this->pagina > 1){
                $this->limite_sup = $this->limite_sup - $this->filas ;
                if( $this->limite_sup < $this->filas ){ $this->limite_sup = $this->filas;}                              
            }            
            $this->index();
        }
        
        
```
El modelo "Faker_users_model":
```php
// get all
    function get_all_rango($filas,$limite_sup)
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table,$filas,$limite_sup)->result();
    }
```
Efectúa la seleccion en la BD.

La vista "main_pager":
```php
<ul class="pager">
<p class="previous text-center"><code>Pagina <?=$pagina?>/<?=$paginas?></code></p>
<li class="inicio">
   <a href="<?=site_url('main')?>">Primero</a>
</li>
<li class="previous">
    <?php if($anterior){ ?>
        <a href="<?=site_url('main/anterior/'.($pagina - 1))?>">&larr; Anterior</a>
    <?php }?>
</li>
<li class="inicio">
   <a href="<?=site_url('main/ultimo')?>">Ultimo</a>
</li>
<li class="next">
    <?php if($siguiente){ ?>
        <a href="<?=site_url('main/siguiente/'.($pagina + 1))?>">Siguiente &rarr;</a>
   <?php }?>
</li>
</ul> 
              
```


Los metodos "anterior", "siguiente", "ultimo" e "index", controlan que registros  se van a solicitar al modelo para presentar en la vista. El controlador **no filtra** los registros por categorías.

He empleado la librería **Faker** para crear un grupo de registros falsos con los que testear el proyecto.

La estructura de la BD esta en **"myci_paginas.sql"**.

Todo el código se distribuye bajo licencia MIT.

El software de terceros:
```html
<ul>
        <li>Faker https://github.com/fzaninotto/Faker.git</li>
        <li>Start Bootstrap - Blog Home (http://startbootstrap.com/)</li>
        <li>Dark Admin Bootstrap Theme  - http://www.prepbootstrap.com </li>
        <li>DevelBar - https://github.com/JCSama/CodeIgniter-develbar</li>
        <li>JavaScript library for mobile-friendly interactive maps - http://leafletjs.com</li>
        <li>Codeigniter Widget - https://github.com/kenjis/codeigniter-widgets.git</li>
        <li>Codeigniter-hmvc-modules - https://github.com/jenssegers/codeigniter-hmvc-modules.git</li>
        <li>Codeigniter-modular-extensions-hmvc - https://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc</li>
        <li>Harviacode CRUD Generator - https://bitbucket.org/harviacode/codeigniter-crud-generator</li>
        <li>Im&aacute;genes - https://pixabay.com/es/</li>
        <li> Bootstrap v3.1.1 - http://getbootstrap.com</li>
    </ul>
```

 
  
    se distribuye con sus respectivas licencias, que figuran en su correspondiente carpeta.

![Pantalla_01.jpg](https://github.com/BlayMo/MyCi_Pagina/blob/master/Pantalla_01.jpg "")

La finalidad de este proyecto es el aprendizaje. Agradezco cualquier sugerencia, y/o correción que sea para mejorar el código del proyecto.

Todo se ha desarrollado con "corazón" y para ser compartido.
El autor:

[expresoWeb](https://expresoweb.joomla.com "").

[email](expresoweb2015@gmail.com "").
