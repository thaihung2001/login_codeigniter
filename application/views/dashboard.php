<h1>Welcome <u><?php echo $this->session->userdata('UserLoginSession')['username']; ?></u> to DashBoard</h1>

<div class="container">
    <div class="card">
        <div class="card-header">
            Upload File
        </div>
        <div class="card-body">
            <form action="<?=base_url('upload')?>" method="post" enctype="multipart/form-data">
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" multiple="" class="custom-file-input" id="uploadfile" name="uploadfile[]" aria-describedby="inputGroupFileAddon04">
                    <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                </div>
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit" name="btn_upload" id="btn_upload">Upload</button>
                    <?php if($this->session->flashdata('message')) {?>
                        <span class="text-primary"><?php echo  $this->session->flashdata('message');?></span>
                    <?php } ?>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>
    


