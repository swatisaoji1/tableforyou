

<h1>Restaurant Administration</h1>


<div class="adminContainer container-fluid">
    <div id = "adminTabContent" class = "tab-content">
        <div class = "tab-pane fade in active" id = "restaurants">
            <div class="form-group"  id="tableAdminApproval">
                <div class="row">
                    <div class="col-md-12">
                        <h3>Approval Required: </h3> 
                    </div>
                </div>
                <div class="row">  
                    <div class="col-md-12">
                        <table class="table table-hover" id="adminTableRestaurantApproval">

                            <tr>
                                <th>Name</th>
                                <th>Address</th>
                                <th>City</th>

                            </tr>
                            <?php foreach ($data as $row) { ?>
                                <tr onclick='t4u_admin_clickable(this)' href_link="<?php echo PUBLIC_ROOT . 'restaurant/details/' . $row['idRestaurants'] ?>">
                                    <td><a target="_blank" href="<?php echo PUBLIC_ROOT . 'restaurant/details/' . $row['idRestaurants'] ?>"><?php echo $row['Name'] ?></a></td>
                                    <td><?php echo $row['Address'] ?></td>
                                    <td><?php echo $row['City'] ?></td>
                                    <!--<td><a target="_blank" href="<?php echo PUBLIC_ROOT . 'restaurant/details/' . $row['idRestaurants'] ?>">Detail</a></td>-->
                                </tr>
                            <?php }; ?>
                        </table>
                    </div>
                </div>
            </div>
            <!--
            <div class="form-group"  id="tableAdminExisting">
                <div class="row">
                    <div class="col-md-12">
                    <h3>Existing Users </h3>
                    </div>
                </div>
                <div class="row">  
                    <div class="col-md-12">
                        <table class="table" id="adminTableRestaurantApproved">

                            <tr>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Date Added</th>

                                <th colspan="3">Action</th>

                            </tr>
                            <tr>
                                <td>John</td>
                                <td>Customer</td>
                                <td>10/18/2015</td>

                                <td><a href="details/<?php echo $row['idRestaurants'] ?>">View</a>&nbsp;&nbsp;<a href="#">Edit</a>&nbsp;&nbsp;<a href="#">Delete</a></td>
                            </tr>


                        </table>
                    </div>
                </div>
            </div>        
            -->
        </div>
        <!--<div class="tab-pane fade" id="users">
            This is the users....
        </div>
        <div class="tab-pane fade" id="settings">
            This is the settings...
        </div>
        <div class="tab-pane fade" id="reviews">
            This is the review...
        </div>-->
    </div>
</div>
