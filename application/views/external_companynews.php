<div class="reg-form-holder">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="license-title">Company News</h1>
                <div class="company-news-holder">
                    <?php
                    foreach($results as $data) {
                        echo '<div class="news">';
                        echo '<h1 class="news-title">'.$data->title.'</h1>';
                        echo '<p class="news-article">';
                        echo $data->message;
                        echo '</p>';
                        echo '<a href="'.base_url().$data->link.'" class="read-more">Read More</a>';
                        echo '<div class="clearfix"></div>';
                        echo '</div>';
                    }
                    ?>
                    <div class="pagination-holder">
                        <nav>
                            <ul class="pagination">
                                <?php echo $links; ?>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="red-line"></div>
                <div class="btn-livedemo">
                    <form class="form-inline">
                        <div class="form-group">
                            <a href="<?php echo base_url()?>register" class="col-sm-6 btn-real">
                                Open Trading Account
                            </a>
                        </div>
                        <div class="form-group">
                            <a href="<?php echo base_url()?>register/demo" class="col-sm-6 btn-demo">
                                Open Demo Account
                            </a>
                        </div>
                        <div class="form-group">
                            <label>Risk Warning: Trading CFDs involves significant risk of loss.</label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>