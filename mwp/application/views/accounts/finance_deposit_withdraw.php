<div class="tab-pane active" id="check-phone-password">
    <div class="tab-title-header">
        <h1 class="all_tab_title">Finance</h1>
    </div>
    <div class="mini-form-container maibtbbox">
        <ul class="bmc">
            <li><a target="_blank" href="https://m7.forexmart.com/manage-accounts/credit-funds">Balance</a> </li>
            <li><a target="_blank" href="https://m7.forexmart.com/manage-accounts/cancel-funds">Margin</a>  </li>
            <li><a target="_blank" href="https://m7.forexmart.com/manage-accounts/credit-mini-bonus">Credit</a>  </li>
        </ul>
        <table class="mytable"  cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th>Login :</th>
                    <th> <input type="text" disabled="disabled" value="<?=$accountDetails['account_number'];?>" class="misize" /></th>
                    <th></th>
                </tr>
                <tr>
                    <th>Full Name :</th>
                    <th colspan="2"><input type="text" disabled="disabled" value="<?=$accountDetails['full_name'];?>" class="fusize" /></th>
                </tr>
                <tr>
                    <th>Balance :</th>
                     <th><input type="text" disabled="disabled" value="<?=number_format($accountDetails['Balance'],2);?>" class="misize" /></th>
                     <th></th>
                </tr>
                  <tr>
                  
                     <th>Available Margin :</th>
                     <th><input type="text" disabled="disabled" value="<?=number_format($accountDetails['Margin'],2);?>" class="misize" /></th>
                     <th></th>
                </tr>
                 <tr>
                    <th>Credit :</th>
                     <th><input type="text" disabled="disabled" value="<?=number_format(0,2);?>" class="misize" /></th>
                     <th></th>
                </tr>
                 <tr>
                    <th>Amount :</th>
                     <th><input type="text"class="misize" /></th>
                     <th></th>
                </tr>
                 <tr>
                    <th>Comment :</th>
                    <th colspan="2">
                        <select class="fusize">
                            <option>Select</option>
                        </select>
                        
                    </th>
                </tr>
            </thead>
            <tbody class="buttonfooter">
                <tr><hr></tr>
            <tr>
                <td colspan="3">
                    <a target="_blank" class="tda" href="https://m7.forexmart.com/manage-accounts/credit-funds">Deposit</a>
                    <a target="_blank" class="tda" href="https://m7.forexmart.com/manage-accounts/cancel-funds">Cancel</a>
                    <a target="_blank" class="tda" href="https://m7.forexmart.com/manage-accounts/credit-mini-bonus">Withdrawal</a>
                </td>
                
            </tr>
            </tbody>
            
        </table>
        
        
        
        
    </div>
   
</div>
 

 

<style>
.maibtbbox{border: 1px solid; width: 40%; padding: 10px;}
.mytable{ width: 100%;}    
.mytable thead th:first-child{width:160px; text-align: right;}  
.mytable thead th{ text-align: left; padding: 5px}
.misize{ width:40%; border: 1px solid #000; height: 30px;}
.fusize{ width:80%; border: 1px solid #000; height: 30px}

.buttonfooter tr td{ margin-top: 10px; text-align: center}
.buttonfooter tr td a{   border: 1px solid #000000;
    float: left;
    height: 30px;
    line-height: 30px;
    margin: 50px 13px 13px;
    text-align: center;
    width: 112px;}

.buttonfooter tr td a:hover{ cursor: pointer; background: #ccc;}



    .bmc {
        display: block;
        height: 50px;
        margin: 15px 0 0;
        padding: 0;
        width: 100%;
    }

    .bmc li {
        float: left;
        list-style: outside none none;
    }

    .bmc li a {
        border: 1px solid #1872b1;
        color: #3e98d7;
        margin: 0 10px;
        padding: 5px 16px;
        text-decoration: none;
    }

    .bmc li a:hover {
        background: #f6f6f6 none repeat scroll 0 0;
    }

    .tda {
        color: #000;
        text-decoration: none !important;
    }
</style>
 