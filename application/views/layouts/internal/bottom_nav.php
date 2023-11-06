<style>
    .footerstyle{
        border-top: 1px solid #2988CA; padding: 10px; 0
    }
    .verticalalignbottom{
        vertical-align: bottom;
    }
    h4.SetAlignment{
        margin-top: 0;
    }
</style>

<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-3">
        <div class="about-us-holder">
            <h1>About Us</h1>
            <ul>
                <li><a href="<?=FXPP::loc_url('accounts')?>">Forex Trading</a></li>
                <li><a href="<?=FXPP::loc_url('accounts')?>">Partners</a></li>
                <li><a href="<?=FXPP::loc_url('contact-us')?>">Contact Us</a></li>
            </ul>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3">
        <div class="account-holder">
            <h1>Accounts</h1>
            <ul>
                <li><a href="<?=FXPP::loc_url('accounts')?>">My Accounts</a></li>
                <li><a href="<?=FXPP::loc_url('profile/edit')?>">My Profile</a></li>
                <li><a href="<?=FXPP::loc_url('transactions/deposit')?>">Deposit Funds</a></li>
                <li><a href="<?=FXPP::loc_url('transactions/withdraw')?>">Withdraw Funds</a></li>
                <li><a href="<?=FXPP::loc_url('accounts')?>">Platforms</a></li>
            </ul>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="connect-holder">
            <h1>Need Help?</h1>
            <ul>
                <li>
                    <a href="">
                        <img src="<?= $this->template->Images()?>circle3.png" width="40px;"/> Help Center
                    </a>
                </li>
                <li>
                    <a href="">
                        <img src="<?= $this->template->Images()?>live.png" width="40px;"/> Live Chat
                    </a>
                </li>
                <li>
                    <a href="">
                        <img src="<?= $this->template->Images()?>contact.png" width="40px;"/> Call Me Back
                    </a>
                </li>
            </ul><div class="clearfix"></div>
        </div>
        <div class="follow-holder">
            <h1>Follow Us</h1>
            <ul>
                <li>
                    <a href="https://plus.google.com" class="gplus"><img src="<?= $this->template->Images()?>gplus.png" width="30px"></a>
                </li>
                <li>
                    <a href="<?= $this->config->item('domain-facebook');?>" class="fb" target="_blank"><img src="<?= $this->template->Images()?>fb.png" width="30px"></a>
                </li>
                <li>
                    <a href="https://www.linkedin.com/" class="in"><img src="<?= $this->template->Images()?>linkedin.png" width="30px"></a>
                </li>
                <li>
                    <a href="<?= $this->config->item('domain-twitter');?>" class="twit" target="_blank"><img src="<?= $this->template->Images()?>twitter.png" width="30px"></a>
                </li>
            </ul><div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="row" style="border-top: 1px solid #2988CA; padding: 10px; 0">
    <div class="col-md-8">
        <ul class="other-link">
            <li><a href="<?=FXPP::loc_url('privacy-policy')?>">Policies</a></li>
            <li class="ver-line">|</li>
            <li><a href="<?=FXPP::loc_url('Risk-Disclosure')?>">Risk Disclosure</a></li>
            <li class="ver-line">|</li>
            <li><a href="<?=FXPP::loc_url('Terms-and-Conditions')?>">Terms & Conditions</a></li>
        </ul><div class="clearfix"></div>
    </div>
    <div class="col-md-4">
        <div class="copyright">
            <h4 class="SetAlignment"><img src="<?= $this->template->Images()?>/logo.png" width="100px"> <small class="verticalalignbottom">&copy; 2015 <img  width="101px" height="11px" class="tradomart" src="<?= $this->template->Images()?>tradomart/tradomart-ltd-small-white.png" />.</small></h4>
        </div>
    </div>
</div>