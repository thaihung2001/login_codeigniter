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
<div class="container">
  <table class='table'>
    <thead>
      <td>STT</td>
      <td>Email</td>
      <td>IP_Address</td>
      <td>Time</td>
      <td>Total</td>
      <td>User Name</td>
    </thead>
    <tbody>
      <?php if(isset($logs)!=FALSE){
        //var_dump($logs);die();
          $i=1;
          foreach ($logs as $log) {
      ?>
        <tr>
          <td><?php echo $i;?></td>
          <td><?php echo $log['email']; ?></td>
          <td><?php echo $log['ip_address']; ?></td>
          <td><?php echo date('d/m/Y H:i:s', strtotime($log['max_time'])); ?></td>
          <td><?php echo $log['count'];?></td> 
          <td><?php if(isset($log['username'])){echo $log['username'];}else{echo '';} ?></td>
        </tr>
      <?php 
          $i++;
          }
        }
      ?>
    </tbody>
  </table>
</div>

<script type='text/javascript'>
   // lấy data failed login
   /* function loadFailedLogin() {
      $.ajax({
        url: "<?php //echo site_url('loadFailedLogin'); ?>",
        type: "GET",
        dataType: "json",
        success: function(response) {
          // Xử lý dữ liệu nhận được
          console.log(response.logs);
          $(".table tbody").empty();
          $.each(response.logs, function(index, item) {
            let $row = $("<tr>");
            $row.append($("<td>").text(index + 1)); // STT
            $row.append($("<td>").text(item.email));
            $row.append($("<td>").text(item.ip_address));
            $row.append($("<td>").text(item.time));
            $row.append($("<td>").text(item.counts));
            $(".table tbody").append($row); // Thêm hàng vào tbody của bảng
          });
        },
        error: function(xhr, status, error) {
          // Xử lý lỗi nếu có
          console.log('Lỗi');
        }
      });
    } */
  $(document).ready(function() {

    //loadFailedLogin(); // Gọi lần 1 khi load trang

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
           // loadFailedLogin(); // gọi lần 2 khi login fail
            alert(response.message);
          }
        }
      });
    });
  });
</script>