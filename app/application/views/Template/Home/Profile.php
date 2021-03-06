<?php
  $perfil_id      = $this->profile->usuario_id;
  $image_portada  = get_portada($perfil_id);
  $image_avatar   = get_avatar($perfil_id);
  $json           = json_decode($this->profile->json);
?>
<section class="slider mb-5 pb-0 shadow">
  <div class="jumbotron top shadow relative bg_portada" style="background-image:url(<?php echo $image_portada?>);">
    <?php
      if(!empty($this->user) && strtolower($this->user->login)==strtolower($this->uri->segment(2))){
    ?>
        <div id="cropContainerMinimal" data-bg=".bg_portada"></div>
        <div id="custom-btn" class="btn-edit btn-tooltip" title="Editar Imagen de Portada"  data-toggle="tooltip" data-placement="right">
          <i class="fas fa-edit fa-2x text-white"></i>
        </div>
    <?php
      }
    ?>
    <div class="container relative">
      <?php if(!empty($this->user) && strtolower($this->user->login)==strtolower($this->uri->segment(2))){ echo form_open(base_url("ApiRest/Push/Profile"),array('ajax' => 'true',"class"=>"form-signin"),array("token"=>$this->user->token));}	?>
        <div class="row p-5">
          <div class="col-12 col-sm-8 text-white bg-titles p-3" >
          <?php
            if(!empty($this->user) && strtolower($this->user->login)==strtolower($this->uri->segment(2))){
          ?>
            <div class="btn-edit btn-tooltip toggle" data-form="true" data-toggle="tooltip" data-placement="right"   title="Editar Información Personal">
              <i class="fas fa-edit fa-2x text-white toggle"></i>
            </div>
            <?php
              }
            ?>
            <h3>Promotor</h3>
            <h2 class="display-4 font-secundary">
              <span class="toggle string_nombres"><?php echo (isset($this->profile->nombres))?$this->profile->nombres:"Ej: Carlos";?></span>
              <span class="toggle hide">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Nombres</span>
                  </div>
                  <?php echo set_input("nombres",@$this->profile->nombres,'Nombres',true,null,array("id"=>"basic-addon2"));?>
                </div>
              </span>
              <span class="toggle string_apellidos"><?php echo (isset($this->profile->apellidos))?$this->profile->apellidos:"Castillo";?></span>
              <span class="toggle hide">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon2">Apellidos</span>
                  </div>
                  <?php echo set_input("apellidos",@$this->profile->apellidos,'Apellidos',true,null,array("id"=>"basic-addon2"));?>
                </div>
              </span>
            </h2>
            <span class="toggle hide">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text string_telefono" id="basic-addon2">Teléfono</span>
                </div>
                <?php echo set_input("telefono",@$this->profile->telefono,'Teléfono',true);?>
              </div>
            </span>
            <span class="toggle hide">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text " id="basic-addon2">Correo electrónico</span>
                </div>
                <?php echo set_input("json[email]",@$json->email,'email@suwebsite.com',true);?>
              </div>
            </span>
            <span class="toggle hide">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text string_website" id="basic-addon2">Website</span>
                </div>
                <?php echo set_input("json[website]",@$json->website,'suwebsite.com',true);?>
              </div>
            </span>
            <span class="toggle hide">
              <div class="row">
                <div class="col-4">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text string_website" id="basic-addon2"><i class="fab fa-facebook fa-1x"></i></span>
                    </div>
                    <?php echo set_input("json[facebook]",@$json->facebook,'Facebook',true);?>
                  </div>
                </div>
                <div class="col-4">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text string_website" id="basic-addon2"><i class="fab fa-twitter fa-1x"></i></span>
                    </div>
                    <?php echo set_input("json[twitter]",@$json->twitter,'Twitter',true);?>
                  </div>
                </div>
                <div class="col-4">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text string_website" id="basic-addon2"><i class="fab fa-instagram fa-1x"></i></span>
                    </div>
                    <?php echo set_input("json[instagram]",@$json->instagram,'Instagram',true);?>
                  </div>
                </div>
              </div>
            </span>
            <ul class="list toggle">
              <li>
                <span class="toggle p-3"><?php echo (isset($this->profile->telefono))?$this->profile->telefono:"0414-0000000";?></span>
              </li>
              <li>
                <span class="toggle p-3"><?php echo (isset($json->email))?$json->email:"email@suwebsite.com";?></span>
              </li>
              <li>
                <span class="toggle p-3"><?php echo (isset($json->website))?$json->website:"suwebsite.com";?></span>
              </li>
            </ul>
            <div class="toggle hide">
              <div class="btn-group " role="group" aria-label="Basic example">
                <button type="submit" class="btn btn-secondary">Guardar</button>
                <button type="button" class="btn btn-secondary close-toggle">Cancelar</button>
              </div>
            </div>
          </div>
        </div>
      <?php if(!empty($this->user) && strtolower($this->user->login)==strtolower($this->uri->segment(2))){ echo form_close();}?>
      <div class="row text-center">
        <div class="col">
          <div class="image-profile">
            <div class="row justify-content-md-center" >
              <div class="col-3" id="btnavatar" data-bg=".bg_portada">
                <?php
                  if(!empty($this->user) && strtolower($this->user->login)==strtolower($this->uri->segment(2))){
                ?>
                    <div id="cropContainerMinimal2"></div>
                    <div class="btn-edit btn-tooltip" id="custom-btn2"  data-toggle="tooltip" data-placement="right"  title="Editar Avatar">
                      <i class="fas fa-edit fa-2x text-white"></i>
                    </div>
                <?php
                  }
                ?>
                <div >
                  <img id="avatar" src="<?php echo $image_avatar?>" class="rounded-circle" alt="..." style="width:200px;">
                </div>
              </div>
            </div>

            <div class="row justify-content-md-center mt-3">
                <div class="col-1">
                  <i class="fab fa-facebook fa-3x"></i>
                </div>
                <div class="col-1">
                  <i class="fab fa-twitter fa-3x"></i>
                </div>
                <div class="col-1">
                  <i class="fab fa-instagram fa-3x"></i>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="super-separador"></div>
