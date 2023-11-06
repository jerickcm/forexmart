
 <script type="text/javascript">
    <?php if(FXPP::html_url()=='sa'){ ?>
        $(document).ready(function(){
            $("head").append('<style type="text/css">ol li:before {margin-left: 100%;left: 10px;}</style>');
        });
    <?php }else{ ?>
        $(document).ready(function(){
            $("head").append('<style type="text/css">ol li:before {margin-right: 100%;right: 10px;}</style>');
        });
    <?php } ?>

 </script>



<link href="<?php echo $this->template->Css()?>view-termsandconditions.css" rel="stylesheet">

<div class="reg-form-holder">
<div class="container">
<div class="row ext-arabic-terms-row">
<div class="col-lg-12">
<h1 class="license-title ext-arabic-license-title">
    <?=lang('tac_01')?>
<!--    Terms and Conditions-->
</h1>
<ol class="main ext-arabic-main-list" >

<!--1.-->
<li class="primaryunits">
    <h4 class="rootnumberheadings">
        <?=lang('tac_02')?>
<!--        LEGAL INFORMATION-->
    </h4>
    <ol>
        <!--1.1.-->
        <li >
            <p class="license-text">
                <img class="tradomart" width="101" height="11" alt=""  src="<?= $this->template->Images()?>tradomart/tradomart-ltd-small-black.png" />
                <?=lang('tac_03')?>
