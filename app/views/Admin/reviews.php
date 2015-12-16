<div class="regContainer container"> 
    <h2>Welcome to the Admin screen</h2><br>
    <form class="form well" role="form" action="home" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <table class="table">

                        <tr>
                            <td colspan="2">
                                <select id="opening_time" name="opening_time" class="form-control" >
                                    <option value="">From</option>
                                    <option value="1:00">1:00</option>
                                    <option value="1:30">1:30</option>
                                    <option value="2:00">2:00</option>
                                    <option value="2:30">2:30</option>
                                    <option value="3:00">3:00</option>
                                    <option value="3:30">3:30</option>
                                    <option value="4:00">4:00</option>
                                    <option value="4:30">4:30</option>
                                    <option value="5:00">5:00</option>
                                    <option value="5:30">5:30</option>
                                    <option value="6:00">6:00</option>
                                    <option value="6:30">6:30</option>
                                    <option value="7:00">7:00</option>
                                    <option value="7:30">7:30</option>
                                    <option value="8:00">8:00</option>
                                    <option value="8:30">8:30</option>
                                    <option value="9:00">9:00</option>
                                    <option value="9:30">9:30</option>
                                    <option value="10:00">10:00</option>
                                    <option value="10:30">10:30</option>
                                    <option value="11:00">11:00</option>
                                    <option value="11:30">11:30</option>
                                    <option value="12:00">12:00</option>
                                    <option value="12:30">12:30</option>                   
                                </select>
                            </td>
                            <td colspan="1">
                                <select  id="o_time_specify" name="o_time_specify" class="form-control" >
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>                  
                                </select>
                            </td>

                            <td colspan="1">to</td>
                            <td colspan="2">
                                <select  id="closing_time" name="closing_time"class="form-control" >
                                    <option value="">To</option>
                                    <option value="1:00">1:00</option>
                                    <option value="1:30">1:30</option>
                                    <option value="2:00">2:00</option>
                                    <option value="2:30">2:30</option>
                                    <option value="3:00">3:00</option>
                                    <option value="3:30">3:30</option>
                                    <option value="4:00">4:00</option>
                                    <option value="4:30">4:30</option>
                                    <option value="5:00">5:00</option>
                                    <option value="5:30">5:30</option>
                                    <option value="6:00">6:00</option>
                                    <option value="6:30">6:30</option>
                                    <option value="7:00">7:00</option>
                                    <option value="7:30">7:30</option>
                                    <option value="8:00">8:00</option>
                                    <option value="8:30">8:30</option>
                                    <option value="9:00">9:00</option>
                                    <option value="9:30">9:30</option>
                                    <option value="10:00">10:00</option>
                                    <option value="10:30">10:30</option>
                                    <option value="11:00">11:00</option>
                                    <option value="11:30">11:30</option>
                                    <option value="12:00">12:00</option>
                                    <option value="12:30">12:30</option>                   
                                </select>
                            </td>
                            <td colspan="1">
                                <select id="c_time_specify" name="c_time_specify" class="form-control" >
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>                  
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <h2>Reviews </h2> 
            </div>
            <div class="row">  
                <div class="col-md-12">

                    <table class="table-bordered">

                        <tr>
                            <th>Name</th>
                            <th>Approve</th>
                        </tr>

                        <tr>
                            <td>Restaurant 1</td>
                            <td><input type="checkbox" value="approved" /></td>
                        </tr>

                        <tr>
                            <td>Restaurant 2</td>
                            <td><input type="checkbox" value="approved" /></td>
                        </tr>

                        <tr>

                            <td>Restaurant 3</td>
                            <td><input type="checkbox" value="approved" /></td>
                        </tr>

                        <tr>

                            <td>Restaurant 4</td>
                            <td><input type="checkbox" value="approved" /></td>
                        </tr>

                    </table>

                </div>


            </div>
        </div>
    </form>
</div>



