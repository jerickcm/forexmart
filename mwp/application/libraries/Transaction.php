<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Transaction
{

    protected $removeBonusesComment =  array(
        1 => 'FM BONUS 30% CANCELLATION',
        2 => 'FM 100% NDB CANCELLATION',
        10 => 'FM BONUS 50% CANCELLATION',
        12 => 'FM_CONTEST_MF_CANCELLATION'
    );

    protected $depositMethods = array(
        1 => 'Deposit_30PercentBonus',
        2 => 'Deposit_NoDepositBonus',
        10 => 'Deposit_50_PercentBonus',
        12 => 'Deposit_Contest_MF_Prize_Bonus'
    );

//    public function RemoveBonus($BonusData){ //Old Procedure
//
//        $accountNumber = $BonusData['Account_number'];
//        $user_id = $BonusData['UserId'];
//
//        // Remove pending 30% and 50% bonuses
////        $this->removePendingDepositBonuses($user_id);
//
//        $transaction_id = $BonusData['TransactionId'];
//        $transaction_type = $BonusData['TransactionType'];
//
//        $getAccountBonusByType = FXPP::getAccountBonusByType($accountNumber);
//        $removeBonuses = $this->removeBonusesComment;
//        foreach($getAccountBonusByType as $key => $bonuses){
//            if(array_key_exists($key, $removeBonuses)){
//                if($bonuses > 0){
//                    $removeContestBonusParams = array(
//                        'amount' => $bonuses,
//                        'account_number' => $accountNumber,
//                        'user_id' => $user_id,
//                        'bonus_id' => $key,
//                        'transaction_id' => $transaction_id,
//                        'transaction_type' => $transaction_type
//                    );
//
//                    self::processRemovingBonus($removeContestBonusParams);
//
//                    if($key == 2){
//                        $realFundToRemove = 0.20 * $bonuses;
//                        $removeContestBonusParams['realFundToRemove'] = $realFundToRemove;
//                        self::Remove20PercentOfNDBInRF($removeContestBonusParams);
//                    }
//
//                }
//            }
//        }
//
//    }

    public function RemoveBonus($BonusData){

        $accountNumber = $BonusData['Account_number'];
        $user_id = $BonusData['UserId'];

        $transaction_id = $BonusData['TransactionId'];
        $transaction_type = $BonusData['TransactionType'];

        $getAccountBonusByType = FXPP::getAccountBonusByType($accountNumber);

        $removeBonuses = $this->removeBonusesComment;
        $accountFunds = FXPP::getAccountFunds($accountNumber);
        foreach($getAccountBonusByType as $key => $bonuses){
            if(array_key_exists($key, $removeBonuses)){

                //check bonus to deduct based on withdraw amount
                if($key == 1){
                    $real_bonus_fund = round($accountFunds['withrawable_real_fund'] * 0.30,2);
                    if($real_bonus_fund < $accountFunds['bonus_fund']){
                        $bonuses = $accountFunds['bonus_fund'] - $real_bonus_fund;
                    }elseif($accountFunds['withrawable_real_fund'] <= 0){
                        $bonuses = $accountFunds['bonus_fund'];
                    }else{
                        $bonuses = 0;
                    }

                }elseif($key == 10){
                    $real_bonus_fund = round($accountFunds['withrawable_real_fund'] * 0.50,2);
                    if($real_bonus_fund <= $accountFunds['bonus_fund']){
                        $bonuses = $accountFunds['bonus_fund'] - $real_bonus_fund;
                    }elseif($accountFunds['withrawable_real_fund'] <= 0){
                        $bonuses = $accountFunds['bonus_fund'];
                    }else{
                        $bonuses = 0;
                    }
                }

                if($bonuses > 0){

                    $removeContestBonusParams = array(
                        'amount' => $bonuses,
                        'account_number' => $accountNumber,
                        'user_id' => $user_id,
                        'bonus_id' => $key,
                        'transaction_id' => $transaction_id,
                        'transaction_type' => $transaction_type,
                        'withrawable_real_fund' => $accountFunds['withrawable_real_fund'],
                        'bonus_fund' => $accountFunds['bonus_fund']
                    );
                    self::processRemovingBonus($removeContestBonusParams);

                    if($key == 2){
                        $realFundToRemove = 0.20 * $bonuses;
                        $removeContestBonusParams['realFundToRemove'] = $realFundToRemove;
                        self::Remove20PercentOfNDBInRF($removeContestBonusParams);
                    }

                }
            }
        }

    }

    public function removePendingDepositBonuses($user_id){
        $ci =& get_instance();
        $ci->load->model('withdraw_model');

        $dateUpdate = array(
            'thirtypercentbonus' => 2,
            'fiftypercentbonus' => 2,
            'date_bonus_acquired' => date('Y-m-d H:i:s')
        );

        $conditions = array(
            'user_id' => $user_id,
            'thirtypercentbonus' => 0,
            'fiftypercentbonus' => 0
        );

        $this->withdraw_model->removePendingDepositBonus($dateUpdate, $conditions);
    }

    public function processRemovingBonus($params){
        $ci =& get_instance();
        $ci->load->model('Withdraw_model');

        $amount = $params['amount'];
        $account_number = $params['account_number'];
        $userId = $params['user_id'];
        $bonusId = $params['bonus_id'];
        $withdraw_id = $params['transaction_id'];
        $transaction_type = $params['transaction_type'];
        $withrawable_real_fund = $params['withrawable_real_fund'];
        $bonus_fund = $params['bonus_fund'];
        $comment = $this->removeBonusesComment[$bonusId];

        $webservice_config = array(
            'server' => 'live_new'
        );

        $remove_amount = $amount * -1;
        $account_info = array(
            'Amount' => $remove_amount,
            'Comment' => $comment,
            'AccountNumber' => $account_number,
            'Method' => $this->depositMethods[$bonusId]
        );

        $WebService = new WebService($webservice_config);
        $WebService->RequestCommonMethodBonus($account_info);
        $result = $WebService->result;

        if ($WebService->request_status === 'RET_OK') {
            $date = date('Y-m-d H:i:s', strtotime(FXPP::getCurrentDateTime()));
            $withdraw_data = array(
                'Account_number' => $account_number,
                'User_id' => $userId,
                'Date' => $date,
                'Ticket' => $result['Ticket'],
                'Amount' => $amount,
                'Bonus_id' => $bonusId,
                'Transaction_id' => $withdraw_id,
                'Transaction_type' => $transaction_type,
                'Withrawable_real_fund' => $withrawable_real_fund,
                'Bonus_fund' => $bonus_fund
            );

            $ci->Withdraw_model->insertWithdrawBonus($withdraw_data);
        }
    }

    public function Remove20PercentOfNDBInRF($params){
        $ci =& get_instance();
        $ci->load->model('Withdraw_model');

        $amount = $params['realFundToRemove'];
        $account_number = $params['account_number'];
        $userId = $params['user_id'];
        $withdraw_id = $params['transaction_id'];
        $transaction_type = $params['transaction_type'];

        $comment = 'FM 20% NDB CANCELLATION';
        $webservice_config = array(
            'server' => 'live_new'
        );

        $remove_amount = $amount * -1;
        $account_info = array(
            'Amount' => $remove_amount,
            'Comment' => $comment,
            'AccountNumber' => $account_number,
            'Method' => 'DepositRealFund'
        );
        $WebService = new WebService($webservice_config);
        $WebService->RequestCommonMethodBonus($account_info);
        $result = $WebService->result;
        if ($WebService->request_status === 'RET_OK') {

            $date = date('Y-m-d H:i:s', strtotime(FXPP::getCurrentDateTime()));
            $withdraw_data = array(
                'Account_number' => $account_number,
                'User_id' => $userId,
                'Date' => $date,
                'Ticket' => $result['Ticket'],
                'Amount' => $amount,
                'Bonus_id' => 0,
                'Transaction_id' => $withdraw_id,
                'Transaction_type' => $transaction_type,
                'Is_realfund' => 1
            );

            $ci->Withdraw_model->insertWithdrawBonus($withdraw_data);

        }
    }

    //    Transaction Record

    public function getAllTransactionData($transType = null, $account_number, $from, $to){
        $transactionTypesId = array(
            'Bonuses' => 1,
            'Deposits' => 3,
            'Withdraws' => 4,
            'Transfers' => 6
        );
        if($transType){
            $getAccountFinanceRecordByTranType = self::getAccountFinanceRecordByTranType($transactionTypesId[$transType], $account_number, $from, $to);
            $TransactionData = $getAccountFinanceRecordByTranType;
        }else{
            $TransactionData = self::getAccountFinanceRecord($account_number, $from, $to);

        }
        return $TransactionData;

    }

    public function getAccountFinanceRecordByTranType($transTypeId, $account_number, $from, $to){
        $account_info = array(
            'account_number' => $account_number,
            'from' => $from,
            'to' => $to,
            'limit' => 999999999,  //suggested by admin no choice
            'offset' => 0,
            'type' => $transTypeId,
        );
        $webservice_config = array('server' => 'live_new');
        $WebService = new WebService($webservice_config);
        $WebService->GetAccountFinanceRecordsByTypeWithLimitOffset($account_info);
        $financeRecord = $WebService->get_result('FinanceRecords');
        if($financeRecord){
            $financeRecordEncode = json_encode($financeRecord);
            $financeRecordDecode = json_decode($financeRecordEncode, true);
            return $financeRecordDecode['FinanceRecordData'];
        }
        return false;

    }

    public function getAccountFinanceRecord($account_number, $from, $to){
        $account_info = array(
            'iLogin' => $account_number,
            'from' => $from,
            'to' => $to
        );
        $webservice_config = array('server' => 'live_new');
        $WebService = new WebService($webservice_config);
        $WebService->open_RequestAccountFinanceRecordsByDate($account_info);
        $financeRecord = $WebService->get_result('FinanceRecords');
        if($financeRecord){
            $financeRecordEncode = json_encode($financeRecord);
            $financeRecordDecode = json_decode($financeRecordEncode, true);
            return $financeRecordDecode['FinanceRecordData'];
        }
        return false;

    }

}