<!--                (hereinafter referred to as-->
                <img class="tradomart" alt="" src="<?= $this->template->Images()?>tradomart.png" />
                <?=lang('tac_04')?>
<!--                or the â€˜Companyâ€™ is an investment firm that operates globally.-->
            </p>
        </li>
        <!--1.2.-->
        <li >
            <p class="license-text">
                <img class="tradomart" alt="" src="<?= $this->template->Images()?>tradomart/tradomart-small-black.png"  height="10"/>
                <?=lang('tac_05')?>
<!--                is incorporated in the Republic of Cyprus with Certificate of Incorporation No. HE 266937.  The Company is authorised and regulated  by the Cyprus Securities and Exchange Commission (â€˜CySECâ€™), with licence No. 266/15, and operates under the Provision of Investment Services, the Exercise of Investment Activities, the Operation of  Regulated  Markets  and  Other  Related  Matters  Law  of  2007,  Law  144(I)/2007,  as  subsequently amended from time to time (the Law).  The Companyâ€™s registered office is located at Anastasi Sioukri & Olympion, Themis Tower, 6th Floor, 3035, Limassol, Cyprus.-->
            </p>
        </li>
        <!--1.3.-->
        <li >
            <p class="license-text">
                <?=lang('tac_06')?>
<!--                The Customer acknowledges that the Companyâ€™s official language is English.-->
            </p>
        </li>
    </ol>
</li>
<!--2.-->
<li class="primaryunits">
    <h4 class="rootnumberheadings">
        <?=lang('tac_07')?>
<!--        INTRODUCTION-->
    </h4>
    <ol>
        <!--2.1-->
        <li >
            <p class="license-text">
                <?=lang('tac_08')?>
<!--                The Service Agreement is legally binding between the Customer and the Company whereby the Customer Agreement forms the basis on which the Company provides investment and ancillary services to the Customer.-->
            </p>
        </li>
        <!--2.2-->
        <li >
            <p class="license-text">
                <?=lang('tac_09')?>
<!--                The Service Agreement lays out the framework of the Service Agreement and the nature of the investment services provided by the Company. They cannot be negotiated, or be overruled by, any prior agreements or arrangements made between the Company and the Customer.-->
            </p>
        </li>
        <!--2.3-->
        <li >
            <p class="license-text">
                <?=lang('tac_10')?>
<!--                The Service Agreement governs the relationship between the Company and the Customer and provides the necessary information to the Customer prior to making a decision in regards to the Company and its services.-->
            </p>
        </li>
        <!--2.4-->
        <li>
            <p class="license-text">
                <?=lang('tac_11')?>
<!--                Since this agreement is made between parties who are geographically remote, it is governed by the Distance Marketing of Consumer Financial Services Law N.242 (I)/2004, which applies to the EU Directive 2002/65/EC, and according to this directive the Customer Agreement is not required to be signed by either the Customer or the Company or both parties, in order to be legally binding.-->

            </p>
        </li>
        <!--2.5-->
        <li>
            <p class="license-text">
                <?=lang('tac_12')?>
<!--                The Customer acknowledges that he/she has read, understood and accepted the Customer Agreement, the Customer Categorisation document, the Investor Compensation Fund document, the Risk Disclosure document, the Services document, the Conflict of Interest policy, the Best Execution Policy and Customer Agreement, as amended from time to time, in addition to any information contained within the Companyâ€™s website, including but not limited to the information contained within the â€˜Legal Informationâ€™ and the â€˜Legal Documentationâ€™ sections (together, the â€˜Service Agreementâ€™).-->
            </p>
        </li>
    </ol>
</li>
<!--3.-->
<li class="primaryunits">
    <h4 class="rootnumberheadings">
        <?=lang('tac_13')?>
<!--        COMMENCEMENT-->
    </h4>
    <ol>
        <!--3.1.-->
        <li>
            <p class="license-text">
                <?=lang('tac_14')?>
<!--                The Customer Agreement is not required to be signed by either the Customer or the Company to be legally bound by it; and the Customer has no right of cancellation on the basis that it is a Distance contract.-->
            </p>
        </li>
        <!--3.2.-->
        <li>
            <p class="license-text">
                <?=lang('tac_15')?>
<!--                The Service Agreement will commence on the date on which the Customer receives such notice from the Company via email and not until all documentation required has been duly completed by the Customer and received by the Company.-->
            </p>
        </li>
    </ol>
</li>
<!--4.-->
<li class="primaryunits">
<h4 class="rootnumberheadings">
    <?=lang('tac_16')?>
<!--    INTERPRETATION OF TERMS-->
</h4>
<ol>
    <li class="license-text">
        <!--4.1.-->

            <?=lang('tac_17')?>
<!--            Unless otherwise indicated, the defined terms included in the Customer Agreement shall have a specific meaning and may be used in singular or plural form as appropriate.-->
    </li>
</ol>

<p class="license-text">
    <?=lang('tac_18')?>
<!--    â€œAccountâ€� shall mean a personalized trading account of the Client with the company-->
</p>

<p class="license-text">
    <?=lang('tac_19')?>
<!--    â€œAccount Detailed Reportâ€� shall mean a statement of the Clients securities portfolio, open positions, margin requirements, cash deposit etc. at a specific point in time-->
</p>
<p class="license-text">
    <?=lang('tac_20_0')?>
<!--    â€œAskâ€� shall mean the higher price in a Quote being the price at which the Customer may buy.-->

</p>
<p class="license-text">
    <?=lang('tac_20')?>
<!--    â€œAuthorised Representativeâ€� shall mean either the natural or legal person who is expressly authorised by the Customer to act on his/ her behalf; where such a relationship is documented through a Power of Attorney, a copy of which is held by the Company.-->
</p>
<p class="license-text">
    <?=lang('tac_21')?>
<!--    â€œBalanceâ€� shall mean the total financial result of all Completed Transactions and any deposits to, or withdrawals from, the Trading Account.-->
</p>
<p class="license-text">
    <?=lang('tac_22')?>
<!--    â€œBalance/Base Currencyâ€� shall mean the currency that the trading account is denominated in.-->
</p>
<p class="license-text">
    <?=lang('tac_23')?>
<!--    â€œBidâ€� shall mean the lower price in a Quote being the price at which the Customer may sell.-->
</p>
<p class="license-text">
    <?=lang('tac_24')?>
<!--    â€œBusiness Dayâ€� shall mean every week day, excluding Saturdays and Sundays, and any other Cyprus or international bank holidays to be publicised on the Companyâ€™s Website.-->
</p>
<p class="license-text">
    <?=lang('tac_25')?>
<!--    â€œClosed positionâ€� shall mean the opposite of an open position.-->
</p>
<p class="license-text">
    <?=lang('tac_25_0')?>
<!--    â€œCompleted transactionâ€� shall mean two counter deals of the same size, an opening and a closing position.-->
</p>
<p class="license-text">
    <?=lang('tac_26')?>
<!--    â€œContract for Difference (CFD)â€� shall mean a CFD on spot foreign exchange (â€˜FXâ€™), or a CFD on shares, or a CFD on spot metals or a CFD on futures or any other CFD related instrument that is available for trading through the-->
    <img class="tradomart" alt="" src="<?= $this->template->Images()?>tradomart.png" />
    <?=lang('tac_27')?>
<!--    trading platform(s); a full list is available online at the Companyâ€™s website.-->

</p>

<p class="license-text">
    <?=lang('tac_28')?>
<!--    â€œCustomerâ€� shall mean either the natural or legal person who received notification as per clause 2.1.â€�-->
</p>
<p class="license-text">
    <?=lang('tac_29')?>
<!--    â€œCustomer/ Trading Accountâ€� shall mean the account, uniquely numbered, containing all Completed Transactions, Open Positions, Orders and deposit/withdrawal transactions in the Trading Platform(s).-->

</p>
<p class="license-text">
    <?=lang('tac_30')?>
<!--    â€œCustomer Agreementâ€� shall mean the agreement between the Customer and the Company relating to the investment and ancillary services provided by the Company.-->
</p>
<p class="license-text">
    <?=lang('tac_31')?>
<!--    â€œCustomer Terminalâ€� shall mean the MetaTrader program version 4, or an updated version, in addition to any trading platform facilitations to web and mobile traders, which are used by the Customer in order to obtain information on underlying markets in real-time, to make technical analysis of the markets, make Transactions, place / delete / modify Orders, as well as to receive notices from the Company and keep a record of Transactions.-->
</p>
<p class="license-text">
    <?=lang('tac_32')?>
<!--    â€œClosed Positionâ€� shall mean the opposite of an Open Position.-->
</p>
<p class="license-text">
    <?=lang('tac_33')?>
<!--    â€œCompany Online Trading Systemâ€� shall mean the Software used by the Company which includes the aggregate of its computer devices, software, databases, telecommunication hardware, trading platform, all programs and technical facilities providing real-time Quotes, making it possible for the Customer to obtain information of Underlying Markets in real time, make technical analysis on the markets, enter into Transactions, place / delete / modify Orders, receive notices from the Company and keep record of Transactions and calculate all mutual obligations between the Customer and the Company.-->
</p>
<p class="license-text">
    <?=lang('tac_34')?>
<!--    â€œCompleted Transactionâ€� shall mean two counter deals of the same size, an opening and a closing position-->
</p>
<p class="license-text">
    <?=lang('tac_35')?>
<!--    â€œContract for Difference (CFD)â€� shall mean a CFD on spot foreign exchange, or a CFD on shares, or a CFD on spot metals or a CFD on futures or any other CFD related instrument that is available for trading through the-->
    <img class="tradomart" alt="" src="<?= $this->template->Images()?>tradomart.png" />
    <?=lang('tac_36')?>
<!--    trading platform(s). A full list of tradable CFDs is available online at the Companyâ€™s website.-->
</p>
<p class="license-text">
    <?=lang('tac_37')?>
<!--    â€œContract Specificationsâ€� shall mean the principal trading terms for each type of financial instrument and/or type of Customer Account as determined by the Company from time to time at its discretion (these may include e.g. margin requirements, spreads, swaps, lot sizes, minimum level for placing orders, financing charges, Company charges, minimum deposit requirements for different types of Customer Accounts etc.) The Contract Specifications appear on the Website of the Company.-->
</p>
<p class="license-text">
    <?=lang('tac_38')?>
<!--    Currency yof the Customer Account shall mean the currenc that the Customer Account is denominated in.-->
</p>
<p class="license-text">
    <?=lang('tac_39')?>
<!--    Currency Pair shall mean the object or Underlying Asset of a currency transaction based on the change in the value of one currency against the other. A Currency Pair consists of two currencies (the Quote Currency and the Base Currency) and shows how much of the Quote currency is needed to purchase one unit of the Base Currency.-->
</p>
<p class="license-text">
    <?=lang('tac_40')?>
<!--    CYSEC is an abbreviation for â€œCyprus Securities and Exchange Commissionâ€� which represents the Companyâ€™s supervisory authority.-->
</p>
<p class="license-text">
    <?=lang('tac_41')?>
<!--    CySEC Rules shall mean the Governing Laws, the Rules, Directives, Regulations, Guidance notes and Circulars published by the Cyprus Securities and Exchange Commission.-->
</p>
<p class="license-text">
    <?=lang('tac_42')?>
<!--    â€œEquityâ€� shall mean the Balance plus the Floating Profit minus the Floating Loss.-->
</p>
<p class="license-text">
    <?=lang('tac_43')?>
<!--    â€œFloating Profit/Lossâ€� shall mean current profit/loss on Open positions calculated at the current Quotes. (Including any commissions or fees where applicable).-->
</p>
<p class="license-text">
    <?=lang('tac_44')?>
<!--    â€œFree Marginâ€� shall mean funds that are available for opening a position.  It is calculated as Equity less Margin.-->
</p>
<p class="license-text">
    <?=lang('tac_45')?>
<!--    â€œMarginâ€� shall mean the required funds available in a trading account for the purpose of maintaining an open position.-->
</p>
<p class="license-text">
    <?=lang('tac_46')?>
<!--    â€œIndicative Quoteâ€� shall mean a Quote for which the Company has the right not to accept any Instructions or execute any Orders.-->
</p>
<p class="license-text">
    <?=lang('tac_47')?>
<!--    â€œIntroducing Brokerâ€� shall mean a third party who introduces prospective Customers to the Company.-->
</p>
<p class="license-text">
    <?=lang('tac_48')?>
<!--    â€œInitial Marginâ€� shall mean the necessary margin required by the Company in order to open a position for each type of financial instrument.-->
</p>
<p class="license-text">
    <?=lang('tac_49')?>
<!--    â€œLeverageâ€� shall mean the ratio of transaction size to initial margin. For example a 1:100 ratio means that in order to open a position, the initial margin is one hundred times less than the transaction size.-->
</p>
<p class="license-text">
    <?=lang('tac_50')?>
<!--    â€œLotâ€� shall mean a unit measuring the transaction amount specified for each financial instrument. In foreign currency 1 lot equals 100,000 units of the base currency.-->
</p>
<p class="license-text">
    <?=lang('tac_51')?>
<!--    â€œMargin shallâ€� mean the necessary funds required in order to open or maintain open positions.-->
</p>
<p class="license-text">
    <?=lang('tac_52')?>
<!--    â€œMargin Callâ€� shall mean the situation whereby the Company informs the Customer to deposit additional funds when the Customer does not have enough margin to open or maintain positions.-->
</p>
<p class="license-text">
    <?=lang('tac_53')?>
<!--    â€œMargin levelâ€� shall mean the Equity to Margin ratio, calculated as Equity divided by Margin times a hundred.-->
</p>
<p class="license-text">
    <?=lang('tac_54')?>
<!--    â€œOpen Positionâ€� shall mean any position that has not been closed and is therefore not a Completed Transaction.-->
</p>
<p class="license-text">
    <?=lang('tac_55')?>
<!--    â€œOrderâ€� shall mean the instruction from the Customer to the Company to open or close a position when the price reaches a predefined order level.-->
</p>
<p class="license-text">
    <?=lang('tac_56')?>
<!--    â€œOver-the-Counter (OTC)â€� shall mean the execution venue for any financial instrument whose trading is governed by the Service Agreement.-->
</p>
<p class="license-text">
    <?=lang('tac_57')?>
<!--    â€œQuoteâ€� means the information for the current price for a specific instrument given as the Bid and Ask prices.-->
</p>
<p class="license-text">
    <?=lang('tac_58')?>
<!--    â€œQuote Currencyâ€� shall mean the second currency represented in the currency pair which can be bought or sold by the Customer for the base currency, e.g. for the EURUSD currency pair the quote currency is the US Dollar.-->
</p>
<p class="license-text">
    <?=lang('tac_59')?>
<!--    â€œRequired Marginâ€� shall mean the necessary margin required by the Company so as to maintain open positions.-->
</p>
<p class="license-text">
    <?=lang('tac_60')?>
<!--    â€œService Agreementâ€� shall mean the Customer Agreement, the Customer Categorisation document, the Investor Compensation Fund document, the Risk Acknowledgement and Disclosure document, the Services document, the Conflict of Interest policy, the Order Execution and Best Interest Policy, the-->

    <a href=" <?php echo FXPP::loc_url('privacy-policy')?>">
        <?=lang('tac_61')?>
<!--        Privacy Policy-->
    </a>
    <?=lang('tac_62')?>
<!--    and the Customer Agreement, as amended from time to time, in addition to any information contained within the Companyâ€™s website, including but not limited to the information contained within the â€˜Legal Informationâ€™ and the â€˜Legal Documentationâ€™ sections.-->

</p>
<p class="license-text">
    <?=lang('tac_63')?>
<!--    â€œSlippageâ€� shall mean the difference between the expected price of a transaction and the price the transaction is actually executed at. Slippage often occurs during periods of high volatility (for example due to market news announcements) making an order at a specified price impossible to execute when market orders are used due to a lack of liquidity and also when large volume orders are executed.-->
</p>
<p class="license-text">
    <?=lang('tac_64')?>
<!--    â€œSpreadâ€� shall mean the difference between the Ask and Bid prices of an Underlying Asset in a CFD at that same moment.-->
</p>
<p class="license-text">
    <?=lang('tac_65')?>
<!--    â€œSwap or Rolloverâ€� shall mean the interest added or deducted for holding a position open overnight.-->

</p>
<p class="license-text">
    <?=lang('tac_66')?>
<!--    â€œTransactionâ€� shall mean any contract, transaction or dealing entered into or executed by the Customer or on behalf of the Customer.-->
</p>
<p class="license-text">
    <?=lang('tac_67')?>
<!--    â€œTransaction Sizeâ€� shall mean the lot size multiplied by the number of lots.-->
</p>

<p class="license-text">
    <?=lang('tac_68')?>
<!--    â€œValue Dateâ€� means the delivery date of funds.-->
</p>
<p class="license-text">
    <?=lang('tac_69')?>
<!--    â€œWebsiteâ€� shall mean the Companyâ€™s website at www.forexmart.com or any other website as the Company may maintain from time to time for access by Customers.-->
</p>
<p class="license-text">
    <?=lang('tac_70')?>
<!--    â€œWritten Noticeâ€� shall mean such notice made through: the Trading Platform internal mail; email; facsimile transmission; post; or information published on the Company website.-->
</p>



</li>
<!--5.-->
<li class="primaryunits">
    <h4 class="rootnumberheadings">
        <?=lang('tac_71')?>
<!--        RISK ACKNOWLEDGEMENT-->
    </h4>
    <ol>
        <!--5.1.-->
        <li>
            <p class="license-text">
                <?=lang('tac_72')?>
<!--                Any financial instrument which is a leveraged product such as CFDs on Forex, precious metals, futures, shares or any other commodities bears significant risk and the Customer might lose a fraction or all the capital which he/she invested. The Customer understands that when trading CFDs he/she is trading on the outcome of the price of an underlying asset and that trading does not occur in a Regulated Market but Over-The-Counter (OTC). Consequently, the Customer acknowledges the risks involved in the transactions of such instruments.-->
            </p>
        </li>
        <!--5.2.-->
        <li>
            <p class="license-text">
                <?=lang('tac_73')?>
<!--                The Customer understands and accepts that the value of an investment in any type of financial instrument may change upwards or downwards or may result in nil value.-->
            </p>
        </li>
        <!--5.3.-->
        <li>
            <p class="license-text">
                <?=lang('tac_74')?>
<!--                The Customer understands all the risks involved and therefore accepts the Risk Acknowledgement and Disclosure Policy which is a necessary document in the registration process.-->
            </p>
        </li>
    </ol>
</li>
<!--6.-->
<li class="primaryunits">
    <h4 class="rootnumberheadings">
        <?=lang('tac_75_0')?>
<!--        ANTI â€“ MONEY LAUNDERING PROVISIONS-->
    </h4>
    <ol>
        <!--6.1.-->
        <li>
            <p class="license-text">
                <?=lang('tac_75')?>
<!--                The Company is legally obliged by the European Union regulation and by local authorities to take all necessary action for the prevention and suppression of money laundering activities. The Customer shall understand from the above that the Company shall request and obtain certain verification documents from the Customer to be legally compliant.-->

            </p>
        </li>
        <!--6.2.-->
        <li>
            <p class="license-text">
                <?=lang('tac_76')?>
<!--                In the case where the Customer fails to provide the Company with the necessary information with regards to the above, the Company reserves the right not to execute orders on behalf of the Customer. Any delays that might arise with regards to the verification of the Customerâ€™s documents are not the responsibility of the Company.-->
            </p>
        </li>
    </ol>
</li>
<!--7.-->
<li class="primaryunits">
    <h4 class="rootnumberheadings">
        <?=lang('tac_77')?>
<!--        CUSTOMER ACCOUNT OPENING PROCEDURE-->
    </h4>
    <ol>
        <!--7.1.-->
        <li>
            <p class="license-text">
                <?=lang('tac_78')?>
<!--                After each prospective Customer fills in and submits an Application Form together with all the required documentation requested by the Company, the Company will perform all internal controls (e.g. anti-money laundering and customer appropriateness tests) and will send to the prospective Customer a notice informing him/her whether or not he/she has been accepted as the Companyâ€™s Customer. The Agreement will take effect and begin on the date on which the Customer receives notification from the Company that he/she has been accepted as the Companyâ€™s Customer and that a Customer Account has been created for him/her. The Company is not required to accept any person as its Customer until all the necessary documentation has been fully completed by such person and received by the Company, and all internal Company controls have been completed.-->
            </p>
        </li>
        <!--7.2.-->
        <li>
            <p class="license-text">
                <?=lang('tac_79')?>
<!--                In the event that the Customer is accepted by the Company as its Customer, the Company will create a Customer Account for him, which will be activated upon the Customer depositing the minimum permitted initial deposit as determined by the Company.-->
            </p>
        </li>
    </ol>
</li>
<!--8.-->
<li class="primaryunits">
    <h4 class="rootnumberheadings">
        <?=lang('tac_80')?>
<!--        CUSTOMER CATEGORISATION-->
    </h4>
    <ol>
        <!--8.1.-->
        <li>
            <p class="license-text">
                <?=lang('tac_81')?>
<!--                The Company will treat the Customer as a â€˜Retail Clientâ€™, as per the terms defined under the Markets in Financial Instruments Directive (MiFID) (EU Directive 2004/39/EC), and as amended from time to time.  The Customerâ€™s categorisation will be determined by the Company based on the information that the Customer provides when completing the application form.  The responsibility thus lies with the Customer to notify the Company in writing, of any change to his/ her personal circumstances.-->
            </p>
        </li>
        <!--8.2.-->
        <li>
            <p class="license-text">
                <?=lang('tac_82')?>
<!--                The Company may review the Customerâ€™s categorisation from time to time to determine if re-categorisation is necessary; in accordance with regulatory requirements.-->
            </p>
        </li>
        <!--8.3.-->
        <li>
            <p class="license-text">
                <?=lang('tac_83')?>
<!--                The Customer accepts that when categorising the Customer and dealing with him/her, the Company will rely on the accuracy, completeness and correctness of the information provided by the Customer in his Application Form and the Customer has the responsibility to immediately notify the Company in the event of information changes at any time thereafter.-->
            </p>
        </li>
        <!--8.4.-->
        <li>
            <p class="license-text">
                <?=lang('tac_84')?>
<!--                The Company shall provide different levels of regulatory protection to each Customer category and therefore to Customers within each category. In particular, Retail Customers are provided with the highest level of regulatory protection.-->
            </p>
        </li>
        <!--8.5.-->
        <li>
            <p class="license-text">
                <?=lang('tac_85')?>
<!--                The Customer has the right to request a change of category and thus modify the level of regulatory protection provided to him/her. In the event where a Customer requests a change of category, he/she needs to meet certain specified quantitative and qualitative criteria (see â€œCustomer Categorisationâ€� document). However, if the above-mentioned criteria are not met, the Company has the right to choose whether to provide services under the requested classification.-->
            </p>
        </li>

        <!--8.6.-->
        <li>
            <p class="license-text">
                <?=lang('tac_86')?>
<!--                It is understood that the Company has the right to review the Customerâ€™s Categorisation and change his category if this is deemed necessary (subject to Applicable Regulations).-->
            </p>
        </li>
        <!--8.7.-->
        <li>
            <p class="license-text">
                <?=lang('tac_87')?>
<!--                If there is a change in the personal circumstances of the Customer, the request for re-categorisation must be communicated to the Company in writing, and the Company will consider such a request at its discretion.-->
            </p>
        </li>

    </ol>
</li>
<!--9.-->
<li class="primaryunits">
    <h4 class="rootnumberheadings">
        <?=lang('tac_88')?>
<!--        PERSONAL DATA AND CONFIDENTIALITY-->
    </h4>
    <ol>
        <!--9.1-->
        <li>
            <p class="license-text">
                <?=lang('tac_89')?>
<!--                The Company may collect Customer information directly from the Customer (from the completed application form or otherwise) or from other persons including, for example, credit reference agencies, fraud prevention agencies and the providers of public registers.-->
            </p>
        </li>
        <!--9.2-->
        <li>
            <p class="license-text">
                <?=lang('tac_90')?>
<!--                The Company will use, store, process and handle personal information provided by the Customer (in case of a natural person) in connection with the provision of the services of the Company and in accordance with the Processing of Personal Data (Protection of the Individual) Law of 2001.-->
            </p>
        </li>
        <!--9.3-->
        <li>
            <p class="license-text">
                <?=lang('tac_91')?>
<!--                The Company will treat as confidential any Customer information it holds and this information will be used solely in connection with the provision of the services of the Company. Information already made public, or previously held by the Company without the obligation of confidentiality will not be regarded as such.-->
            </p>
        </li>
        <!--9.4-->
        <li>
            <p class="license-text">
                <?=lang('tac_92')?>
<!--                The Company has the right to disclose Customer information including recordings and documents of a private nature in the following circumstances:-->
            </p>
            <p class="license-text">
                &#8226;
                <?=lang('tac_93')?>
<!--                where required by the governing law or a competent Court;-->
            </p>
            <p class="license-text">
                &#8226; <?=lang('tac_94')?>
<!--                where requested by CySEC or any other regulatory authority that has control or jurisdiction over the Company or the Customer or their associates or in whose territory the Company has Customers;-->
            </p>
            <p class="license-text">
                &#8226; <?=lang('tac_95')?>
<!--                where required by relevant authorities to investigate or prevent fraud, money laundering or any other illegal activity;-->
            </p>
            <p class="license-text">
                &#8226; <?=lang('tac_96')?>
<!--                where necessary in order for the Company to defend or exercise its legal rights;-->

            </p>
            <p class="license-text">
                &#8226; <?=lang('tac_97')?>
<!--                to the Companyâ€™s professional advisors provided that in each case the relevant party shall be duly informed about the confidential nature of such information and commit to the confidentiality herein obligations as well;-->
            </p>
            <p class="license-text">
                &#8226; <?=lang('tac_100')?>
<!--                to credit reference and fraud prevention agencies and other financial institutions for credit checking, fraud prevention, anti-money laundering purposes, identification or due diligence of the Customer; at the Customerâ€™s request or with the Customerâ€™s consent.-->
            </p>
        </li>
        <!--9.5-->
        <li>
            <p class="license-text">
                <?=lang('tac_101')?>
<!--                By entering into the Service Agreement, the Customer consents to the transmittal of the Customerâ€™s personal data outside the European Economic Area, according to the provisions of Processing of Personal Data (Protection of the Individual) Law of 2001.-->

            </p>
        </li>

        <!--9.6-->
        <li>
            <p class="license-text">
                <?=lang('tac_102')?>
<!--                Telephone conversations between the Customer and the Company may be recorded and recordings will be the sole property of the Company. The Customer accepts such recordings as conclusive evidence of the Orders/Instructions/Requests or conversations so recorded.-->
            </p>
        </li>
        <!--9.7-->
        <li>
            <p class="license-text">
                <?=lang('tac_103')?>
<!--                The Customer accepts that the Company may, from time to time, make direct contact with the Customer by telephone, fax, or otherwise.-->

            </p>
        </li>
        <!--9.8-->
        <li>
            <p class="license-text">
                <?=lang('tac_104')?>
<!--                Under Applicable Regulations, the Company will keep records containing Customer personal data, trading information, account opening documents, communications and  anything else which relates to the Customer for at least five years after termination of the Service Agreement.-->
            </p>
        </li>
    </ol>
</li>
<!--10.-->

<!--11.-->
<li class="primaryunits">
    <h4 class="rootnumberheadings">
        <?=lang('tac_127')?>
<!--        SERVICES-->
    </h4>

    <ol>
        <!--11.1-->
        <li>
            <p class="license-text">
                <?=lang('tac_128')?>
<!--                The Company provides investment and ancillary services to the Customer as published by CySEC online at http://www.cysec.gov.cy.-->
            </p>
        </li>

        <!--11.2-->
        <li>
            <p class="license-text">
                <?=lang('tac_129')?>
<!--                The Company offers, on an execution-only basis, a number of financial instruments to the Customer; the contract specifications of which are found online at the Companyâ€™s website.  The Company is entitled to execute an instruction received by the Customer even if such transaction is not suitable for the Customer.-->


            </p>
        </li>
        <!--11.3-->
        <li>
            <p class="license-text">
                <?=lang('tac_130')?>
<!--                The trading conditions and execution rules of the financial instruments on offer by the Company can be found at any given time on the Companyâ€™s website.  The Company reserves the right to amend, from time to time, any part of the Service Agreement and the Customer will continue to be bound by the Service Agreement, including but not limited to any amendments that have been implemented.  Notice to the Customer will be given of any such aforementioned amendments.-->

            </p>
        </li>

        <!--11.4-->
        <li>
            <p class="license-text">
                <?=lang('tac_131')?>
<!--                Under Applicable Regulations the Company is obliged to obtain information about the Customerâ€™s knowledge and experience in the Investment field so that an assessment of the appropriateness of the envisaged product or service to the Customer can be accomplished.  The Company will assume that all information provided by the Customer, relating to his/ her knowledge and experience, is accurate and that the Company incurs no liability to the Customer if such information is misleading, incomplete, changes, becomes inaccurate through Customer negligence unless the Customer informs the Company of any such changes in writing.-->
            </p>
        </li>

        <!--11.5-->
        <li>
            <p class="license-text">
                <?=lang('tac_132')?>
<!--                The Company may from time to time and as often as it deems appropriate, provide information including but not limited to the conditions of the financial market, which may be posted on its website and/ or other media.  This information is provided for communication purposes assisting the Customer to make his/ her own investment decisions and it does not contain nor should it be construed as containing investment advice or an investment recommendation or an offer of or solicitation for any transactions in financial instruments.  The Company makes no representation and assumes no liability as to the accuracy or completeness of the information provided, nor any loss arising from any investment based on a recommendation, forecast or other information supplied by an employee of the Company, a third party or otherwise.  All expressions of opinion included in the information are subject to change without notice and any opinions made may be personal to the author and may not reflect the opinions of the Company.-->
            </p>
        </li>

        <!--11.6-->
        <li>
            <p class="license-text">
                <?=lang('tac_133')?>
<!--                The Company will not provide investment advice or make any recommendation to the Customer and is not required to assess the suitability of investments which the Customer wishes to undertake. The Customer will not benefit from the protection of applicable regulations as regards assessment of suitability.  The Customer understands that independent advice should be sought in relation to trading financial instruments, including but not limited to trading any specific financial instruments, investment strategies pursued and possible tax implications.-->

            </p>
        </li>
        <!--11.7-->
        <li>
            <p class="license-text">
                <?=lang('tac_134')?>
<!--                The Customer may trade through his/ her trading account from 00.00.01 (GMT+2) on a Monday until 00.00.00 (GMT+2) on a Friday.  Certain financial instruments trade during specific time frames. Company holidays will be announced on the Company website.-->
            </p>
        </li>

        <!--11.8-->
        <li>
            <p class="license-text">
                <?=lang('tac_135')?>
<!--                The Company is entitled to refuse the provision of any investment or ancillary service to the Customer, at any time and the Customer agrees that the Company is not obliged to provide the reasons for such action.-->

            </p>
        </li>
        <!--11.9-->
        <li>
            <p class="license-text">
                <?=lang('tac_136')?>
<!--                The Company will not provide delivery of the underlying asset of an instrument in relation to any trade through the Customerâ€™s trading account.-->
            </p>
        </li>
        <!--11.10-->
        <li>
            <p class="license-text">
                <?=lang('tac_137')?>
<!--                The Services provided by the Company, may engage in margined transactions or transactions in financial instruments which are: traded on exchanges which are not recognised or designated investment exchanges; and/or not traded on any stock or investment exchange.-->
            </p>
        </li>

        <!--11.11-->
        <li>
            <p class="license-text">
                <?=lang('tac_138')?>
<!--                The Company has the right, at its discretion and at any time, to withdraw the whole or any part of the Services on a temporary or permanent basis and the Customer agrees that the Company will have no obligation to inform the Customer of the reason.-->
            </p>
        </li>
    </ol>
</li>
<!--12.-->
<li class="primaryunits">
    <h4 class="rootnumberheadings">
        <?=lang('tac_139')?>
<!--        CAPACITY-->
    </h4>
    <ol>
        <!--12.1.-->
        <li>
            <p class="license-text">
                <?=lang('tac_140')?>
<!--                The Customer acts as a principal and not as an agent on behalf of any third party. The Customer, unless otherwise agreed, will be treated according to article 4.1.  The Customer will be fully and directly responsible for performing his/ her obligations.-->
            </p>
        </li>
        <!--12.2.-->
        <li>
            <p class="license-text">
                <?=lang('tac_141')?>
<!--                The Company will continue to accept instructions or requests given by such person on the Customerâ€™s behalf as described in 6.2 above, until written notification is received from the Customer for the termination of such authorisation. This written notification should be received by the Company at least five (5) business days prior to the termination date.-->
            </p>
        </li>
        <!--12.3.-->
        <li>
            <p class="license-text">
                <?=lang('tac_142')?>
<!--                The Customer authorises the Company to rely and act on any instruction or request received from the Customer, given by the Customer or on behalf of the Customer without the need on the Companyâ€™s part for confirming the authenticity of the instruction or the identity of the person giving such request or instruction.-->

            </p>
        </li>
        <!--12.4.-->
        <li>
            <p class="license-text">
                <?=lang('tac_143')?>
<!--                Until the Company receives written notice of the death or mental incapacity of the Customer, the Company will have no responsibility or liability in respect of the actions or omissions or fraud of the authorised third party (appointed as in 6.2. above).  Upon receiving such notice, the Company will stop accepting any instructions or requests from the authorised party.-->
            </p>
        </li>
        <!--12.5.-->
        <li>
            <p class="license-text">
                <?=lang('tac_144')?>
<!--                Any person, natural or legal, that is identified as responsible for acting on behalf of a Customer through the means of a Power of Attorney may give instructions and requests to the Company on behalf of that Customer.-->
            </p>
        </li>
    </ol>

</li>
<!--13.-->
<li class="primaryunits">
    <h4 class="rootnumberheadings">
        <?=lang('tac_145')?>
<!--        CUSTOMER MONEY-->
    </h4>
    <ol>
        <!--13.1.-->
        <li>
            <p class="license-text">
                <?=lang('tac_146')?>
<!--                The Company, when holding Customerâ€™s funds, shall take every possible action to ensure that the Customerâ€™s funds are safeguarded. Such funds will be held in designated bank accounts of the Customer.-->
            </p>
        </li>
        <!--13.2.-->
        <li>
            <p class="license-text">
                <?=lang('tac_147')?>
<!--                The Company shall keep separate accounting records of the Customerâ€™s and its own funds and shall be able to promptly distinguish funds held for different Customers of the Company.-->
            </p>
        </li>
        <!--13.3.-->
        <li>
            <p class="license-text">
                <?=lang('tac_148')?>
<!--                The Customer accepts to clearly denote all the required information on any payment document (funds deposit/withdrawal/transfer) to comply with the international regulations against fraud and money laundering. The Company shall not accept any payment made by a third party on behalf of the Customer.-->
            </p>
        </li>
        <!--13.4.-->
        <li>
            <p class="license-text">
                <?=lang('tac_149')?>
<!--                Any amount of funds transferred by the Customer from his/her bank account  will be deposited to his/her Customer account at the value date of the payment receipt and the amount will be net of any charges from the Customerâ€™s bank.-->
            </p>
        </li>
        <!--13.5.-->
        <li>
            <p class="license-text">
                <?=lang('tac_150')?>
<!--                The Company reserves the right to refuse a transfer of funds on behalf of the Customer in the following cases:-->
            </p>
            <p class="license-text">
                &#8226; <?=lang('tac_151')?>
<!--                If the Company has reasonable suspicion that the person transferring the funds is not duly authorised;-->

            </p>
            <p class="license-text">
                &#8226; <?=lang('tac_152')?>
<!--                If the funds are not transferred directly from the Customer and a third party is involved;-->

            </p>
            <p class="license-text">
                &#8226; <?=lang('tac_153')?>
<!--                If the transfer is in violation of the Cypriot legislation.-->
            </p>
        </li>
        <!--13.6.-->
        <li>
            <p class="license-text">
                <?=lang('tac_154')?>
<!--                In any of the cases mentioned in paragraph 10.5, the Company shall return any received funds to the sender, using the same method that they were received, and the Customer will be charged with the resulting bank charges.-->
            </p>
        </li>

        <!--13.7.-->
        <li>
            <p class="license-text">
                <?=lang('tac_155')?>
<!--                The Customer shall be entitled to withdraw from his/her account any funds that are not used to cover margins and other obligations.-->
            </p>
        </li>
        <!--13.8.-->
        <li>
            <p class="license-text">
                <?=lang('tac_156')?>
<!--                The Customer authorizes the Company, by accepting the Service Agreement, to perform deposits and withdrawals from the Customerâ€™s bank account on his/her behalf and any other transactions for the payment of all amounts due by the Customer.-->
            </p>
        </li>
        <!--13.9.-->
        <li>
            <p class="license-text">
                <?=lang('tac_157')?>
<!--                Customer funds â€˜the Fundsâ€™ held on the Trading Account will be deposited in an institution â€˜the Institutionâ€™ specified by the Company on the Customerâ€™s behalf.  The Funds will be segregated by the Company and held in accordance with applicable regulations in a segregated account.  The Company may hold the Funds of different Customers in the same account as per the applicable regulations.-->
            </p>
        </li>
        <!--13.10.-->
        <li>
            <p class="license-text">
                <?=lang('tac_158')?>
<!--                The Customer has the right to withdraw any part of the Funds equal to the free margin available in the trading account. Such a request may take up to three (3) business days to be processed; The Company reserves the right to request additional information to safeguard a legitimate Customer request. The Company may decline such a request if it deems that the request may not be legitimate.-->

            </p>
        </li>


        <!--13.11.-->
        <li>
            <p class="license-text">
                <?=lang('tac_159')?>
<!--                The Company is not obliged to pay interest to the Customer on the Funds deposited.-->
            </p>
        </li>
        <!--13.12.-->
        <li>
            <p class="license-text">
                <?=lang('tac_160')?>
<!--                The Customer accepts that the Funds will be deposited in the trading account on the value date received by the Institution, net of any transfer fees or other charges incurred.-->
            </p>
        </li>


        <!--13.13.-->
        <li>
            <p class="license-text">
                <?=lang('tac_161')?>
<!--                The Company is covered by the Investors Compensation Fund (ICF), whereby the Customer may be entitled to compensation from the ICF if the Company cannot meet its obligations; as explained in the Investors Compensation Fund document.-->
            </p>
        </li>
        <!--13.14.-->
        <li>
            <p class="license-text">
                <?=lang('tac_162')?>
<!--                The Customer has the right to withdraw any part of the Funds available using a specific transfer method.  The Company has the right to decline and has the right to suggest an alternative method of transfer.-->
            </p>
        </li>

        <!--13.15.-->
        <li>
            <p class="license-text">
                <?=lang('tac_163')?>
<!--                If the Customerâ€™s trading account is inactive for a calendar year, the Company reserves the right to charge an account maintenance fee in order to keep the trading account open.  The Company may close the account, charge a relevant fee and notify the Customer accordingly.-->

            </p>
        </li>

    </ol>
</li>
<!--14.-->
<li class="primaryunits">
    <h4 class="rootnumberheadings">
        <?=lang('tac_164')?>
<!--        DEPOSITS-->
    </h4>
    <ol>
        <!--14.1.-->
        <li>
            <p class="license-text">
                <?=lang('tac_165')?>
<!--                We reserve the right to impose deposit limits and deposit fees in our system(s), at any time.-->


            </p>
        </li>
        <!--14.2.-->
        <li>
            <p class="license-text">
                <?=lang('tac_166')?>
<!--                You agree that any funds transmitted to our bank accounts by you or, where permitted, on your behalf, will be deposited into your Account with us at the value date of when the received by us and net of any charges/fees charged by the bank account providers, our payment service providers and/or any other intermediary involved in such transaction process.-->

            </p>
        </li>
        <!--14.3.-->
        <li>
            <p class="license-text">
                <?=lang('tac_167')?>
<!--                Before accepting any such funds into our bank accounts and/or making any such funds available to into your Account with us, we must be fully satisfied that you, as our client, are the sender of such funds, or that such funds have been transmitted to us by an authorized representative of you, as our client; in those instances where we are not satisfied that you, as our client, are the sender of such funds, or that such funds have been transmitted to us by an authorized representative of you, as our client, we reserve the right to refund/send back the net amount received to the same remitter from, and by the same payment method through which such funds were received.-->
            </p>
        </li>
    </ol>
</li>
<!--15.-->
<li class="primaryunits">
    <h4 class="rootnumberheadings">
        <?=lang('tac_168')?>
<!--        REFUNDS AND WITHDRAWALS-->
    </h4>
    <ol>
        <!--15.1.-->
        <li>
            <p class="license-text">
                <?=lang('tac_169')?>
<!--                We reserve the right to impose withdrawal limits and withdrawal fees in our systems, at any time.-->
            </p>
        </li>
        <!--15.2.-->
        <li>
            <p class="license-text">
                <?=lang('tac_170-1')?>
<!--                Upon submitting a withdrawal request you may be required to submit documentation as required by applicable â€œAnti-Money Laundering (â€œAMLâ€�) & Know Your Customer (â€œKYCâ€�) Legislationâ€� and/or any other similar rules and regulations applicable to us.-->
            </p>
        </li>
        <!--15.3.-->
        <li>
            <p class="license-text">
                <?=lang('tac_170')?>
<!--                When a withdrawal or refund is performed, we reserve the right (but shall under no circumstances be obliged) to remit the funds to the same remitter from, and by the same payment method through which such funds were initially received by us. In that connection, we reserve the right, at our sole discretion, (a) to decline withdrawals via certain specific payment methods; (b) to require another payment method as the one indicated in any withdrawal request, in which instance a new withdrawal request may have to be submitted; and/or (c) to require that further documentation be submitted, as required by applicable â€œAnti-Money Laundering (â€œAMLâ€�) & Know Your Customer (â€œKYCâ€�) Legislationâ€� and/or any other similar rules and regulations applicable to us, before proceeding with any withdrawal request.-->
            </p>
        </li>
        <!--15.4.-->
        <li>
            <p class="license-text">
                <?=lang('tac_171')?>
<!--                If we are unable to remit the funds, or any partial amount thereof, to the same remitter from, and by the same payment method through which such funds were initially received by us, we reserve the right (but shall under no circumstances be obliged) to transmit the funds via an alternative payment method selected by us, at our sole discretion, in any currency we deem fit (regardless of the currency in which the initial deposit was made). Under these circumstances, we shall not be responsible for any transfer fees or charges charged by the receiver and/or for any currency exchange rates resulting from the payment of such amount and the provisions of Section 50 hereinabove shall be applicable mutatis mutandis.-->

            </p>
        </li>
        <!--15.5.-->
        <li>
            <p class="license-text">
                <?=lang('tac_172')?>
<!--                Withdrawal requests that are accepted and approved by us in accordance with the terms of this Agreement are, in principle, processed within one Business Days following the receipt of the transfer request instructions. The amount to be transferred reduces the balance of the relevant Account from which such transfer is to be made, when the transfer request process is concluded. We reserve the right (a) to decline a withdrawal request if the request is not in accordance with the provisions of this Section, or (b) to delay the processing of the request if we are not satisfied with the ancillary documentation submitted with the withdrawal request.-->

            </p>
        </li>

        <!--15.6.-->
        <li>
            <p class="license-text">
                <?=lang('tac_173')?>
<!--                You agree, when we so request, to pay any bank transfer fees incurred when you are withdrawing funds from your Account or when funds are refunded by us to your designated bank account. You are solely responsible for the payments details you are providing us with and we do not accept any responsibility for your funds, if the payment details you have provided to us are incorrect or incomplete. It is also understood that we do not accept any responsibility for any funds that are not directly deposited into our bank accounts.-->
            </p>
        </li>
    </ol>
</li>
<!--16.-->
<li class="primaryunits">
<h4 class="rootnumberheadings">
    <?=lang('tac_174')?>
<!--    DEPOSITS BY CREDIT/DEBIT CARD-->
</h4>
<ol>
<!--16.1-->
<li>
    <p class="license-text">
        <?=lang('tac_175_0')?>
<!--        You can deposit funds to your Account with us quickly and easily by credit or debit card. The entire transaction is processed electronically - online.-->
    </p>
</li>
<!--16.2-->
<li>
    <p class="license-text">
        <?=lang('tac_175')?>
<!--        Before you can use your credit card, we reserve the right, but shall under no circumstances be obliged, to require that you register it with us.   As the case may be, the credit card registration process will be clearly explained on the Credit Card Deposit screen displayed on our Online Trading Facility. Upon submitting your credit card registration, you may be required to submit  documentation  as required  by  applicable â€œAnti-Money  Laundering  (â€œAMLâ€�)  &  Know Your  Customer  (â€œKYCâ€�) Legislationâ€� and/or any other similar rules and regulations applicable to us. Once your credit card has been successfully registered, you can start depositing funds into your Account by credit card.-->

    </p>
</li>

<!--16.3-->
<li>
    <p class="license-text">
        <?=lang('tac_176')?>
<!--        Registering and using your debit card is the same as using a credit card. The debit card must be associated with either Visa or-->
    </p>
</li>
<!--16.4-->
<li>
    <p class="license-text">
        <?=lang('tac_177')?>
<!--        MasterCard. The following information must match:-->
    </p>
    <p class="license-text">
        <?=lang('tac_178')?>
<!--        a. the mailing address you provided upon your account registration must match your credit/debit card statement's billing address; and-->

    </p>
    <p class="license-text">
        <?=lang('tac_189')?>
<!--        b.our full name must match  the name on the credit/debit card; DO NOT USE INITIALS OR NICKNAMES IN  ANY ACCOUNT!!-->

    </p>
</li>

<!--16.5-->
<li>
    <p class="license-text">
        <?=lang('tac_180')?>
<!--        Please note that it is a serious criminal offence to provide false or inaccurate information during your credit/debit card registration. At the very least, you may be prevented from accessing our Online Trading Facility via your current and future Accounts with us. Furthermore, in the event that we suspect or determine, at our sole discretion, that the information you provided during your credit/debit card registration is false or incorrect, we reserve the right, at our sole discretion, to take all action as we see fit, including, without limitation, completely blocking access to our Online Trading Facility, blocking and/or revoking your Access Codes and/or terminating your Account. Under these circumstances, we reserve the right to seize any profits and/or revenues generated directly or indirectly by exercising any such prohibit trading activity  and we shall be entitled to inform any Interested third parties of your breach of this clause; any active Orders associated with the same fraudulent credit card and/or Account will also be cancelled immediately; we have, and will continue to develop any tools necessary to identify credit/debit card fraud; any dispute arising from such fraudulent activity will be resolved by us in our sole and absolute discretion, in the manner we deem to be the fairest to all concerned; that decision shall be final and/or binding on all participants; no correspondence will be entered into.-->

    </p>
</li>
<!--16.6-->
<li>
    <p class="license-text">
        <?=lang('tac_181')?>
<!--        Before accepting any credit card deposits and/or making any such credit card deposits available into your Account with us, we must be fully satisfied that you are the legitimate owner/user of the credit card used and that it is you, as the legitimate owner/user of the credit card, who is making and/or authorizing the deposit by credit card; in those instances where we are not satisfied that you are the legitimate owner/user of the credit card used and that it is you, as the legitimate owner/user of the credit card, who is making and/or authorizing the deposit by credit card, we reserve the right to refuse the credit card deposit(s) in question and to refund/send back the net amount deposited to the same credit card account and via the same payment method through which such deposit(s) was/were made. Fraudulent transactions are immediately cancelled after being detected. Furthermore, in such instances, we reserve the right, at our sole discretion, to take all action as we see fit, including, without limitation, completely blocking access to our Online Trading Facility, blocking and/or revoking your Access Codes  and/or terminating  your Account.  Under these circumstances, we  reserve  the  right to seize  any  profits  and/or revenues generated directly or indirectly by exercising any such prohibit trading activity and we shall be entitled to inform any Interested third parties of your breach of this clause; any active Orders associated with the same fraudulent credit card and/or Account will also be cancelled immediately; we have, and will continue to develop any tools necessary to identify credit/debit card fraud; any dispute arising from such fraudulent activity will be resolved by us in our sole and absolute discretion, in the manner we deem to be the fairest to all concerned; that decision shall be final and/or binding on all participants; no correspondence will be entered into.-->

    </p>
</li>

<!--16.7-->
<li>
    <p class="license-text">
        <?=lang('tac_182')?>
<!--        We reserve the right, at our sole discretion, to impose such deposit limits and restrictions, as we deem fit. Current deposit limits and restrictions are displayed on the Credit/Debit Card Deposit screen displayed on our Online Trading Facility. If you would like to increase your credit/debit card deposit limit, please contact our Customer Support team as follows:-->
    </p>

    <p class="license-text">
        <u>
            <?=lang('tac_183')?>
<!--            Customer Support-->
        </u><br/>
        <?=lang('tac_184')?>
<!--        Working hours: 24/5-->
        <br/>
        <?=lang('tac_185')?>
<!--                Tel.:  +357 25-->
        <br/>
        <?=lang('tac_186')?>
<!--        E-mail:-->
        support@<img class="tradomart"  src="<?= $this->template->Images()?>tradomart.png" alt="" /> .com<br/>
    </p>

    <p class="license-text">
        <?=lang('tac_187')?>
<!--        Please include your name, Account number, mailing address, e-mail address and telephone number.-->
    </p>
</li>
<!--16.8-->
<li>
    <p class="license-text">
        <?=lang('tac_188')?>
<!--        Credit/debit card transactions are generally processed within minutes of being requested. The deposited funds are available for use immediately. We do not charge any fees for using this service. If we accept any payments to be made by a debit card, credit card or any other payment method that may charge processing fees, we do, however, reserve the right to levy a transfer charge. All transactions should be listed as purchases on your credit/debit card statement. You may wish to contact your credit/debit card company to ask if there are any fees on their side in processing these transactions.-->
    </p>
</li>

<!--16.9-->
<li>
    <p class="license-text">
        <?=lang('tac_189')?>
<!--        For credit/debit cards, we provide you with the option of paying in your own currency. We provide a competitive exchange rate, presented upfront in the payment method interface. Should you choose to pursue this service, the transaction will be processed on your payment method immediately using the exchange rate provided. In case you would like the payment provider to perform the currency exchange for you, the transaction will be posted to your card when processed by your issuing bank while the exchange rate and any additional fees will be determined by your issuing bank.-->
    </p>
</li>
<!--16.10-->
<li>
    <p class="license-text">
        <?=lang('tac_190')?>
<!--        If you plan to use more than one credit/debit card to deposit funds into your Account, you must ensure that your account has a zero balance before changing cards. You can do this by using any remaining funds within the Account or withdrawing any remaining funds to the original credit card. Before you can use any other credit card, you will need to register it with us in accordance with the procedures described hereinabove.-->

    </p>
</li>

<!--16.11-->
<li>
    <p class="license-text">
        <?=lang('tac_191')?>
<!--        It is important to keep a record of all of your credit/debit card deposits. To help you maintain these records you should be aware that your credit/debit card deposits are recorded and reported on your credit/debit card statement-->

    </p>
</li>
<!--16.12-->
<li>
    <p class="license-text">
        <?=lang('tac_192')?>
<!--        We are committed to continuing to provide the highest level of security for our customers when depositing money on-line. A new initiative has been put into place by MasterCard and Visa to further protect on-line transactions called MasterCard SecureCode and Verified by Visa. These both work in a similar way and protect the card holder with a secret code/password against unauthorized use of your card when you deposit money online. Please click one of the links below to visit the MasterCard or Visa websites for full information.-->

    </p>
    <p class="license-text">
        &#8226; <?=lang('tac_193')?>
<!--        MasterCard SecureCode-->
    </p>
    <p class="license-text">
        &#8226; <?=lang('tac_194')?>
<!--        Verified by Visa-->
    </p>
</li>

<!--16.13-->
<li>
    <p class="license-text">
        <?=lang('tac_195')?>
<!--        If your card qualifies for either MasterCard SecureCode or Verified by Visa you may be prompted to either register or enter your security details at the Credit Card Deposit screen displayed on our Online Trading Facility and follow the instructions posted thereon.-->

    </p>
</li>

</ol>
</li>
<!--17.-->

<li class="primaryunits">
    <h4 class="rootnumberheadings">
        <?=lang('tac_196')?>
<!--        CHARGEBACKS-->
    </h4>
    <ol>
        <!--17.1.-->
        <li>
            <p class="license-text">
                <?=lang('tac_197')?>
<!--                If you place a chargeback with your credit card company (on purpose or by mistake) for any deposit you made in your Account with us, we reserve the right to charge a â€œUSD 150, research feeâ€� to your Account upon receiving the chargeback by our merchant provider to cover our investigative expenses to prove that you did make the deposit, and you hereby authorize us to charge this amount to your credit card.-->
            </p>
        </li>
        <!--17.2.-->
        <li>
            <p class="license-text">
                <?=lang('tac_198')?>
<!--                We do not tolerate credit card fraud, and all fraud, without exception, will be prosecuted through criminal proceedings in your local jurisdiction to the fullest extent of the law. In addition, we will pursue civil legal action in your local jurisdiction seeking any loss of income related to the fraud, including business, legal fees, research costs, employee down time and loss of revenues.-->

            </p>
        </li>
        <!--17.3.-->
        <li>
            <p class="license-text">
                <?=lang('tac_199')?>
<!--                We employ advanced risk modelling to detect fraudulent transaction clues across our Services. Fraudulent transactions are immediately cancelled after being detected. Any active Orders associated with the same fraudulent credit card will also be cancelled immediately. We also actively leverage external, cross-industry resources - such as worldwide fraud blacklists â€“ to prevent fraudulent users from accessing our Online Trading Facility in the first place.-->
            </p>
        </li>
        <!--17.4.-->
        <li>
            <p class="license-text">
                <?=lang('tac_200')?>
<!--                We consider credit card charge backs to be fraudulent if you make no reasonable effort to work with us to resolve any problems with your deposit. All frivolous chargebacks not only cost our employees time away from our usual and customary matters of conducting normal business, but also cost us money, therefore:-->
            </p>
            <p class="license-text">
                <?=lang('tac_201')?>
<!--                a. when we detect questionable activity related to a deposit that is being made in an Account, we will mark the deposit with a â€œcustomer review in progressâ€� status and perform fraud detection checks on the deposit to reduce your exposure to risk; during this time, you won't be able to access your Account.-->
            </p>
            <p class="license-text">
                <?=lang('tac_202')?>
<!--                b. In general, we complete reviews within four (4) to six (6) hours; certain deposits posing a higher potential risk may require more time, however, as our Compliance Department performs even more extensive fraud detection checks. We may also contact you directly as a backup precaution. If we determine that a deposit is high-risk or doesn't comply with our Fraud & Security Policies, the deposit will immediately be cancelled and the funds will immediately be refunded to the credit card from which the deposit was initially made. Furthermore, in such instances, we reserve the right, at our sole discretion, to close any and all of your Account(s) with us immediately. Any active Orders associated with the same fraudulent credit card and/or Account will also be cancelled immediately.-->

            </p>
            <p class="license-text">
                <?=lang('tac_203')?>
<!--                c. You agree that if you choose to do business with us and you file a charge back with your credit card company, but you do not win the charge back argument, you agree to pay us, in addition to the â€œUSD 150,- research fee mentioned above, a â€œUSD 150,- administrative processing feeâ€� for our time responding to the matter. You hereby authorize us to charge this amount to your credit card. If this charge is rejected, we will pursue legal action to recoup losses for our time associated with responding to the charge back in addition to any other fees explained above. You agree to reimburse us or any Representative we may appoint for any legal expenses your actions may make us incur.-->

            </p>
            <p class="license-text">
                <?=lang('tac_204')?>
<!--                d. In addition, we will attempt to recover fraudulently disputed charges plus additional costs via a third-party collection agency and your account will be reported to all credit bureaus as a delinquent collection account. This may severely damage your credit rating for at least the next seven (7) years. At this point, we will no longer accept a settlement of your debt and will only accept payment in full. In addition to this, we will file a report with your local police department, and pursue all fraudulent activities through your local jurisdiction for prosecution to the fullest extent of the law. Furthermore, in such instances, we reserve the right, at our sole discretion, to take all action as we see fit, including, without limitation, completely blocking access to our Online Trading Facility, blocking and/or revoking your Access Codes and/or terminating your Account. Under these circumstances, we reserve the right to seize any profits and/or revenues generated directly or indirectly by exercising any such prohibit trading activity and we shall be entitled to inform any Interested third parties of your breach of this clause; any active Orders associated with the same fraudulent credit card and/or Account will also be cancelled immediately; we have, and will continue to develop any tools necessary to identify credit/debit card fraud; any dispute arising from such fraudulent activity will be resolved by us in our sole and absolute discretion, in the manner we deem to be the fairest to all concerned; that decision shall be final and/or binding on all participants; no correspondence will be entered into.-->
            </p>
        </li>
        <!--17.5.-->
        <li>
            <p class="license-text">
                <?=lang('tac_205')?>
<!--                We take fraud very seriously. We log IP strings on all deposits made in our accounts - any orders coming back as a chargeback due to fraudulent activities will be diligently.  We take fraud very seriously. We log IP strings on all deposits made in our accounts - any orders coming back as a chargeback due to fraudulent activities will be diligently-->
            </p>
        </li>
    </ol>
</li>

<li class="primaryunits">
    <h4 class="rootnumberheadings">
        NEGATIVE BALANCE PROTECTION
    </h4>

    <ol>
        <!--10.1.-->
        <li>
            <p class="license-text">
                The Company will not be liable for any margin call or losses that the Client may
suffer, including but not limited to losses due to Stop-out Level, if the trading benefit is
withdrawn for any reason pursuant to the applicable “Client Agreement - Terms and
Conditions of Business”. The Company ensures that losses will never exceed the total
available funds across the Clients’ Traders Trust trading portfolio (negative balance
protection).

            </p>
        </li>
        <!--10.2.-->
        <li>
            <p class="license-text">
                In addition, the client accepts that the Company reserves the right to immediately
terminate the client’s access to the trading platform(s) and recover any losses caused
by the client, in the event that the Firm determines, at its sole discretion, that the
client voluntarily and/or involuntarily abuses the ‘Negative Balance Protection’ offered
by the Company, by way of, but not limited to, hedging his/her exposure using his/her
trading accounts, whether under the same profile or in connection with another
client(s); and/or requesting a withdrawal of funds.


            </p>
        </li>
        <!--10.3.-->
    </ol>
</li>
<!--18.-->
<li class="primaryunits">
    <h4 class="rootnumberheadings">
        <?=lang('tac_206')?>
<!--        CHARGES AND OTHER COSTS-->
    </h4>
    <ol>
        <!--18.1.-->
        <li>
            <p class="license-text">
                <?=lang('tac_207')?>
<!--                The provision of Services is subject to the payment of costs, fees, commissions and charges to the Company, which are set out in the Contract Specifications or on the Companyâ€™s website. In addition to costs, other commissions and charges may be due by the Customer directly to third parties. The Customer is obliged to pay all such costs.-->

            </p>
        </li>
        <!--18.2.-->
        <li>
            <p class="license-text">
                <?=lang('tac_208')?>
<!--                Certain types of costs may appear as a percentage of the value of the financial instrument, therefore the Customer has the responsibility to understand how costs are calculated.-->
            </p>
        </li>
        <!--18.3.-->
        <li>
            <p class="license-text">
                <?=lang('tac_209')?>
<!--                When providing a Service to a Customer, the Company may pay or receive fees, commissions or other non-monetary benefits from third parties or introducing brokers as far as permitted by the Applicable Regulations. To the extent required by law, the Company will provide information on such benefits to the Customer on request.-->
            </p>
        </li>
        <!--18.4.-->
        <li>
            <p class="license-text">
                <?=lang('tac_210')?>
<!--                The Customer agrees to pay all expenses relating to this Agreement and any documentation which may be required for the carrying out of Transactions.-->
            </p>
        </li>
        <!--18.5.-->
        <li>
            <p class="license-text">
                <?=lang('tac_211')?>
<!--                Any applicable charges will be instantly deducted from his/ her trading account.-->

            </p>
        </li>

        <!--18.6.-->
        <li>
            <p class="license-text">
                <?=lang('tac_212')?>
<!--                Any charges including commissions and other costs will be paid by the Customer; the details of which will be displayed on the Companyâ€™s website.-->
            </p>
        </li>
        <!--18.7.-->
        <li>
            <p class="license-text">
                <?=lang('tac_213')?>
<!--                Details of any tax obligations which the Company is required to pay on the Customerâ€™s behalf will be stated to the Customer. The Customer is also accountable for other taxes which are not collected by the Company and the Customer should seek independent expert advice if he/she is in any doubt as to whether he may incur any further tax liabilities. Tax laws are subject to change from time to time.-->
            </p>
        </li>
        <!--18.8.-->
        <li>
            <p class="license-text">
                <?=lang('tac_214')?>
<!--                The Customer is solely responsible for all filings, tax returns and reports on any transactions which should be made to any relevant authority, whether governmental or otherwise, and for payment of all taxes (including but not limited to any transfer or value added taxes), arising out of or in connection with any Transaction.-->
            </p>
        </li>
        <!--18.9.-->
        <li>
            <p class="license-text">
                <?=lang('tac_215')?>
<!--                The Company may change its costs periodically. The Company will send a notification to the Customer informing him/her of any changes, before they come into effect. The Company will provide the Customer with at least two business daysâ€™ notice of such modifications except where such modification is based on a change in interest rates or tax treatment or it is otherwise impractical for the Company to do so.-->

            </p>
        </li>
        <!--18.10.-->
        <li>
            <p class="license-text">
                <?=lang('tac_216')?>
<!--                Swaps are calculated on the basis of the interbank market price.-->
            </p>
        </li>

        <!--18.11.-->
        <li>
            <p class="license-text">
                <?=lang('tac_217')?>
<!--                All CFDs traded with the Company relate to open-ended margined products that require funding on a daily basis.-->

            </p>
        </li>
    </ol>
</li>
<!--19.-->
<li class="primaryunits">
    <h4 class="rootnumberheadings">
        <?=lang('tac_218')?>
<!--        LIABILITY-->
    </h4>
    <ol>
        <!--19.1.-->
        <li>
            <p class="license-text">
                <?=lang('tac_219')?>
<!--                In cases where the Company provides information, recommendations, news, information relating to transactions, market commentary or research to the Customer (or in newsletters which it may post on its website or provide to subscribers via its website or otherwise), the Company shall not be liable for any losses, costs, expenses or damages suffered by the Customer arising from any inaccuracy or mistake in any such information given. Subject to the right of the Company to void or close any transaction in the specific circumstances set out in the Agreement, any transaction following such inaccuracy or mistake shall nonetheless remain valid and binding in all respects on both the Company and the Customer.-->
            </p>
        </li>
        <!--19.2.-->
        <li>
            <p class="license-text">
                <?=lang('tac_220')?>
<!--                The Company shall not be held liable for any loss or damage or expense incurred by the Customer in relation to, or directly or indirectly arising from but not limited to:-->
            </p>
            <p class="license-text">
                &#8226; <?=lang('tac_221')?>
<!--                any error or failure in the operation of the companyâ€™s online trading system;-->
            </p>
            <p class="license-text">
                &#8226; <?=lang('tac_222')?>
<!--                any delay caused by the Customer terminal;-->
            </p>
            <p class="license-text">
                &#8226; <?=lang('tac_223')?>
<!--                transactions made via the Customer terminal;-->
            </p>
            <p class="license-text">

                &#8226; <?=lang('tac_224')?>
<!--                any failure by the Company to perform any of its obligations under the Agreement as a result of a Force Majeure Event or any other cause beyond its control;-->

            </p>
            <p class="license-text">
                &#8226; <?=lang('tac_225')?>
<!--                the acts, omissions or negligence of any third party;-->

            </p>

            <p class="license-text">
                &#8226; <?=lang('tac_226')?>
<!--                any person obtaining the Customerâ€™s access codes that the Company has issued to the Customer prior to the Customer reporting such misuse of his access codes to the Company;-->

            </p>
            <p class="license-text">
                &#8226; <?=lang('tac_227')?>
<!--                all orders given through and under the Customerâ€™s access codes;-->

            </p>
            <p class="license-text">
                &#8226; <?=lang('tac_228')?>
<!--                unauthorized third parties having access to information, including electronic addresses, electronic communication, personal data and access codes when the above are transmitted between the parties or any other party using the internet or other network communication facilities, post, telephone, or any other electronic means;-->
            </p>
            <p class="license-text">
                &#8226; <?=lang('tac_229')?>
<!--                a delay transmitting an order for execution;-->

            </p>
            <p class="license-text">
                &#8226; <?=lang('tac_230')?>
<!--                currency risk;-->

            </p>

            <p class="license-text">
                &#8226; <?=lang('tac_231')?>
<!--                Slippage;-->
            </p>
            <p class="license-text">
                &#8226; <?=lang('tac_232')?>
<!--                any of the risks relating to CFD trading materialisation;-->

            </p>
            <p class="license-text">
                &#8226; <?=lang('tac_233')?>
<!--                any changes in the rates of tax;-->
            </p>
            <p class="license-text">
                &#8226; <?=lang('tac_234')?>
<!--                any actions or representations of the introducing broker;-->
            </p>
            <p class="license-text">
                &#8226; <?=lang('tac_235')?>
<!--                the Customer relying on stop loss or stop limit orders;-->
            </p>
        </li>
        <!--19.3.-->
        <li>
            <p class="license-text">
                <?=lang('tac_236')?>
<!--                If the Company incurs any claims, damage, liability, costs or expenses, which may arise in relation to the execution or as a result of the execution of the Customer Agreement and/or in relation to the provision of the services and/or in relation to any Order; it is understood that the Company bears no responsibility whatsoever and it is the Customerâ€™s responsibility to indemnify the Company.-->
            </p>
        </li>
        <!--19.4.-->
        <li>
            <p class="license-text">
                <?=lang('tac_237')?>
<!--                The Company shall in no circumstances be liable to the Customer for any significant or indirect losses, damages, loss of profits, loss of opportunity (including in relation to subsequent market movements), costs or expenses the Customer may suffer in relation to the Customer Agreement.-->
            </p>
        </li>
        <!--19.5.-->
        <li>
            <p class="license-text">
                <?=lang('tac_238')?>
<!--                The Law and applicable regulations will prevail over the Service Agreement in circumstances of obligation or liability of the Company towards the Customer or where the Customer is required to indemnify or compensate the Company.-->
            </p>
        </li>

        <!--19.6.-->
        <li>
            <p class="license-text">
                <?=lang('tac_239')?>
<!--                The Company bears no responsibility for any loss of opportunity that results in a reduction in the value of the Customerâ€™s transactions in financial instruments, regardless of the cause of such reduction, except to the extent that the reduction occurred as a direct consequence of the Companyâ€™s deliberate actions or omissions.-->
            </p>
        </li>
        <!--19.7.-->
        <li>
            <p class="license-text">
                <?=lang('tac_240')?>
<!--                Failure by the Customer to perform any of the Customerâ€™s obligations under the Service Agreement, which directly or indirectly results in the Company suffering liabilities, costs, claims, demands and expenses will be indemnified by the Customer and will keep the Company indemnified on demand.-->
            </p>
        </li>
        <!--19.8.-->
        <li>
            <p class="license-text">
                <?=lang('tac_241')?>
<!--                The Company bears no responsibility for any acts or omissions concluded by either a natural or legal person that provides the Company with information in relation to the execution of the Customerâ€™s transactions in financial instruments, unless such acts or omissions are the result of fraud or negligence on behalf of the Company.-->
            </p>
        </li>
        <!--19.9.-->
        <li>
            <p class="license-text">
                <?=lang('tac_242')?>
<!--                For the avoidance of doubt, the Customer shall at all times be responsible for, and shall be bound by, any unauthorized access and/or use of our Online Trading Facility, made in breach of this Agreement.-->
            </p>
        </li>
        <!--19.10.-->
        <li>
            <p class="license-text">
                <?=lang('tac_243')?>
<!--                It is the Customerâ€™s obligation to keep his Account numbers, user names and passwords (â€œAccess Codesâ€�) strictly confidential. The Customer acknowledges and agrees that any Instruction or communication transmitted via the Companyâ€™s Online Trading Facility by him or on his behalf, or through his Account, is made entirely at the Customerâ€™s own risk. The Customer hereby expressly authorizes-->

                <img class="tradomart" src="<?= $this->template->Images()?>tradomart/tradomart-small-black.png" alt=""  height="10"/>
                <?=lang('tac_244')?>
<!--                to rely and act on, and treat as fully authorized and binding upon the Customer, any Instruction given to-->
                <img class="tradomart" src="<?= $this->template->Images()?>tradomart/tradomart-small-black.png" alt="" height="10"/>
                <?=lang('tac_245')?>
<!--                that the Company believes to have been given by the Customer or on his behalf by any agent or intermediary whom-->

                <img class="tradomart" src="<?= $this->template->Images()?>tradomart/tradomart-small-black.png" alt="" height="10"/>
                <?=lang('tac_246')?>
<!--                believes in good faith to have been duly authorized by the Customer. The Customer acknowledges and agrees that-->

                <img class="tradomart" src="<?= $this->template->Images()?>tradomart/tradomart-small-black.png" alt="" height="10"/>
                <?=lang('tac_247')?>
<!--                shall be entitled to rely upon the Customerâ€™s Account number, Access Codes (user names and/or passwords) to identify the Customer and agrees that the Customer will not disclose this information to anyone not duly authorized by the Customer.-->
            </p>
        </li>
    </ol>
</li>
<!--20.-->
<li class="primaryunits">
    <h4 class="rootnumberheadings">
        <?=lang('tac_248')?>
<!--        ASSURANCES AND GUARANTEES-->
    </h4>
    <ol>
        <!--20.1.-->
        <li>
            <p class="license-text">
                <?=lang('tac_249')?>
<!--                The Customer guarantees the validity and authenticity of any documentation sent to the Company during the account opening process and during the life of the trading account.-->
            </p>
        </li>
        <!--20.2.-->
        <li>
            <p class="license-text">
                <?=lang('tac_250')?>
<!--                The Customer assures and guarantees; that the Funds belong to the Customer and are free of any pledge, charge, lien or other encumbrance; that the Funds are not the direct or indirect proceeds of any illegal act or omission or product of any criminal activity; and that the Customer acts for himself/ herself and is not a representative or trustee of a third person unless satisfactory documentation to the contrary is provided.-->

            </p>
        </li>
    </ol>

</li>

<!--21.-->
<li class="primaryunits">

    <h4 class="rootnumberheadings">
        <?=lang('tac_251')?>
<!--        AMENDMENT AND TERMINATION OF THE SERVICE AGREEMENT-->
    </h4>
    <ol>
        <!--21.1.-->
        <li>
            <p class="license-text">
                <?=lang('tac_252')?>
<!--                The Company has the right to amend the terms of the Service Agreement and shall notify the Customer accordingly.  Such amendments will become effective on the specified date and will apply to any positions opened and any orders placed prior to such date.-->

            </p>
        </li>
        <!--21.2.-->
        <li>
            <p class="license-text">
                <?=lang('tac_253')?>
<!--                The Customer and the Company may terminate this Agreement with immediate effect by giving written notice to the respective counter party.-->
            </p>
        </li>
        <!--21.3.-->
        <li>
            <p class="license-text">
                <?=lang('tac_254')?>
<!--                The Customer will be liable to pay any amount that is due to the Company, any expenses that are incurred by the Company as a result of the termination of the Service Agreement and any damage that has arisen because of an arrangement or settlement.-->

            </p>
        </li>
        <!--21.4.-->
        <li>
            <p class="license-text">
                <?=lang('tac_255')?>
<!--                Any such termination will not affect any obligation already incurred by either the Company or the Customer in respect to the Service Agreement, any Open position or any Transactions and deposit/ withdrawal operations made there under.-->
            </p>
        </li>
        <!--21.5.-->
        <li>
            <p class="license-text">
                <?=lang('tac_256')?>
<!--                The Company will immediately transfer to the Customer any amount available in his/ her trading account less any outstanding amount that is due to the Company by the Customer.-->
            </p>
        </li>
    </ol>
</li>

<!--22.-->
<li class="primaryunits">
    <h4 class="rootnumberheadings">
        <?=lang('tac_257')?>
<!--        CONFIDENTIALITY AND PERSONAL DATA-->
    </h4>

    <ol>
        <!--22.1.-->
        <li>
            <p class="license-text">
                <?=lang('tac_258')?>
<!--                Any personal Customer data is kept by the Company in accordance with the Processing of Personal Data (Protection of the Individual) Law of 2001, its amendment (Law No. 37(I)/2003) and the Regulation of Electronic Communications.-->
            </p>
        </li>
        <!--22.2.-->
        <li>
            <p class="license-text">
                <?=lang('tac_259')?>
<!--                The Customer accepts and consents that the Company may disclose some or all of the Customerâ€™s data on an anonymous and aggregated basis for business development reasons.-->
            </p>
        </li>
        <!--22.3.-->
        <li>
            <p class="license-text">
                <?=lang('tac_260')?>
<!--                None of the Customerâ€™s confidential information will be disclosed to a third party unless required to do so by the regulatory authority of a competent jurisdiction.-->

            </p>
        </li>

    </ol>
</li>
<!--23.-->
<li class="primaryunits">
    <h4 class="rootnumberheadings">
        <?=lang('tac_261')?>
<!--        RECORDING OF TELEPHONE CALLS-->
    </h4>

    <ol>
        <!--23.1.-->
        <li>
            <p class="license-text">
                <?=lang('tac_262')?>
<!--                Telephone communication between the Company and the Customer may be recorded.  All recordings are the property of the Company and may be used in instances including, but not limited to dispute, and shall be conclusive and binding evidence.-->
            </p>
        </li>
        <!--23.2.-->
        <li>
            <p class="license-text">
                <?=lang('tac_263')?>
<!--                The Company may provide copies of such recordings of telephone calls to the regulatory authority of a competent authority without informing the Customer.-->
            </p>
        </li>
        <!--23.3.-->
        <li>
            <p class="license-text">
                <?=lang('tac_264')?>
<!--                Instructions or requests received over the phone will be equally binding as written instructions.-->
            </p>
        </li>

    </ol>
</li>
<!--24.-->
<li class="primaryunits">
    <h4 class="rootnumberheadings">
        <?=lang('tac_265')?>
<!--        CONSENT TO DIRECT CONTACT-->
    </h4>
    <ol>
        <!--24.1.-->
        <li>
            <p class="license-text">
                <?=lang('tac_266')?>
<!--                The Customer consents that any communication whether by telephone, facsimile or otherwise, received by the Company in relation to the Service Agreement or marketing does not breach any of the Customerâ€™s rights under the Service Agreement.-->


            </p>
        </li>
    </ol>
</li>
<!--25.-->
<li class="primaryunits">
    <h4 class="rootnumberheadings">
        <?=lang('tac_267')?>
<!--        MARKET MAKING-->
    </h4>

    <ol>
        <!--25.1.-->
        <li>
            <p class="license-text">
                <?=lang('tac_268')?>
<!--                You are specifically made aware that in certain markets, including the foreign exchange markets, OTC foreign exchange options and CFD Contracts, we may act as a â€˜Market Makerâ€™, i.e., we may take the risk of holding a certain number of Supported Financial Instruments in order to facilitate trading in these Financial Instruments by displaying/quoting â€˜bidâ€™ and â€˜askâ€™ prices (â€˜buyâ€™ and â€˜sellâ€™ quotations) for such Supported Financial Instruments on our Online Trading Facility and filling Orders received in respect to such Supported Financial Instruments from our own inventory or seeking an Offsetting Order.-->
            </p>
        </li>
        <!--25.2.-->
        <li>
            <p class="license-text">
                <?=lang('tac_269')?>
<!--                In order for us to provide Price Quotes with the swiftness normally associated with speculative trading, we may have to rely on available price or available information that may later prove to be faulty due to specific market circumstances, for instance, but not limited to, lack of liquidity in, or suspension of an Underlying Instrument or asset or errors in feeds from information providers or in Price Quotes from our counterparties. In these circumstances, provided that we have acted in good faith when providing the relevant Price Quote to you, we may cancel the relevant Transaction and/or Contract with you, but shall do so within reasonable time and shall provide you with a full explanation for the reason of such cancellation.-->

            </p>
        </li>
        <!--25.3.-->
        <li>
            <p class="license-text">
                <?=lang('tac_270')?>
<!--                Following execution of any position with you, we may, at our reasonable discretion, subsequently offset each such position with you with another client position or with a position with one of our counterparties, or we may decide to retain a proprietary position in the Market with the intention to obtain trading profits from such positions. Such decisions and actions may therefore result in us offsetting client positions at prices different â€“ sometimes significantly different â€“ from the Price Quotes provided to you, resulting in trading profits or losses for us. This in turn can raise the possibility of you incurring, what may be seen as, an implied cost (i.e., the difference between the price at which you traded with us and the price at which we subsequently traded with our counterparties and/or other clients), due to any profits realised by us as a result of the Market Making function. Please also note, however, that the Market Making function may involve significant costs to us, if the market moves against us in comparison to the price at which we traded with you.-->
            </p>
        </li>
        <!--25.4.-->
        <li>
            <p class="license-text">
                <?=lang('tac_271')?>
<!--                You accept that, in such Markets where we act as Market Maker, we may hold positions that are contrary to your positions and/or the positions of certain other of our clients, resulting in potential conflicts of interest between us, and any such other of our clients.-->
            </p>
        </li>
        <!--25.5.-->
        <li>
            <p class="license-text">
                <?=lang('tac_272')?>
<!--                In Markets, where we act as a Market Maker, you accept that we have no obligation to quote prices to you and/or any of our other clients, at any time in any given Market,nor shall we have an obligation to provide such Price Quotes to you and/or any of our other clients with a specific maximum spread.-->
            </p>
        </li>


        <!--25.6.-->
        <li>
            <p class="license-text">
                <?=lang('tac_273')?>
<!--                You acknowledges, recognize and accept that the Price Quotes provided to you include a â€˜spreadâ€™ when compared with the price for which we may have covered or expected to be able to â€˜coverâ€™ the Transaction or Contract in a trade with another client or a counterparty; furthermore, you acknowledges, recognize and accept that said â€˜spreadâ€™ constitutes remuneration to us and that such â€˜spreadâ€™ cannot necessarily be calculated individually for all Transactions and/or Contracts and that such â€˜spreadâ€™ will not be specified at the Settlement/Trade Confirmation or otherwise revealed to you-->
            </p>
        </li>
        <!--25.7.-->
        <li>
            <p class="license-text">
                <?=lang('tac_274')?>
<!--                Any commission costs, interest charges, costs associated to and included in the â€˜spreadsâ€™ that are part of the Price Quotes provided by us as a Market Maker in certain Markets, and any other fees and charges will consequently influence you trading result(s) and may have a negative effect on your trading performance compared to a situation in which such commission costs, interest charges, costs associated to and included in theâ€™ spreadsâ€™, would not apply.-->
            </p>
        </li>
        <!--25.8.-->
        <li>
            <p class="license-text">
                <?=lang('tac_275')?>
<!--                Whilst dealing â€˜spreadsâ€™ and commissions are normally considered moderate seen in relation to the value of the Financial Instruments traded, such costs may be considerable when compared with your Margin deposit. As a consequence thereof, your Margin deposit may be depleted by the trading losses, which you may incur and by the directly visible dealing costs such as commissions, interest charges and brokerage fees, as well as by the afore-mentioned invisible costs for you that are caused by our performance as a Market Maker.-->

            </p>
        </li>
        <!--25.9.-->
        <li>
            <p class="license-text">
                <?=lang('tac_276')?>
<!--                If you are an active trader and you are undertaking numerous Transactions and/or Contracts, the total impact of visible as well as invisible costs may be significant. Consequently, you may have to obtain significant profits in order to cover the costs associated with the trading activities you undertake with us as a Market Maker. For very active clients, such costs may over time exceed the value of the Margin deposited with us. Normally, when trading Margined derivatives, the lower the percentage of the applicable Margin rate, the higher the proportion of the costs associated with executing a Transaction and/or Contract.-->

            </p>
        </li>
        <!--25.10.-->
        <li>
            <p class="license-text">
                <?=lang('tac_277')?>
<!--                You are hereby specifically made aware that in the area of Market Making in foreign exchange, CFD Contracts and other OTC products, significant implied costs can arise as a consequence of the profits made by us performing in our capacity as a Market Maker; thus, our performance as a Market Maker may negatively affect your Account with us and the said associated costs may neither directly visible nor directly quantifiable for you at any time.-->

            </p>
        </li>


        <!--25.11.-->
        <li>
            <p class="license-text">
                <?=lang('tac_278')?>
<!--                Please not that we are at no time and under no circumstances obliged to disclose any details of our performance or our income produced as a Market Maker, or otherwise related to other commissions, charges and fees.-->
            </p>
        </li>
        <!--25.12.-->
        <li>
            <p class="license-text">
                <?=lang('tac_279')?>
<!--                You are hereby specifically made aware that CFDs may be OTC products quoted by us whilst operating as a Market Maker, and are not traded on a recognized stock exchange. As a result, the description above of the implied, not visible costs related to our performance as a Market Maker, may also apply to any CFD Contract.-->
            </p>
        </li>
    </ol>
</li>
<!--26.-->
<li class="primaryunits">
    <h4 class="rootnumberheadings">
        <?=lang('tac_280')?>
<!--        CONFLICT OF INTEREST-->
    </h4>
    <ol>
        <!--26.1.-->
        <li>
            <p class="license-text">
                <?=lang('tac_281')?>
<!--                The Company is required by Law to take all reasonable steps to detect and avoid conflicts of interest.  The Company is committed to act honestly, fairly and in the best interests of its Customers.  The document â€˜Conflicts of Interest Policyâ€™ provides a summary of the policy.-->
            </p>
        </li>
        <!--26.2.-->
        <li>
            <p class="license-text">
                <?=lang('tac_282')?>
<!--                The Customer accepts that a conflict of interest may arise when the interest of the Company competes or interferes with the Customerâ€™s interests under the Service Agreement.  By way of example, the Customer accepts that:-->
            </p>
            <p class="license-text">
                <?=lang('tac_283')?>
<!--                a. The Company may establish business or trading relationships with other issuers of financial instruments and the Company may have a financial interest in such instruments.-->
            </p>
            <p class="license-text">
                <?=lang('tac_284')?>
<!--                b. The Company may execute at the same time instructions by different Customers that are opposite to one another;-->
            </p>
            <p class="license-text">
                <?=lang('tac_285')?>
<!--                c. The Company may pay commission or other related fee, to a third party for introducing the Customer or the Customerâ€™s trading activity;-->

            </p>
        </li>
        <!--26.3.-->
        <li>
            <p class="license-text">
                <?=lang('tac_286')?>
<!--                Full details of our Conflicts of Interest Policy are available on our Online Trading Facility. Our Conflicts of Interest Policy is a policy only, it is NOT part of these-->
                <a href="<?= FXPP::loc_url('Terms-and-conditions')?>">
                    <?=lang('tac_287')?>
<!--                    Terms and Conditions-->
                </a>
                <?=lang('tac_288')?>
<!--                and is not intended to be contractually binding or impose or seek to impose any obligations on us which we would not otherwise have, but for the Cyprus Investment Services and Activities and Regulated Markets Law of 2007 (Law 144(I)/2007).-->

            </p>
        </li>
        <!--26.4.-->
        <li>
            <p class="license-text">
                <?=lang('tac_289')?>
<!--                By accepting these-->
                <a href="<?= FXPP::loc_url('Terms-and-conditions')?>">
                    <?=lang('tac_290')?>
<!--                Terms and Conditions-->
                </a>
                <?=lang('tac_291')?>
<!--                you expressly acknowledge and agree that we may transact such business without prior reference to any potential specific Conflict of Interest.-->

            </p>
        </li>
    </ol>
</li>
<!--27.-->
<li class="primaryunits">
    <h4 class="rootnumberheadings">
        <?=lang('tac_292')?>
<!--        GOVERNING LAW AND JURISDICTION-->
    </h4>

    <ol>
        <!--27.1-->
        <li>
            <p class="license-text">
                <?=lang('tac_293')?>
<!--                The Service Agreement is governed by the laws of the Republic of Cyprus.-->
            </p>
        </li>
        <!--27.2-->
        <li>
            <p class="license-text">
                <?=lang('tac_294')?>
<!--                The Customer agrees not to claim that such proceedings have been brought in an inconvenient forum or that such court does not have jurisdiction over the Customer.-->

            </p>
        </li>
        <!--27.3-->
        <li>
            <p class="license-text">
                <?=lang('tac_295')?>
<!--                Notwithstanding any other provision in this Agreement, in providing Services to the Customer the Company shall be entitled to take any action it considers necessary, in its absolute discretion, to ensure compliance with the relevant market rules and or practices and all other applicable laws.-->

            </p>
        </li>
        <!--27.4-->
        <li>
            <p class="license-text">
                <?=lang('tac_296')?>
<!--                All transactions on behalf of the Customer shall be subject to the applicable regulations and any other public authorities which govern the operation of the Cyprus Investment Firms, as they are amended or modified from time to time. The Company shall be entitled to take (or omit to take) any measures which it considers desirable in view of compliance with the Applicable Regulations in force at the time. Any such measures that may be taken and the Applicable Regulations in force shall be binding on the Customer.-->

            </p>
        </li>
        <!--27.5-->
        <li>
            <p class="license-text">
                <?=lang('tac_297')?>
<!--                Any proceedings and their settlement involving the Customer and the Company will take place in the competent courts of the Republic of Cyprus.-->
            </p>
        </li>
    </ol>
</li>
<!--28.-->
<li class="primaryunits">
    <h4 class="rootnumberheadings">
        <?=lang('tac_298')?>
<!--        REPRESENTATIONS AND WARRANTIES-->
    </h4>
    <ol>
        <!--28.1.-->
        <li>
            <p class="license-text">
                <?=lang('tac_299')?>
<!--                The Customer accepts that the Company will take all reasonable steps to ensure compliance with applicable rules and regulations which will be binding upon the Customer.-->

            </p>
        </li>
        <!--28.2.-->
        <li>
            <p class="license-text">
                <?=lang('tac_300')?>
<!--                The Customer declares that he/ she is over eighteen (18) years of age in the case of a person, or has full capacity in the case of a legal person.-->
            </p>
        </li>
        <!--28.3.-->
        <li>
            <p class="license-text">
                <?=lang('tac_301')?>
<!--                The Customer declares that he/ she has read and fully understood the terms of the Service Agreement including the Risk Acknowledgement and Disclosure document.-->

            </p>
        </li>
        <!--28.4.-->
        <li>
            <p class="license-text">
                <?=lang('tac_302')?>
<!--                The Customer accepts that the Company maintains the right to revoke at any time, without prior written notice, any Power of Attorney documents governing his/ her relationship with his/ her authorised representative.-->
            </p>
        </li>
        <!--28.5.-->
        <li>
            <p class="license-text">
                <?=lang('tac_303')?>
<!--                The Customer declares that all information provided by the Customer to the Company is accurate, true and complete in all material matters.-->
            </p>
        </li>
        <!--28.6.-->
        <li>
            <p class="license-text">
                <?=lang('tac_304')?>
<!--                The Customer declares that he/ she is fully aware of any restrictions and implications applicable to his/ her local jurisdiction in relation to entering the Service Agreement.-->
            </p>
        </li>
        <!--28.7.-->
        <li>
            <p class="license-text">
                <?=lang('tac_305')?>
<!--                The Customer agrees that if an amount is due for payment to the Company, the Company will be entitled to debit the Customerâ€™s account accordingly.-->

            </p>
        </li>
        <!--28.8.-->
        <li>
            <p class="license-text">
                <?=lang('tac_306')?>
<!--                The Customer accepts that the Company may provide him/ her with information about amendments to the terms and conditions, fees, costs, the Service Agreement, Policies and information about the nature and risks of investments; to be posted on the Companyâ€™s website. Such information will be binding on the Customer, without prior written notice and consent.-->

            </p>
        </li>
    </ol>
</li>
<!--29.-->
<li class="primaryunits">
    <h4 class="rootnumberheadings">
        <?=lang('tac_307')?>
<!--        FORCE MAJEURE-->
    </h4>

    <ol>
        <!--29.1.-->
        <li>
            <p class="license-text">
                <?=lang('tac_308')?>
<!--                A Force Majeure event includes without limitation any natural, political, governmental, economic, social, technological acts that may be outside the control of the Company, which prevent the Company from maintaining an orderly operation of business.-->
            </p>
        </li>
        <!--29.2.-->
        <li>
            <p class="license-text">
                <?=lang('tac_309')?>
<!--                The Company may, in its reasonable opinion, determine that a force majeure event occurred, in which case the Company will take all reasonable steps to inform the Customer.-->
            </p>
            <p class="license-text">
                <?=lang('tac_310')?>
<!--                A Force Majeure Event includes without limitation one or more of the following:-->
            </p>
            <p class="license-text">
                &#8226; <?=lang('tac_311')?>
<!--                Government actions, the outbreak of war or hostilities, the threat of war, acts of terrorism, national emergency, riot, civil disturbance, sabotage, requisition, or any other international calamity, economic or political crisis;-->
            </p>
            <p class="license-text">
                &#8226;  <?=lang('tac_312')?>
<!--                Act of God, earthquake, tsunami, hurricane, typhoon, accident, storm, flood, fire, epidemic or other natural disaster;-->

            </p>
            <p class="license-text">
                &#8226; <?=lang('tac_313')?>
<!--                Labour disputes, strikes and lock-outs;-->
            </p>
            <p class="license-text">
                &#8226; <?=lang('tac_314')?>
<!--                Suspension of trading on a Market, or the fixing of minimum or maximum prices for trading on a Market, a regulatory ban on the activities of any party (unless the Company has caused that ban), decisions of state authorities, governing bodies of self-regulating organisations, decisions of governing bodies of organised trading platforms;-->
            </p>
            <p class="license-text">
                &#8226; <?=lang('tac_315')?>
<!--                A financial services moratorium having been declared by the appropriate regulatory authorities or any other acts or regulations of any regulatory, governmental, or supranational body or authority;-->
            </p>
            <p class="license-text">
                &#8226; <?=lang('tac_316')?>
<!--                Breakdown, failure or malfunction of any electronic, network and communication lines (not due to the bad faith or willful default of the company);-->
            </p>

            <p class="license-text">
                &#8226; <?=lang('tac_317')?>
<!--                Any event, act or circumstance not reasonably within the Companyâ€™s control and the effect of that event(s) is such that the Company is not in a position to take any reasonable action to cure the default;-->

            </p>
            <p class="license-text">
                &#8226; <?=lang('tac_318')?>
<!--                The suspension, liquidation or closure of any market or the abandonment or failure of any event to which the Company relates its Quotes, or the imposition of limits or special or unusual terms on the trading in any such market or on any such event.-->
            </p>
        </li>
        <!--29.3.-->
        <li>
            <p class="license-text">
                <?=lang('tac_319')?>
<!--                If the Company determines that a force majeure event exists, without prejudice to any other rights of the Customer under the Service Agreement, the Company without prior written notice may:-->
            </p>
            <p class="license-text">
                <?=lang('tac_320')?>
<!--                a. Increase margin requirements;-->
            </p>
            <p class="license-text">
                <?=lang('tac_321')?>
<!--                b. Decrease leverages;-->
            </p>
            <p class="license-text">
                <?=lang('tac_322')?>
<!--                c. Request amendments to any closed positions;-->

            </p>
            <p class="license-text">
                <?=lang('tac_323')?>
<!--                d. Increase spreads;-->
            </p>
            <p class="license-text">
                <?=lang('tac_324')?>
<!--                e. Close out any open positions at such prices that the Company considers in good faith and appropriate;-->
            </p>
            <p class="license-text">
                <?=lang('tac_325')?>
<!--                f. Suspend or modify or freeze the provision of investment and/ or ancillary services to the Customer;-->
            </p>
            <p class="license-text">
                <?=lang('tac_326')?>
<!--                g. Amend any or all of the content of the Service Agreement on the basis that it is impossible or impractical for the Company to comply with it.-->
            </p>

        </li>
        <!--29.4.-->
        <li>
            <p class="license-text">
                <?=lang('tac_327')?>
<!--                Under the provisions of this Agreement, the Company will not be liable or have any responsibility for any type of loss or damage arising out of any failure, interruption, or delay in performing its obligations under this Agreement where such failure, interruption or delay is due to a Force Majeure event.-->
            </p>
        </li>
    </ol>



</li>
<!--30.-->
<li class="primaryunits">
    <h4 class="rootnumberheadings">
        <?=lang('tac_328')?>

<!--        DEFAULT-->
    </h4>
    <ol>
        <!--30.1.-->
        <li>
            <p class="license-text">
                <?=lang('tac_329')?>
<!--                When an Event of Default occurs the Company may, without prior written Notice, take measures such as:-->
            </p>
            <p class="license-text">
                <?=lang('tac_330')?>
<!--                a. Close any or all of the Customerâ€™s Trading Accounts;-->
            </p>
            <p class="license-text">
                <?=lang('tac_331')?>
<!--                b. Close out all or any of the Customerâ€™s Open Positions at current Quotes;-->

            </p>
            <p class="license-text">
                <?=lang('tac_332')?>
<!--                c. Refuse to open new trading Accounts for the Customer;-->
            </p>
            <p class="license-text">
                <?=lang('tac_333')?>
<!--                d. Debit the Customerâ€™s Trading Account(s) for any amounts due to the Company.-->
            </p>
        </li>
        <!--30.2.-->
        <li>
            <p class="license-text">
                <?=lang('tac_334')?>
<!--                An Event of Default occurs when the Customer:-->
            </p>
            <p class="license-text">
                <?=lang('tac_335')?>
<!--                a. Is in breach of the Service Agreement;-->
            </p>
            <p class="license-text">
                <?=lang('tac_336')?>
<!--                b. Is a person and becomes of unsound mind or dies;-->
            </p>
            <p class="license-text">
                <?=lang('tac_337')?>
<!--                c. Is a legal person and proceedings have been initiated for the Customerâ€™s bankruptcy or for the winding-up or for the appointment of an administrator or receiver or any similar action.-->
            </p>
        </li>
    </ol>
</li>

<!--31.-->
<li class="primaryunits">
    <h4 class="rootnumberheadings">
        <?=lang('tac_338')?>
<!--        ELECTRONIC TRADING-->
    </h4>
    <ol>
        <!--31.1.-->
        <li>
            <p class="license-text">
                <?=lang('tac_339')?>
<!--                Upon commencement of the Service Agreement, the Customer shall download and install the Companyâ€™s trading platform software, which is available on the website of the Company, and receive the access codes which will enable the Customer to log in and enter into transactions with the Company-->

            </p>
        </li>
        <!--31.2.-->
        <li>
            <p class="license-text">
                <?=lang('tac_340')?>
<!--                The Customer is responsible for any instructions/transactions received/entered through the trading platform, either from the Customer directly or through an authorized representative.-->

            </p>
        </li>

        <!--31.3.-->
        <li>
            <p class="license-text">
                <?=lang('tac_341')?>
<!--                The Customer acknowledges that the Company has the right to restrict, modify or even terminate the access of the Customer to the trading platform if the Company deems it necessary. This measure is in force to ensure the unobstructed functioning of the electronic systems for trading and the protection of both the customersâ€™ and the Companyâ€™s interests.-->
            </p>
        </li>
        <!--31.4.-->
        <li>
            <p class="license-text">
                <?=lang('tac_342')?>
<!--                The Customerâ€™s access codes, transaction activities and all other related information must remain confidential at all times and the Company does not bear any responsibility for any financial loss that might arise should the Customer disclose his/her access codes to an unauthorised third party.-->
            </p>
        </li>


        <!--31.5.-->
        <li>
            <p class="license-text">
                <?=lang('tac_343')?>
<!--                The Customer shall inform the Company immediately if his/her access codes have been used by another party without his/her consent.-->
            </p>
        </li>
        <!--31.6.-->
        <li>
            <p class="license-text">
                <?=lang('tac_344')?>
<!--                In cases where there is a disruption in electronic trading and the Customer is not able to access the trading platform to enter into any type of transaction, he/she must contact the Company either though telephone or email and place a verbal/written instruction. The Customer understands that if the instructions are not clear or his/her identity cannot be verified, the Company reserves the right to decline the verbal/written instruction at hand. In addition, the Customer must acknowledge that in circumstances of large transaction flows (important market news announcements) there might be some delay.-->
            </p>
        </li>

        <!--31.7.-->
        <li>
            <p class="license-text">
                <?=lang('tac_345')?>
<!--                The Company shall be responsible to maintain and update its electronic systems at all times and therefore the Customer must accept the need for periodic maintenance to ensure the effective operation of the trading platform and that the Company does not bear any responsibility for any loss incurred these during periods of maintenance.-->

            </p>
        </li>
        <!--31.8.-->
        <li>
            <p class="license-text">
                <?=lang('tac_346_0')?>
<!--                The Company shall not be accountable for any loss or damages that might be incurred to equipment or software due to viruses, malfunctions or defects of its electronic systems.-->
            </p>
        </li>
        <!--31.9.-->
        <li>
            <p class="license-text">
                <?=lang('tac_346')?>
<!--                Confirmations: You acknowledge the electronic nature of our Services via our Online Trading Facility and the inherent risk that communications by electronic means may not reach their intended destination or may do so much later than intended for reasons outside our control. Accordingly, any Instruction sent by you or on your behalf via our Online Trading Facility or by e-mail shall only be deemed to have been received and shall only then constitute a valid Instruction and/or binding Contract between you and us, when such Instruction has been recorded as executed by us and confirmed by us to you through a Settlement/Trade Confirmation, and the mere transmission of an Instruction by you or on your behalf shall not by itself constitute a binding Contract between you and us.-->
            </p>
        </li>
        <!--31.10.-->
        <li>
            <p class="license-text">
                <?=lang('tac_347')?>
<!--        Internet: Since we do not control signal power, its reception or routing via Internet or any other means of electronic communication, configuration of our clientsâ€™ equipment or reliability of its connection, we shall not be liable for any claims, losses, damages, costs or expenses, including attorneysâ€™ fees, caused directly or indirectly, by any breakdown or failure of any transmission or communication system or computer facility belonging to us, nor for any loss, expense, cost or liability suffered or incurred by you as result of Instructions being given, or any other communications being made, via the Internet. You will be solely responsible for all Orders, and for the accuracy of all information, sent via the Internet using your Access Codes. We will not execute an Order until we have confirmed the Order to you and transmission of an Order by itself shall not give rise to a binding Transaction and/or Contract between you and us.-->
            </p>
        </li>
        <!--31.11.-->
        <li>
            <p class="license-text">
                <?=lang('tac_348')?>
<!--                Mobile: There are a series of inherent risks with the use of the mobile trading technology such as the duplication of Orders/Instructions, latency in the prices provided, and other issues that are a result of mobile connectivity. Prices displayed on our mobile platform are solely an indication of the executable rates and may NOT reflect the actual executed price of the Order. Our mobile feature utilizes public communication network circuits for the transmission of messages. We shall not be liable for any and all circumstances in which you experience a delay in Price Quote or an inability to trade caused by network circuit transmission problems or any other problems outside our direct control, which include but are not limited to the strength of the mobile signal, cellular latency, or any other issues that may arise between you and any internet service provider, phone service provider, or any other service provider. Please also note that some of the features available on Online Trading Facility may not be available on our mobile feature.-->
            </p>
        </li>
        <!--31.12.-->
        <li>
            <p class="license-text">
                <?=lang('tac_349')?>
<!--                prejudice to any other provisions of this Agreement, you will be liable for all Transactions and/or Contracts executed by means of your Access Codes, even if such may be wrongful. prejudice to any other provisions of this Agreement, you will be liable for all Transactions and/or Contracts executed by means of your Access Codes, even if such may be wrongful.-->
            </p>
        </li>
        <!--31.13.-->
        <li>
            <p class="license-text">
                <?=lang('tac_350')?>
<!--                Pricing Data: Unless otherwise indicated or agreed upon any prices shown on our Online Trading Facility are indicative at the time shown based on data that is subject to constant change. The execution price is that which is confirmed to you on the Settlement/Trade Confirmation issued (whether on screen or otherwise) after your Order is executed, although this price may in certain cases differ from the price appearing on the screen at the time the Order was placed. In the event that an erroneous price is used as the basis of any transaction, we reserve the right, at our sole discretion, to amend or revoke the details of the Transaction(s) and/or Contract(s) in question.-->
            </p>
        </li>
        <!--31.14.-->
        <li>
            <p class="license-text">
                <?=lang('tac_351')?>
<!--                Restrictions: There may be restrictions on the total value and/or number of Transactions and/or Contracts that you can enter into on any one day and also in terms of the total value and/or number of those Transactions and/or Contracts when using our Online Trading Facility.-->
            </p>
        </li>
        <!--31.15.-->
        <li>
            <p class="license-text">
                <?=lang('tac_352')?>
<!--                Limit Orders: The â€˜Limit Orderâ€™ functionality of our Online Trading Facility will be subject to the Internet service remaining available over the period in which theâ€™ Limit Orderâ€™ is outstanding, and will be subject to size limits input by our dealer(s) remaining in excess of your Order size and such dealerâ€™s position limits and/or any other limits determined by us to be applicable to you (whether or not disclosed to you) and your still being able to facilitate the Order at the time the limit price is reached.-->
            </p>
        </li>
        <!--31.16.-->
        <li>
            <p class="license-text">
                <?=lang('tac_353')?>
<!--                Access: You will be responsible for providing the computer system(s) to enable you to access and/or use our Online Trading Facility and for making all appropriate arrangements with any telecommunications suppliers or, where access to our Online Trading Facility is provided through a third party server, any such third party, necessary in order to obtain access to our Online Trading Facility; neither we nor any company maintaining, operating, owning, licensing, or providing services to us in connection with, our Online Trading Facility makes any representation or warranty as to the availability, utility, suitability or otherwise of any such equipment, software or arrangements.-->
            </p>
        </li>
        <!--31.17.-->
        <li>
            <p class="license-text">
                <?=lang('tac_354')?>
<!--                Viruses: You will be responsible for the installation and proper use of any virus detection/scanning program we require from time to time and for the implementation and regular use of up-to-date virus detection/scanning programs; in the event you become aware of a material defect, malfunction or virus in your computer system(s) or in our Online Trading Facility, you will immediately notify us of such defect, malfunction or virus and cease all use of our Online Trading Facility until you have received permission from us to resume.-->
            </p>
        </li>
        <!--31.18.-->
        <li>
            <p class="license-text">
                <?=lang('tac_355')?>
<!--                Information, Data and Software: In the event that you receive any data, information or Software via our Online Trading Facility, other than that which you are entitled to receive pursuant to this Agreement, you will immediately notify us in writing and will not use, in any way whatsoever, such data, information or Software.-->
            </p>
        </li>
        <!--31.19.-->
        <li>
            <p class="license-text">
                <?=lang('tac_356')?>
<!--                Performance standards: When using our Online Trading Facility you must: (a) ensure that your computer systems are maintained in good order and are suitable for use with our Online Trading Facility; (b) run such tests and provide such information to us as we shall reasonably consider necessary to establish that your computer systems satisfy the requirements notified by us to you from time to time; (c) carry out virus checks on a regular basis; (d) inform us immediately of any unauthorised access to our Online Trading Facility or any unauthorised Transaction or Instruction which you know of or suspect and, if within your control, cause such unauthorised use to cease; and (e) not at any time leave the computer terminal from which you have accessed our Online Trading Facility or let anyone else use such computer terminal until you have logged off from our Online Trading Facility.-->
            </p>
        </li>
        <!--31.20.-->
        <li>
            <p class="license-text">
                <?=lang('tac_357')?>
<!--                Defects: In the event you become aware of a material defect, malfunction or virus in your computer system(s) or our Online Trading Facility, you will immediately notify us in writing of such defect, malfunction or virus and cease all use of our Online Trading Facility until you have received permission from us to resume use.-->
            </p>
        </li>
    </ol>
</li>
<!--32.-->
<li class="primaryunits">
    <h4 class="rootnumberheadings">
        <?=lang('tac_358')?>
<!--        CUSTOMER INSTRUCTIONS AND ORDERS-->
    </h4>

    <ol>
        <!--32.1.-->
        <li>
            <p class="license-text">
                <?=lang('tac_359')?>
<!--                The Customer shall provide instructions to the Company through the trading platform or other electronic means determined in the Customer Agreement. Also, the Customer accepts that the Company has the right to partially carry out his/her instructions.-->
            </p>
        </li>
        <!--32.2.-->
        <li>
            <p class="license-text">
                <?=lang('tac_360')?>
<!--                The Customer acknowledges that the Company enters into transactions with the Customer as the principal counterparty and not as an agent despite the fact that the Company may transmit orders to liquidity providers/brokers for execution.-->
            </p>
        </li>
        <!--32.3.-->
        <li>
            <p class="license-text">
                <?=lang('tac_361')?>
<!--                The Customer shall be able to take new positions or close existing positions through the trading platform of the Company and place orders on any type of financial instrument.-->
            </p>
        </li>
        <!--32.4.-->
        <li>
            <p class="license-text">
                <?=lang('tac_362')?>
<!--                The Customer shall be able to instruct the Company about either an instantly executed order and/or a pending order. A pending order instruction may be one the following (for further information regarding the execution of the below mentioned orders, please read the â€œOrder Execution and Best Interest Policyâ€�):-->
            </p>
            <p class="license-text">

                &#8226; <?=lang('tac_363')?>
<!--                Buy Limit: Shall be an order to buy any type of financial instrument at a specified price which is lower than the current market price.-->
            </p>
            <p class="license-text">

                &#8226; <?=lang('tac_364')?>
<!--                Sell Limit: Shall be an order to sell any type of financial instrument at a specified price which is higher than the current market price.-->
            </p>
            <p class="license-text">

                &#8226; <?=lang('tac_365')?>
<!--                Buy Stop: Shall be an order to buy any type of financial instrument where the price of the order is set above the current market price.-->
            </p>
            <p class="license-text">

                &#8226; <?=lang('tac_366')?>
<!--                Sell Stop: Shall be an order to sell any type of financial instrument where the price of the order is set lower than the current market price-->

            </p>
        </li>
        <!--32.5.-->
        <li>
            <p class="license-text">
                <?=lang('tac_367')?>
<!--                The Customerâ€™s orders are executed at the Bid and Ask prices of the available current market prices that the Company offers through its liquidity providers. For instant execution orders the Customer places his order based on the current prices displayed in his/her terminal and the execution process is triggered. The Customer acknowledges and accepts that the requested price of a market request may change due to high volatility of the market or low connectivity between the Company server and the Customer terminal. Moreover, in the case of any communication and/or technical error that affects the quoted prices, the Company reserves the right not to execute an order.-->
            </p>
        </li>

        <!--32.6.-->
        <li>
            <p class="license-text">
                <?=lang('tac_368')?>
<!--                The Customer acknowledges that the Company will keep records of all telephone transactions, without any prior written consent, in order to ensure that all relevant information being transmitted via telephone is properly recorded. The records kept are the Companyâ€™s property and may be used by the Company where appropriate, as evidence of the Customerâ€™s transaction.-->
            </p>
        </li>
        <!--32.7.-->
        <li>
            <p class="license-text">
                <?=lang('tac_369')?>
<!--                In the event of a corporate action, the Customer accepts that the Company has the right to alter the value and/or size of a transaction. Such an alteration would be made to maintain the economic equivalent of the rights and obligations of the parties to that transaction prior to the corporate action. The alterations are conclusive and binding and the Customer will be properly and promptly informed by the Company.-->
            </p>
        </li>
        <!--32.8.-->
        <li>
            <p class="license-text">
                <?=lang('tac_370')?>
<!--                The Company reserves the right of partial execution of orders in cases where the volume of the Customerâ€™s order and/or the market conditions, dictate such action. In the case where the underlying asset of a financial instrument is subject to a specific risk resulting in a financial loss, the Company has the right to restrict short selling or even remove the aforementioned financial instrument from the trading platform.-->
            </p>
        </li>
        <!--32.9.-->
        <li>
            <p class="license-text">
                <?=lang('tac_371')?>
<!--                The Company has the right to change the spreads of financial instruments depending on market conditions and the size of the Customerâ€™s order. In addition, the Company has the right to alter the level of the swap rate applied to each type of financial instrument at any given time and the Customer understands that in such cases he/she will be informed through the Companyâ€™s website.-->
            </p>
        </li>
        <!--32.10.-->
        <li>
            <p class="license-text">
                <?=lang('tac_372')?>
<!--                The size of orders placed is measured in lots. The minimum volume size for any type of financial instrument is 0.10 lot for premium accounts and 0.01 for standard accounts (with the exception of CFDâ€™s on shares which is 10 lots). The Customer shall review the contract specifications on the Companyâ€™s website and be thereby informed with regards to the applicable swap rates.-->
            </p>
        </li>



        <!--32.11.-->
        <li>
            <p class="license-text">
                <?=lang('tac_373')?>
<!--                The Customer shall be able to set and adjust the level of leverage for his/her account in the â€œLeverage Levelâ€� section of the Customer Agreement. The Company reserves the right to adjust the leverage level of the Customer without the formerâ€™s consent and such event will be disclosed to the Customer via mail or email.-->
            </p>
        </li>
        <!--32.12.-->
        <li>
            <p class="license-text">
                <?=lang('tac_374')?>
<!--                The Company shall have the right to gradually close the Customerâ€™s positions starting from the most unprofitable ones, when the margin level of the Customerâ€™s account is less than the percentage of margin permitted by the Company from time to time.-->
            </p>
        </li>
        <!--32.13.-->
        <li>
            <p class="license-text">
                <?=lang('tac_375')?>
<!--                The Customer acknowledges that all orders executed by the Company on behalf of the Customer are executed outside a regulated market.-->
            </p>
        </li>

    </ol>
</li>
<!--33.-->
<li class="primaryunits">
    <h4 class="rootnumberheadings">
<!--        REFUSAL TO EXECUTE ORDERS-->
        <?=lang('tac_376')?>
    </h4>

    <ol>
        <!--33.1.-->
        <li>
            <p class="license-text">
                <?=lang('tac_377')?>
<!--                The Customer accepts that the Company reserves the right to refuse the provision of any investment and ancillary service, at any time, including but not limited to the execution of instructions for trading any type of financial instrument of the Company, without prior notice to the Customer. The circumstances under which the Company shall proceed to the above actions are as follows:-->
            </p>
            <p class="license-text">

                &#8226; <?=lang('tac_378')?>
<!--                If the Customer has insufficient funds in his/her account;-->
            </p>
            <p class="license-text">

                &#8226; <?=lang('tac_379')?>
<!--                If the order affects the orderly function of the market;-->
            </p>
            <p class="license-text">

                &#8226; <?=lang('tac_380')?>
<!--                If the order aims at manipulating the market of the underlying financial instrument;-->
            </p>
            <p class="license-text">

                &#8226; <?=lang('tac_381')?>
<!--                If the order constitutes the exploitation of confidential information;-->
            </p>
            <p class="license-text">

                &#8226; <?=lang('tac_382')?>
<!--                If the order affects the orderly operation of the trading platform; and-->
            </p>
            <p class="license-text">

                &#8226; <?=lang('tac_383')?>
<!--                If the order contributes to the legalisation of proceeds from illegal actions ( money laundering)-->
            </p>

        </li>
        <!--33.2.-->
        <li>
            <p class="license-text">
                <?=lang('tac_384')?>
<!--                The Customer understands that any act of refusal by the Company for the execution of any order will not affect any obligation of the Customer towards the Company under the Service Agreement.-->
            </p>
        </li>
    </ol>
</li>
<!--34.-->
<li class="primaryunits">
    <h4 class="rootnumberheadings">
        <?=lang('tac_385')?>
<!--        DORMANT ACCOUNT POLICY-->
    </h4>

    <ol>
        <!--34.1.-->
        <li>
            <p class="license-text">
                <?=lang('tac_386')?>
<!--                In the event that there are no transactions (trading/withdrawals/deposits) in the Customer Account for a set period of at least twelve (12) months-->
                <img class="tradomart" src="<?= $this->template->Images()?>tradomart.png" alt="" />
                <?=lang('tac_387')?>
<!--                will regard the account to be dormant. An account shall be deemed as dormant from the last day of the twelfth month in which there have been no transactions (trading/withdrawals/deposits) in the Account.-->
            </p>
        </li>
        <!--34.2.-->
        <li>
            <p class="license-text">
                <?=lang('tac_388')?>
<!--                Dormant Accounts will be charged an Annual Maintenance Fee of USD 20 (twenty United States Dollars) or the full amount of the free balance in the Account if the free .balance is less than USD 20 (twenty United States Dollars). There will be no charge if the free balance in the Account is zero.-->
            </p>
        </li>
        <!--34.3.-->
        <li>
            <p class="license-text">
                <?=lang('tac_389')?>
<!--                In the event that the Customer logs-on to the Account and performs transactions (trading/withdrawals/deposits) in the Customer Account in the period during which the Annual Maintenance Fee is being applied,-->

                <img class="tradomart" src="<?= $this->template->Images()?>tradomart.png" alt=""  />
                <?=lang('tac_390')?>
<!--                will cease to deduct the Annual Maintenance Fee, but shall not be obligated to refund any Annual Maintenance Fees deducted from the Account prior to such log-on.  Dormant Accounts with a zero free balance will be closed automatically.-->
            </p>
        </li>
    </ol>
</li>
<!--35.-->
<li class="primaryunits">
    <h4 class="rootnumberheadings">
        <?=lang('tac_391')?>
<!--        PROHIBITED TRADING TECHNIQUES-->
    </h4>

    <ol>
        <!--35.1.-->
        <li>
            <p class="license-text">
                <?=lang('tac_392')?>
<!--                You shall be solely responsible for providing and maintaining the means by which to access and use our Online Trading Facility, which may include, but shall not be limited to, a personal computer, modem and telephone or other access line. You shall be responsible for all access and service fees necessary to connect to our Online Trading Facility and you shall assume all charges incurred in accessing such systems. You further assume all risks associated with the use and storage of information on your personal computer(s) or on any other computer(s) through which you will gain access to, and/or make use of our Online Trading Facility.-->
            </p>
        </li>
        <!--35.2.-->
        <li>
            <p class="license-text">
                <?=lang('tac_393')?>
<!--                You represent and warrant that you have implemented and plan to operate and maintain appropriate protection in relation to the security and control of all access and use of your computer, infection or viruses, worms, Trojan horses or other code that manifest  contaminating or destructive properties and/or other similar harmful or inappropriate materials, devices, information or data.-->

            </p>
        </li>
        <!--35.3.-->
        <li>

            <p class="license-text">
                <?=lang('tac_394')?>
<!--                You agree that we shall not be liable, in any manner whatsoever, to you in the event of failure of or damage or destruction to your computer systems, data or records or any part thereof, or for delays, losses, errors or omissions resulting from the failure or mismanagement of any telecommunications or computer equipment or software.-->

            </p>
        </li>
        <!--35.4.-->
        <li>
            <p class="license-text">
                <?=lang('tac_395')?>
<!--                You will not transmit to, or in any way, whether directly or indirectly, expose us or any of our online service providers to any infection or viruses, worms, Trojan horses or other code that manifest contaminating or destructive properties and/or other similar harmful or inappropriate materials, devices, information or data.-->

            </p>
        </li>
        <!--35.5.-->
        <li>

            <p class="license-text">
                <?=lang('tac_396')?>
<!--                You agree to be fully and personally liable for the due settlement of every Transaction and/or Contract entered into through your Account with us. You are responsible for ensuring that, unless we otherwise agree beforehand and in writing, you, and only you, shall control access to your Account, and that no Minor or other person is granted access to trading on our Online Trading Facility using your Account. In any event, you, and only you, shall remain fully liable for any and all positions traded in your Account, and for any credit card transactions entered into for your Account. You agree to indemnify us fully in respect to all costs and losses whatsoever, as may be incurred by us and/or by you as a result, direct or indirect, of your failure to perform or settle such a transaction.-->
            </p>
        </li>
        <!--35.6.-->
        <li>
            <p class="license-text">
                <?=lang('tac_397')?>
<!--                You agree that if a trade has fallen into a gap that resulted in a change of equity of the account of greater than 10%, then Company has the right to adjust the result of the change to 10% from the account.-->
            </p>
        </li>
        <!--35.7.-->
        <li>
            <p class="license-text">
                <?=lang('tac_398')?>
<!--                You agree that in the case that any Transaction is entered into, and/or any Contract is acquired or sold at prices that do not reflect relevant Market Prices, or that is acquired or sold at an abnormally low level of risk ("mispricing") due to an undetected programming error, bug, defect, error or glitch in our Online Trading Facility and/or any related software, or for any other reason, resulting in mispricing (for the purpose of this section the "error"), we reserve the right to cancel such Transactions and/or Contracts upon notifying you of the nature of the computer error that led to the mispricing. You have a duty to report to us any problem, error or suspected system or other inadequacies that you may experience.-->
            </p>
        </li>
        <!--35.8.-->
        <li>
            <p class="license-text">
                <?=lang('tac_399')?>
<!--                Without prejudice to any other provisions of this Agreement, should quoting and/or execution errors occur, which may include, but are not limited to, a dealer's mistype of a quote, a quote or trade which is not representative of the then prevailing Market Prices, an erroneous Price Quote from us or any third party, such as but not limited to an erroneous Price Quote due to failure of hardware, software or communication lines or systems and/or inaccurate external data feeds provided by third-party vendors, we will not be liable for the resulting errors in your Account balances. In the event of a quoting or execution error, we reserve the right to make the necessary corrections or adjustments on the Account involved. Any dispute arising from such quoting or execution errors will be resolved by us in our sole and absolute discretion.-->
            </p>
        </li>
        <!--35.9.-->
        <li>
            <p class="license-text">
                <?=lang('tac_400')?>
<!--                The Company reserves the right to cancel any trade where the time period for which the transaction has been opened is less than two minutes.-->
            </p>
        </li>
        <!--35.10.-->
        <li>
            <h4>
                <?=lang('tac_401')?>
<!--                Circumvention & Reverse Engineering:-->
            </h4>
            <img class="tradomart" src="<?= $this->template->Images()?>tradomart/tradomart-small-black.png" alt="" height="10"/>
            <p class="license-text">
                <?=lang('tac_402')?>
<!--                The Customer shall not unlawfully access or attempt to gain access, reverse engineer or otherwise circumvent any security measures that the Company has applied to its Online Trading Facility and/or computer system(s). If, at the Companyâ€™s sole discretion, it were to determine that the Customer is in breach of this clause, the Company reserves the right to take all action as deemed fit, including, without limitation, completely blocking access to the Online Trading Facility, blocking and/or revoking the Customerâ€™s Access Codes and/or terminating the Account. Under these circumstances,-->
                <img class="tradomart" src="<?= $this->template->Images()?>tradomart/tradomart-small-black.png" alt="" height="10"/>
                <?=lang('tac_403')?>
<!--                reserves the right to seize any profits and/or revenues generated directly or indirectly by exercising any such prohibited trading activity and shall be entitled to inform any Interested third parties of the Customerâ€™s breach of this clause;-->
                <img class="tradomart" src="<?= $this->template->Images()?>tradomart/tradomart-small-black.png" alt="" height="10"/>
                <?=lang('tac_404')?>
<!--                has, and will continue to develop any tools necessary to identify fraudulent and/or unlawful access and use of the Online Trading Facility; any dispute arising from such fraudulent and/or or unlawful trading activity will be resolved by the Company in its sole and absolute discretion, in the manner it deems to be the fairest to all concerned; that decision shall be final and/or binding on all participants; no correspondence will be entered into.-->

            </p>
        </li>
        <!--35.11.-->
        <li>
            <h4>
                <?=lang('tac_405')?>
<!--                Artificial Intelligence Software:-->
            </h4>
            <p class="license-text">
                <?=lang('tac_406')?>
<!--                It is absolutely prohibited to use any software , which the Company determines, at its sole discretion, to have as its purpose to apply any kind of artificial intelligence analysis to its Online Trading Facility and/or computer system(s) relating to the use of the Company Services; in the event that-->
                <img class="tradomart" src="<?= $this->template->Images()?>tradomart/tradomart-small-black.png" alt="" height="10"/>
                <?=lang('tac_407')?>
<!--                determines, at its own discretion, that any such artificial intelligence software has been used, or is being used,-->
                <img class="tradomart" src="<?= $this->template->Images()?>tradomart/tradomart-small-black.png" alt="" height="10"/>
                <?=lang('tac_408')?>
<!--                reserves the right to take all action as deemed fit, including, without limitation, completely blocking access to the Online Trading Facility, blocking and/or revoking the Customerâ€™s Access Codes and/or terminating his Account. Under these circumstances,-->
                <img class="tradomart" src="<?= $this->template->Images()?>tradomart/tradomart-small-black.png" alt="" height="10"/>
                <?=lang('tac_409')?>
<!--                reserves the right to seize any profits and/or revenues generated directly or indirectly by exercising any such prohibited trading activity and shall be entitled to inform any Interested third parties of the Customerâ€™s breach of this clause;-->
                <img class="tradomart" src="<?= $this->template->Images()?>tradomart/tradomart-small-black.png" alt="" height="10"/>
                <?=lang('tac_410')?>
<!--                has, and will continue to develop any tools necessary to identify fraudulent and/or unlawful access and use of the Online Trading Facility; any dispute arising from such fraudulent and/or or unlawful trading activity will be resolved by-->
                <img class="tradomart" src="<?= $this->template->Images()?>tradomart/tradomart-small-black.png" alt="" height="10"/>
                <?=lang('tac_411')?>
<!--                in its sole and absolute discretion, in the manner it deems to be the fairest to all concerned; that decision shall be final and/or binding on all participants; no correspondence will be entered into.-->
            </p>
        </li>
        <!--35.12.-->
        <li>
            <h4>
                <?=lang('tac_412')?>
<!--                Unlawful trading techniques:-->
            </h4>
            <p class="license-text">
                <?=lang('tac_413')?>
<!--                Internet, connectivity delays, and price feed errors sometimes create a situation where the price(s) displayed on the Online Trading Facility does not accurately reflect the market rates. The concept of using trading strategies aimed at exploiting errors in prices and/or concluding trades at off-market prices and/or by taking advantage of internet delays (commonly known as â€œarbitrageâ€�, â€œsnipingâ€� or â€œscalpingâ€� hereinafter, collectively, referred to as â€œArbitrageâ€�), cannot exist in an OTC market where the client is buying or selling directly from the principal; accordingly,-->
                <img class="tradomart" src="<?= $this->template->Images()?>tradomart/tradomart-small-black.png" alt="" height="10"/>
                <?=lang('tac_414')?>
<!--                reserves the right, at its sole discretion, NOT to permit the abusive exploitation of Arbitrage on its Online Trading Facility and/or in connection with its Services; any Transactions or Contracts that rely on price latency arbitrage opportunities may be revoked, at-->
                <img class="tradomart" src="<?= $this->template->Images()?>tradomart/tradomart-small-black.png" alt="" height="10"/>&#39;s
                <?=lang('tac_415')?>
<!--                sole discretion and without prior notice being required; furthermore, in those instances,-->
                <img class="tradomart" src="<?= $this->template->Images()?>tradomart/tradomart-small-black.png" alt="" height="10"/>
                <?=lang('tac_416')?>
<!--                reserves the right, at its sole discretion and without prior notice being required: (a) to make the necessary corrections or adjustments on the Account(s) involved (including, without limitation, adjusting the price spreads available to the customer); (b) to restrict the Account(s) involved access to streaming, instantly tradable quotes (including, without limitation, providing manual quotations only and submitting any Orders to-->
                <img class="tradomart" src="<?= $this->template->Images()?>tradomart/tradomart-small-black.png" alt="" height="10"/>
                <?=lang('tac_416_0')?>
<!--                â€™s prior approval); (c) to retrieve from the Account(s) involved any historic trading profits that-->
                <img class="tradomart" src="<?= $this->template->Images()?>tradomart/tradomart-small-black.png" alt="" height="10"/>
                <?=lang('tac_417')?>
<!--                can document as having been gained through such abuse of liquidity at any time during the client relationship; (d) to terminate the client relationship and/or close all Accounts involved (including, without limitation all other Accounts held by the same Account holder with us)-->
                <img class="tradomart" src="<?= $this->template->Images()?>tradomart/tradomart-small-black.png" alt="" height="10"/>
                <?=lang('tac_418')?>
<!--                has, and will continue to develop any tools necessary to identify fraudulent and/or unlawful access and use of its Online Trading Facility; any dispute arising from such fraudulent and/or or unlawful trading activity will be resolved by-->
                <img class="tradomart" src="<?= $this->template->Images()?>tradomart/tradomart-small-black.png" alt="" height="10"/>
                <?=lang('tac_419')?>
<!--                in its sole and absolute discretion, in the manner it deems to be the fairest to all concerned; that decision shall be final and/or binding on all participants; no correspondence will be entered into.-->



            </p>
        </li>
        <!--35.13.-->
        <li>
            <h4>
                <?=lang('tac_420')?>
<!--                Changes in Market conditions:-->
            </h4>
            <p class="license-text">
                <?=lang('tac_421')?>
<!--                Please note that-->

                <img class="tradomart" src="<?= $this->template->Images()?>tradomart/tradomart-small-black.png" alt="" height="10"/>
                <?=lang('tac_422')?>
<!--                shall have no obligation to contact the Customer to advise upon appropriate action in light of changes in Market Conditions (including, without limitation, Market Disruptions) or otherwise. The Customer acknowledges that the Over-The-Counter Market in leveraged Financial Instruments is highly speculative and volatile and that, following execution of any transaction, the Customer is solely responsible for making and maintaining contact with-->
                <img class="tradomart" src="<?= $this->template->Images()?>tradomart/tradomart-small-black.png" alt="" height="10"/>
                <?=lang('tac_423')?>
<!--                and for monitoring open positions and ensuring that any further instructions are given on a timely basis. In the event of any failure to do so,-->
                <img class="tradomart" src="<?= $this->template->Images()?>tradomart/tradomart-small-black.png" alt="" height="10"/>
                <?=lang('tac_424')?>
<!--                can give no assurance that it will be possible for the Company to contact the Customer and it accepts no liability for loss alleged to be suffered as a result of any failure by the Customer to do so.-->
            </p>
        </li>
        <!--35.14.-->
        <li>
            <h4>
                <?=lang('tac_425')?>
<!--                Indemnification:-->
            </h4>
            <p class="license-text">
                <?=lang('tac_426')?>
<!--                Without prejudice to any other provisions of this Agreement, the Customer agrees to indemnify the Company and hold-->
                <img class="tradomart" src="<?= $this->template->Images()?>tradomart/tradomart-small-black.png" alt="" height="10"/>
                <?=lang('tac_427')?>
<!--                , its Affiliates and any of its Associates, harmless from and against any and all liabilities, losses, damages, costs and expenses, including, without limitation, legal fees and expenses incurred in connection with and/or directly or indirectly related with, any fraudulent and/or unlawful access and use by the Customer of the Online Trading Facility and/or the prevention and/or remediation thereof, provided that any such liabilities, losses, damages, costs and expenses would not have not arisen, but for-->
                <img class="tradomart" src="<?= $this->template->Images()?>tradomart/tradomart-small-black.png" alt="" height="10"/>&#39;s

                <?=lang('tac_428')?>
<!--                gross negligence, fraud or wilful default.-->


            </p>
        </li>
    </ol>
</li>
<!--36.-->
<li class="primaryunits">
    <h4 class="rootnumberheadings">
        <?=lang('tac_429')?>
<!--        INTRODUCTION OF CUSTOMER VIA AN INTRODUCING BROKER-->
    </h4>
    <ol>
        <!--36.1.-->
        <li>
            <p class="license-text">
                <?=lang('tac_430')?>
<!--                In cases where the Customer is introduced to the Company through an Introducing Broker, the Customer acknowledges that the Company is not responsible or accountable for the conduct, representations or inducements of the Introducing Broker and the Company is not bound by any separate agreements entered into between the Customer and the Introducing Broker.-->
            </p>
        </li>
        <!--36.2.-->
        <li>
            <p class="license-text">
                <?=lang('tac_431')?>
<!--                The Customer acknowledges and confirms that his agreement or relationship with the Introducing Broker may result in additional costs, as the Company may be obliged to pay commission fees or charges to the Introducing Broker.-->
            </p>
        </li>
    </ol>
</li>
<!--37.-->
<li class="primaryunits">
    <h4 class="rootnumberheadings">
        <?=lang('tac_432')?>
<!--        THIRD PARTY AUTHORISATION-->
    </h4>

    <ol>
        <!--37.1.-->
        <li>
            <p class="license-text">
                <?=lang('tac_433')?>
<!--                The Customer has the right to authorise a third party to place instructions and/or orders with the Company or to handle any other matters related to the Customer Account, provided that the Customer notifies the Company in writing and that this person is approved by the Company and meets all the Companyâ€™s specifications.-->
            </p>
        </li>
        <!--37.2.-->
        <li>
            <p class="license-text">
                <?=lang('tac_434')?>
<!--                Unless the Company receives a written notification from the Customer for the termination of the authorisation of the person as described in paragraph 20.1, the Company will continue accepting instructions and/or orders and/ or other instructions relating to the Customer Account given by this person on the Customerâ€™s behalf and the Customer will recognise such orders as valid.-->
            </p>
        </li>
        <!--37.3.-->
        <li>
            <p class="license-text">
                <?=lang('tac_435')?>
<!--                Written notification of the termination of the third party authorisation has to be received by the Company with at least 5 days notice prior to the date of termination.-->
            </p>
        </li>
    </ol>
</li>
<!--38.-->
<li class="primaryunits">
    <h4 class="rootnumberheadings">
        <?=lang('tac_436')?>
<!--        INVESTOR COMPENSATION FUND-->

    </h4>
    <ol>
        <li>
            <p class="license-text">
                <?=lang('tac_437')?>
<!--                The Company is a member of the Investor Compensation Fund (ICF) for Cypriot Investment Firms and the maximum compensation amount for each Customer is 20,000 Euros. The Customer shall understand and accept the provisions of the ICF. The Companyâ€™s ICF policy can be found on the Companyâ€™s website. If the Customer requires further information, this can be provided by the Company upon request.-->

            </p>
        </li>
    </ol>
</li>
<!--39.-->
<li class="primaryunits">
    <h4 class="rootnumberheadings">
        <?=lang('tac_438')?>
<!--        COMPLAINT HANDLING PROCEDURE-->
    </h4>
    <ol>
        <!--39.1.-->
        <li>
            <p class="license-text">
<!--                Under the complaint handling rules,-->
                <?=lang('tac_439')?>
                <img class="tradomart" alt="" src="<?= $this->template->Images()?>tradomart.png" />
<!--                must deal with any expression of dissatisfaction about any financial services activity provided or withheld by the Company. If the Customer has a complaint in relation to any of the services provided by the Company, this complaint should be made using the â€œComplaint Handling formâ€� which can be found on the Companyâ€™s website. All Customersâ€™ complaint forms shall be addressed to the Customer Support Department as soon as the issue arises. The Customer shall have the right to contact the Compliance Department of the Company if the reply from the Customer Support Department is deemed unsatisfactory.-->
                <?=lang('tac_440')?>
            </p>
        </li>
        <!--39.2.-->
        <li>
            <p class="license-text">
<!--                If the Customer wishes to report a complaint, he must send an email to the Companyâ€™s Customer Support Department in which the following information needs to be included:-->
                <?=lang('tac_441')?>
            </p>
            <p class="license-text">
                &#8226; <?=lang('tac_442')?>
<!--                Customer forename and surname-->
            </p>
            <p class="license-text">
                &#8226; <?=lang('tac_443')?>
<!--                The account number of the Customer-->
            </p>
            <p class="license-text">
                &#8226; <?=lang('tac_444')?>
<!--                Detailed enquiry description-->
            </p>
            <p class="license-text">
                &#8226; <?=lang('tac_445')?>
<!--                References of transactions involved in the complaint-->
            </p>
            <p class="license-text">
                &#8226; <?=lang('tac_446')?>
<!--                Date and time of the incident causing the complaint-->
            </p>

        </li>
        <!--39.3.-->
        <li>
            <p class="license-text">
                <?=lang('tac_447')?>
<!--                If a situation arises which is not expressly covered by the Customer Agreement, the parties shall agree to try to resolve the matter on the basis of good faith and fairness and by taking such necessary action as is consistent with market practice.-->
            </p>
        </li>
        <!--39.4.-->
        <li>

            <p class="license-text">
                <?=lang('tac_448')?>
<!--                The Customerâ€™s right to take legal action remains unaffected by the existence or use of any complaints procedures referred to above.-->
            </p>
        </li>
        <!--39.5.-->
        <li>
            <p class="license-text">
                <?=lang('tac_449')?>
<!--                The Company considers it important that it deals properly with any reasonable complaint made by a customer, whatever the subject matter of the complaint. For further details please refer to the Complaint Handling procedure document.-->
            </p>
        </li>
    </ol>

</li>
<!--40.-->
<li class="primaryunits">
    <h4 class="rootnumberheadings">
<!--        MISCELLANEOUS-->
        <?=lang('tac_450')?>
    </h4>
    <ol>
        <!--40.1.-->
        <li>
            <p class="license-text">
                <?=lang('tac_451')?>
<!--                If for any reason a court of a competent jurisdiction deems a part of the Service Agreement unenforceable, then such part will be severed and the remainder of the Service Agreement will remain unaffected.-->
            </p>
        </li>
        <!--40.2.-->
        <li>
            <p class="license-text">
                <?=lang('tac_452')?>
<!--                The Customer accepts that the Companyâ€™s official language is English and should always refer to the Companyâ€™s Website for all required information. Translation to other languages is for information purposes only, does not bind the Company and therefore no responsibility or liability regarding the correctness of the information is accepted.-->
            </p>
        </li>
        <!--40.3.-->
        <li>
            <p class="license-text">
                <?=lang('tac_453')?>
<!--                The rights and remedies provided to the Company under the Service Agreement are cumulative and are not exclusive of any rights or remedies provided by law.-->
            </p>
        </li>
        <!--40.4.-->
        <li>
            <p class="license-text">
                <?=lang('tac_454')?>
<!--                The Customer cannot assign or transfer any of his/ her rights and or obligations under the Service Agreement to another or legal person.-->
            </p>
        </li>
        <!--40.5.-->
        <li>
            <p class="license-text">
                <?=lang('tac_455')?>
<!--                The Company has the right to suspend the Customerâ€™s Trading Account at any time for any good reason with or without Written Notice to the Customer.-->
            </p>
        </li>
        <!--40.6.-->
        <li>
            <p class="license-text">
                <?=lang('tac_456')?>
<!--                The Company may assign or transfer any of its rights and or obligations under the Service Agreement to another or legal person, in whole or in part provided that such party agrees to abide by the Service Agreement.-->
            </p>
        </li>
        <!--40.7.-->
        <li>
            <p class="license-text">
                <?=lang('tac_457')?>
<!--                In the instance where the Customer comprises of two or more persons, the liabilities and obligations under any agreement with the Company will be joint and several.-->
            </p>
            <ol>
                <!--40.7.1.-->
                <li>
                    <p class="license-text">
                        <?=lang('tac_458')?>
<!--                        Any Order given by one of the persons who form the Customer will be deemed to have been given by all the persons who form the Customer.-->
                    </p>
                </li>
                <!--40.7.2.-->
                <li>
                    <p class="license-text">
                        <?=lang('tac_459')?>
<!--                        Any notice given to one of the persons which form the Customer will be deemed to have been given to all the persons who form the Customer.-->
                    </p>
                </li>
                <!--40.7.3.-->
                <li>
                    <p class="license-text">
                        <?=lang('tac_460')?>
<!--                        When one or more of the persons which form the Customer dies or becomes mentally incapacitated, all Funds held by the Company, will be for the benefit of the survivor Account Holder(s) and all obligations and liabilities owed to the Company will be owed by such survivor(s).-->

                    </p>
                </li>
            </ol>
        </li>

    </ol>

</li>

<!--41.-->
<li class="primaryunits">
    <h4 class="rootnumberheadings">
        <?=lang('tac_461')?>
<!--        COMMUNICATIONS AND WRITTEN NOTICES-->
    </h4>
    <ol>
        <!--41.1.-->
        <li>
            <p class="license-text">
                <?=lang('tac_462')?>
<!--                Unless stated in this Agreement to the contrary, any notice, instruction, request or other communication to be given to the Company by the Customer under the Service Agreement shall be in writing and shall be sent to the Companyâ€™s address below (or to any other address which the Company may from time to time specify to the Customer for this purpose) by email, facsimile, post if posted in Cyprus, or airmail if posted outside Cyprus, or commercial courier service and shall be deemed delivered only when actually received by the Company at: Anastasi Sioukri & Olympion, Themis Tower, 6th Floor, 3035, Limassol, Cyprus.-->
            </p>
        </li>
        <!--41.2.-->
        <li>
            <p class="license-text">
                <?=lang('tac_463')?>
<!--                In order to communicate with the Customer, the Company may use any of the following: email; company online trading system internal mail; facsimile transmission; telephone; post; commercial courier service; air mail; or the Companyâ€™s website. The methods of communication specified in this paragraph are also considered as written notice from the Company.-->
            </p>
        </li>
    </ol>

</li>
</ol>

    <?= $DemoAndLiveLinks; ?>
</div>
</div>
</div>
</div>