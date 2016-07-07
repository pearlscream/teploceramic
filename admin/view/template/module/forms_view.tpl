<?php if ($error_warning) { ?>
<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
  <button type="button" class="close" data-dismiss="alert">&times;</button>
</div>
<?php } ?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><i class="fa fa-eye"></i> <?php echo $text_edit; ?></h3> <span class="pull-right"><a href="<?php echo $link_forms; ?>"><?php echo $text_all; ?></a></span>
  </div>
  <div class="table-responsive">
    <div class="filters">
      <input type="datetime-local" class="date-filter">
      <a href="<?php echo $url . '&filter=week'?>" class="week-button">Неделя</a>
      <a href="<?php echo $url . '&filter=month'?>" class="month-button">Месяц</a>
      <a href="<?php echo $url . '&filter=year'?>" class="year-button">Год</a>
    </div>
    <table class="table">
      <thead>
        <tr>
          <td><?php echo $text_form; ?></td>
          <td><?php echo $text_name; ?></td>
          <td><?php echo $text_email; ?></td>
          <td><?php echo $text_telephone; ?></td>
          <td>Дата</td>
          <td class="text-center"><?php echo $text_status; ?></td>
          <td class="text-center"><?php echo $text_add; ?></td>
          <td class="text-center"><?php echo $text_comments; ?></td>
          <td><?php echo $text_actions; ?></td>
        </tr>
      </thead>
      <tbody>
        <?php if ($leads){ ?>
        <?php foreach ($leads as $num => $lead){ ?>
        <tr id="lead<?php echo $lead['data_id'] ?>">
          <td><?php echo $lead['form_id']; ?></td>
          <td><?php echo $lead['name']; ?></td>
          <td><a href="mailto:<?php echo $lead['email']; ?>"><?php echo $lead['email']; ?></a></td>
          <td><a href="tel:<?php echo $lead['telephone']; ?>"><?php echo $lead['telephone']; ?></a></td>
          <td><?php echo $lead['date']; ?></td>
          <td class="text-center status"><span class="label" data-status="<?php echo $lead['status_id']; ?>" style="background: <?php echo $statuses[$lead['status_id']]['bg']; ?>; color: <?php echo $statuses[$lead['status_id']]['color']; ?>;"><?php echo $statuses[$lead['status_id']]['title'][$lang]; ?></span></td>
          <td>
            <?php if ($lead['add']){ ?>
            <dl class="dl-horizontal">
            <?php foreach ($lead['add'] as $key => $value){ ?>
              <dt><?php echo $key; ?></dt>
              <dd><?php echo $value; ?></dd>
            <?php } ?>
            </dl>
            <?php } ?>
          </td>
          <td class="comment">
            <?php if ($lead['comments']){ ?>
            <dl class="dl-horizontal">
            <?php foreach ($lead['comments'] as $key => $value){ ?>
                <dt><?php echo $key; ?></dt>
                <dd><?php echo $value; ?></dd>
            <?php } ?>
            </dl>
            <?php } ?>
          </td>
          <td>
            <a onclick="edit(<?php echo $lead['data_id'] ?>);" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
            <a onclick="save(<?php echo $lead['data_id'] ?>);" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary hidden"><i class="fa fa-save"></i></a>
            <form action="<?php echo $add; ?>" method="POST" id="add-<?php echo $num; ?>">
              <?php 
                $customer_group_id = 1;
                foreach ($forms_users as $user) {
                  if($lead['form_id'] == $user['form_id']){
                    $customer_group_id = $user['customer_group_id'];
                  }
                }
                $name = explode(' ', $lead['name']);
               ?>
              <input type="hidden" name="customer_id" value="<?php echo $lead['customer_id']; ?>">
              <input type="hidden" name="firstname" value="<?php echo $name[0]; ?>">
              <input type="hidden" name="lastname" value="<?php echo (isset($name[1])?$name[1]:''); ?>">
              <input type="hidden" name="email" value="<?php echo $lead['email']; ?>">
              <input type="hidden" name="telephone" value="<?php echo $lead['telephone']; ?>">
              <input type="hidden" name="customer_group_id" value="<?php echo $customer_group_id; ?>">
              <a onclick="$('#add-<?php echo $num; ?>').submit();" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a></div>
            </form>
          </td>
        </tr>
        <?php } ?>
        <?php }else{ ?>
          <tr>
            <td class="text-center" colspan="8"><?php echo $text_no_results; ?></td>
          </tr>
        <?php } ?>
      </tbody>
      <tbody>
        <tr>
          <td colspan="8">
            <a href="<?php echo $link_forms; ?>" class="btn btn-primary center-block"><?php echo $text_all; ?></a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
<script>
var status  = '<select name="status" id="status{{id}}" class="form-control">';
<?php foreach($statuses as $status){ ?>
    status += '<option value="<?php echo $status['status_id']; ?>"><?php echo $status['title'][$lang]; ?></option>';
<?php } ?>
    status += '</select>';
var comment = '<textarea name="comment" id="comment{{id}}" class="form-control"></textarea>';
  function edit(data_id){
    // console.log(data_id);
    var lead = $('#lead'+data_id);
    var stat = lead.find('.label').attr('data-status');
    lead.find('.status').html(status.replace('{{id}}',data_id));
    lead.find('#status'+data_id).val(stat);
    lead.find('.comment').append(comment.replace('{{id}}',data_id));
    lead.find('a.btn').toggleClass('hidden');
    // console.log(lead.find('#status').val());
  }
  function save(data_id){
    var lead = $('#lead'+data_id);
    console.log(lead.find('#status'+data_id).val());
    console.log(lead.find('#commentcomment'+data_id).val());


    $.ajax({
      url: 'index.php?route=module/forms/view&token=<?php echo $token; ?>',
      type: 'post',
      data: {
        'data_id': data_id,
        'status':  lead.find('#status'+data_id).val(),
        'comment': lead.find('#comment'+data_id).val(),
      },
      dataType: 'json',
      success: function(data) {
        console.log(data);
        if (data.e == 'error') {
          console.log(data.error);
        }
        if (data.e == 'success') {
          lead.find('.status').html(data.status);
          lead.find('.comment').html(data.comment);
          lead.find('a.btn').toggleClass('hidden');
        }
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert('error: ' + thrownError);
      }
    });
  }
</script>
</div>
