<style>
    ol {
        counter-reset: item;
    }
    ol li {
        display: block;
        position: relative;
    }
    ol li:before {

        color: #2988CA;
        font-weight: bold;

        counter-increment: item;
        position: absolute;
        margin-right: 100%;
        right: 10px; /* space between number and text */

    }
    ol.III li:before {
        content: "3." counters(item, ".")".";
    }
    ol.V li:before {
        content: "5." counters(item, ".")".";
    }
    ol.VI li:before {
        content: "6." counters(item, ".")".";
    }
    ol.VII li:before {
        content: "7." counters(item, ".")".";
    }
    ol.IX li:before {
        content: "9." counters(item, ".")".";
    }
    ol.X li:before {
        content: "10." counters(item, ".")".";
    }
    .rootnumberheadings{
        color: #2988CA;
        font-weight: bold;
    }
    .subnumberheadings{
        font-weight: bold;
    }
    .main{
        padding-top: 20px;
    }
    .primaryunits{
        padding-bottom: 20px;
    }
    .ordinal {vertical-align:super;}

    ul.disc {
        display: block;
        list-style-type: disc;
        margin-top: 1em;
        margin-bottom: 1em;
        margin-left: 0;
        margin-right: 0;
        padding-left: 40px;
        color: #333;
    }
    ul.disc li{
        padding: 2px 0;
    }
    .license-text{
        margin-top: 0px;
    }
    .underline{
        text-decoration: underline;
    }

</style>

