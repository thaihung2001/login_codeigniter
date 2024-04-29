<div class="card">
  <div class="card-header">
    Login
  </div>
  <div class="card-body">
    <form method="POST" action="<?=base_url('auth')?>">
    <div class="form-group">
        <label for="exampleInputEmail1">Email </label>
        <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
    
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" name="password" id="password">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <?php if($this->session->flashdata('login_fail')){ ?>
        <span class="text-danger"><?= $this->session->flashdata('login_fail')?></span>
    <?php } ?>
    </form>
  </div>
</div>