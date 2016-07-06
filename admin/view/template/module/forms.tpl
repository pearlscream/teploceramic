<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-account" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-account" class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="forms_status" id="input-status" class="form-control">
                <?php if ($forms_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>

<!-- ///////////////////////////////////////////////////////////// -->
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-status" data-toggle="tab"><?php echo $tab_status; ?></a></li>
            <li><a href="#tab-user" data-toggle="tab"><?php echo $tab_user; ?></a></li>
          </ul><!-- /.nav.nav-tabs -->
          <div class="tab-content">
            <div class="tab-pane active" id="tab-status">
              <h2><?php echo $tab_status; ?></h2>
              <div class="table-responsive">
                <table id="forms" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <td class="text-left"><?php echo $entry_names; ?></td>
                      <td class="text-left"><?php echo $entry_color; ?></td>
                      <td class="text-right"><?php echo $entry_sort_order; ?></td>
                      <td></td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $form_row = 0; ?>
                    <?php if ($forms){ ?>
                    <?php foreach ($forms as $form) { ?>
                    <tr id="form-row<?php echo $form_row; ?>">

                      <td class="text-right col-sm-5">
                        <?php foreach ($languages as $language) { ?>
                        <div class="input-group pull-left"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> </span>
                          <input type="text" name="forms[<?php echo $form_row; ?>][title][<?php echo $language['language_id']; ?>]" value="<?php echo isset($form['title'][$language['language_id']]) ? $form['title'][$language['language_id']] : ''; ?>" placeholder="<?php echo $entry_names; ?>" class="form-control" />
                        </div>
                        <?php } ?>
                      </td>

                      <td class="text-left">
                        <input name="forms[<?php echo $form_row; ?>][bg]" class="form-control" value="<?php echo $form['bg']; ?>">
                        <input type="hidden" name="forms[<?php echo $form_row; ?>][color]" class="form-control" value="<?php echo $form['color']; ?>">
                        <input type="hidden" name="forms[<?php echo $form_row; ?>][status_id]" value="<?php echo $form['status_id']; ?>" />
                      </td>

                      <td class="text-right"><input type="text" name="forms[<?php echo $form_row; ?>][sort_order]" value="<?php echo $form['sort_order']; ?>" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" /></td>

                      <td class="text-left"><button type="button" onclick="$('#form-row<?php echo $form_row; ?>').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>

                    </tr>
                    <?php $form_row++; ?>
                    <?php } ?>
                    <?php } ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="3"></td>
                      <td class="text-left"><button type="button" onclick="add();" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                    </tr>
                  </tfoot>
                </table>
              </div><!-- /.table-responsive -->
            </div><!-- /#tab-status -->
<!-- *********************************************************************************** -->
            <div class="tab-pane " id="tab-user">
              <h2><?php echo $text_user; ?></h2>
              <div class="table-responsive">
                <table id="forms_user" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <td class="text-left"><?php echo $entry_form; ?></td>
                      <td class="text-left"><?php echo $entry_user_group; ?></td>
                      <td></td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $user_row = 0; ?>
                    <?php if ($forms_user){ ?>
                    <?php foreach ($forms_user as $form_user) { ?>
                    <tr id="user-row<?php echo $user_row; ?>">

                      <td class="text-right col-sm-5">
                        <input type="text" name="forms_user[<?php echo $user_row; ?>][form_id]" value="<?php echo isset($form_user['form_id']) ? $form_user['form_id'] : ''; ?>" placeholder="<?php echo $entry_names; ?>" class="form-control" />
                      </td>

                      <td class="text-left">
                        <select name="forms_user[<?php echo $user_row; ?>][customer_group_id]" id="input-customer-group" class="form-control">
                          <?php foreach ($customer_groups as $customer_group) { ?>
                          <?php if ($customer_group['customer_group_id'] == $form_user['customer_group_id']) { ?>
                          <option value="<?php echo $customer_group['customer_group_id']; ?>" selected="selected"><?php echo $customer_group['name']; ?></option>
                          <?php } else { ?>
                          <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></option>
                          <?php } ?>
                          <?php } ?>
                        </select>
                      </td>

                      <td class="text-left"><button type="button" onclick="$('#user-row<?php echo $user_row; ?>').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>

                    </tr>
                    <?php $user_row++; ?>
                    <?php } ?>
                    <?php } ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="2"></td>
                      <td class="text-left"><button type="button" onclick="addUser();" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                    </tr>
                  </tfoot>
                </table>
              </div><!-- /.table-responsive -->
            </div><!-- /#tab-user -->
          </div>
<!-- ///////////////////////////////////////////////////////////// -->

        </form>
      </div>
    </div>
  </div>
</div>
<link rel="stylesheet" href="view/javascript/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <script src="view/javascript/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
  <script>
    $(function(){
        $('input[name*="bg"]').colorpicker({'format': 'hex'}).on('create', function(ev){
          $(this).parent().css('background', $(this).val());
          $(this).parent().find('input[name*="color"]').val(contrast($(this).val()));
          // console.log(contrast($(this).val()));
        }).on('changeColor', function(ev){
          $(this).parent().css('background', ev.color.toHex());
          $(this).parent().find('input[name*="color"]').val(contrast(ev.color.toHex()));

          console.log(ev.color.toHex());
          console.log(contrast(ev.color.toHex()));
        });
    });
</script>
<script type="text/javascript"><!--
var form_row = <?php echo $form_row; ?>;
var user_row = <?php echo $user_row; ?>;

function add() {
  html  = '<tr id="form-row' + form_row + '">';
  html += '  <td class="text-right">';
  <?php foreach ($languages as $language) { ?>
  html += '    <div class="input-group">';
  html += '      <span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span><input type="text" name="forms[' + form_row + '][title][<?php echo $language['language_id']; ?>]" value="" placeholder="<?php echo $entry_names; ?>" class="form-control" />';
    html += '    </div>';
  <?php } ?>
  html += '  </td>';
  html += '  <td class="text-left"><input name="forms[' + form_row + '][bg]" class="form-control" value=""><input type="hidden" name="forms[' + form_row + '][color]" class="form-control" value=""><input type="hidden" name="forms[' + form_row + '][status_id]" value="' + form_row + '" /></td>';

  html += '  <td class="text-right"><input type="text" name="forms[' + form_row + '][sort_order]" value="" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" /></td>';

  html += '  <td class="text-left"><button type="button" onclick="$(\'#form-row' + form_row  + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

  html += '</tr>';

  $('#forms tbody').append(html);
  $('input[name="forms[' + form_row + '][bg]"]').colorpicker({'format': 'hex'}).on('create', function(ev){
    $(this).parent().css('background', $(this).val());
    $(this).parent().find('input[name*="color"]').val(contrast($(this).val()));
    console.log(contrast($(this).val()));
  }).on('changeColor', function(ev){
    $(this).parent().css('background', ev.color.toHex());
    $(this).parent().find('input[name*="color"]').val(contrast(ev.color.toHex()));
    console.log(contrast(ev.color.toHex()));
  });

  form_row++;
}

function addUser() {
  html  = '<tr id="user-row' + user_row + '">';

  html += '  <td class="text-right col-sm-5"><input type="text" name="forms_user[' + user_row + '][form_id]" value="" placeholder="<?php echo $entry_names; ?>" class="form-control" /></td>';

  html += '  <td class="text-left">';
  html += '    <select name="forms_user[' + user_row + '][customer_group_id]" id="input-customer-group" class="form-control">';

<?php foreach ($customer_groups as $customer_group) { ?>
  html += '      <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></option>';
<?php } ?>

  html += '    </select>';
  html += '  </td>';

  html += '  <td class="text-left"><button type="button" onclick="$(\'#user-row' + user_row + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

  html += '</tr>';

  $('#forms_user tbody').append(html);

  user_row++;
}

function contrast(hexcolor){
    hexcolor = hexcolor.substr(1);
    var r = parseInt(hexcolor.substr(0,2),16);
    var g = parseInt(hexcolor.substr(2,2),16);
    var b = parseInt(hexcolor.substr(4,2),16);
    var yiq = ((r*299)+(g*587)+(b*114))/1000;
    return (yiq >= 128) ? '#000' : '#fff';
}
//--></script>
<?php echo $footer; ?>