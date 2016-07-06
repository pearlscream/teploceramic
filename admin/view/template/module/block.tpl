<?php function renderField($key, $field, $language, $num, $numi, $numi2, $grid = false, $gr = false){ ?>
  <div class="form-group">
  <?php if($field['type'] == 'img' || $field['type'] == 'limg'){ ?>
  <label class="col-sm-2 control-label">Картинка <?php echo $numi; ?></label>
  <?php }else{ ?>
  <label class="col-sm-2 control-label">Текстовое поле <?php echo $num; ?></label>
  <?php } ?>

  <div class="col-sm-10">
  <?php switch ($field['type']) {
    case 'textarea':
      echo '<textarea rows="5" name="fields[' . $language['language_id'] . ']'. (($grid)?'[' . $grid . '][' . $gr . ']':'') .'[' . $key . '][value]" class="form-control">' . $field['value'] . '</textarea>';
      break;

    case 'img':
      // print_r($field);
      $find = array('/catalog\/view/','/catalog\/(?!view)/');
      $replace = array('../catalog/view','../image/catalog/');
      echo '<div class="col-sm-2"><a href="" id="thumb-image' . $language['language_id'] . '' . $numi2 . '" data-toggle="image" class="img-thumbnail"><img src="' . preg_replace($find, $replace, $field['value']) . '" width="100" height="100" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a><input type="hidden" name="fields[' . $language['language_id'] . ']'. (($grid)?'[' . $grid . '][' . $gr . ']':'') .'[' . $key . '][value]" value="' . $field['value'] . '" class="image" id="input-image' . $language['language_id'] . '' . $numi2 . '" /></div><div class="col-sm-10">';
      echo '<label>width<input type="text" name="fields[' . $language['language_id'] . ']'. (($grid)?'[' . $grid . '][' . $gr . ']':'') .'[' . $key . '][width]" value="' . $field['width'] . '" class="form-control" /></label>';
      echo '<label>height<input type="text" name="fields[' . $language['language_id'] . ']'. (($grid)?'[' . $grid . '][' . $gr . ']':'') .'[' . $key . '][height]" value="' . $field['height'] . '" class="form-control" /></label><br>';
      echo '<label>alt</label><input type="text" name="fields[' . $language['language_id'] . ']'. (($grid)?'[' . $grid . '][' . $gr . ']':'') .'[' . $key . '][alt]" value="' . $field['alt'] . '" class="form-control" />';
      echo '<label>title</label><input type="text" name="fields[' . $language['language_id'] . ']'. (($grid)?'[' . $grid . '][' . $gr . ']':'') .'[' . $key . '][title]" value="' . $field['title'] . '" class="form-control" />';
      echo '</div>';
      break;

    case 'limg':
      // print_r($field);
      $find = array('/catalog\/view/','/catalog\/(?!view)/');
      $replace = array('../catalog/view','../image/catalog/');
      echo '<div class="col-sm-2"><a href="" id="thumb-image' . $language['language_id'] . '' . $numi2 . '" data-toggle="image" class="img-thumbnail"><img src="' . preg_replace($find, $replace, $field['value']) . '" width="100" height="100" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a><input type="hidden" name="fields[' . $language['language_id'] . ']'. (($grid)?'[' . $grid . '][' . $gr . ']':'') .'[' . $key . '][value]" value="' . $field['value'] . '" class="image" id="input-image' . $language['language_id'] . '' . $numi2 . '" /></div><div class="col-sm-10">';
      echo '<label>width<input type="text" name="fields[' . $language['language_id'] . ']'. (($grid)?'[' . $grid . '][' . $gr . ']':'') .'[' . $key . '][width]" value="' . $field['width'] . '" class="form-control" /></label>';
      echo '<label>height<input type="text" name="fields[' . $language['language_id'] . ']'. (($grid)?'[' . $grid . '][' . $gr . ']':'') .'[' . $key . '][height]" value="' . $field['height'] . '" class="form-control" /></label><br>';
      echo '<label>alt</label><input type="text" name="fields[' . $language['language_id'] . ']'. (($grid)?'[' . $grid . '][' . $gr . ']':'') .'[' . $key . '][alt]" value="' . $field['alt'] . '" class="form-control" />';
      echo '<label>title</label><input type="text" name="fields[' . $language['language_id'] . ']'. (($grid)?'[' . $grid . '][' . $gr . ']':'') .'[' . $key . '][title]" value="' . $field['title'] . '" class="form-control" />';
      echo '</div>';
      break;

    default:
      echo '<input type="text" name="fields[' . $language['language_id'] . ']'. (($grid)?'[' . $grid . '][' . $gr . ']':'') .'[' . $key . '][value]" value="' . $field['value'] . '" class="form-control" />';
      break;
  } ?>
    <input type="hidden" name="fields[<?php echo $language['language_id']; ?>]<?php echo (($grid)?'[' . $grid . '][' . $gr . ']':''); ?>[<?php echo $key; ?>][type]" value="<?php echo $field['type']; ?>" />
  </div>
  </div>
<?php } // renderField /////////////////////////////////////////////// ?>
<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-block" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-block" class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_name; ?></label>
            <div class="col-sm-10">
              <input type="text" name="name" value="<?php echo $name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
              <?php if ($error_name) { ?>
              <div class="text-danger"><?php echo $error_name; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="status" id="input-status" class="form-control">
                <?php if ($status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
<!-- module code //////////////////////////////////////// -->
          <div id="head" class="form-group<?php if ($fields){ ?> hidden<?php } ?>">
            <div class="col-sm-2 control-label">
              <label class="control-label" for="input-head"><?php echo $entry_head; ?></label>
            </div>
            <div class="col-sm-10">
              <textarea name="head" placeholder="<?php echo $entry_head; ?>" id="input-head" class="form-control" rows="7"><?php echo $head; ?></textarea>
              <?php if ($error_head) { ?>
              <div class="text-danger"><?php echo $error_head; ?></div>
              <?php } ?>
            </div>
          </div>
          <div id="code" class="form-group<?php if ($fields){ ?> hidden<?php } ?>">
            <div class="col-sm-2 control-label">
              <label class="control-label" for="input-code"><?php echo $entry_code; ?></label>
              <br><br><br><br>
              <button type="button" id="button_code" class="btn btn-danger"><?php echo $button_code; ?></button>
            </div>
            <div class="col-sm-10">
              <textarea name="code" placeholder="<?php echo $entry_code; ?>" id="input-code" class="form-control" rows="7"><?php echo $code; ?></textarea>
              <?php if ($error_code) { ?>
              <div class="text-danger"><?php echo $error_code; ?></div>
              <?php } ?>
            </div>
          </div>
<!-- /module code /////////////////////////////////////// -->
          <div class="tab-pane">
            <ul class="nav nav-tabs" id="language">
              <?php foreach ($languages as $language) { ?>
              <li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
              <?php } ?>
            </ul>
            <style>
              .preview{
                width: 100%;
                height: 300px;
                border: 1px solid #000;
                margin-bottom: 20px;
              }
            </style>
            <div class="tab-content">

              <?php foreach ($languages as $language) { ?>
              <div class="tab-pane" id="language<?php echo $language['language_id']; ?>">
              <!-- <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?> -->
<!-- fields code //////////////////////////////////////// -->
              <?php $num = 1 ; ?>
              <?php $numi = 1 ; ?>
              <?php $numi2 = 1 ; ?>
              <?php if ($fields){ ?>
              <iframe id="block-<?php echo $language['language_id']; ?>" class="preview"></iframe>
              <?php foreach ($fields[$language['language_id']] as $key => $field){ ?>
                <?php if (isset($field['type'])){ ?>
                  <?php renderField($key, $field, $language, $num, $numi, $numi2); ?>
                <?php }else{ ?>
                  <div class="panel panel-default" id="<?php echo $key ?>-<?php echo $language['language_id']; ?>">
                    <div class="panel-heading">
                      <h3 class="panel-title"><?php echo $key ?></h3>
                    </div>
                    <div class="panel-body">
                      <table class="table table-bordered" style="background: #FFFFD3;">
                      <?php foreach ($field as $key2 => $fields2){ ?>
                        <tr><td>
                        <?php foreach ($fields2 as $key3 => $field3){ ?>
                          <?php renderField($key3, $field3, $language, $num, $numi, $numi2, $key, $key2); ?>
                          <?php $numi2++; ?>
                        <?php } ?>
                        </td><td><button type="button" class="del btn btn-danger"><i class="fa fa-trash-o"></i></button></td></tr>
                      <?php } ?>
                      </table>
                      <button type="button" class="add btn btn-primary btn-block"><?php echo $text_more; ?></button>
                    </div>
                  </div>
                <?php } ?>
                <?php $num++; ?>
                <?php $numi++; ?>
                <?php $numi2++; ?>
              <?php } ?>
              <?php } ?>
              </div><!-- /.tab-pane -->
<!-- /fields code /////////////////////////////////////// -->
              <?php } ?>
            </div><!-- /.tab-content -->
          </div><!-- /.tab-pane -->
          </div>
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript"><!--
<?php /*foreach ($languages as $language) { ?>
$('#input-description<?php echo $language['language_id']; ?>').summernote({height: 300});
<?php }*/ ?>
//--></script>
  <script type="text/javascript"><!--
$('#language a:first').tab('show');
//--></script></div>

<script><!--
CodeMirror.defineMode("mustache", function(config, parserConfig) {
  var mustacheOverlay = {
    token: function(stream, state) {
      // console.log(state);
      if (stream.match(/\{\{\/{0,1}group.*?\}\}/i, true)) {
        return "group";
      }
      if (stream.match(/\{\{.*?\|{0,1}(.*?)\}\}/i, true)) {
        return "mustache";
      }
      while (stream.next() != null && !stream.match("{{", false)) {}
      return null;
    }
  };
  return CodeMirror.overlayMode(CodeMirror.getMode(config, parserConfig.backdrop || "text/html"), mustacheOverlay);
});
window.editor = CodeMirror.fromTextArea(document.getElementById('input-code'), {
  mode: 'mustache',
  tabMode: 'indent',
  lineNumbers: true,
  matchBrackets: true,
  indentWithTabs: true,
  tabSize: 3,
  indentUnit: 3,
  lineWrapping: true,
  theme: 'monokai',
  matchTags: {bothTags: true},
  extraKeys: {"Ctrl-J": "toMatchingTag"}
});
window.editorh = CodeMirror.fromTextArea(document.getElementById('input-head'), {
  mode: 'text/html',
  tabMode: 'indent',
  lineNumbers: true,
  matchBrackets: true,
  indentWithTabs: true,
  tabSize: 3,
  indentUnit: 3,
  lineWrapping: true,
  theme: 'monokai'
});


$('#button_code').click(function(e){
  e.preventDefault();

  // var code = $('#input-code').val();
  var code = window.editor.getValue() || $('#input-code').val();

    var out = '<iframe id="block-{}" class="preview"></iframe>';
  //grops of fields

  var groups = code.match(/\{\{group +name=['"]([.\s\S]*?)['"].*?\}\}([.\s\S]*?)\{\{\/group\}\}/g);
// console.log(groups);
  for (gr in groups) {
    code = code.replace(groups[gr],'');
    var grid = groups[gr].match(/name=['"](.*?)['"]/)[1];
    // var gr = 1;
    out += '<div class="panel panel-default" id="' + grid + '-{}"><div class="panel-heading"><h3 class="panel-title">' + grid + '</h3></div><div class="panel-body"><table class="table table-bordered" style="background: #FFFFD3;"><tr><td>';
    out += buildFields(groups[gr].replace(/\{\{\/{0,1}group.*?\}\}/g,''), grid, gr);
    out += '</td><td><button type="button" class="del btn btn-danger"><i class="fa fa-trash-o"></i></button></td></tr></table><button class="add btn btn-primary btn-block"><?php echo $text_more; ?></button></div></div>';
  }
  // console.log(groups);
  // console.log(code);

  //regular fields
  function buildFields(code, grid, gr){
    grid = grid || false;
    gr   = gr || false;

    var txt = code.match(/\{\{([\s\S]*?)\|{0,1}(.*)\}\}/g);

    var out = '';
    for (key in txt) {
      var val = txt[key].replace(/[\{\}]/g,'').split('|');

      out += '<div class="form-group">';
      out += '<label class="col-sm-2 control-label">' + val[0].replace(/src=(["'])catalog\/view/, 'src=$1../catalog/view') + '</label>';
      out += '<div class="col-sm-10">';
      switch(val[1]){
        case "textarea":
          out += '<textarea rows="5" name="fields[{}]' + ((grid)?'[' + grid + '][0]':'') + '[' + val[0].replace(/\n/g,'%0D%0A') + '][value]" class="form-control">' + val[0] + '</textarea>';
          break;
        case "img":
          var img = val[0].match(/src=["'](.*?)["']/);
          var height = val[0].match(/height=["'](.*?)["']/);
          var width = val[0].match(/width=["'](.*?)["']/);
          var alt = val[0].match(/alt=["'](.*?)["']/);
          var title = val[0].match(/title=["'](.*?)["']/);
          // console.log(img, height, width);
          out +='<div class="col-sm-2"><a href="" id="thumb-image{}' + key + '' + (gr?gr:'') + '" data-toggle="image" class="img-thumbnail"><img src="' + img[1].replace(/catalog\/view/, '../catalog/view') + '" width="100" height="100" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a><input type="hidden" name="fields[{}]' + ((grid)?'[' + grid + '][0]':'') + '[' + img[1] + '][value]" value="' + img[1] + '" class="image" id="input-image{}' + key + '' + (gr?gr:'') + '" /></div><div class="col-sm-10">';
          out +='<label>width<input type="text" name="fields[{}]' + ((grid)?'[' + grid + '][0]':'') + '[' + img[1] + '][width]" value="' + (width?width[1]:'') + '" class="form-control" /></label>';
          out +='<label>height<input type="text" name="fields[{}]' + ((grid)?'[' + grid + '][0]':'') + '[' + img[1] + '][height]" value="' + (height?height[1]:'') + '" class="form-control" /></label><br>';
          out +='<label>alt</label><input type="text" name="fields[{}]' + ((grid)?'[' + grid + '][0]':'') + '[' + img[1] + '][alt]" value="' + (alt?alt[1]:'') + '" class="form-control" />';
          out +='<label>title</label><input type="text" name="fields[{}]' + ((grid)?'[' + grid + '][0]':'') + '[' + img[1] + '][title]" value="' + (title?title[1]:'') + '" class="form-control" />';
          out +='</div>';
          break;
        case "limg":
          var img = val[0].match(/src=["'](.*?)["']/);
          // console.log(img);
          // console.log(val[0]);
          var height = val[0].match(/height=["'](.*?)["']/);
          var width = val[0].match(/width=["'](.*?)["']/);
          var alt = val[0].match(/alt=["'](.*?)["']/);
          var title = val[0].match(/title=["'](.*?)["']/);
          // console.log(img, height, width);
          out +='<div class="col-sm-2"><a href="" id="thumb-image{}' + key + '' + (gr?gr:'') + '" data-toggle="image" class="img-thumbnail"><img src="' + img[1].replace(/catalog\/view/, '../catalog/view') + '" width="100" height="100" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a><input type="hidden" name="fields[{}]' + ((grid)?'[' + grid + '][0]':'') + '[' + img[1] + '][value]" value="' + img[1] + '" class="image" id="input-image{}' + key + '' + (gr?gr:'') + '" /></div><div class="col-sm-10">';
          out +='<label>width<input type="text" name="fields[{}]' + ((grid)?'[' + grid + '][0]':'') + '[' + img[1] + '][width]" value="' + (width?width[1]:'') + '" class="form-control" /></label>';
          out +='<label>height<input type="text" name="fields[{}]' + ((grid)?'[' + grid + '][0]':'') + '[' + img[1] + '][height]" value="' + (height?height[1]:'') + '" class="form-control" /></label><br>';
          out +='<label>alt</label><input type="text" name="fields[{}]' + ((grid)?'[' + grid + '][0]':'') + '[' + img[1] + '][alt]" value="' + (alt?alt[1]:'') + '" class="form-control" />';
          out +='<label>title</label><input type="text" name="fields[{}]' + ((grid)?'[' + grid + '][0]':'') + '[' + img[1] + '][title]" value="' + (title?title[1]:'') + '" class="form-control" />';
          out +='</div>';
          break;
        default:
          out += '<input type="text" name="fields[{}]' + ((grid)?'[' + grid + '][0]':'') + '[' + val[0] + '][value]" value="' + val[0] + '" class="form-control" />';
          break;
      }
      if(val[0] == 'undefined'){
        type = 'text'
      }else{
        type = val[0]
        if(val[1] == 'img' || val[1] == 'limg'){
          val[0] = img[1];
        }
      };
      out += '<input type="hidden" name="fields[{}]' + ((grid)?'[' + grid + '][0]':'') + '[' + val[0] + '][type]" value="' + val[1] + '" />'
      out += '</div>\n';
      out += '</div>\n';
    }
    return out;
  }
  out += buildFields(code);
  //console.log(out);
  $('.tab-content .tab-pane').each(function(){
    var lang = $(this).attr('id').replace(/language/,'');
    $(this).html(out.replace(/\{\}/g, lang ));
    // console.log(out);
  });
  // console.log(fields);
  delay = setTimeout(updPreview, 1);

});

var delay;

function updPreview(){
  var previewFrame = $('.preview').each(function(){
    var preview =  this.contentDocument || this.contentWindow.document;
    preview.open();

    var head =  window.editorh.getValue() || $('#input-head').val();
    preview.write(head);

    // var code = $('#input-code').val();
    var code = window.editor.getValue() || $('#input-code').val();

    var groups = code.match(/\{\{group +name=['"]([.\s\S]*?)['"].*?\}\}([.\s\S]*?)\{\{\/group\}\}/g);
    var lang = $(this).attr('id').replace(/block\-/,'');

    for (gr in groups) {
      var grid   = groups[gr].match(/name=[\'"](.*?)[\'"]/)[1];
      // console.log(grid);
      // console.log(gr);
      var groupe = groups[gr].replace(/\{\{\/{0,1}group.*?\}\}/g,'');
      // console.log(groupe);
      var grFields = [];
      $('#' + grid + '-' + lang + ' tr').each(function(gr){
        grFields[gr] = renderFields(groupe, lang, grid, gr);
        // console.log(this);
        // console.log(grFields[gr]);
        // console.log($(this).find('[name*="fields[' + lang + '][' + grid + ']"]').serializeArray());
      });
        // console.log(grFields);
      code = code.replace(groups[gr], grFields.join(''));
    }

    function renderFields(code, lang, grid, gr){
      var txt = code.match(/\{\{([\s\S]*?)\|{0,1}(.*)\}\}/g);
      for (key in txt) {
        var val = txt[key].replace(/[\{\}]/g,'').split('|');

        if(val[1] != 'img' && val[1] != 'limg'){
          var value = $('[name="fields[' + lang + ']' + ((grid)?'[' + grid + '][' + gr + ']':'') + '[' + val[0].replace(/\n/g,'%0D%0A') + '][value]"]').val();
          code = code.replace(txt[key], value);
        }else if(val[1] == 'img'){

          var val2 = val[0].replace(/<.*src=[\'"](.*?)[\'"].*>/,'$1').trim();
          var iclass = txt[key].match(/class=[\'"].*?[\'"]/);

          var value = $('[name="fields[' + lang + ']' + ((grid)?'[' + grid + '][' + gr + ']':'') + '[' + val2 + '][value]"]').val();
          var width = $('[name="fields[' + lang + ']' + ((grid)?'[' + grid + '][' + gr + ']':'') + '[' + val2 + '][width]"]').val();
          var height = $('[name="fields[' + lang + ']' + ((grid)?'[' + grid + '][' + gr + ']':'') + '[' + val2 + '][height]"]').val();
          var alt = $('[name="fields[' + lang + ']' + ((grid)?'[' + grid + '][' + gr + ']':'') + '[' + val2 + '][alt]"]').val();
          var title = $('[name="fields[' + lang + ']' + ((grid)?'[' + grid + '][' + gr + ']':'') + '[' + val2 + '][title]"]').val();

          var value2 = '<img src="' + (value?value.replace(/catalog\/(?!view)/,'../image/catalog/'):'') + '" width="' + width + '" height="' + height + '" alt="' + alt + '" title="' + title + '"' + (iclass?' ' + iclass:'') + ' />';
          code = code.replace(txt[key], value2);
        }else if(val[1] == 'limg'){

          var val2 = val[0].replace(/<.*src=["'](.*?)["'].*>/,'$1').trim();

          var value = $('[name="fields[' + lang + ']' + ((grid)?'[' + grid + '][' + gr + ']':'') + '[' + val2 + '][value]"]').val();
          var width = $('[name="fields[' + lang + ']' + ((grid)?'[' + grid + '][' + gr + ']':'') + '[' + val2 + '][width]"]').val();
          var height = $('[name="fields[' + lang + ']' + ((grid)?'[' + grid + '][' + gr + ']':'') + '[' + val2 + '][height]"]').val();
          var alt = $('[name="fields[' + lang + ']' + ((grid)?'[' + grid + '][' + gr + ']':'') + '[' + val2 + '][alt]"]').val();
          var title = $('[name="fields[' + lang + ']' + ((grid)?'[' + grid + '][' + gr + ']':'') + '[' + val2 + '][title]"]').val();
          var value2 = '<img src="' + value.replace(/catalog\/(?!view)/,'../image/catalog/') + '" width="' + width + '" height="' + height + '" alt="' + alt + '" title="' + title + '" />';
          var ff = val[0].replace(/<img.*?>/,value2).replace(/href=[\'"].*?[\'"]/, 'href="' + value.replace(/catalog\/(?!view)/,'../image/catalog/') + '"').replace(/title=[\'"].*?[\'"]/, 'title="' + title + '"');
          // console.log(width, height, alt);
          // console.log(val[0]);
          // console.log(val2);
          // console.log(ff);
          code = code.replace(txt[key],ff);
        }
      }
      return code;
    }

    code = renderFields(code, lang);
    preview.write(code.replace(/catalog\/view/g,'../catalog/view'));

    preview.close();
  });

  setTimeout(function(){
    $('.preview').each(function(){
        this.style.height = (this.contentWindow.document.body.scrollHeight || 200) + 2 + 'px' ;
    });
  }, 800);

}

$(document).on('keydown', '.tab-pane input, .tab-pane textarea', function(){
  clearTimeout(delay);
  delay = setTimeout(updPreview, 500);
}).on('change', 'input.image', function(){
  clearTimeout(delay);
  updPreview();
});

$(document).on('click', '.add', function(e){
  e.preventDefault();
  var table = $(this).parent();
  var add = table.find('tr:first').html();
  var num = table.find('tr').length;
  // console.log(add.replace(/\[0\]/g, '[' + num + ']'));
  table.find('table').append('<tr>' + add.replace(/\[0\]/g, '[' + num + ']').replace(/thumb\-image([0-9]+)/,'thumb-image$1' + num).replace(/input\-image([0-9]+)/,'input-image$1' + num) + '</tr>');
  clearTimeout(delay);
  updPreview();
});
$(document).on('click', 'tr:not(:first-child) .del', function(e){
  e.preventDefault();
  $(this).parent().parent().remove();
  clearTimeout(delay);
  updPreview();
});
$( document ).keydown(function( event ) {
  // console.log(event.which)
  if(event.which == 120){
    $('#code, #head').toggle(200).toggleClass('hidden');
    setTimeout(function(){
      editor.refresh();
      editorh.refresh();
    }, 250);
  }
})

updPreview();

//--></script>
<style>
.cm-mustache {
  background-color: #3C3C32;
}
.cm-group {
  background-color: #4D4D29;
}
.cm-bla {
  color: #ff0;
}
</style>

<?php echo $footer; ?>