<div class="super-separador"></div>
<section class="bg-white ">
  <div class="container shadow" style="background:#ddd;">
    <div class="text-left p-5 relative">
      <h1 class="font-secundary">
        Inmuebles
      </h1>
      <h2>Destacados</h2>
      <?php
        if(!empty($this->user) && strtolower($this->user->login)==strtolower($this->uri->segment(2))){
      ?>
          <a href="<?php echo base_url("Gestion/Inmuebles/Add/0/Iframe")?>" class="btn-edit btn-tooltip" data-toggle="tooltip" data-placement="right"  title="Agregar nuevo inmueble">
            <i class="fas fa-plus fa-2x text-secondary"></i>
          </a>
      <?php
        }
      ?>
    </div>
    <div class="row text-center">
      <div class="col-12 col-sm-3 p-0 m-0 position-relative hover-link-effect">
        <a class="text-white" href="#" >
          <div class="position-absolute hover-link p-5">
            <h2 class="">Casa</h2>
            <h3>Valencia</h3>
          </div>
        </a>
        <img class=" img-fluid" src="<?php echo IMG?>design/10.jpg" alt="Art Fit Center">
      </div>
      <div class="col-12 col-sm-3 p-0 m-0 position-relative hover-link-effect">
        <a class="text-white" href="#" >
          <div class="position-absolute hover-link p-5">
            <h2 class="">Apartamento</h2>
            <h3>Caracas</h3>
          </div>
        </a>
        <img class=" img-fluid" src="<?php echo IMG?>design/07.jpg" alt="B2U Jeans">
      </div><div class="col-12 col-sm-3 p-0 m-0 position-relative hover-link-effect">
        <a class="text-white" href="#" >
          <div class="position-absolute hover-link p-5">
            <h2 class="">Apartamento</h2>
            <h3>Barinas</h3>
          </div>
        </a>
        <img class=" img-fluid" src="<?php echo IMG?>design/08.jpg" alt="Eventos Nueva Estación">
      </div><div class="col-12 col-sm-3 p-0 m-0 position-relative hover-link-effect">
        <a class="text-white" href="#" >
          <div class="position-absolute hover-link p-5">
              <h2 class="">Finca</h2>
              <h3>Barinas</h3>
          </div>
        </a>
        <img class=" img-fluid" src="<?php echo IMG?>design/09.jpg" alt="Dina diesel">
      </div>
    </div>
  </div>
</section>

<!--section class="bg-white">
  <div class="container-fluid">
    <div class="text-center p-5">
      <h1 class="font-secundary">
        Otros
      </h1>
      <h2>Inmuebles</h2>
    </div>
    <div class="row text-center">
      <div class="col-12 col-sm-2 p-0 m-0 position-relative hover-link-effect">
        <a class="text-white" href="#" >
          <div class="position-absolute hover-link p-5">
              <h6>La Pastora</h6>
          </div>
        </a>
        <img class=" img-fluid" src="<?php echo IMG?>design/01.jpg" alt="Art Fit Center">
      </div>
      <div class="col-12 col-sm-2 p-0 m-0 position-relative hover-link-effect">
        <a class="text-white" href="#" >
          <div class="position-absolute hover-link p-5">
              <h6>CCCT</h6>
          </div>
        </a>
        <img class=" img-fluid" src="<?php echo IMG?>design/06.jpg" alt="B2U Jeans">
      </div>
      <div class="col-12 col-sm-2 p-0 m-0 position-relative hover-link-effect">
        <a class="text-white" href="#" >
          <div class="position-absolute hover-link p-5">
              <h6>Las Mercedes</h6>
          </div>
        </a>
        <img class=" img-fluid" src="<?php echo IMG?>design/02.jpg" alt="Eventos Nueva Estación">
      </div>
      <div class="col-12 col-sm-2 p-0 m-0 position-relative hover-link-effect">
        <a class="text-white" href="#" >
          <div class="position-absolute hover-link p-5">
              <h6>El Marqués</h6>
          </div>
        </a>
        <img class=" img-fluid" src="<?php echo IMG?>design/03.jpg" alt="Dina diesel">
      </div>
      <div class="col-12 col-sm-2 p-0 m-0 position-relative hover-link-effect">
        <a class="text-white" href="#" >
          <div class="position-absolute hover-link p-5">
              <h6>Av Panteón</h6>
          </div>
        </a>
        <img class=" img-fluid" src="<?php echo IMG?>design/04.jpg" alt="Art Fit Center">
      </div>
      <div class="col-12 col-sm-2 p-0 m-0 position-relative hover-link-effect">
        <a class="text-white" href="#" >
          <div class="position-absolute hover-link p-5">
              <h6>CCCT</h6>
          </div>
        </a>
        <img class=" img-fluid" src="<?php echo IMG?>design/05.jpg" alt="Eventos Nueva Estación">
      </div>
    </div>
  </div>
