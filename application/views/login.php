
<div class="card">
  <div class="card-header">
    Login
  </div>
  <div class="card-body">
    <form method="POST" id="loginForm">
    <div class="form-group">
        <label for="exampleInputEmail1">Email </label>
        <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
    
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" name="password" id="password">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
   
 <script type='text/javascript'>
      $(document).ready(function() {
        $('#loginForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('auth'); ?>",
                data: $(this).serialize(),
                dataType: "json",
                success: function(response) {
                    if (response.status) {       
                      //alert(response.message);
                      window.location.href = "<?php echo site_url('dashboard'); ?>";
                    } else {
                        alert(response.message);
                    }
                }
            });
        });
    });
</script>
