<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pl_PL/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="row">
  <div class="col-lg-12">
    <h3>Konfiguracja</h3>
    <div class="row">
      <div class="col-lg-6">
        <div class="config_bar">
          <h4 class="cms_cmf_header">Nazwa</h4>
          <div class="form_edit_cms" id="cmsfg_form">
            <?php echo form_open('admin/settings/cmsname'); ?>
            <?php echo form_input('name', set_value('name', $cmsconfig->name),'class="input_wp"'); ?>
            <?php echo form_submit('submit', 'Zapisz', 'class="btn btn-primary no_border_radius"'); ?>
            <?php echo form_close();?>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="config_bar">
          <h4 class="cms_cmf_header">Ikona</h4>
          <div class="form_edit_cms" id="cmsfg_form_3">
          <p>Plik musi mieć rozmiary 16x16 i rozszerzenie .ico</p>
          <div class="clearfix"></div>
          <?php echo form_open_multipart('admin/settings/upload_icon');; ?>
          <?php echo form_upload('userfile','','class="input_file"'); ?>
          <br>
          <?php echo form_submit('upload', 'Zapisz', 'class="btn btn-primary no_border_radius"'); ?>
          <?php echo form_close();?>
          </div>
        </div>   
      </div>
    </div>
    <br><hr>
    <div class="row">
      <div class="col-lg-4">
        <div class="config_bar">
          <h4 class="cms_cmf_header">Status rejestracji</h4>
          <p>Włącz lub wyłącz rejestracje</p>
          <p>
            <?php if ($cmsconfig->register_status == 0): ?>
              <a href="<?php echo site_url('admin/settings/register_on') ?>">
                <button type="button" class="btn btn-primary no_border_radius">Włącz</button>
              </a>
            <?php else: ?>
              <a href="<?php echo site_url('admin/settings/register_off') ?>">
                <button type="button" class="btn btn-primary no_border_radius">Wyłącz</button>
              </a>
            <?php endif; ?>  
          </p>
        </div>  
      </div>
      <div class="col-lg-4">
        <div class="config_bar">
          <h4 class="cms_cmf_header">Status logowania</h4>
          <p>Włącz lub wyłącz logowanie</p>
          <p>
            <?php if ($cmsconfig->login_status == 0): ?>
              <a href="<?php echo site_url('admin/settings/login_on') ?>">
                <button type="button" class="btn btn-primary no_border_radius">Włącz</button>
              </a>
            <?php else: ?>
              <a href="<?php echo site_url('admin/settings/login_off') ?>">
                <button type="button" class="btn btn-primary no_border_radius">Wyłącz</button>
              </a>
            <?php endif; ?> 
          </p>
        </div> 
      </div>
      <div class="col-lg-4">
        <div class="config_bar">
          <h4 class="cms_cmf_header">Status sklepu</h4>
          <p>Włącz lub wyłącz logowanie</p>
          <p>
            <?php if ($cmsconfig->shop_status == 0): ?>
              <a href="<?php echo site_url('admin/settings/shop_on') ?>">
                <button type="button" class="btn btn-primary no_border_radius">Włącz</button>
              </a>
            <?php else: ?>
              <a href="<?php echo site_url('admin/settings/shop_off') ?>">
                <button type="button" class="btn btn-primary no_border_radius">Wyłącz</button>
              </a>
            <?php endif; ?> 
          </p>
        </div>  
      </div>
    </div>
    <br><hr>
    <div class="row">
      <div class="col-lg-6">
        <div class="config_bar">
          <h4 class="cms_cmf_header">Logo</h4>
          <div class="old_logo">
            <img src="<?php echo site_url() . $cmsconfig->cmslogo; ?>" alt="">
          </div>
          <?php echo form_open_multipart('admin/settings/upload_logo');; ?>
          <?php echo form_upload('userfile','','class="input_file"'); ?>
          <div class="clearfix"></div><br>
          <?php echo form_submit('upload', 'Zapisz', 'class="btn btn-primary no_border_radius btn_cmsconfig btn_save_data"'); ?>
          <?php echo form_close();?>
        </div>  
      </div>
      <div class="col-lg-6">
        <div class="config_bar">      
          <h4 class="cms_cmf_header">Facebook</h4>
          <p>Podaj link do fanpage</p>
          <div class="clearfix"></div>
          <?php echo form_open('admin/settings/facebook_link'); ?>
          <?php echo form_input('fb_link', '','class="input_wp"'); ?>
          <?php echo form_submit('submit', 'Zapisz', 'class="btn btn-primary no_border_radius btn_cmsconfig btn_save_data"'); ?>
          <?php echo form_close();?>
          <div class="clearfix"></div>
          <br>
          <div class="fb-like-box" data-href="<?php echo $cmsconfig->fb_link; ?>" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true" data-width="270"></div>
        </div>  
      </div>
    </div>
    <br><hr>
    <div class="row">
      <div class="col-lg-6">
        <div class="config_bar">
          <h4 class="cms_cmf_header">Link do forum</h4>
          <div class="form_edit_cms">
            <p>Podaj link do forum</p>
            <?php echo form_open('admin/settings/forum_link'); ?>
            <?php echo form_input('forum', set_value('forum',set_value('forum',$cmsconfig->forum_url)),'class="input_wp"'); ?>
            <div class="clearfix"></div><br>
            <?php echo form_submit('submit', 'Zapisz', 'class="btn btn-primary no_border_radius"'); ?>
            <?php echo form_close();?>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="config_bar">
          <h4 class="cms_cmf_header">Adres Team Speak 3</h4>
          <div class="form_edit_cms">
            <p>Podaj adres Team Speak 3</p>
            <?php echo form_open('admin/settings/ts_adress'); ?>
            <?php echo form_input('ts_adress', set_value('ts_adress',$cmsconfig->ts_adress),'class="input_wp"'); ?>
            <div class="clearfix"></div><br>
            <?php echo form_submit('submit', 'Zapisz', 'class="btn btn-primary no_border_radius"'); ?>
            <?php echo form_close();?>
          </div>
        </div>
      </div>
    </div>
    <br><hr>
    <div class="row">
      <div class="col-lg-6">
        <div class="config_bar">
          <h4 class="cms_cmf_header">O Serwerze</h4>
          <div class="form_edit_cms" id="cmsfg_form_7">
          <p>Opisz w kilku zdaniach serwer</p>
            <?php echo form_open('admin/settings/about_service'); ?>
            <?php
              $data_textarea = array(
                'name' => 'about_service',
                'value' => $cmsconfig->about,
                'class' => 'input_about',
                'rows' => 10,
                'cols' => 70
              );
             echo form_textarea($data_textarea); ?>
            <div class="clearfix"></div>
            <?php echo form_submit('submit', 'Zapisz', 'class="btn btn-primary no_border_radius"'); ?>
            <?php echo form_close();?>
          </div>
        </div>  
      </div>
      <div class="col-lg-6">
        <div class="config_bar">
          <h4 class="cms_cmf_header">Opis zawartości</h4>
          <div class="form_edit_cms" id="cmsfg_form_8">
            <p>Opisz w maksymalnie 10 słowach zawartość strony. *Ważne przy pozycjonowaniu strony.</p>
            <div class="clearfix"></div>
              <?php echo form_open('admin/settings/description'); ?>
                <?php
                  $data_textarea = array(
                    'name' => 'description',
                    'value' => $cmsconfig->description,
                    'class' => 'input_about',
                    'rows' => 10,
                    'cols' => 70
                  );
               echo form_textarea($data_textarea); ?>
              <div class="clearfix"></div>
              <?php echo form_submit('submit', 'Zapisz', 'class="btn btn-primary no_border_radius"'); ?>
              <?php echo form_close();?>
          </div>
        </div>  
      </div>
    </div>
    <br><hr>
    <div class="row">
      <div class="col-lg-12">
        <div class="config_bar">
          <h4 class="cms_cmf_header">Słowa kluczowe</h4>
          <p>Podaj słowa kluczowe oddzielone przecinkami. *Pamiętaj, aby podawać tylko słowa związane z treścią strony. Słowa niezgodne z treścią działają negatywnie na pozycjonowanie strony.</p>
          <div class="clearfix"></div>
            <?php echo form_open('admin/settings/keywords'); ?>
              <?php
                $data_textarea = array(
                  'name' => 'keywords',
                  'value' => $cmsconfig->keywords,
                  'class' => 'input_about',
                  'rows' => 10,
                  'cols' => 113
                );
             echo form_textarea($data_textarea); ?>
            <div class="clearfix"></div>
            <?php echo form_submit('submit', 'Zapisz', 'class="btn btn-primary no_border_radius"'); ?>
            <?php echo form_close();?>
        </div>    
      </div>
    </div>
    <br><hr>
    <div class="row">
      <div class="col-lg-12">
        <div class="config_bar">
          <h4 class="cms_cmf_header">Regulamin</h4>
           <div class="form_edit_cms" id="cmsfg_form_2">
            <?php echo form_open('admin/settings/cmsregulamin'); ?>
            <?php echo form_textarea('regulamin', set_value('regulamin', $cmsconfig->regulamin),'id="ckeditor" rows="4"'); ?>
            <div class="clearfix"></div>
            <?php echo form_submit('submit', 'Zapisz', 'class="btn btn-primary no_border_radius btn-block"'); ?>
            <?php echo form_close();?>
          </div>
        </div>  
      </div>
    </div>
  </div>
</div>
<div class="space100"></div>
