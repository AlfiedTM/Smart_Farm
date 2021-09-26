<!-- Delete Record -->
 <div class="modal fade" id="elete" role="dialog"> 
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Deleting...</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" action="">
                  <?php
                $id = $_POST['Delete'];
                $sql="Select Admin_name from admin where ID ='$id'";
                $result= $Conn ->query($sql);
                $row = $result->fetch_assoc();
               ?>
                <div class="text-center">
                    <p>DELETE ADMIN ACCOUNT</p>
                    <h2 class="bold fullname"><?php echo $row['Admin_name'];?></h2>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" style="background:black; color:white" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" style="background:black; color:white" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>
              </form>
             <?php if(isset($_POST['delete'])){
                //  $id = $_POST['Delete'];
        $sql = "DELETE FROM admin WHERE ID ='$id'";
        $result=$Conn->query($sql);

     
       
      }
      ?>
            </div>
        </div>
    </div>
</div>

<!-- Plant Record Delete -->
<div class="modal fade" id="plant_elete" role="dialog"> 
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Deleting...</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" action="">
                  <?php
                $id = $_POST['Delete'];
                $sql="Select Plant_name from plant _records where ID ='$id'";
                $result= $Conn ->query($sql);
                $row = $result->fetch_assoc();
               ?>
                <div class="text-center">
                    <p>DELETE PLANT RECORD</p>
                    <h2 class="bold fullname"><?php echo $row['Plant_name'];?></h2>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" style="background:black; color:white" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" style="background:black; color:white" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>
              </form>
             <?php if(isset($_POST['delete'])){
                //  $id = $_POST['Delete'];
        $sql = "DELETE FROM plant_records WHERE ID ='$id'";
        $result=$Conn->query($sql);
      }
      ?>
            </div>
        </div>
    </div>
</div>