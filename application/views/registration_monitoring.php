<style type="text/css">
    thead td{
        background: rgba(72, 72, 72, 0.87);
        color: #ffffff;
        text-align: center;
        font-size: 16px;
    }
    td{
        padding: 5px;
        font-size:11px;
        border:1px solid #cecece;
    }
</style>
<div class="reg-form-holder">
    <div class="col-md-12">
        <div class="row">
            <table style="border: 1px solid blue;width: 100%;">
                <thead>
                <tr>
                    <td style="width:20px">ID</td>
                    <td style="width:240px;word-break: break-all;">Data</td>
                    <td style="width:80px;word-break: break-all;">Condition</td>
                    <td style="width:240px;word-break: break-all;">Error</td>
                    <td style="width:100px;word-break: break-all;">URL</td>
                    <td style="width:60px;word-break: break-all;">Date</td>
                    <td style="width:60px;word-break: break-all;">IP</td>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($tbl as $k) { ?>
                    <tr>
                        <td><?php echo $k['id'] ?></td>
                        <td style="width:240px;word-break: break-all;"><?php echo $k['data']?></td>
                        <td style="width:80px;word-break: break-all;"><?php echo $k['error_condition']?></td>
                        <td style="width:240px;word-break: break-all;"><?php echo $k['error_msg']?></td>
                        <td style="width:100px;word-break: break-all;"><?php echo $k['registration_url']?></td>
                        <td style="width:60px;word-break: break-all;"><?php echo $k['date']?></td>
                        <td style="width:60px;word-break: break-all;"><?php echo $k['ip_address']?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>