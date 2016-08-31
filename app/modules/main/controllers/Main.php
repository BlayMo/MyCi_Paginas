<?php
/* * **********************************************************
 * The MIT License
 *
 * Copyright 2016 Blas Monerris Alcaraz.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.

  --------------- CodeIgniter -----------------------------------

  @package	CodeIgniter
  @author	EllisLab Dev Team
  @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
  @copyright	Copyright (c) 2014 - 2016, British Columbia Institute of Technology (http://bcit.ca/)
  @license	http://opensource.org/licenses/MIT	MIT License
  @link	https://codeigniter.com
  @since	Version 1.0.0
  @filesource

  --------------------- xxxxxx -------------------------

  @Proyecto: MyCi_Pagina
  @Autor:    Blas Monerris Alcaraz
  @Objeto:   Aprendizaje/Desarrollo
  @Comienzo: 29-08-2016
  @licencia  http://opensource.org/licenses/MIT  MIT License
  @link      https://expresoweb.joomla.com
  @Version   1.0.0

  @mail: expresoweb2015@gmail.com

  PHP7 + Codeigniter 3.2.0-dev + otras

  textoacambiar

  Script creado el 29-08-2016
 * ******************************************************************** */
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MX_Controller {
    
        var $limite_sup;        
        var $filas;
        var $nro_reg;
        var $pagina;
        var $tot_paginas;
        
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
            $this->tot_paginas = intval(($this->nro_reg / $this->filas) + ($this->nro_reg % $this->filas));
        }
	
	public function index()
	{     
            $faker_users = $this->Faker_users_model->get_all_rango($this->filas,$this->limite_sup);
            $data = array(
                'faker_users_data' => $faker_users
            );            
            //print_r($this->limite_sup); 
            
            $data['pagina'] = $this->pagina;
            $data['paginas'] = $this->tot_paginas;
            $this->load->view('main_view',$data);                       
	}
                                                                
        public function siguiente($pagina)
        {            
            $this->limite_sup = ($pagina * $this->filas) - $this->filas;
            if( $this->limite_sup > $this->nro_reg ){ $this->limite_sup = $this->nro_reg;}
            $this->pagina = $pagina;
            $this->index();            
        }
        
        public function ultimo()
        {
            $this->limite_sup = $this->nro_reg - $this->filas ;
            $this->pagina = $this->tot_paginas;
            $this->index();           
        }
        
        public function anterior($pagina)
        {     
            if ($pagina === 0){ $this->pagina = 1;}else { $this->pagina = $pagina;}
            if ($this->pagina > 1){
                $this->limite_sup = $this->limite_sup - $this->filas ;
                if( $this->limite_sup < $this->filas ){ $this->limite_sup = $this->filas;}                              
            }            
            $this->index();
        }
        
        
        //crea datos falsos para prueba del programa
        public function Crea()
        {
            $this->crear_faker_data(10);
            $this->index();
        }
                        
        private function crear_faker_data($limit)
	{
            // create a fake reord of user accounts
            // Values https://github.com/fzaninotto/Faker
            for ($i = 0; $i < $limit; $i++) {         
                    $data = array(
                            'username' => $this->faker->unique()->userName, // get a unique nickname
                            'password' => md5('12345'), // run this via your password hashing function
                            'firstname' => $this->faker->firstName,
                            'lastname' => $this->faker->lastName,
                            'gender' => rand(0, 1) ? 'male' : 'female',
                            'bio' => $this->faker->text($maxNbChars = 500),
                            'address' => $this->faker->streetAddress,
                            'city' => $this->faker->city,
                            'state' => $this->faker->state,
                            'country' => $this->faker->country,
                            'postcode' => $this->faker->postcode,
                            'email' => $this->faker->email,
                            'email_verified' => mt_rand(0, 1) ? '0' : '1',
                            'phone' => $this->faker->phoneNumber,
                            'birth_date' => $this->faker->dateTimeThisCentury->format('Y-m-d H:i:s'),
                            'registration_date' => $this->faker->dateTimeThisYear->format('Y-m-d H:i:s'),
                            'ip_address' => mt_rand(0, 1) ? $this->faker->ipv4 : $this->faker->ipv6,
                            'active' => $i === 0 ? true : rand(0, 1),
                    );
                    $this->Faker_users_model->insert($data);
            }
	}
        //-----------------------------------------------
}
