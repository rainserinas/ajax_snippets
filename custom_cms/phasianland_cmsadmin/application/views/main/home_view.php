<?php $this->load->view('default/header'); ?>


<div class="content-frame">  

    <div class="content-frame-top">                        
        <div class="page-title">                    
            <h2> <?=$pageInfo->header?></h2>
        </div>                  
    </div> 

	<div class="page-content-wrap">

		<div class="block">
        	<div class="col-md-12">    
        		<h1>Asianland Analytics</h1>                                        
                <p>Generates detailed statistics about web application traffic and traffic sources.</p>
            </div>


            
            <div class="col-md-12">                                            
                <p><span class="fa fa-warning"></span> Data analytics data refreshed end of each hour.</p>
            </div>

        </div>
    </div>

</div>

<?php $this->load->view('default/footer'); ?>