</section>
<section class="bg-success text-center p-5 text-white">
  <h1 class="font-secundary">
    Ubicación fácil de encontrar
  </h1>
  <h2>¡fíjate del mapa!</h2>
  <p>Radal 189, Santiago, Estación Central, Región Metropolitana, Chile</p>
</section-->

<section class="bg-green mt-5 shadow">
  <div class="container ">
    <h1 class="font-secundary p-5">
      Redes Sociales
    </h1>
    <div class="row pb-5">
      <div class="col-12 col-sm-4 ">
        <div class="redes-timeline">
          <i class="fab fa-facebook fa-5x"></i>
          <p>facebook</p>
        </div>
      </div>
      <div class="col-12 col-sm-4 ">
        <div class="redes-timeline">
          <i class="fab fa-twitter fa-5x"></i>
          <p>twitter</p>
        </div>
      </div>
      <div class="col-12 col-sm-4">
        <div class="redes-timeline">
          <i class="fab fa-instagram fa-5x"></i>
          <p>instagram</p>
        </div>
      </div>
    </div>
  </div>
</section>
<script>
var croppicContaineroutputMinimal = {
    imgBG:".bg_portada",
    customUploadButtonId:'custom-btn',
    uploadUrl:'<?php echo base_url("ApiRest/Upload/ImagesUp?folder=".$this->user->usuario_id."&name=portada")?>',
    cropUrl:'<?php echo base_url("ApiRest/Upload/ImagesCrop?folder=".$this->user->usuario_id."&name=portada")?>',
    modal:false,
    doubleZoomControls:false,
    rotateControls: false,
    loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
    onBeforeImgUpload: function(){ console.log('onBeforeImgUpload') },
    onAfterImgUpload: function(){ console.log('onAfterImgUpload') },
    onImgDrag: function(){ console.log('onImgDrag') },
    onImgZoom: function(){ console.log('onImgZoom') },
    onBeforeImgCrop: function(){ console.log('onBeforeImgCrop') },
    onAfterImgCrop:function(){ console.log('onAfterImgCrop') },
    onReset:function(){ console.log('onReset') },
    onError:function(errormessage){ console.log('onError:'+errormessage) }
}
var cropContaineroutput = new Croppic('cropContainerMinimal', croppicContaineroutputMinimal);


var croppicContaineroutputMinimal2 = {
    imgSrcChange:"#avatar",
    customUploadButtonId:'custom-btn2',
    uploadUrl:'<?php echo base_url("ApiRest/Upload/ImagesUp?folder=".$this->user->usuario_id."&name=avatar")?>',
    cropUrl:'<?php echo base_url("ApiRest/Upload/ImagesCrop?folder=".$this->user->usuario_id."&name=avatar")?>',
    modal:false,
    doubleZoomControls:false,
    rotateControls: false,
    loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
    onBeforeImgUpload: function(){ console.log('onBeforeImgUpload') },
    onAfterImgUpload: function(){ console.log('onAfterImgUpload') },
    onImgDrag: function(){ console.log('onImgDrag') },
    onImgZoom: function(){ console.log('onImgZoom') },
    onBeforeImgCrop: function(){ console.log('onBeforeImgCrop') },
    onAfterImgCrop:function(){ console.log('onAfterImgCrop') },
    onReset:function(){ console.log('onReset') },
    onError:function(errormessage){ console.log('onError:'+errormessage) }
}
var cropContaineroutput2 = new Croppic('cropContainerMinimal2', croppicContaineroutputMinimal2);

function toggle(data){
  variable =  $.parseJSON(JSON.stringify(data));
  $.each(variable,function(k,v){
    console.log(v)
    console.log(k)
    $(".string_"+k).html(v);
  })
  $(".active").find(".toggle").toggle();
}

</script>
