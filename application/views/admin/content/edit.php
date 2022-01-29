<?php $this->load->view('admin/header'); ?>
<?php $CI =& get_instance(); ?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php echo $CI->module_title;?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url().'admin/home' ?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url().$CI->module_url_list ?>"><?php echo $CI->module_title;?></a></li>
              <li class="breadcrumb-item active">Edit Content</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card card-primary">
              <div class="card-header">
                <div class="card-title">
                    Edit Item "<?php echo $content['title']; ?>"
                </div>

              </div>

              <div class="card-body">
                  <form name="contentForm" id="contentForm" action=""  method="post" enctype="multipart/form-data">

                    <input type="hidden" name="pkg_id" access="false" id="pkg_id" value="<?php echo isset($_SESSION['admin']['pkg_id'])?$_SESSION['admin']['pkg_id']:''; ?>">

                    <input type="hidden" name="id" access="false" id="id" value="<?php echo $content['id']; ?>">

                    <input type="hidden" name="image_old" access="false" id="image_old" value="<?php echo $content['image']; ?>">

                    <div class="row">
                        <div class="col-sm-4 mb-3">
                            <label for="cat_id" class="formbuilder-number-label">CatId</label>
                            <input type="number" placeholder="Enter CatId" class="form-control" name="cat_id" value="<?php echo $content['cat_id']; ?>" access="false" id="cat_id">
                        </div>
                        <div class="col-sm-4 mb-3">
                            <label for="sub_cat_id" class="formbuilder-number-label">SubCatId</label>
                            <input type="number" placeholder="Enter SubCatId" value="<?php echo $content['sub_cat_id'];?>" class="form-control" name="sub_cat_id" access="false" value="0" id="sub_cat_id">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4 mb-3">
                            <label for="title" class="formbuilder-text-label">Title <span style="color:red">*</span></label>
                            <input type="text" placeholder="Enter Title" value="<?php echo $content['title'];?>" class="form-control" name="title" access="false" id="title">
                        </div>
                        <div class="col-sm-4 mb-3">
                            <label for="description" class="formbuilder-number-label">Description</label>
                            <input type="text" placeholder="Enter Description" value="<?php echo $content['description'];?>" class="form-control" name="description" access="false" id="description">
                        </div>
                        <div class="col-sm-4 mb-3">
                            <label for="link" class="formbuilder-number-label">Link</label>
                            <input type="text" placeholder="Enter link" value="<?php echo $content['link']; ?>" class="form-control" name="link" access="false" id="link">
                        </div>
                    </div>

                    <div class="row">
                         <div class="col-sm-6 mb-3">
                             <label for="image" class="formbuilder-file-label">Image</label>
                             <input type="file" class="form-control" name="image" access="false" multiple="false" id="image">
                             <?php if(!empty($content['image']) && file_exists('./'.path_image_thumb.$content['image'])) {?>
                                <img class="mt-3" src="<?php echo base_url().path_image_thumb.$content['image']; ?>" >
                             <?php } ?>
                         </div>

                          <div class="col-sm-6 mb-3">
                              <label for="radio-group-1642854908703" class="formbuilder-radio-group-label">Visibility</label>
                              <div class="radio-group row">
                                  <div class="ml-3">
                                      <input name="visibility"  id="radio_active" value="1" type="radio" <?php echo ($content['visibility'] == 1) ? 'checked' : ''; ?>>
                                      <label for="radio_active">Active</label>
                                  </div>
                                  <div class="ml-3">
                                      <input name="visibility"  id="radio-deactive" value="0" type="radio" <?php echo ($content['visibility'] == 0) ? 'checked' : ''; ?>>
                                      <label for="radio-deactive">Deactive</label>
                                  </div>
                              </div>
                          </div>
                    </div>

                     <div class="row">
                         <div class="col-sm-6 mb-3">
                             <label for="json_data" class="formbuilder-text-label">Json Data</label>
                             <input type="text" placeholder="Enter Json Data" value="<?php echo $content['json_data']; ?>" class="form-control" name="json_data" access="false" id="json_data">
                         </div>
                         <div class="col-sm-6 mb-3">
                             <label for="other_property" class="formbuilder-text-label">Other Property</label>
                             <input type="text" placeholder="Enter Other Property" value="<?php echo $content['other_property']; ?>" class="form-control" name="other_property" access="false" id="other_property">
                         </div>
                     </div>

                     <div class="formbuilder-button form-group field-submit">
                        <button type="submit" class="btn-success btn" name="submit" access="false" style="success" id="submitBtn">Submit</button>
                    </div>
                  </form>
              </div>

            </div>

          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php $this->load->view('admin/footer'); ?>

<script type="text/javascript">
$(document).ready(function() {
    $("#contentForm").submit(function(e) {
        e.preventDefault();
        $("#submitBtn").prop("disabled", true);

        var formData= new FormData($("#contentForm")[0]);
        console.log('my message' + formData);

        $.ajax({
            type: "POST",
            url: "<?php echo base_url().version_prefix.'database/update_content' ?>",
            data: formData,
            processData: false,
            contentType: false,
            encode: true,
        }).done(function(data) {
            var successURL = "<?php echo base_url().$CI->module_url_list; ?>";
            if(data.status==0){
              showToast(false, data.message);
              $("button[type='submit']").prop("disabled", false);
            } else {
              if(successURL!==null) {
                window.location.href=successURL;
              }
            }
        });
    });
});
</script>