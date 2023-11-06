<style>
    #affiliate-account {
        display: none;
    }
    .calculate-main-button{
        font-size: 15px!important;
        float: right;
        color: #fff!important;
        margin: 0 auto;
        transition: all ease 0.3s;
        background: #29a643;
        border: none;
        width: 30%!important;
        padding: 5px;
        margin-top: 20px!important;
        margin-bottom: 10px!important;
        margin-right: 15px!important;
    }
</style>
<link rel='stylesheet' href='<?=$this->template->Css()?>calculate-saldo-style.css'>
<script src="<?=base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js' ></script>
<script src='https://cdn.datatables.net/1.10.9/js/dataTables.bootstrap.min.js' ></script>
<section class="content-header">
    <h1>Total Information</h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-info-circle"></i> Total Information</li>
        <li class="active">Agent's Commission Calculator</li>
    </ol>
</section>
<section class="content">
    <div class="box style-box" style="display: inline-block;">
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="margin-left: 31%;">
    <div class="calculate-section">
        <div class="calculate-saldo-container">
            <div class="calculate-saldo-content">
                <form id="form">
                    <div class="">
                        <div class="col-lg-12 calculate-saldo-input-number">
                            <label for="type">Calcualte by</label>
                            <select name="type" id="type" class="form-control">
                                <option value="all">By All Account</option>
                                <option value="group">By Group Account</option>
                                <option value="specific">By Specific Account</option>
                            </select>
                        </div>

                        <div class="col-lg-12 calculate-saldo-input-number">
                            <label>Agent's Account Number</label>
                            <input type="text" class="form-control" placeholder="Account Number" id="text-account-number"/>
                            <div class="reqs" style="color:red"></div>
                        </div>
                        <div class="col-lg-12 calculate-saldo-input-number" id="affiliate-account">
                            <label for="type">Affiliate's Account Number</label>
                            <input type="text" class="form-control" placeholder="Account Number" id="text-aff-account-number" value="0"/>
                            <div class="reqs" style="color:red"></div>
                        </div>

                        <div class="inputed-aff-account-number" id="inputed-aff-account-number">
                            <ul style="height:auto" id="ref_num2"></ul>
                        </div>
                    </div>
                    <div class="">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>From</label>
                            <div class="input-group">
                                <div class="input-group-addon round-0"><i class="fa fa-calendar"></i></div>
                                <input type="text" class="form-control round-0" placeholder="from" id="from" value="05/05/2015">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>To</label>
                            <div class="input-group">
                                <div class="input-group-addon round-0"><i class="fa fa-calendar"></i></div>
                                <input type="text" class="form-control round-0" placeholder="to" id="to">
                            </div>
                        </div>
                    </div>
                    <button type="button" class="calculate-main-button" id="calculate">Calculate</button>
                </form>
                <div class=" col-lg-12 calculate-result-container calculate-result-container-header">
                    <table>
                        <thead id="calc-header"></thead>
                    </table>
                </div>
                <div class="col-lg-12 calculate-result-container calculate-result-container-body" style="">
                    <table>
                        <tbody id="calc-result"></tbody>
                    </table>
                </div>
                <div class="calculate-result-container-footer">

                </div>
            </div>
        </div>
    </div>
</div>
    </div>
</section>

<script type="text/javascript">
    $(function() {
        $('#from').daterangepicker({
            "singleDatePicker": true,
            locale: {
                format: 'MM/DD/YYYY'
            }
        }, function(start, end, label) {});

        $('#to').daterangepicker({
            "singleDatePicker": true,
            locale: {
                format: 'MM/DD/YYYY'
            }
        }, function(start, end, label) {});
    });


    $(function(){
        var site_url ="<?=site_url('')?>",
            account_num = $('#text-account-number'),
            aff_num = $('#text-aff-account-number'),
            form = $('#form :input');

        $('#type').change(function () {
            if ($(this).val() === 'specific') {
                $('#affiliate-account').show();
                aff_num.val('');
            } else {
                $('#affiliate-account').hide();
            }
        });

        $('#calculate').click(function() {
            form.each(function (index,item) {
                var total_input = form.length;

                if (item.id !== 'type' && item.id !== 'calculate') {

                    if ($(this).val().length < 1) {
                        if ($('#type').val() === 'specific') {
                            $(this).closest('.form-control').next('div.reqs').html('<p class="field-req">This field is required.</p>');
                        } else {
                            account_num.closest('.form-control').next('div.reqs').html('<p class="field-req">This field is required.</p>');
                            aff_num.closest('.form-control').next('div.reqs').html('');
                            aff_num.val(0);
                        }
                    } else {
                        $(this).closest('.form-control').next('div.reqs').html('');

                        if (total_input - 2 == index) {
                            if (!$('#form p.field-req').length) {

                                $('#error-account-number p').remove();
                                $('.calculate-result-container-footer table').remove();
                                $('#calc-result tbody tr').remove();
                                $('.calculate-result-container-body').css('height','212px');

                                var btn = $('.calculate-main-button'),
                                    type = $('#type').val(),
                                    from = $('#from').val(),
                                    to = $('#to').val();

                                $.ajax({
                                    url: site_url+'/agent-commission-calculator/calculate',
                                    type: 'POST',
                                    data:{ account: account_num.val(), affiliate: aff_num.val(), type: type, from: from, to: to },
                                    beforeSend: function() {
                                        btn.html('<img src="<?= $this->template->Images()?>loader.GIF" style="height:20px;">');
                                        btn.attr('disabled',true);
                                    }
                                }).done(function(response){
                                    btn.html('Calculate');
                                    btn.attr('disabled',false);

                                    console.log(response);

                                    if (response.error) {
                                        var agentError = response.message.includes('Agent'),
                                            affiliateError = response.message.includes('Affiliate');
                                        if (agentError) {
                                            account_num.closest('.form-control').next('div.reqs').html('<p class="field-req">'+ response.message +'</p>');
                                        } else if (affiliateError) {
                                            aff_num.closest('.form-control').next('div.reqs').html('<p class="field-req">'+ response.message +'</p>');
                                        } else {
                                            alert(response.message);
                                        }

                                    } else {
                                        var table_header = '', table_result = '';
                                        $.each(response.result, function (index, item) {
                                            console.log(index);
                                            console.log(item);
                                            if (type == 'all') {
                                                table_result = '<tr><td><b>Total Commissions:</b></td><td>'+ item.TotalAmount +'</td></tr>';
                                            } else {
                                                table_header = '<tr><th>Account Number</th><th>Commission</th></tr>';
                                                table_result += '<tr><td>'+ item.FromAccount +'</td><td>'+ item.TotalAmount +'</td></tr>';
                                            }
                                        });
//                                        $('.calculate-result-container-header').css({'margin-top':'2%!important'});
//                                        $('.calculate-result-container-body').css({'margin-top':'0!important'});
                                        $('#calc-header').html(table_header);
                                        $('#calc-result').html(table_result);
                                    }
                                });
                            }
                        }
                    }
                }
            });
        });
    });
</script>