<div class="reg-form-holder">
<div class="container">
<div class="row">
<div class="col-lg-12">
<h1 class="license-title">Best Execution Policy</h1>
<ul class="disc">
<li>
    <h4 class="rootnumberheadings">LEGAL INFORMATION</h4>
    <p class="license-text">
        <img class="tradomart" width="101" height="11"  src="<?= $this->template->Images()?>tradomart/tradomart-ltd-small-black.png" alt="" />  (hereinafter referred to as ‘FXCO’ or the ‘Company’ is an investment firm that operates globally.
    </p>
    <p class="license-text">
        FXCO is incorporated in the Republic of Cyprus with Certificate of Incorporation No. HE 266937.  The Company is authorised and regulated  by the Cyprus Securities and Exchange Commission (‘CySEC’), with licence No. 266/15, and operates under the Provision of Investment Services, the Exercise of Investment Activities, the Operation of  Regulated  Markets  and  Other  Related  Matters  Law  of  2007,  Law  144(I)/2007,  as  subsequently amended from time to time (the Law).  The Company’s registered office is located at Anastasi Sioukri & Olympion, Themis Tower, 6th Floor, 3035, Limassol, Cyprus.
    </p>
    <p class="license-text">
        The Customer acknowledges that the Company’s official language is English.
    </p>
</li>
<li>
    <h4 class="rootnumberheadings">INTRODUCTION</h4>
    <p class="license-text">
        Implementing the Markets in Financial Instruments Directive (MiFID) 2004/39/EC as well as the Investment Services and Activities and Regulated Market Law of 2007 (Law 144(I)/2007), the Company has established its Best Execution Policy (hereinafter referred to as the “Policy”). The Company is required to set up this Policy and to take all reasonable steps to obtain the best possible result for its Retail and Professional Customers, either when executing Customer orders or receiving and transmitting orders for execution in relation to financial instruments, or placing orders with other entities for execution that results from decisions by the Company to deal in financial instruments on behalf of the Customer.
    </p>
    <p class="license-text">
        The Company provides herein a summary of the Policy it maintains in order to set out a general overview on how the Company will obtain best execution for its Customers and to provide appropriate information to its Customers on its Policy.
    </p>
    <p class="license-text">
        The Company is operating under Directive 2004/39/EC of the European Parliament and of the Council of 21 April 2004 on markets in financial instruments amending Council Directives 85/611/EEC and 93/6/EEC and Directive 2000/12/EC of the European Parliament and of the Council and repealing Council Directive 93/22/EEC, as the same may be in force from time to time and modified or amended from time to time (the “Markets in Financial Instruments Directive (2004/39/EC)” or “MiFID”).
    </p>
    <p class="license-text">
        The Company is operating under Directive 2004/39/EC of the European Parliament and of the Council of 21 April 2004 on markets in financial instruments amending Council Directives 85/611/EEC and 93/6/EEC and Directive 2000/12/EC of the European Parliament and of the Council and repealing Council Directive 93/22/EEC, as the same may be in force from time to time and modified or amended from time to time (the “Markets in Financial Instruments Directive (2004/39/EC)” or “MiFID”).
    </p>
</li>
<li>
    <h4 class="rootnumberheadings">
        SCOPE OF THE POLICY
    </h4>
    <ol class="III">
        <li>
            <p class="license-text">
                The Policy applies to all Company directors, employees, any persons directly or indirectly linked to the Company (hereinafter called ‘related persons’) and refers to all interactions with all Customers.
            </p>
        </li>
        <li>
            <p class="license-text">
                The Policy forms part of the Customer Agreement. Therefore, by entering into the Customer Agreement with the Company, the Customer is also agreeing to the Policy relating to financial instruments provided by the Company, the contract specifications of which are available online at www.forexmart.com  (herein referred to as the “Financial Instruments”).
            </p>
        </li>
        <li>
            <p class="license-text">
                This Policy applies when executing transactions with the Customer for the Financial Instruments provided by the Company. The Financial Instruments provided by the Company are Contracts for Difference; it is up to the Company’s discretion to decide which types of Financial Instruments to make available and to publish the prices at which these can be traded. The Company, through its Trading Platform(s), provides the Customer with live streaming prices, ‘Quotes’, along with a breakdown of the available volumes (‘market depth’) as received from its third party liquidity providers. The Company is always the counterparty (or principal) to every trade; therefore, if the Customer decides to open a position in a Financial Instrument with the Company, then that open position can be only closed with the Company.
            </p>
        </li>
        <li>
            <p class="license-text">
                The Policy applies to retail and professional clients. Therefore, if the Company classifies the Client as an eligible counterparty, this Policy does not apply to the respective Client.
            </p>
        </li>
    </ol>
</li>


<li>
    <h4 class="rootnumberheadings">
        ORDER TYPE DEFINITIONS
    </h4>
    <p class="license-text">
        There are different types of orders as follows:
    </p>
    <ul class="disc">
        <li>
            <p class="license-text">
                <b>Buy Stop:</b> this is an order to buy at a specified price (‘the stop price’) that is higher than the current market price.
            </p>
        </li>
        <li>
            <p class="license-text">
                <b>Sell Stop: </b>this is an order to sell at a specified price (‘the stop price’) that is lower than the current market price.
            </p>
        </li>
        <li>
            <p class="license-text">
                <b>Buy Limit: </b>this is an order to buy at a specified price (‘the limit price’) that is lower than the current market price.
            </p>
        </li>
        <li>
            <p class="license-text">
                <b>Sell Limit:  </b>this is an order to sell at a specified price (‘the limit price’) that is higher than the current market price.
            </p>
        </li>
        <li>
            <p class="license-text">
                <b>Stop Loss: </b>this is an order that maybe attached to an already open position to close a position at a specified price (‘the stop loss price’). A ‘stop loss’ may be used to minimise losses.
            </p>
        </li>
        <li>
            <p class="license-text">
                <b>Take profit: </b>this is an order that maybe attached to an already open position to close a position at a specified price (‘the take profit price’). A ‘take profit’ may be used to secure profits.
            </p>
        </li>
    </ul>
</li>
<li>
    <h4 class="rootnumberheadings">
        ORDER EXECUTION ELEMENTS
    </h4>
    <ol class="V">
        <li>
            <p class="license-text">
                <b>Prices: </b>The Company generates its own tradable prices based on price feeds from some of the world’s leading liquidity providers and independent price providers. The main way in which the Company will ensure that the Customer receives the best execution will be to ensure that the calculation of the ‘bid’ and ‘ask’ spread is made with reference to a range of underlying price providers and data sources. The Company reviews its independent price providers at least once a year to ensure that correct and competitive pricing is offered.
            </p>
        </li>
        <li>
            <p class="license-text">
                <b>Re-quoting: </b>this is the practice of providing a secondary quote to the Customer after an ‘instant order’ has been submitted; the Customer must agree to this quote before the order is executed. The Company will re-quote ‘instant orders’ if the requested price originally specified by the Customer is not available. The secondary quote provided to the Customer is the next available price received by the Company from its third party liquidity providers. The Company does not re-quote ‘pending orders’.
            </p>
        </li>
        <li>
            <p class="license-text">
                <b>Slippage: </b>at the time that an order is presented for execution, the specific price requested by the Customer may not be available; therefore, the order will be executed close to or a number of pips away from the Customer’s requested price. If the execution price is better than the price requested by the Customer that is referred to as ‘positive slippage’. In contrast, if the execution price is worse than the price requested by the Customer this is referred to as ‘negative slippage’. Please be advised that ‘slippage’ is a normal market practice and a regular feature of the foreign exchange markets under conditions* such as liquidity and volatility due to news announcements, economic events and market openings. The Company’s automated execution software does not operate based on any individual parameters related to the execution of orders through any specific Customer accounts.
            </p>
        </li>
        <li>
            <p class="license-text">
                <b>Partial fills: </b> this is the practice of executing an order in parts if there is not enough liquidity in the market at the time in order to fill-in the full order at a specific price. Partial fills may be executed at different prices.
            </p>
        </li>
        <li>
            <p class="license-text">
                <b>Commission: </b>the Customer shall be charged commission when trading some types of financial instruments. Further information is available on line at: www.forexmart.com
            </p>
        </li>
        <li>
            <p class="license-text">
                <b>Partial fills: </b>in the context of www.forexmart.com  the Customers shall be charged a mark-up per currency pair.
            </p>
            <i>
                * Please note that this is not an exhaustive list.
            </i>
        </li>

    </ol>
</li>
<li>
    <h4 class="rootnumberheadings">
        ORDER TYPE EXECUTION
    </h4>
    <p class="license-text underline">
        “Meta Trader”
    </p>

    <p class="license-text">
        <b> INSTANT ORDER(S)</b>
    </p>

    <ol class="VI">
        <li>
            <p class="license-text">
                <b>Instant Order:</b>this is an order to either buy or sell at the ‘ask’ or ‘bid’ price (respectively) as it appears in the quotes flow at the time the Customer presents the order for execution.
            </p>
            <b>
                PENDING ORDER(S)
            </b>
        </li>
        <li>
            <p class="license-text">
                <b>Stop Orders:</b> this is an order to buy or sell once the market reaches the ‘stop price’. Once the market reaches the ‘stop price’ the ‘stop order’ is triggered and treated as a ‘market order’* If the ‘stop order’ is not triggered it shall remain in the system until a later date subject to the conditions described in the ‘Good till Cancel’ section. For further information please see the Company’s website.
            </p>
        </li>
        <li>
            <p class="license-text">
                <b>
                    Stop Loss:
                </b>
                this is an order to minimise losses. Once the market reaches the ‘stop loss price’ the order is triggered and treated as a ‘market order’*. If the ‘stop loss’ is not triggered it shall remain in the system until a later date. For further information please see the Company’s website.
            </p>
        </li>
        <li>
            <p class="license-text">
                <b>
                    <i>*Market Order:</i>
                </b>
                <i>
                    this is an order to buy or sell at the current market price that is available. The system automatically aggregates the volume received from third party liquidity providers and executes the ‘market order’ at VWAP (‘Volume-Weighted Average Price’) that is the average and best available price at the time of the execution. Once the ‘market order’ is triggered it shall be subject to the conditions described in the ‘Good till Cancel’ section.
                </i>
            </p>
            <p class="license-text">
                <b>
                    <i>Good till Cancel (‘GTC’) (=Expiry): </i>
                </b>
                <i>
                    this is a time setting that the Customer may apply to ‘pending orders’. The Customer may choose a specific date in the future until which the order may remain ‘live’ and pending execution; if the order is not triggered during this timeframe it shall be deleted from the system.
                </i>
            </p>
        </li>
        <li>
            <p class="license-text">
                <b>
                    Limit Orders:
                </b>
                this is an order to buy or sell once the market reaches the ‘limit price’. Once the market reaches the ‘limit price’ the ‘limit order’ is triggered and executed at the ‘limit price’ or better. If the ‘limit order’ is not triggered it shall remain in the system until a later date subject to the conditions described in the ‘Good till Cancel’ section. For further information please see the Company’s website.
            </p>
        </li>


        <li>
            <p class="license-text">
                <b>
                    Take Profit:
                </b>
                this is an order to secure profits. Once the market reaches the ‘take profit price’ the order is triggered and treated as a ‘limit order’. If the ‘take profit order’ is not triggered it shall remain in the system until a later date. For further information please see the Company’s website.
            </p>
        </li>
        <li>
            <p class="license-text">
                <b>
                    Pending Order Modification/Cancellation:
                </b>
                the Customer may modify/cancel a ‘pending order’ if the market did not reach the level of the price specified by the Customer.
            </p>
        </li>
        <li>
            <p class="license-text">
                <b>
                    NOTE:
                </b>
                Most of the orders shall be automatically executed by the Company’s MetaTrader4, as described above. But, it should be noted that the Company reserves the right, at its absolute discretion, to manually execute in whole or in part an order of 100 lots or above, for major currency pairs; the same practice applies for orders of a significant size for minor currency pairs.
            </p>
            <p class="license-text">
                <b>
                    MARKET ORDER(S)
                </b>
            </p>
        </li>
        <li>
            <p class="license-text">
                <b>
                    Market Order:
                </b>
                this is an order to buy or sell at the current market price that is available. The system automatically aggregates the volume received from third party liquidity providers and executes the ‘market order’ at VWAP (‘Volume-Weighted Average Price’) that is the average and best available price at the time of the execution.
            </p>

            <p class="license-text">
                <b>
                    PENDING ORDER(S)
                </b>
            </p>
        </li>
        <li>
            <p class="license-text">
                <b>
                    Stop Orders:
                </b>
                this is an order to buy or sell once the market reaches the ‘stop price’. Once the market reaches the ‘stop price’ the ‘stop order’ is triggered and treated as a ‘market order’* If the ‘stop order’ is not triggered it shall remain in the system until a later date subject to the conditions described in the ‘Good till Cancel’ section. ‘Stop orders’ can be placed as close to the current market price as the Customer wishes; there is no restriction.
            </p>
        </li>



        <li>
            <p class="license-text">
                <b>
                    Stop Loss:
                </b>
                this is an order to minimise losses. Once the market reaches the ‘stop loss price’ the order is triggered and treated as a ‘market order’*. If the ‘stop loss’ is not triggered it shall remain in the system until a later date. ‘Stop loss orders’ can be placed as close to the current market price as the Customer wishes; there is no restriction.
            </p>
        </li>
        <li>
            <p class="license-text">
                <b>
                    <i>*Market Order (Applicable for ‘Stop Orders’ and ‘Stop Loss Orders’): </i>
                </b>
                <i>this is an order to buy or sell at the current market price that is available. The system automatically aggregates the volume received from third party liquidity providers and executes the ‘market order’ at VWAP (‘Volume-Weighted Average Price’) that is the average and best available price at the time of the execution. Once the ‘market order’ is triggered it shall be subject to the conditions described in the ‘Good till Day’ and ‘Good till Cancel’ sections.</i>
            </p>
            <p class="license-text">
                <b>
                    <i>Good till Cancel (‘GTC’) (=Expiry):</i>
                </b>
                <i>this is a time setting that the Customer may apply to ‘pending orders’. The Customer may choose a specific date in the future up until when the order may remain ‘live’ and pending execution; if the order is not triggered during this timeframe it shall be deleted from the system.</i>
            </p>
            <p class="license-text">
                <b>
                    <i> Good till Day (‘GTD’):</i>
                </b>
                <i>this is an execution setting that applies to ‘pending orders’ traded through “Meta Trader”. It refers to the 5 second period commencing from the time the order is triggered. During these 5 seconds the order is pending execution according to its type as described above.</i>
            </p>
        </li>
        <li>
            <p class="license-text">
                <b>
                    Limit Orders:
                </b>
                this is an order to buy or sell once the market reaches the ‘limit price’. Once the market reaches the ‘limit price’ the ‘limit order’ is triggered and executed at the ‘limit price’ or better. If the ‘limit order’ is not triggered it shall remain in the system until a later date subject to the conditions described in the ‘Good till Cancel’ section. ‘Limit orders’ can be placed as close to the current market price as the Customer wishes; there is no restriction.
            </p>
        </li>
        <li>
            <p class="license-text">
                <b>
                    Take Profit:
                </b>
                this is an order to secure profits. Once the market reaches the ‘take profit price’ the order is triggered and treated as a ‘take profit order’. If the ‘take profit order’ is not triggered it shall remain in the system until a later date. ‘Take profit orders’ can be placed as close to the current market price as the Customer wishes; there is no restriction.
            </p>
        </li>

        <li>
            <p class="license-text">
                <b>
                    Pending Order Modification / Cancellation:
                </b>
                the Customer may modify/cancel a ‘pending order’ if the market does not reach the level of the price specified by the Customer.
            </p>
        </li>

        <li>
            <p class="license-text">
                <b>
                    Simultaneous Positions:
                </b>
                A Customer may hold up to 200 positions simultaneously (considered as summary of “Market” and “Pending Orders” per Customer.
            </p>
        </li>
        <li>
            <p class="license-text">
                The Company reserves the right to change the software trading platforms from time to time.
            </p>
        </li>

    </ol>
</li>

<li>
    <h4 class="rootnumberheadings">
        BEST EXECUTION
    </h4>
    <ol class="VII">
        <li>
            <p class="license-text">
                The Company shall take all reasonable steps to obtain the best possible result for its Customers taking into consideration several factors when executing Customers orders against the Company’s quoted prices. Prices, costs and currency conversion carry the highest importance when executing transactions for our Customers.
            </p>
        </li>
        <li>
            <p class="license-text">
                <b>
                    Price
                </b>
            </p>

            <p class="license-text">
                &#8226;  <i>Bid –  Ask Spread</i> :
                for any given Financial Instrument the Company will quote two prices: the higher price (ASK) at which the Customer can buy (go long) that Financial Instrument, and the lower price (BID) at which the Customer can sell (go short) that Financial Instrument; collectively referred to as the ‘Company’s prices’. The difference between the lower and the higher price of a given Financial Instrument is called the spread.
            </p>
            <p class="license-text">
                &#8226;  <i>Pending Orders</i>:
                such orders as Buy Limit, Buy Stop and Stop Loss/Take Profit for opened short position are executed at ASK price. Such orders as Sell Limit, Sell Stop and Stop Loss/Take Profit for opened long position are executed at BID price.
            </p>

            <p class="license-text">
                &#8226; The Company’s price for a given Financial Instrument is calculated by reference to the price of the relevant underlying financial instrument which the Company obtains from third party liquidity providers. The Company updates its prices as frequently as the limitations of technology and communication links allow. The Company will not quote any price outside the Company’s operations time (see Execution Venue below) therefore no orders can be placed by the Customer during that time.
            </p>
            <p class="license-text">
                &#8226; For the ECN platform, traders are routed directly to liquidity providers through the electronic execution system. This system automatically requests a quote from a selection of liquidity providers. In conjunction with the price, the Company quotes the available liquidity, (or ‘market depth’), as obtained from its third party liquidity providers. The Company’s software will automatically aggregate all available liquidity at the best possible prices available and fill at the Volume-Weighted Average Price (V.W.A.P.).
            </p>
        </li>
        <li>
            <p class="license-text">
                <b>Charges and other costs:</b> for opening a position in some types of Financial Instruments the Customer may be required to pay commission or other fees, if applicable. These amounts are disclosed in the contract specifications available in the Company’s website.
            </p>
            <p class="license-text">
                <i>Commissions</i>: commissions will be charged as a fixed amount and can be found in the Company’s website at www.forexmart.com
            </p>
            <p class="license-text">
                <i>Financing Fee</i>: in the case of financing fees, the value of opened positions in some types of Financial Instruments is increased or reduced by a daily financing fee “swap” throughout the life of the contract. Financing fees are based on prevailing market interest rates, which may vary. Details of daily financing fees applied are available on the Financial Instruments Contract Specifications section in the Company’s website.
            </p>
            <p class="license-text">
                For all types of Financial Instruments that the Company offers, the commission and financing fees are not incorporated into the Company’s quoted price and are instead charged separately to the Customer account.
            </p>
        </li>
        <li>
            <p class="license-text">
                <b>Currency Conversion</b>: the Company may provide a currency conversion quote from the Customer’s base currency to the currency of the relevant Financial Instrument. This will not reflect an actual conversion of currency in the Customer’s account, and serves the purpose of calculating consideration in the base currency only.
            </p>
        </li>
        <li>
            <p class="license-text">
                <b>Speed Execution:</b> as explained in the ‘Execution Venues’ section of this Policy, the Company acts as principal and not as agent on the Customer’s behalf; therefore, the Company is the sole Execution Venue for the execution of the Customer’s orders for the Financial Instruments provided by the Company. The Company places a significant importance when executing Customer’s orders and strives to offer a high speed of execution within the limitations of technology and communication links. The use of wireless connection or dial-up connection or any other form of unstable connection at the Customer’s end, may result in poor or interrupted connectivity or lack of signal strength causing delays in the transmission of data between the Customer and the Company when using the Company’s electronic trading platform. This may result in the placement of the Customer’s order at an out-of date price, which the Company might decline and provide the Customer with a new quote (i.e. re-quoting).
            </p>
            <p class="license-text">
                If the Customer undertakes transactions on an electronic system, he/she will be exposed to risks associated with the system including the failure of hardware and software (Internet / Servers). The result of any system failure may be that your order is either not executed according to your instructions or it is not executed at all. The Company does not accept any liability in the case of such a failure. The use of wireless connection or dial-up connection or any other form of unstable connection at the Customer’s end, may result in poor or interrupted connectivity or lack of signal strength causing delays in the transmission of data between the Customer and Company’s when using the Company’s Electronic Trading Platform. This delay may result in sending to the Company out of date “market orders”. In this case the Company will update the price and execute the order at the market price available.
            </p>
        </li>


        <li>
            <p class="license-text">
                <b>Likelihood of Execution:</b>
                as explained in the ‘Execution Venues’ section of this Policy, the Company acts as principal and not as an agent on the Customer’s behalf; therefore, the Company is the sole Execution Venue for the execution of the Customer’s orders for the Financial Instruments provided by the Company. However the Company relies on third party liquidity providers for prices and available liquidity. Although the Company executes all orders placed by the Customers, it reserves the right to decline an order of any type.
            </p>
            <p class="license-text">
                Orders: Market Order, Buy Limit, Sell Limit, Sell Stop, Buy Stop, Stop Loss, Take Profit on Financial Instruments are executed in the manner explained in the ‘Order Execution’ section above. It should be noted that the price at which a trade is executed may vary significantly from the original requested price during abnormal market conditions. This may occur, for example, in the following cases:
            </p>
            <p class="license-text">
                &#8226; During Market opening.
            </p>
            <p class="license-text">
                &#8226; During news times.
            </p>
            <p class="license-text">
                &#8226; During volatile markets where prices may move significantly away from the declared price.
            </p>
            <p class="license-text">
                &#8226; Where there is rapid price movement - if the price rises or falls in one trading session to such an extent that under the rules of the relevant exchange, trading is suspended or restricted.
            </p>
            <p class="license-text">
                &#8226; If there is insufficient liquidity for the execution of the specific volume at the declared price.
            </p>
        </li>
        <li>
            <p class="license-text">
                The Company strives to provide the best possible price to its Customers, and makes every effort and necessary arrangements to do so.
            </p>
        </li>
        <li>
            <p class="license-text">
                <b>Likelihood of Settlement:</b> the Company shall proceed to a settlement of all transactions upon execution of such transactions.
            </p>
        </li>
        <li>
            <p class="license-text">
                <b>Size of Order:</b>  all orders are placed in lot sizes.  A lot is a unit measuring the transaction amount and it is different for each Financial Instrument. Details of the lot sizes are available on the Contract Specifications in the Company’s website. Although there is no maximum order size that the Customer can place with the Company, the Company reserves the right to decline an order as explained in the agreement entered into with the Customer.
            </p>
            <p class="license-text">
                The Company makes every effort to fill the order of the Customer irrespective of the volume. But, if this is achieved, it may be at the best available price as the market liquidity may allow at the time of execution. (See ‘Likelihood of Execution’)
            </p>
        </li>
        <li>
            <p class="license-text">
                <b>Market Impact:</b> some factors may alter significantly the price of the underlying financial instruments, from how the price that was quoted by the Company for its Financial Instruments was derived. The Company will take all reasonable steps to obtain the best possible result for its Customers.
            </p>
        </li>


        <li>
            <p class="license-text">
                The Company does not consider the above-mentioned factors to be exhaustive and the order in which the above factors are presented shall not be taken as priority factor.
            </p>
        </li>
        <li>
            <p class="license-text">
                Nevertheless, whenever there is a specific instruction from the Customer, the Company shall make sure that the Customer’s order shall be executed following the specific instruction.
            </p>
        </li>
        <li>
            <p class="license-text">
                The Company will determine the relative importance of the above factors by using its commercial judgment and experience in the light of the information available on the market and taking into account the criteria described below:
            </p>
            <p class="license-text">
                &#8226; The characteristics of the Customer including the categorization of the Customer as retail or professional.
            </p>
            <p class="license-text">
                &#8226; The characteristics of the Customer order.
            </p>
            <p class="license-text">
                &#8226; The characteristics of the financial instruments that are the subject of that order.
            </p>
            <p class="license-text">
                &#8226; The characteristics of the execution venues to which that order can be directed.
            </p>
        </li>
        <li>
            <p class="license-text">
                The best possible result for a Customer shall be determined in terms of the total consideration, representing the price of the financial instrument and the costs related to execution, which shall include all expenses incurred by the Customer which are directly related to the execution of the order.
            </p>
        </li>

    </ol>
</li>
<li>
    <h4 class="rootnumberheadings">
        EXECUTION VENUES
    </h4>
    <p class="license-text">
        Execution Venues are the entities with which the orders are placed or to which the Company transmits orders for execution. For the purposes of orders for the Financial Instruments provided by the Company, the Company acts as principal and not as agent on the Customer’s behalf; therefore the Company is the sole Execution Venure for the execution of Client’s Orders. The Company does not transmit the Client order in the external market if the order is for the financial instrument provided by the Company.
    </p>
    <p class="license-text">
        Operating hours: The Company’s operation hours are as follows:
    </p>




    <ul class="disc">
        <li>
            <p class="license-text">
                Round the clock: 00:00 AM Cyprus Time (GMT +2) Monday through to 00:00 PM Cyprus Time (GMT +2) Friday
            </p>
        </li>
        <li>
            <p class="license-text">
                Non-working periods: 00:00 AM Cyprus Time (GMT +2) Saturday through to 00:00 PM Cyprus Time (GMT +2) Sunday. Holidays will be announced through the internal mail of the trading terminal supplied by the company
            </p>
        </li>
    </ul>

    <p class="license-text">
        The Company places significant reliance to the above Execution Venue on the above mentioned factors and their relevant importance. It is the Company’s policy to maintain such internal procedures and principles in order to act for the best interest of its Clients and provide them the best possible result (or “Best Exectuon”) when dealing with them.
    </p>

    <p class="license-text">
        The Client acknowledges that the transactions entered in Financial Instruments with the Company are not undertaken on a recognised exchange, rather they are undertaken through the Company’s Trading Platform and, accordingly, they may expose they may expose the Client to greater risks than regulated exchange transactions. Therefore the Company may not execute an order, or it may change the opening (closing) price of an order in case of any technical failure of the trading platform or quote feeds. The <a href="<?= ($this->config->item('domain-www')); ?>/terms-and-conditions"> Terms and Conditions </a> and trading rules are established solely by the counterparty which in this case is the Company. The Client is obliged to close an open position of any given Financial Instruments during the opening hours of the Company’s Trading Platform. The Client also has to close any position with the same counterparty with whom it was originally entered into, i.e. the Company.
    </p>
</li>
<li>
    <h4 class="rootnumberheadings">
        MONITOR AND REVIEW
    </h4>
    <ol class="IX">
        <li>
            The Company is required, when establishing a business relation with the Customer, to obtain his/her prior consent to this Policy.
        </li>
        <li>
            By entering into the ‘Customer Agreement’, the Customer provides the consent referred to in  paragraph 9.1 above, where the Customer is informed that any orders placed with the Company for the Financial Instruments offered by the Company, the Company acts as the principal and the Company is the sole Execution Venue, which is a non-regulated market.
        </li>
    </ol>
</li>

<li>
    <h4 class="rootnumberheadings">
        CLIENT CONSENT
    </h4>
    <ol class="X">
        <li>
            The Company is required, when establishing a business relation with the Customer, to obtain his/her prior consent to this Policy.
        </li>
        <li>
            By entering into the ‘Customer Agreement’, the Customer provides the consent referred to in  paragraph 9.1 above, where the Customer is informed that any orders placed with the Company for the Financial Instruments offered by the Company, the Company acts as the principal and the Company is the sole Execution Venue, which is a non-regulated market.
        </li>
    </ol>
</li>
<li>
    <h4 class="rootnumberheadings">
        IMPORTANT INFORMATION
    </h4>
    <p class="license-text">
        Some Financial Instruments traded in by the Company are not eligible for sale in certain jurisdictions or countries. The Policy is not directed to any jurisdiction or country where its publication, availability or distribution would be contrary to local laws or regulations, including the United States of America. The Policy does not constitute an offer, invitation or solicitation to buy or sell these financial instruments. It may not be reproduced or disclosed (in whole or in part) to any other person without prior written permission. The Policy is not intended to constitute the sole basis for the evaluation of the Customer’s decision to trade in the above-mentioned financial instruments.
    </p>
</li>
<li>
    <h4 class="rootnumberheadings">
        FAQs
    </h4>
    <p class="license-text">
        Questions regarding the Order Execution Policy should be addressed, in the first instance, to the Customer Support Department: support@forexmart.com .
    </p>
</li>

</ul>
<?php echo $DemoAndLiveLinks; ?>
</div>
</div>
</div>
</div>