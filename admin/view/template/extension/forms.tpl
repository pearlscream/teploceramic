<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <h1><?php echo $heading_title; ?></h1>
            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <div class="filters">
            <form style="display: inline-block" action="<?php echo $url ?>" method="get">
                <input type="hidden" name="route" value="<?php echo $route ?>">
                <input type="hidden" name="token" value="<?php echo $token?>">
                <input class="form-control" style="display: inline-block; width: 70%" type="datetime-local"
                       id="date-filter" name="date" value="<?php echo date('Y-m-d\Tg:i:s')?>">
                <input class="btn-primary btn" style="display: inline-block" type="submit" value="Фильтр">
            </form>
            <form style="display: inline-block" action="<?php echo $url ?>" method="get">
                <input type="hidden" name="route" value="<?php echo $route ?>">
                <input type="hidden" name="token" value="<?php echo $token?>">
                <input class="btn-primary btn" type="submit" value="Все">
            </form>
            <form style="display: inline-block; position: absolute; right: 0;" action="<?php echo $url ?>" method="get">
                <input type="hidden" name="route" value="<?php echo $route ?>">
                <input type="hidden" name="token" value="<?php echo $token?>">
                <input id='smart-search' class="form-control" style="display:inline-block;  width: 305px" type="number" name="telephone"
                       placeholder="номер телефона" autocomplete="off">
                <input class="btn-primary btn" type="submit" value="Телефон">
                <div class="search-box"></div>
            </form>
            <div>
                <div style="display: inline-block; margin-left: 5px">
                    <a class="btn-primary btn" href="<?php echo $url . '&filter=week'?>" class="week-button">Неделя</a>
                    <a class="btn-primary btn" href="<?php echo $url . '&filter=month'?>" class="month-button">Месяц</a>
                    <a class="btn-primary btn" href="<?php echo $url . '&filter=year'?>" class="year-button">Год</a>
                </div>
                <div style="display: inline-block; right: 0; position: absolute;">
                    <a class="btn-primary btn" href="<?php echo $url . '&filter=get_back(1)'?>"
                       class="get-back">get-back(1)</a>
                    <a class="btn-primary btn" href="<?php echo $url . '&filter=get_back(2)'?>"
                       class="get-back">get-back(2)</a>
                    <a class="btn-primary btn" href="<?php echo $url . '&filter=middle_form'?>" class="middle-form">middle-form</a>
                    <a class="btn-primary btn" href="<?php echo $url . '&filter=have_question'?>" class="have-question">have-question</a>
                    <a class="btn-primary btn" href="<?php echo $url . '&filter=call'?>" class="call">call</a>
                    <a class="btn-primary btn" href="<?php echo $url . '&filter=order'?>" class="order">order</a>
                </div>
            </div>
            <form action="#0" id="add-call" style="text-align: center">
                <button id="add-call-show" class="btn btn-primary" style="margin: 5px;">Добавить звонок</button>
                <input type="hidden" name="name" data-error="E-mail обязателен для заполнения!">
                <div id="add-call-inputs" style="display: none">
                    <input class="form-control" style="width: 40%;display: inline-block" type="text"
                           placeholder="Номер телефона" name="telephone" class="mask"
                           data-error="Номер телефона обязателен для заполнения!">
                    <input class="form-control" style="width: 40%; display: inline-block" type="text"
                           placeholder="E-mail" name="email"
                           data-error="E-mail обязателен для заполнения!">
                    <input class="btn-primary btn" type="submit" value="Добавить звонок">
                    <input type="hidden" value="call" name="form_id" class="form-control">
                </div>

            </form>
        </div>
        <?php if ($error_warning) { ?>
        <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-eye"></i> <?php echo $text_edit; ?></h3>
            </div>
            <div class="table-responsive">
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
                        <td class="text-center">Обращения</td>
                        <td><?php echo $text_actions; ?></td>
                    </tr>


                    </thead>

                    <tbody>
                    <?php if ($leads){ ?>
                    <?php foreach ($leads as $num => $lead){ ?>
                    <tr id="lead<?php echo $lead['data_id'] ?>">
                        <td><?php echo $lead['form_id']; ?></td>
                        <td class="name"><?php echo $lead['name']; ?></td>
                        <td class="email"><a href="mailto:<?php echo $lead['email']; ?>"><?php echo $lead['email']; ?></a></td>
                        <td class="telephone"><a href="tel:<?php echo $lead['telephone']; ?>"><?php echo $lead['telephone']; ?></a></td>
                        <td><?php echo $lead['date']; ?></td>
                        <td class="text-center status"><span class="label"
                                                             data-status="<?php echo $lead['status_id']; ?>"
                                                             style="background: <?php echo $statuses[$lead['status_id']]['bg']; ?>; color: <?php echo $statuses[$lead['status_id']]['color']; ?>;"><?php echo $statuses[$lead['status_id']]['title'][$lang]; ?></span>
                        </td>
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
                            <button class="btn btn-primary treatment-btn"><?php echo $lead['treatment'] ?></button>
                        </td>
                        <td>
                            <a onclick="edit(<?php echo $lead['data_id'] ?>);" data-toggle="tooltip"
                               title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                            <a href="index.php?route=module/forms/delete&token=<?php echo $token?>&lead_id=<?php echo $lead['data_id']?>"
                               data-toggle="tooltip" title="Удалить" class="btn btn-primary"><i
                                        class="fa fa-eraser"></i></a>
                            <a onclick="save(<?php echo $lead['data_id'] ?>);" data-toggle="tooltip"
                               title="<?php echo $button_save; ?>" class="save btn btn-primary hidden"><i
                                        class="fa fa-save"></i></a>
                            <a onclick="saveCopy(<?php echo $lead['data_id'] ?>);" data-toggle="tooltip"
                               title="Сохранить копию" class="save-copy btn btn-primary hidden"><i
                                        class="fa fa-save"></i></a>
                            <a onclick="copy(<?php echo $lead['data_id'] ?>);" data-toggle="tooltip"
                               title="Копировать" class="btn btn-primary"><i class="fa fa-copy"></i></a>
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
                                <input type="hidden" name="lastname" value="<?php echo $name[1]; ?>">
                                <input type="hidden" name="email" value="<?php echo $lead['email']; ?>">
                                <input type="hidden" name="telephone" value="<?php echo $lead['telephone']; ?>">
                                <input type="hidden" name="customer_group_id" value="<?php echo $customer_group_id; ?>">
                                <a onclick="$('#add-<?php echo $num; ?>').submit();" data-toggle="tooltip"
                                   title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
            </div>
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
            </table>
        </div>
        <div style="text-align: center;"><?php echo $pagination; ?></div>


        <script>
            var status = '<select name="status" id="status{{id}}" class="form-control">';
            <?php foreach($statuses as $status) { ?>
                status += '<option value="<?php echo $status['status_id']; ?>"><?php echo $status['title'][$lang]; ?></option>';
            <?php } ?>
            status += '</select>';
            var comment = '<textarea name="comment" id="comment{{id}}" class="form-control"></textarea>';
            function edit(data_id) {
                // console.log(data_id);
                var lead = $('#lead' + data_id);
                var stat = lead.find('.label').attr('data-status');
                lead.find('.status').html(status.replace('{{id}}', data_id));
                lead.find('#status' + data_id).val(stat);
                lead.find('.comment').append(comment.replace('{{id}}', data_id));
                lead.find('a.btn').toggleClass('hidden');
                lead.find('.save-copy').toggleClass('hidden');
                // console.log(lead.find('#status').val());
            }
            var oldLead = '';
            function copy(data_id) {
                console.log(data_id);
                var lead = $('#lead' + data_id);
                oldLead = lead.clone();
                var telephone = "<input type='text' id='telephone" + data_id + "' value='" + lead.find('.telephone a').html() + "'>";
                var name = "<input type='text' id='name" + data_id + "' value='" + lead.find('.name').html() + "'>";
                var email = "<input type='email' id='email" + data_id + "' value='" + lead.find('.email a').html() + "'>";
                var stat = lead.find('.label').attr('data-status');
                lead.find('.status').html(status.replace('{{id}}', data_id));
                lead.find('#status' + data_id).val(stat);
                lead.find('.comment').append(comment.replace('{{id}}', data_id));
                lead.find('.name').html(name);
                lead.find('.email').html(email);
                lead.find('.telephone').html(telephone);
                lead.find('a.btn').toggleClass('hidden');
                lead.find('.save').toggleClass("hidden");
                // console.log(lead.find('#status').val());
            }
            function save(data_id) {
                var date = new Date();
                var curr_date = date.getDate();
                var curr_month = date.getMonth() + 1;
                var curr_year = date.getFullYear();
                var curr_hours = date.getHours();
                var curr_minutes = date.getMinutes();
                date = curr_year + "-" + curr_month + "-" + curr_date + " " + curr_hours + ":" + curr_minutes;

                var lead = $('#lead' + data_id);
                console.log(lead.find('#status' + data_id).val());
                console.log(lead.find('#commentcomment' + data_id).val());


                $.ajax({
                    url: 'index.php?route=module/forms/view&token=<?php echo $token; ?>',
                    type: 'post',
                    data: {
                        'data_id': data_id,
                        'status': lead.find('#status' + data_id).val(),
                        'comment': lead.find('#comment' + data_id).val(),
                        'date' : date,
                    },
                    dataType: 'json',
                    success: function (data) {
                        console.log(data);
                        if (data.e == 'error') {
                            console.log(data.error);
                        }
                        if (data.e == 'success') {
                            lead.find('.status').html(data.status);
                            lead.find('.comment').html(data.comment);
                            lead.find('a.btn').toggleClass('hidden');
                            lead.find('.save-copy').toggleClass("hidden");
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert('error: ' + thrownError);
                    }
                });
            }

            function saveCopy(data_id) {
                var date = new Date();
                var curr_date = date.getDate();
                var curr_month = date.getMonth() + 1;
                var curr_year = date.getFullYear();
                var curr_hours = date.getHours();
                var curr_minutes = date.getMinutes();
                date = curr_year + "-" + curr_month + "-" + curr_date + " " + curr_hours + ":" + curr_minutes;

                var lead = $('#lead' + data_id);
                console.log(lead.find('#status' + data_id).val());
                console.log(lead.find('#commentcomment' + data_id).val());


                $.ajax({
                    url: '/index.php?route=module/forms/save',
                    type: 'post',
                    data: {
                        'name' : lead.find('#name' + data_id).val(),
                        'email': lead.find('#email' + data_id).val(),
                        'telephone' : lead.find('#telephone' + data_id).val(),
                        'form_id':'call',
                        'status': lead.find('#status' + data_id).val(),
                        'comment': lead.find('#comment' + data_id).val(),
                        'date' : date,
                    },
                    dataType: 'json',
                    success: function (data) {
                        console.log(data);
                        $('#lead' + data_id).html(oldLead.html());
                        console.log(oldLead);
                        alert('Копия успешно добавлена');
                    },
                    error: function () {
                        alert('ОШИБКА. Запись не добавлена :( ');
                    },
                });
            }
        </script>
    </div>

</div>
</div>
<?php echo $footer; ?>