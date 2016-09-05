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
defined('BASEPATH') OR exit('No direct script access allowed');?> 
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
      <meta name="description" content="">
      <meta name="author" content="">
      <link rel="icon" href="../../favicon.ico">
      <title>Main</title>
      <!-- Bootstrap core CSS -->               
      <link href="<?=my_url('')?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">      
      <link href="<?=RUTA?>local.css" rel="stylesheet">
      <!------------------------- mapa leafletjs ------------------------------------------------------>    
      <link href='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.css' rel='stylesheet' />
      <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.21.0/mapbox-gl.css' rel='stylesheet' />
      <style>
         #map { height: 180px; }            
         #pre.ui-distance {
         position:absolute;
         bottom:10px;
         left:10px;
         padding:5px 10px;
         background:rgba(0,0,0,0.5);
         color:#fff;
         font-size:11px;
         line-height:18px;
         border-radius:3px;
         }                   
      </style>
   </head>
   <body>
      <!-- Fixed navbar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" style="background-color: #2c095d">
         <div class="container">
            <div class="navbar-header">
               <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               </button>
               <a class="navbar-brand" href="<?=site_url('main')?>">My Proy</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
               <ul class="nav navbar-nav">
                  <li class="active"><a href="<?=site_url('main')?>">Home</a></li>
                  <li><a href="#about">About</a></li>
                  <li><a href="#contact">Contact</a></li>
                  <li class="dropdown">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                     <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li class="dropdown-header">Nav header</li>
                        <li><a href="#">Separated link</a></li>
                        <li><a href="#">One more separated link</a></li>
                     </ul>
                  </li>
               </ul>
            </div>
         </div>
      </nav>
      <!-- Page Content -->
      <div class="container">
         <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-8">
               <?php             
                  foreach ($faker_users_data as $value)
                  { ?>
               <h1 class="page-header">
                  Ejercicio de Paginaci&oacute;n
                  <small>Mi propia paginaci&oacute;n</small>
               </h1>
               <!-- First Blog Post -->
               <h2>
                  <a href="#">Blog Post Title <?=$value->city?></a>
               </h2>
               <p class="lead">
                  by <a href="#"><?=$value->id.'/'.$value->firstname.' ('.$value->username.')';?></a>
               </p>
               <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo /*$value->registration_date*/ fecha_es() ?></p>
               <hr>
               <img class="img-responsive" src="<?=my_url('')?>assets/images/foto-<?=format_cero($value->id)?>.jpg" alt="">
               <hr>
               <p><?php echo $value->bio ?></p>
               <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
               <hr>
               <!-- Pager ----------------------------------------------------------------------------->
               <?php  }
               if ($paginacion){ require_once 'main_pager.php';}               
               ?>                              
            </div>
            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">
               <!-- Blog Search Well -->
               <div class="well">
                  <h4>Blog Search</h4>
                  <div class="input-group">
                     <input type="text" class="form-control">
                     <span class="input-group-btn">
                     <button class="btn btn-default" type="button">
                     <span class="glyphicon glyphicon-search"></span>
                     </button>
                     </span>
                  </div>
                  <!-- /.input-group -->
               </div>
               <!-- Blog Categories Well -->
               <div class="well">
                  <h4>Blog Categories</h4>
                  <div class="row">
                     <div class="col-lg-6">
                        <ul class="list-unstyled">
                           <li><a href="#">Category Name</a>
                           </li>
                           <li><a href="#">Category Name</a>
                           </li>
                           <li><a href="#">Category Name</a>
                           </li>
                           <li><a href="#">Category Name</a>
                           </li>
                        </ul>
                     </div>
                     <!-- /.col-lg-6 -->
                     <div class="col-lg-6">
                        <ul class="list-unstyled">
                           <li><a href="#">Category Name</a>
                           </li>
                           <li><a href="#">Category Name</a>
                           </li>
                           <li><a href="#">Category Name</a>
                           </li>
                           <li><a href="#">Category Name</a>
                           </li>
                        </ul>
                     </div>
                     <!-- /.col-lg-6 -->
                  </div>
                  <!-- /.row -->
               </div>
               <!-- Side Widget Well -->
               <div class="well">
                  <h4>Side Widget Well 1</h4>
                  <!--<pre id='info'></pre>-->
                  <div id="map"></div>
                  <pre id='distance' class='ui-distance'>Click to place a marker</pre>
               </div>
               <div class="well">
                  <h4>Side Widget Well 2</h4>
                  <?php echo widget('main_widget::wbanner1');?>
               </div>
               <div class="well">
                  <h4>Software empleado</h4>
                  <?php echo widget('main_widget::wbanner2');?>
               </div>
               <div class="well">
                  <h4>Side Widget Well 4</h4>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
               </div>
            </div>
         </div>
         <!-- /.row -->
         <hr>
         <!-- Footer -->
         <footer>
            <div class="row">
               <div class="col-lg-12">
                  <p>Copyright &copy; My Proy (Ej. Paginaci&oacute;n) 2016</p>
               </div>
               <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
         </footer>
      </div>
      <!-- /.container -->
      <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
      <!----------------------------- mapa ----------------------------------------------->        
      <script src='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.js'></script>        
      <script>
         L.mapbox.accessToken = 'pk.eyJ1IjoiYmxheW1vIiwiYSI6ImNpcXBocDg2bTAwNm1pNG5tanV3MGhlMTQifQ.AdVY_NiyRFiavkFi9wALyQ';
         var map = L.mapbox.map('map', 'mapbox.streets')
             .setView([42.43140, -8.65029], 13);
         
             // Start with a fixed marker.
         var fixedMarker = L.marker(new L.LatLng(42.43140, -8.65060), {
             icon: L.mapbox.marker.icon({
                 'marker-color': 'ff8888'
             })
         }).bindPopup('Nueva de arriba,17').addTo(map);
         
         // Store the fixedMarker coordinates in a variable.
         var fc = fixedMarker.getLatLng();
         
         // Create a featureLayer that will hold a marker and linestring.
         var featureLayer = L.mapbox.featureLayer().addTo(map);
         
         // When a user clicks on the map we want to
         // create a new L.featureGroup that will contain a
         // marker placed where the user selected the map and
         // a linestring that draws itself between the fixedMarkers
         // coordinates and the newly placed marker.
         map.on('click', function(ev) {
             // ev.latlng gives us the coordinates of
             // the spot clicked on the map.
             var c = ev.latlng;
         
             var geojson = [
               {
                 "type": "Feature",
                 "geometry": {
                   "type": "Point",
                   "coordinates": [c.lng, c.lat]
                 },
                 "properties": {
                   "marker-color": "#ff8888"
                 }
               }, {
                 "type": "Feature",
                 "geometry": {
                   "type": "LineString",
                   "coordinates": [
                     [fc.lng, fc.lat],
                     [c.lng, c.lat]
                   ]
                 },
                 "properties": {
                   "stroke": "#000",
                   "stroke-opacity": 0.5,
                   "stroke-width": 4
                 }
               }
             ];
         
             featureLayer.setGeoJSON(geojson);
         
             // Finally, print the distance between these two points
             // on the screen using distanceTo().
             var container = document.getElementById('distance');
             container.innerHTML = (fc.distanceTo(c)).toFixed(0) + 'm';
         });
         
         map.on('mousemove', function (e) {
             document.getElementById('info').innerHTML =
                 // e.point is the x, y coordinates of the mousemove event relative
                 // to the top-left corner of the map
                 JSON.stringify(e.point) + '<br />' +
                     // e.lngLat is the longitude, latitude geographical position of the event
                 JSON.stringify(e.lngLat);
         });
      </script>
   </body>
</html>
