

  <div class="modal fade" id="Modal_education" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><i class="fa fa-remove"></i>
                  </button>
                  <h4 class="card-title">Education Level</h4>
              </div>
              
              <div class="box-body">
                <form class="form-horizontal" method="post">
                      <div class="box-body">
                       <button type="submit" class="btn btn-default" id="add_edd_field"><i class="fa fa-plus"></i></button>
                        <div class="form-group">
                           <label for="inputEmail3" class="col-sm-2 control-label">&nbsp;</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-book"></i></span>
                                    <input type="text" class="form-control" name="up_edinput" id="up_edinput" placeholder="Enter education level">
                                </div>
                            </div>
                        </div>
                      </div>

                      <div class="box-footer">
                        <button type="submit" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-info pull-right" name="up_edbtn" id="up_edbtn">Submit</button>
                      </div>
                    </form>
              </div>
          </div>
      </div>
  </div>
  
  
  <div class="modal fade" id="Modal_location" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><i class="fa fa-remove"></i>
                  </button>
                  <h4 class="card-title">Update Location</h4>
              </div>
              
              <div class="box-body">
                <form class="form-horizontal" method="post">
                      <div class="box-body">
                        <div class="form-group">
                           <label for="inputEmail3" class="col-sm-2 control-label">&nbsp;</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                    <input type="text" class="form-control" name="up_location" id="up_location" placeholder="Enter your Location">
                                </div>
                            </div>
                        </div>
                      </div>

                      <div class="box-footer">
                        <button type="submit" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-info pull-right" name="up_locationbtn" id="up_locationbtn">Submit</button>
                      </div>
                    </form>
              </div>
          </div>
      </div>
  </div>
  
  
    <div class="modal fade" id="Modal_name" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><i class="fa fa-remove"></i>
                  </button>
                  <h4 class="card-title">Update Full name</h4>
              </div>
              
              <div class="box-body">
                <form class="form-horizontal" method="post">
                      <div class="box-body">
                        <div class="form-group">
                           <label for="inputEmail3" class="col-sm-2 control-label">&nbsp;</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" class="form-control" name="up_nameinput" id="up_nameinput" placeholder="Enter your Correct name">
                                </div>
                            </div>
                        </div>
                      </div>

                      <div class="box-footer">
                        <button type="submit" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-info pull-right" name="up_namebtn" id="up_namebtn">Submit</button>
                      </div>
                    </form>
              </div>
          </div>
      </div>
  </div>



  <div class="modal fade" id="Modal_skill" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><i class="fa fa-remove"></i>
                  </button>
                  <h4 class="card-title">Skills Panel</h4>
              </div>
              
              <div class="box-body">
                <form class="form-horizontal" method="post">
                      <div class="box-body">
                       <button type="submit" class="btn btn-default"><i class="fa fa-plus"></i></button>
                        <div class="form-group">
                           <label for="inputEmail3" class="col-sm-2 control-label">&nbsp;</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                                        <select class="form-control select2" style="width: 100%;" name="up_skillinput" id="up_skillinput" onChange="(this.value);">
                                            <option value="">--choose--</option>
                                            <?php 
                                                $sql = "SELECT * FROM tblskills";
                                                $query = $dbh->prepare($sql);
                                                $query->execute();
                                                $results=$query->fetchAll(PDO::FETCH_OBJ);
                                                if($query->rowCount() > 0)
                                                {
                                                    foreach($results as $result)
                                                    {  ?>
                                                        <option value="<?php echo htmlentities($result->skill_ID); ?>"><?php echo htmlentities($result->skill_name); ?></option>
                                                        <?php }
                                                } ?>
                                        </select>
                                </div>
                            </div>
                        </div>
                      </div>

                      <div class="box-footer">
                        <button type="submit" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-info pull-right" name="up_skilbtn" id="up_skilbtn">Submit</button>
                      </div>
                    </form>
              </div>
          </div>
      </div>
  </div>