<?php
    if (isset($data['msg'])) { ?>
    <div class="alert alert-warning">
        <?php echo $data['msg']; ?>
    </div>
<?php } ?>

<div class="jumbotron table4u_background" id="t4utest">
    <div class="container-fluid">

        <div class="t4u_homepage_text">Find a restaurant that suits your appetite</div>

        <form role="form" action="restaurant/search" method="post">
            <div class="container-fluid t4u_searchbar">
                <div class="row t4u_searchbar_row">
                    <div class="col-md-10 t4u_searchcol">
                        <input class ="search t4u_searchbarSearchInput" type="text" name="search" placeholder="Location or Restaurant" required/>
                    </div>
                    <div class="col-md-2 t4u_searchcol">                    
                        <button class ="btn t4u_searchbarButton" type="submit" value="Find Restaurant" name="submit">Find Restaurant</button>
                    </div>

                    <!--
                    <button class ="btn t4u_searchbarButton" type="submit" value="Find Restaurant" name="submit">Find Restaurant</button>
                </div>-->
                    <!--</div>    -->
                </div>
            </div>
        </form>

        <!--<div class="container">
            <h1>Find a restaurant that suits your appetite</h1>
          <p>Find a restaurant that suits your appetite</p>
          
        </div>-->
    </div>     
</div>  